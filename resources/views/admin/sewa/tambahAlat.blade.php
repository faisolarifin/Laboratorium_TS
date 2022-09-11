@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Penyewaan / Alat /</span> Tambah</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Alat</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adm.sewa.alat.s')}}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nm_alat">Nama Alat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="nm_alat"
                                        placeholder="Nama Alat" name="nm_alat" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="biaya_umum">Biaya Umum</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="biaya_umum"
                                        placeholder="Biaya Umum" name="biaya_umum" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="biaya_khusus">Biaya Khusus</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="biaya_khusus"
                                           placeholder="Biaya Khusus" name="biaya_khusus" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="jumlah"
                                           placeholder="Jumlah" name="jumlah" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="kondisi">Kondisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="kondisi"
                                           placeholder="Kondisi" name="kondisi" />
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class='bx bx-save'></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
