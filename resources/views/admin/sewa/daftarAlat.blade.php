@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Penyewaan /</span> Alat</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Daftar Alat</h5>
                        <a href="{{ route('adm.sewa.alat.t') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i></button></a>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">Nama Alat</th>
                                    <th colspan="2" class="text-center">Biaya Sewa Perhari</th>
                                    <th rowspan="2">Jumlah</th>
                                    <th rowspan="2">Kodisi</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Umum</th>
                                    <th>Dosen/Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($no = 0)
                                @foreach ($alat as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->nm_alat }}</td>
                                        <td>Rp. {{ number_format($row->biaya_umum, 2) }}</td>
                                        <td>Rp. {{ number_format($row->biaya_khusus, 2) }}</td>
                                        <td>{{ $row->jumlah }}</td>
                                        <td>{{ $row->kondisi }}</td>
                                        <td>
                                            <a href="{{ route('adm.sewa.alat.e', $row->id_alat) }}"><button
                                                    class="btn btn-sm btn-info"><i class='bx bxs-edit'></i></button></a>
                                            <form class="d-inline" action="{{ route('adm.sewa.alat.d') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="kode_alat" value="{{ $row->id_alat }}">
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class='bx bx-trash-alt'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
