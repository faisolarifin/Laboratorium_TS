@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Keuangan /</span> Kode</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kode Kas</h5>
                        <a href="{{ route('adm.keu.fkode') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i></button></a>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th width="130">Kode</th>
                                    <th width="250">Harga</th>
                                    <th>Keterangan</th>
                                    <th width="130">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($kode as $row)
                                    <tr>
                                        <td>{{ $row->nm_kode }}</td>
                                        <td>Rp. {{ number_format($row->harga, 2) }}</td>
                                        <td>{{ $row->ket ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('adm.keu.ekode', $row->id) }}"><button
                                                    class="btn btn-sm btn-info"><i class='bx bxs-edit'></i></button></a>
                                            <form class="d-inline" action="{{ route('adm.keu.dkode') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="kode" value="{{ $row->id }}">
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
