@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Master /</span> Pengguna</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Pengguna</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>TTL</th>
                                    <th>Alamat</th>
                                    <th>No. HP</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($no = 0)
                                @foreach ($user as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td><img src="{{ Storage::url($row->foto) }}" class="rounded" width="40"
                                                height="40" alt=".."></td>
                                        <td>{{ $row->username }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->tmp_lahir . ', ' . $row->tgl_lahir }}</td>
                                        <td>{{ $row->alamat }}</td>
                                         <td>{{ $row->no_hp }}</td>
                                        <td><span class="badge {{($row->status == 'aktif') ? 'bg-success' : (($row->status == 'block') ? 'bg-danger' : 'bg-warning')}}">{{ $row->status }}</span></td>
                                         <td>{{ strtoupper($row->role) }}</td>
                                        <td>
                                            <form class="d-inline" action="{{ route('adm.master.resetuser') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="kode_user" value="{{ $row->id_user }}">
                                                <button type="submit" class="btn btn-sm btn-info"><i class='bx bx-reset'></i></button>
                                            </form>
                                            <form class="d-inline" action="{{ route('adm.master.blockuser') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="kode_user" value="{{ $row->id_user }}">
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class='bx bx-block'></i></button>
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
