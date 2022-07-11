@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Praktikum /</span> Kelompok</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Daftar Kelompok</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr>
                                <td class="px-0">
                                    @foreach ($matkum_periode as $row)
                                        <a href="{{ route('adm.prak.kelompok', $row->id_mp) }}"
                                            class="btn btn-sm {{ (Request::segment(3) ?? 1) == $row->id_mp ? 'btn-primary' : 'btn-outline-primary' }}">{{ $row->nama_mp }}</a>
                                    @endforeach
                                </td>
                            </tr>
                        </table>

                        <table class="table table-striped">
                            <tr class="table-primary">
                                <td>Nama Kelompok</td>
                                <td>Nama Praktikum</td>
                                <td>Tanggal Ujian</td>
                                <td>Dosen Pembimbing</td>
                                <td>Dosen Penguji</td>
                                <td>Aksi</td>
                            </tr>
                            @foreach ($list_kelompok as $row)
                                <tr>
                                    <td>{{ $row->nm_kel }}</td>
                                    <td>{{ $row->matkum->nama_mp }}</td>
                                    <td>{{ @Date::tglIndo($row->tgl_ujian) }}</td>
                                    <td>{{ $row->pbb->nama ?? '-' }}</td>
                                    <td>{{ $row->pgj->nama ?? '-' }}</td>
                                    <td>
                                        {{-- <form class="d-inline" action="{{ route('adm.prak.hpskelompok') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="kode_kel" value="{{ $row->id_kel }}">
                                            <button type="submit" class="btn btn-sm btn-danger">x</button>
                                        </form> --}}
                                        <button type="button" class="btn btn-sm btn-primary mt-1" data-bs-toggle="modal"
                                            data-bs-target="#smallModal"
                                            data-bs="{{ $row->id_kel }}:{{ $row->nm_kel }}:{{ $row->tgl_ujian }}:{{ $row->pembimbing }}:{{ $row->penguji }}">
                                            <i class='bx bx-edit-alt'></i>
                                        </button>
                                        <a href="{{ route('adm.prak.anggota', $row->id_kel) }}"
                                            class="btn btn-sm btn-warning mt-1">
                                            <i class='bx bx-group'></i></a>
                                        <a href="{{ route('adm.prak.jadwal', $row->id_kel) }}"
                                            class="btn btn-sm btn-success mt-1">
                                            <i class='bx bx-calendar'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($list_kelompok->isNotEmpty())
                                <tr>
                                    <td colspan="6">
                                        <div class="row mt-1">
                                            <div class="col text-end">
                                                <form class="d-inline" action="{{ route('adm.export.dafdirdosen') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="kode_mp"
                                                        value="{{ Request::segment(3) ?? 1 }}">
                                                    <button type="submit" class="btn btn-sm btn-info">
                                                        <i class='bx bxs-download'></i> DAFDIR DOSEN PENGUJI</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Small Modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('adm.prak.kel') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <input type="hidden" name="kode_kel" id="kode_kel">
                                <label for="tgl_ujian" class="form-label">Tanggal Ujian</label>
                                <input type="date" id="tgl_ujian" name="tgl_ujian" class="form-control" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label class="form-label" for="dsn_pembimbing">Dosen Pembimbing</label>
                                <select class="form-select" id="dsn_pembimbing" name="dsn_pembimbing">
                                    @foreach ($dosen as $row)
                                        <option value="{{ $row->id_dosen }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col dsn_penguji-0">
                                <label for="dobSmall" class="form-label">Dosen Penguji</label>
                                <select class="form-select" id="dsn_penguji" name="dsn_penguji">
                                    @foreach ($dosen as $row)
                                        <option value="{{ $row->id_dosen }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        var exampleModal = document.getElementById('smallModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var data = button.getAttribute('data-bs').split(':')

            var modalTitle = exampleModal.querySelector('.modal-title')
            var Kode_Kel = exampleModal.querySelector('.modal-body #kode_kel')
            var Tgl_Ujian = exampleModal.querySelector('.modal-body #tgl_ujian')
            var Dsn_Penguji = exampleModal.querySelector('.modal-body #dsn_penguji')
            var Dsn_Pembimbing = exampleModal.querySelector('.modal-body #dsn_pembimbing')

            Kode_Kel.value = data[0]
            modalTitle.textContent = data[1]
            Tgl_Ujian.valueAsDate = new Date(data[2])
            Dsn_Pembimbing.value = data[3]
            Dsn_Penguji.value = data[4]

        })
    </script>
@endsection
