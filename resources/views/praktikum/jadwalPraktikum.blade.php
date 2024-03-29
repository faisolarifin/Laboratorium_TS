@extends('templates.user')

@section('content')

    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Jadwal Praktikum</h5>
                    <div class="mt-0">
                        @if (@$matkum)
                            @foreach ($matkum as $row)
                                <a href="{{route('mhs.jadwal', $row->id_mp)}}"
                                   class="btn btn-sm {{ (Request::segment(2) ?? 1) == $row->id_mp ? 'btn-primary' : 'btn-outline-primary' }}">{{$row->matkum->nama_mp}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if (@$kelompok && @$jadwal)

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th colspan="3" class="px-0 pb-0"><h4>{{strtoupper($kelompok->nm_kel)}}</h4></th>
                            </tr>
                            <tr class="table-primary">
                                <th>Hari/Tanggal</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($jadwal as $row)
                                <tr>
                                    <td>{{Date::hariIni($row->tgl_prak)}}, {{Date::tglIndo($row->tgl_prak)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger mb-0">
                            Kelompok masih belum dibentuk!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
