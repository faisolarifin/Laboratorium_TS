@extends('templates.admin')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Praktikum /</span> Peserta Praktikum</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Peserta Praktikum</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td class="px-0">
                                    @foreach ($matkum_periode as $row)
                                        <a href="{{ route('adm.prak.daftaracc', $row->id_daftar) }}"
                                            class="btn btn-sm {{ (Request::segment(3) ?? 1) == $row->id_daftar ? 'btn-primary' : 'btn-outline-primary' }}">{{ $row->matkum->nama_mp }}</a>
                                    @endforeach
                                </td>
                            </tr>
                        </table>

                        @if (count($list_pendaftar) > 0)
                            <table class="table table-striped">
                                <tr class="table-primary">
                                    <td>Foto</td>
                                    <td>Nama</td>
                                    <td>N P M</td>
                                    <td>No. Hp</td>
                                    <td>Aksi</td>
                                </tr>
                                @foreach ($list_pendaftar as $row)
                                    <tr>
                                        <td><img src="{{ Storage::url($row->mhs->foto) }}" class="rounded" width="35"
                                                height="35" alt=".."></td>
                                        <td>{{ strtoupper($row->mhs->nama) }}</td>
                                        <td>{{ $row->mhs->nim }}</td>
                                        <td>{{ $row->mhs->no_hp }}</td>
                                        <td>
                                            <form class="d-inline" action="{{ route('adm.prak.bayar') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="kode_mhs" value="{{ $row->mhs_id_mhs }}">
                                                <button type="submit" class="btn btn-sm btn-danger">x</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <form class="d-inline" action="{{ route('adm.prak.generate') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="kode_daftar"
                                                        value="{{ Request::segment(3) ?? 1 }}">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="jml_kelompok" placeholder="Jumlah Kelompok" required>
                                                        <button type="submit" class="btn btn-sm btn-warning"
                                                            {{ $matkum_periode[(Request::segment(3) ?? 1) - 1]->status_generate != 0 ? 'disabled' : '' }}>GENERATE
                                                            KELOMPOK</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form class="d-inline" action="{{ route('adm.export.dafdir') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="kode_daftar"
                                                        value="{{ Request::segment(3) ?? 1 }}">
                                                    <button type="submit" class="btn btn-sm btn-info">
                                                        <i class='bx bxs-download'></i> DAFDIR MAHASISWA UJIAN</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        @else
                            <div class="alert alert-danger mt-3">
                                Tidak ada data ditemukan!
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
