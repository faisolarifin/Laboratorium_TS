<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use App\Helpers\Date;

use App\Models\Praktikum\{
    DaftarAnggotaKelompok,
    DaftarKelompok,
    JadwalPraktikum,
    PendaftarAcc,
    PendaftarAccd,
};

use App\Models\{
    Dosen,
    Setting,
};

class AdminExport extends Controller
{
    public function exportDaftarHadir(Request $request)
    {
        //Open template with ${table}
        $template_document = new TemplateProcessor(storage_path('word/praktikum/').'Daftar_Hadir_Praktikum.docx');
        
        //Create table
        $document_with_table = new PhpWord();

        $KelbyId= DaftarKelompok::where([
            'id_kel' => $request->kode_kel,
        ])->with('periode')->with('matkum')->first();
        
        // Replace mark by xml code of table
        $template_document->setValue('praktikum', strtoupper($KelbyId->matkum->nama_mp));
        $template_document->setValue('semester', $KelbyId->periode->thn_ajaran);
        $template_document->setValue('thn', strtoupper($KelbyId->periode->semester));
        $template_document->setValue('tanggal', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        
        $section = $document_with_table->addSection();

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000', 
            'afterSpacing' => 3, 
            'Spacing'=> 0, 
            'cellMargin'=> 0,
        ]);
        $fStyle = ['name' => 'Cambria', 'size' => '9', 'color' => '000', 'bold' => true, 'italic' => false];   
        $pStyle = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $pStyle2 = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(5));
        $hStyle = array("spaceAfter" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $style = array('bgColor' => 'dddddd');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
        $cellRowContinue = array('vMerge' => 'continue');
              
        $jadwal = JadwalPraktikum::where([
            'id_kel' => $request->kode_kel
        ])->get();

        if ($jadwal->isEmpty()) return redirect()->back()->with('error', 'Jadwal praktikum belum ditentukan!');

        foreach($jadwal as $row){
            $table->addRow(300);
            $table->addCell(null, ['gridSpan' => 2, 'borderColor' =>'ffffff',
            'borderSize' => 6,])->addText("Hari/Tanggal", ['bold' => true], $hStyle);
            $table->addCell(null, ['gridSpan' => 3, 'borderColor' =>'ffffff',
            'borderSize' => 6,])->addText(Date::hariIni($row->tgl_prak).', '. Date::tglIndo($row->tgl_prak), ['bold' => true], $hStyle);
            
            $table->addRow(350);
            $table->addCell(850, $style)->addText('NO', $fStyle, $pStyle);
            $table->addCell(1750, $style)->addText('N P M', $fStyle, $pStyle);
            $table->addCell(3550, $style)->addText('NAMA MAHASISWA', $fStyle, $pStyle);
            $table->addCell(1750, $style)->addText('KELOMPOK', $fStyle, $pStyle);
            $table->addCell(2450, $style)->addText('TANDA TANGAN', $fStyle, $pStyle);
            
            $no=0;
            foreach(
                DaftarAnggotaKelompok::where([
                    'id_kel' => $request->kode_kel
                ])->with('mhs')->get() as $tb){ 

                $table->addRow(450);
                $table->addCell()->addText(++$no, $fStyle, $pStyle2);
                $table->addCell()->addText($tb->mhs->nim, $fStyle, $pStyle2);
                $table->addCell()->addText(strtoupper($tb->mhs->nama), $fStyle, $pStyle2);
                if ($no==1) {
                    $table->addCell(1750, $cellRowSpan)->addText(strtoupper($KelbyId->nm_kel), $fStyle, ['align' => 'center']);
                }else {
                    $table->addCell(null, $cellRowContinue);
                }
                $table->addCell();            
            }
            $table->addRow(450);
            $table->addCell(null,  ['gridSpan' => 5, 'borderColor' =>'ffffff','borderSize' => 1]);
        }                
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table, 'Word2007');
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        
        $template_document->setValue('table', $tablexml);

        $filename = "Daftar_Hadir_Praktikum-{$KelbyId->matkum->nama_mp}.docx";

        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }

    public function exportPenjadwalan(Request $request)
    {
        $periode_id = Setting::find(1)->periode_aktif;
        $head = DaftarKelompok::where([
            'id_periode' => $periode_id,
            'id_mp' => $request->kode_mp,
        ])->with('periode')->with('matkum')->first();

        $kelompok = DaftarKelompok::where([
            'id_periode' => $periode_id,
            'id_mp' => $request->kode_mp,
        ])->with('pbb')
        ->with('pgj')
        ->with('pgj2')
        ->with(['detail' => function($q){
            $q->with('mhs');
        }])
        ->with('jadwal')->get();

        if ($kelompok->isEmpty()) return redirect()->back()->with('error', 'Kelompok belum ditentukan!');

        //Open template with ${table}
        $template_document = new TemplateProcessor(storage_path('word/praktikum/').'Penjadwalan.docx');
        
        //Create table
        $document_with_table = new PhpWord();

        // Replace mark by xml code of table
        $template_document->setValue('praktikum', strtoupper($head->matkum->nama_mp));
        $template_document->setValue('semester', strtoupper($head->periode->semester));
        $template_document->setValue('thn', strtoupper($head->periode->thn_ajaran));
        $template_document->setValue('tanggal', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        $template_document->setValue('kaprodi', Setting::find(1)->kaprodi);
        $template_document->setValue('kalab', Setting::find(1)->kalab);
        
        $section = $document_with_table->addSection();

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000', 
            'afterSpacing' => 3, 
            'Spacing'=> 0, 
            'cellMargin'=> 0,
        ]);
        $fStyle = ['name' => 'Cambria', 'size' => '9', 'color' => '000', 'bold' => true, 'italic' => false];   
        $pStyle = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $pStyle2 = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(5));
        $hStyle = array("spaceAfter" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $style = array('bgColor' => 'dddddd');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
        $cellRowContinue = array('vMerge' => 'continue');
              
        $no=0;
        $table->addRow(350);
        $table->addCell(850, $style)->addText('NO', $fStyle, $pStyle);
        $table->addCell(1750, $style)->addText('N P M', $fStyle, $pStyle);
        $table->addCell(2550, $style)->addText('NAMA', $fStyle, $pStyle);
        $table->addCell(2150, $style)->addText('KELOMPOK ASISTEN PRAKTIKUM', $fStyle, $pStyle);
        $table->addCell(2450, $style)->addText('JADWAL PRAKTIKUM', $fStyle, $pStyle);

        foreach($kelompok as $row){
            $i=1;
            foreach ($row->detail as $d) {
                $table->addRow(350);
                $table->addCell()->addText(++$no, $fStyle, $pStyle2);
                $table->addCell()->addText($d->mhs->nim, $fStyle, $pStyle2);
                $table->addCell()->addText(strtoupper($d->mhs->nama), $fStyle, $pStyle2);          
                if ($i==1) {
                    $c1 = $table->addCell(1750, $cellRowSpan);
                    $c1->addText(strtoupper($row->nm_kel), $fStyle, ['align' => 'center']);
                    $c1->addText(strtoupper($row->asprak), $fStyle, ['align' => 'center']);
                    $c2 = $table->addCell(1750, $cellRowSpan);
                    foreach($row->jadwal as $j){
                         $c2->addText(Date::hariIni($j->tgl_prak).', '.Date::tglIndo($j->tgl_prak), $fStyle, ['align' => 'center']);
                    }
                }else {
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(null, $cellRowContinue);
                }
                $i++;
            }
        }         
                       
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table, 'Word2007');
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        
        $template_document->setValue('table', $tablexml);

        //Create table 2
        $document_with_table2 = new PhpWord();

        $section = $document_with_table2->addSection();

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000', 
            'afterSpacing' => 3, 
            'Spacing'=> 0, 
            'cellMargin'=> 0,
        ]);
        
        $no=0;
        $table->addRow(350);
        $table->addCell(850, $style)->addText('NO', $fStyle, $pStyle);
        $table->addCell(1750, $style)->addText('N P M', $fStyle, $pStyle);
        $table->addCell(2550, $style)->addText('NAMA', $fStyle, $pStyle);
        $table->addCell(2150, $style)->addText('KELOMPOK PEMBIMBING', $fStyle, $pStyle);
        $table->addCell(2450, $style)->addText('DOSEN PENGUJI', $fStyle, $pStyle);

        foreach($kelompok as $row){
            $i=1;
            foreach ($row->detail as $d) {
                $table->addRow(350);
                $table->addCell()->addText(++$no, $fStyle, $pStyle2);
                $table->addCell()->addText($d->mhs->nim, $fStyle, $pStyle2);
                $table->addCell()->addText(strtoupper($d->mhs->nama), $fStyle, $pStyle2);          
                if ($i==1) {
                    $c1 = $table->addCell(1750, $cellRowSpan);
                    $c1->addText(strtoupper($row->nm_kel), $fStyle, ['align' => 'center']);
                    $c1->addText(strtoupper($row->pbb->nama), $fStyle, ['align' => 'center']);
                    $c2 = $table->addCell(1750, $cellRowSpan);
                    $c2->addText(strtoupper($row->pgj->nama), $fStyle, ['align' => 'center']);
                    $c2->addText(strtoupper($row->pgj2->nama), $fStyle, ['align' => 'center']);
                }else {
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(null, $cellRowContinue);
                }
                $i++;
            }
        } 
               
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table2, 'Word2007');
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        
        $template_document->setValue('table2', $tablexml);

        $filename = "KELOMPOK DAN JADWAL PRAKTIKUM.docx";

        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }

    public function exportDafdirPerMatkum(Request $request)
    {
        //Open template with ${table}
        $template_document = new TemplateProcessor(storage_path('word/praktikum/').'Dafdir_Mahasiswa_Ujian.docx');

        //Create table
        $document_with_table = new PhpWord();
    
        $acc = PendaftarAcc::where([
            'id_daftar' => $request->kode_daftar,
        ])->with('periode')->with('matkum')->first();
        
        // Replace mark by xml code of table
        $template_document->setValue('praktikum', $acc->matkum->nama_mp);
        $template_document->setValue('semester', $acc->periode->semester);
        $template_document->setValue('thn', $acc->periode->thn_ajaran);
        $template_document->setValue('tanggal', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        
        $section = $document_with_table->addSection();

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000', 
            'afterSpacing' => 3, 
            'Spacing'=> 0, 
            'cellMargin'=> 0,
        ]);

        $fStyle = ['name' => 'Cambria', 'size' => '12', 'color' => '000', 'bold' => true, 'italic' => false];
        $pStyle = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $pStyle2 = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(5));
        $style = array('bgColor' => 'dddddd');

        $table->addRow(650);
        $table->addCell(850, $style)->addText('NO', $fStyle, $pStyle);
        $table->addCell(1750, $style)->addText('N P M', $fStyle, $pStyle);
        $table->addCell(4550, $style)->addText('NAMA MAHASISWA', $fStyle, $pStyle);
        $table->addCell(3550, $style)->addText('TANDA TANGAN', $fStyle, $pStyle);

        $no=0;
        $list_pendaftar = PendaftarAccd::where([
            'id_daftar' => $request->kode_daftar,
            ])->with('mhs')->get();
        foreach($list_pendaftar as $row)
        {
            $table->addRow(650);
            $table->addCell()->addText(++$no, $fStyle, $pStyle2);
            $table->addCell()->addText($row->mhs->nama, $fStyle, $pStyle2);
            $table->addCell()->addText($row->mhs->nim, $fStyle, $pStyle2);
            $table->addCell();  
        }
        
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table, 'Word2007');     
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        
        $template_document->setValue('table', $tablexml);
        //save template with table
        $filename = "Dafdir_Mhs_Ujian-{$acc->matkum->nama_mp}.docx";

        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }

    public function exportDafdirPenguji(Request $request)
    {
        $periode_id = Setting::find(1)->periode_aktif;
        $kel = DaftarKelompok::where([
            'id_mp' => $request->kode_mp,
            'id_periode' => $periode_id,
        ])->with('periode')->with('matkum')->first();

        $dosen = array();
        foreach(DaftarKelompok::select('penguji','penguji2')->where([
            'id_periode' => $periode_id,
            'id_mp' => $request->kode_mp,
        ])->with('pgj')->with('pgj2')->get() as $row) {
            array_push($dosen, $row->pgj->nama, $row->pgj2->nama);
        }
        $dosen = array_unique($dosen);
        if (count($dosen) <= 0) return redirect()->back()->with('error', 'Dosen penguji belum ditentukan!');

        $template_document = new TemplateProcessor(storage_path('word/praktikum/').'Dafdir_Dosen_Penguji.docx');

        //Create table
        $document_with_table = new PhpWord();
    
        $template_document->setValue('praktikum', $kel->matkum->nama_mp);
        $template_document->setValue('thn', $kel->periode->thn_ajaran);
        $template_document->setValue('tanggal', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        $template_document->setValue('dekan', Setting::find(1)->dekan);
        
        $section = $document_with_table->addSection();

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000', 
            'afterSpacing' => 3, 
            'Spacing'=> 0, 
            'cellMargin'=> 0,
        ]);

        $fStyle = ['name' => 'Cambria', 'size' => '12', 'color' => '000', 'bold' => true, 'italic' => false];
        $fStyleNama = ['name' => 'Cambria', 'size' => '12', 'color' => '000', 'bold' => false, 'italic' => false];
        $pStyle = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $pStyleNama = array('align' => 'left', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $pStyle2 = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(5));
        $style = array('bgColor' => 'dddddd');

        $table->addRow(650);
        $table->addCell(850, $style)->addText('NO', $fStyle, $pStyle);
        $table->addCell(4550, $style)->addText('NAMA', $fStyle, $pStyle);
        $table->addCell(4550, $style)->addText('TANDA TANGAN', $fStyle, $pStyle);

        $no=0;
        foreach($dosen as $row)
        {
            $table->addRow(650);
            $table->addCell()->addText(++$no, $fStyle, $pStyle2);
            $table->addCell()->addText($row, $fStyleNama, $pStyleNama);
            $table->addCell();  
        }
        
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table, 'Word2007');     
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        
        $template_document->setValue('table', $tablexml);
        //save template with table
        $filename = "Dafdir_Dosen_Penguji-{$kel->matkum->nama_mp}.docx";

        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }

    public function exportBAUjianPerMatkum(Request $request)
    {
        //Open template with ${table}
        $template_document = new TemplateProcessor(storage_path('word/praktikum/').'BA_Ujian.docx');

        //Create table
        $document_with_table = new PhpWord();
    
        $kel = DaftarKelompok::where([
            'id_kel' => $request->kode_kel,
        ])->with('pgj')->with('pgj2')->with('matkum')->first();

        if ($kel->tgl_ujian == null) return redirect()->back()->with('error', 'Tanggal ujian belum ditentukan!');
        if ($request->penguji==1 && $kel->penguji == null) return redirect()->back()->with('error', 'Dosen penguji belum ditentukan!');
        if ($request->penguji==2 && $kel->penguji2 == null) return redirect()->back()->with('error', 'Dosen penguji belum ditentukan!');
        
        // Replace mark by xml code of table
        $template_document->setValue('praktikum', strtoupper($kel->matkum->nama_mp));
        $template_document->setValue('hari', $kel->periode->semester);
        $template_document->setValue('kelompok', strtoupper($kel->nm_kel));
        $template_document->setValue('tanggal', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        $template_document->setValue('tglujian', Date::tglIndo($kel->tgl_ujian));
        $template_document->setValue('penguji', ($request->penguji==1) ? $kel->pgj->nama : $kel->pgj2->nama);
        
        $section = $document_with_table->addSection();

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000', 
            'afterSpacing' => 3, 
            'Spacing'=> 0, 
            'cellMargin'=> 0,
        ]);

        $fStyle = ['name' => 'Cambria', 'size' => '12', 'color' => '000', 'bold' => true, 'italic' => false];
        $pStyle = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $pStyle2 = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(5));
        $style = array('bgColor' => 'dddddd');

        $no=0;
        $list_pendaftar = DaftarAnggotaKelompok::where([
            'id_kel' => $request->kode_kel,
            ])->with('mhs')->get();
        foreach($list_pendaftar as $row)
        {
            $table->addRow(650);
            $table->addCell(550)->addText(++$no, $fStyle, $pStyle2);
            $table->addCell(1450)->addText($row->mhs->nim, $fStyle, $pStyle2);
            $table->addCell(3170)->addText($row->mhs->nama, $fStyle, $pStyle2);
            $table->addCell(1360);    
            $table->addCell(1360);    
            $table->addCell(1360);    
            $table->addCell(1360);    
        }
        
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table, 'Word2007');     
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        
        $template_document->setValue('table', $tablexml);
        $filename = "BA_Ujian-{$kel->matkum->nama_mp}(Penguji {$request->penguji}).docx";

        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }

    public function exportBAPelaksanaanPerMatkum(Request $request)
    {
        //Open template with ${table}
        $template_document = new TemplateProcessor(storage_path('word/praktikum/').'BA_Pelaksanaan_Praktikum.docx');
        //Create table
        $document_with_table = new PhpWord();
    
        $kel = DaftarKelompok::where([
            'id_kel' => $request->kode_kel,
        ])->with('matkum')->first();

        if ($kel->asprak == null) return redirect()->back()->with('error', 'Asistem Praktikum belum ditentukan!');

        // Replace mark by xml code of table
        $template_document->setValue('praktikum', strtoupper($kel->matkum->nama_mp));
        $template_document->setValue('semester', strtoupper($kel->periode->semester));
        $template_document->setValue('tahun', $kel->periode->thn_ajaran);
        $template_document->setValue('kelompok', strtoupper($kel->nm_kel));
        $template_document->setValue('asprak', $kel->asprak);
        $template_document->setValue('tanggal', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        
        $section = $document_with_table->addSection();

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000', 
            'afterSpacing' => 3, 
            'Spacing'=> 0, 
            'cellMargin'=> 0,
        ]);

        $fStyle = ['name' => 'Cambria', 'size' => '9', 'color' => '000', 'bold' => true, 'italic' => false];
        $pStyle = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(3));
        $pStyle2 = array('align' => 'center', "spaceBefore" => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(5));
        $style = array('bgColor' => 'dddddd');

        $no=0;
        $list_pendaftar = DaftarAnggotaKelompok::where([
            'id_kel' => $request->kode_kel,
            ])->with('mhs')->get();
        foreach($list_pendaftar as $row)
        {
            $table->addRow(380);
            $table->addCell(550)->addText(++$no, $fStyle, $pStyle2);
            $table->addCell(1450)->addText($row->mhs->nim, $fStyle, $pStyle2);
            $table->addCell(3170)->addText($row->mhs->nama, $fStyle, $pStyle2);
            $table->addCell(1360);    
            $table->addCell(1360);    
            $table->addCell(1360);    
            $table->addCell(1360);    
        }
        
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table, 'Word2007');     
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        
        $template_document->setValue('table', $tablexml);

        $filename = "BA_Pelaksanaan_Ujian-{$kel->matkum->nama_mp}.docx";

        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }

    public function exportSertifikat(Request $request)
    {
        $tmp = array(
            'Sertifikat Laboratorium - Bahan.docx',
            'Sertifikat Laboratorium - IUT.docx',
            'Sertifikat Laboratorium - Perpetaan.docx',
            'Sertifikat Laboratorium - Hidrolika.docx',
            'Sertifikat Laboratorium - Jalan Raya.docx',
            'Sertifikat Laboratorium - Mektan.docx',
            'Sertifikat Laboratorium - Beton.docx',
        );

        $angg = DaftarAnggotaKelompok::where([
            'id_kel' => $request->kode_kel,
            'id_mhs' => $request->kode_mhs,
        ])->with('parent')->with('mhs')->first();
        
        $template_document = new TemplateProcessor(storage_path('word/sertifikat/').$tmp[$angg->parent->id_mp - 1]);
        
        $template_document->setValue('nama', strtoupper($angg->mhs->nama));
        $template_document->setValue('nim', $angg->mhs->nim);
        $template_document->setValue('nilai', $angg->nilai);
        $template_document->setValue('tglujian', Date::tglIndo($angg->parent->tgl_ujian));
        $template_document->setValue('tglbawah', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        $template_document->setValue('dekan', Setting::find(1)->dekan);
        $template_document->setValue('kalab', Setting::find(1)->kalab);
 
        $filename = "Sertifikat-{$angg->mhs->nama}.docx";
        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }
}
