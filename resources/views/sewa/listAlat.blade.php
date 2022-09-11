@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Daftar Alat</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="mytable">
                        <thead>
                            <tr class="table-primary">
                                <th rowspan="2">#</th>
                                <th rowspan="2">Nama Alat</th>
                                <th colspan="2" class="text-center">Biaya Sewa Perhari</th>
                                <th rowspan="2">Jumlah Tersedia</th>
                                <th rowspan="2">Kodisi</th>
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
