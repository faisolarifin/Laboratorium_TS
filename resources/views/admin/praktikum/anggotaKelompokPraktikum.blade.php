@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Praktikum / Kelompok /</span> Anggota</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Anggota</h5>
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
                                    <span>Anggota Kelompok</span>
                                    <a href="{{ route('adm.prak.jadwal', $matkum->id_kel) }}">
                                        <button class="btn btn-sm btn-primary float-end">Jadwal Praktikum</button></a>
                                </th>
                            </tr>
                            <tr class="table-primary">
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>N P M</th>
                                <th>Nilai Praktikum</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($anggota_kel as $row)
                                <tr>
                                    <td><img src="{{ Storage::url($row->mhs->foto) }}" class="rounded" width="35"
                                            height="35" alt=".."></td>
                                    <td>{{ strtoupper($row->mhs->nama) }}</td>
                                    <td>{{ $row->mhs->username }}</td>
                                    <td>{{ $row->nilai }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#smallModal"
                                            data-bs="{{ $matkum->id_kel }}:{{ $row->mhs->id_user }}:{{ $row->mhs->nama }}:{{ $row->nilai }}">+</button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="mt-3">
                                        <form class="d-inline" action="{{ route('adm.export.jadwal') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="kode_kel" value="{{ $matkum->id_kel }}">
                                            <button type="submit" class="btn btn-sm btn-secondary"><i
                                                    class='bx bxs-download'></i> DAFTAR HADIR</button>
                                        </form>
                                        <form class="d-inline" action="{{ route('adm.export.ba') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="kode_kel" value="{{ $matkum->id_kel }}">
                                            <button type="submit" class="btn btn-sm btn-warning"><i
                                                    class='bx bxs-download'></i> BA PELAKSANAAN</button>
                                        </form>
                                        <form class="d-inline" action="{{ route('adm.export.baujian') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="kode_kel" value="{{ $matkum->id_kel }}">
                                            <input type="hidden" name="penguji" value="1">
                                            <button type="submit" class="btn btn-sm btn-info"><i
                                                class='bx bxs-download'></i> BA UJIAN PENGUJI 1</button>
                                        </form>
                                        <form class="d-inline" action="{{ route('adm.export.baujian') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="kode_kel" value="{{ $matkum->id_kel }}">
                                            <input type="hidden" name="penguji" value="2">
                                            <button type="submit" class="btn btn-sm btn-info"><i
                                                    class='bx bxs-download'></i> BA UJIAN PENGUJI 2</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
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
                <form action="{{ route('adm.prak.nilai') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col mb-3">
                                <input type="hidden" name="kode_kel" id="kode_kel">
                                <input type="hidden" name="kode_mhs" id="kode_mhs">
                                <label class="form-label" for="nilai">Nilai Praktikum</label>
                                <select class="form-select" id="nilai" name="nilai">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
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
        var nilaiModal = document.getElementById('smallModal')
        nilaiModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var data = button.getAttribute('data-bs').split(':')
            var modalTitle = nilaiModal.querySelector('.modal-title')
            var modalKodeKel = nilaiModal.querySelector('.modal-body #kode_kel')
            var modalKodeMhs = nilaiModal.querySelector('.modal-body #kode_mhs')
            var modalBodySelect = nilaiModal.querySelector('.modal-body select')

            modalTitle.textContent = data[2]
            modalKodeKel.value = data[0]
            modalKodeMhs.value = data[1]
            modalBodySelect.value = data[3]
        })
    </script>
@endsection
