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
                        <h5 class="mb-0">Data Periode</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr class="table-primary">
                                <td width="20">No.</td>
                                <td>Tahun Ajaran</td>
                                <td>Semester</td>
                                <td>Aksi</td>
                            </tr>
                            @php($no = 0)
                            @foreach ($periode as $row)
                                <tr>
                                    <td>{{++$no}}</td>
                                    <td>{{ $row->thn_ajaran }}</td>
                                    <td>{{ $row->semester }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('adm.prak.bayar') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="kode_mhs" value="{{ $row->id_periode }}">
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
