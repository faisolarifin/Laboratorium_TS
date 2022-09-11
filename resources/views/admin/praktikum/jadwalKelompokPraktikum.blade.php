@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Praktikum / Kelompok/</span> Jadwal</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Jadwal Praktikum</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr>
                                <th>Nama Kelompok : {{ strtoupper($matkum->nm_kel) }}</th>
                            </tr>
                            <tr>
                                <th>Nama Praktikum : {{ $matkum->matkum->nama_mp }}</th>
                            </tr>
                            <tr>
                                <th>Tahun Ajaran : {{ $matkum->periode->thn_ajaran }}</th>
                            </tr>
                            <tr>
                                <th>Semeseter : {{ $matkum->periode->semester }}</th>
                            </tr>

                        </table>

                        <table class="table table-striped table-bordered mt-1">
                            <tr>
                                <th colspan="5">
                                    <form class="d-inline" action="{{ route('adm.prak.tmbjadwal') }}" method="post">
                                        @csrf
                                        <div class="input-group w-25 float-end">
                                            <input type="hidden" name="kode_kel" value="{{ $matkum->id_kel }}">
                                            <input type="date" name="tgl_prak" class="form-control form-control-sm" required>
                                            <button type="submit" class="btn btn-sm btn-primary">Tambah Jadwal</button>
                                        </div>

                                    </form>

                                </th>
                            </tr>
                            <tr class="table-primary">
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($jadwal_prak as $row)
                                <tr>
                                    <td>{{ Date::hariIni($row->tgl_prak) . ', ' . Date::tglIndo($row->tgl_prak) }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('adm.prak.hpsjadwal') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="kode_jad" value="{{ $row->id_jadwal }}">
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
