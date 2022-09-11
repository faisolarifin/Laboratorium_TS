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
                        <a href="{{ route('adm.master.fmatkum') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i></button></a>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th width="20">No.</th>
                                    <th width="330">Nama Praktikum</th>
                                    <th width="190">Harga</th>
                                    <th>Deskripsi</th>
                                    <th width="130">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($no = 0)
                                @foreach ($matkum as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->nama_mp }}</td>
                                        <td>Rp. {{ number_format($row->harga, 2) }}</td>
                                        <td>{{ $row->deksripsi ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('adm.master.ematkum', $row->id_mp) }}"><button
                                                    class="btn btn-sm btn-info"><i class='bx bxs-edit'></i></button></a>
                                            <form class="d-inline" action="{{ route('adm.master.dmatkum') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="kode_prak" value="{{ $row->id_mp }}">
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
