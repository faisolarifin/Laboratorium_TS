@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Praktikum /</span> History</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">History Praktikum</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped mb-2 tab-table">
                            <tr>
                                <td class="px-0">
                                    @foreach ($matkum_periode as $row)
                                        <a href="{{ route('adm.prak.history', $row->id_mp) }}"
                                            class="btn btn-sm {{ (Request::segment(3) ?? 1) == $row->id_mp ? 'btn-primary' : 'btn-outline-primary' }}">{{ $row->nama_mp }}</a>
                                    @endforeach
                                </td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th>Periode</th>
                                    <th>Semester</th>
                                    <th>N P M</th>
                                    <th>Nama</th>
                                    <th>Nama Pratikum</th>
                                    <th>Nilai</th>
                                    <th>Sertifikat</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($hist_praktikum as $row)
                                    <tr>
                                        <td>{{ $row->parent->periode->thn_ajaran }}</td>
                                        <td>{{ $row->parent->periode->semester }}</td>
                                        <td>{{ $row->mhs->username }}</td>
                                        <td>{{ $row->mhs->nama }}</td>
                                        <td>{{ $row->parent->matkum->nama_mp }}</td>
                                        <td>{{ $row->nilai }}</td>
                                        <td>
                                            <form class="d-inline" action="{{ route('adm.export.sertif') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="kode_kel" value="{{ $row->id_kel }}">
                                                <input type="hidden" name="kode_mhs" value="{{ $row->mhs->id_user }}">
                                                <button type="submit" class="btn btn-sm btn-warning" {{($row->nilai=='') ? 'disabled' : ''}}><i class='bx bxs-download'></i></button>
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
