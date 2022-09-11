@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Praktikum /</span> Praktikum Diambil</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Detail Pendaftaran</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr>
                                <th>Nama : {{ $pendaftar->mhs->nama }}</th>
                            </tr>
                            <tr>
                                <th>NRP : {{ $pendaftar->mhs->username }}</th>
                            </tr>
                            <tr>
                                <th>Periode Praktikum : {{ $pendaftar->periode->thn_ajaran }}</th>
                            </tr>

                        </table>

                        <table class="table table-striped mt-1">
                            <tr class="table-primary">
                                <th>Nama Matkul</th>
                                <th>Harga</th>
                            </tr>
                            @php($total = 0)
                            @foreach ($detail_daftar_matkum as $row)
                                <tr>
                                    <td>{{ $row->matkum->nama_mp }}</td>
                                    <td>Rp. {{ number_format($row->matkum->harga) }}</td>
                                </tr>
                                @php($total += $row->matkum->harga)
                            @endforeach

                            <tr>
                                <th>
                                    <h5 class="mb-0">Total Biaya : Rp. {{ number_format($total) }}</h5>
                                </td>
                                <th>
                                    <form class="d-inline" action="{{ route('adm.prak.bayar') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="kode_daftar" value="{{ Request::segment(4) }}">
                                        <button type="submit" class="btn btn-warning">Bayar</button>
                                    </form>

                                    <form class="d-inline" action="{{ route('adm.prak.accfix') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="kode_daftar" value="{{ Request::segment(4) }}">
                                        <input type="hidden" name="kode_mhs" value="{{ $pendaftar->mhs->id_user }}">
                                        <button type="submit" class="btn btn-success">Terima</button>
                                    </form>
                                </th>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
