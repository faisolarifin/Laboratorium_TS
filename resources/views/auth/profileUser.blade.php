@extends('templates.user')

@section('content')

    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @include('templates.alert')

                        <form id="formAuthentication" class="mb-3" action="{{route('mhs.profile')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="nama"
                                            name="nama"
                                            placeholder="Nama Lengkap"
                                            autofocus
                                            value="{{$mhs->nama}}"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">No Identitas</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="username"
                                            name="username"
                                            placeholder="No Identitas"
                                            value="{{$mhs->username}}"
                                        />
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="tmp_lahir">Tempat Lahir</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                id="tmp_lahir"
                                                class="form-control"
                                                name="tmp_lahir"
                                                placeholder="Tempat Lahir"
                                                aria-describedby="tmp_lahir"
                                                value="{{$mhs->tmp_lahir}}"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="date"
                                                id="tgl_lahir"
                                                class="form-control"
                                                name="tgl_lahir"
                                                placeholder="Tanggal Lahir"
                                                aria-describedby="tgl_lahir"
                                                value="{{$mhs->tgl_lahir}}"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No. HP</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="no_hp"
                                            name="no_hp"
                                            placeholder="No. HP"
                                            value="{{$mhs->no_hp}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            placeholder="Email"
                                            value="{{$mhs->email}}"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" rows="2"
                                                  name="alamat">{{$mhs->alamat}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input class="form-control" type="file" id="foto" name="foto">
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid" type="submit">Simpan</button>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

@endsection
