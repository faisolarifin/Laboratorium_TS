@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Master /</span> Praktikum</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Praktikum</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr class="table-primary">
                                <td width="20">No.</td>
                                <td width="330">Nama Praktikum</td>
                                <td width="190">Harga</td>
                                <td>Deskripsi</td>
                                <td width="130">Aksi</td>
                            </tr>
                            @php($no = 0)
                            @foreach ($matkum as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $row->nama_mp }}</td>
                                    <td>Rp. {{ number_format($row->harga, 2) }}</td>
                                    <td>{{ $row->deksripsi ?? '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info">!</button>
                                        <form class="d-inline" action="{{ route('adm.prak.bayar') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="kode_mhs" value="{{ $row->id_mp }}">
                                            <button type="submit" class="btn btn-sm btn-danger">x</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
