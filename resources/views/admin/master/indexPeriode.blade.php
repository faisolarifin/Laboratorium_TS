@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Master /</span> Periode</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Periode</h5>
                        <a href="{{ route('adm.master.fperiode') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i></button></a>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th width="20">No.</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 0)
                                @foreach ($periode as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->thn_ajaran }}</td>
                                        <td>{{ $row->semester }}</td>
                                        <td>
                                            <a href="{{ route('adm.master.eperiode', $row->id_periode) }}">
                                                <button type="submit" class="btn btn-sm btn-info"><i
                                                        class='bx bxs-edit'></i></button></a>
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
