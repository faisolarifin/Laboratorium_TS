@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Penyewaan /</span> Sewa</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Daftar Penyewaan</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Nama Penyewa</th>
                                    <th>Nama Alat</th>
                                    <th>Tgl Permohonan</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Jumlah</th>
                                    <th>Total Biaya</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($no = 0)
                                @foreach ($penyewa as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->user->nama }}</td>
                                        <td>{{ $row->alat->nm_alat }}</td>
                                        <td>{{ Date::tglReverse($row->tgl_permohonan) }}</td>
                                        <td>{{ Date::tglReverse($row->tgl_sewa) }}</td>
                                        <td>{{ Date::tglReverse($row->tgl_kembali) }}</td>
                                        <td>{{ $row->jumlah }}</td>
                                        <td><strong>Rp.{{ number_format($row->total_biaya, 2) }}</strong></td>
                                        <td><span class="badge {{ ($row->status == 'selesai') ? 'bg-success' : (($row->status == 'sewa') ? 'bg-info' : 'bg-warning') }}">{{ $row->status }}</td>
                                        <td>
                                            @if($row->status == 'permohonan')
                                            <form class="d-inline" action="{{route('adm.sewa.st')}}" method="post" title="setujui penyewaan">
                                                @csrf
                                                <input type="hidden" name="kode_sewa" value="{{ $row->id_sewa }}">
                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                    <span class="tf-icons bx bx-pie-chart-alt"></span>
                                                </button>
                                            </form>
                                            @elseif($row->status == 'sewa')
                                            <form class="d-inline" action="{{route('adm.sewa.fs')}}" method="post" title="penyewaan selesai">
                                                @csrf
                                                <input type="hidden" name="kode_sewa" value="{{ $row->id_sewa }}">
                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                    <span class="tf-icons bx bx-check-double"></span>
                                                </button>
                                            </form>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                    <span class="tf-icons bx bx-x"></span>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($row->status != 'permohonan')
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            @if($row->status == 'sewa')
                                            <form class="d-inline" action="{{route('adm.sewa.export.bap')}}" method="post" title="Download BA Peminjaman">
                                                @csrf
                                                <input type="hidden" name="kode_sewa" value="{{ $row->id_sewa }}">
                                                <button type="submit" class="btn btn-sm btn-warning">Cetak BA Peminjaman</button>
                                            </form>
                                            <form class="d-inline" action="{{route('adm.sewa.export.bp')}}" method="post" title="Download Bukti Peminjaman">
                                                @csrf
                                                <input type="hidden" name="kode_sewa" value="{{ $row->id_sewa }}">
                                                <button type="submit" class="btn btn-sm btn-secondary">Cetak Bukti Peminjaman</button>
                                            </form>
                                            @elseif($row->status == 'selesai')
                                            <form class="d-inline" action="{{route('adm.sewa.export.sbt')}}" method="post" title="Download Surat Bebas Tanggungan">
                                                @csrf
                                                <input type="hidden" name="kode_sewa" value="{{ $row->id_sewa }}">
                                                <button type="submit" class="btn btn-sm btn-primary">Cetak Surat Bebas Tanggungan</button>
                                            </form>
                                            @endif
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
