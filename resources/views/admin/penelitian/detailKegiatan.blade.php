@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Penelitian / Kegiatan /</span> Detail</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Detail Penelitian</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr>
                                <td width="140">Nama</td>
                                <td width="10">:</td>
                                <td>{{ strtoupper($detail->user->nama) }}</td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td>:</td>
                                <td>{{ $detail->user->username }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Daftar</td>
                                <td>:</td>
                                <td>{{ Date::tglIndo($detail->tgl_daftar) }}</td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered mt-1">
                            <tr>
                                <th colspan="5">
                                    <span>Daftar Percobaan</span>
                                </th>
                            </tr>
                            <tr class="table-primary">
                                <th>Nama Percobaan</th>
                                <th>Jumlah Percobaan</th>
                                <th>Total Biaya</th>
                                <th width="50">Aksi</th>
                            </tr>
                            @php($total = 0)
                            @foreach ($detail->detail as $row)
                                <tr>
                                    <td>{{ $row->pcb->nm_percobaan }}</td>
                                    <td>{{ ($row->jml_percobaan) ? $row->jml_percobaan.' Kali' : '' }}</td>
                                    <td>Rp. {{ number_format($row->total_biaya) }}</td>
                                    <td>
                                        <button type="button" class="btn p-1 btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#smallModal"
                                            data-bs="{{$row->id_plt}}:{{$row->id_percobaan}}:{{$row->jml_percobaan}}:{{$row->total_biaya}}">
                                            <span class="tf-icons bx bx-pencil"></span>
                                        </button>
                                    </td>
                                </tr>
                                @php($total += $row->total_biaya)
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-end">Total Bayar:</td>
                                <td colspan="2">Rp. {{ number_format($total) }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Update Percobaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('adm.plt.percobaan') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="kode_plt" id="kode_plt">
                                <input type="hidden" name="kode_pcb" id="kode_pcb">
                                <div class="mb-2">
                                    <label class="form-label" for="jumlah">Jumlah Percobaan</label>
                                    <input type="text" placeholder="Jumlah Percobaan" class="form-control" name="jumlah" id="jumlah">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="biaya">Total Biaya</label>
                                    <input type="number" placeholder="Total Biaya" class="form-control" name="total_biaya" id="biaya">
                                </div>
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
            var kodePlt = nilaiModal.querySelector('.modal-body #kode_plt')
            var kodePcb = nilaiModal.querySelector('.modal-body #kode_pcb')
            var jumlah = nilaiModal.querySelector('.modal-body #jumlah')
            var biaya = nilaiModal.querySelector('.modal-body #biaya')

            kodePlt.value = data[0]
            kodePcb.value = data[1]
            jumlah.value = data[2]
            biaya.value = data[3]
        })
    </script>
@endsection
