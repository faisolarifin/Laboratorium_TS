@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Master / Dosen /</span> Edit</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Dosen</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adm.master.udsn')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="kode_dosen" value="{{$dosen->id_dosen}}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nm_dosen">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="nm_dosen"
                                        placeholder="Nama" name="nm_dosen" value="{{$dosen->nama}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nip">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="nip"
                                        placeholder="NIP" name="nip" value="{{$dosen->nip}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jabatan">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="jabatan"
                                    placeholder="Jabatan" name="jabatan" value="{{$dosen->jabatan}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="no_hp">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="no_hp"
                                        placeholder="No. HP" name="no_hp" value="{{$dosen->no_hp}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="email">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control w-50" id="email"
                                        placeholder="Email" name="email" value="{{$dosen->email}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control w-50" id="alamat" rows="3" name="alamat" placeholder="Deksripsi">{{$dosen->alamat}}</textarea>
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
