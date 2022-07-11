@extends('templates.mhs')

@section('content')

    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Daftar Kelompok</h5>
                    @if (@$matkum)
                        <div class="mt-0">
                            @foreach ($matkum as $row)
                                <a href="{{ route('mhs.kelompok', $row->id_mp) }}"
                                    class="btn btn-sm {{ (Request::segment(2) ?? 1) == $row->id_mp ? 'btn-primary' : 'btn-outline-primary' }}">{{ $row->matkum->nama_mp }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-body">

                    @if (@$kelompok && @$anggota)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="3" class="px-0 pb-0">
                                        <h4>{{ strtoupper($kelompok->nm_kel) }}</h4>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="px-0">
                                        Tanggal Ujian : {{ Date::tglIndo($kelompok->tgl_ujian) }}
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="px-0">
                                        Dosen Pembimbing : {{ $kelompok->pbb->nama }}
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="px-0">
                                        Dosen Pembimbing : {{ $kelompok->pgj->nama }}
                                    </th>
                                </tr>
                                <tr class="table-primary">
                                    <th>Foto</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($anggota as $row)
                                    <tr>
                                        <td>foto.jpg</td>
                                        <td>{{ $row->mhs->nim }}</td>
                                        <td>{{ strtoupper($row->mhs->nama) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger mb-0">
                            Kelompok masih belum dibentuk!
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
