@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Form Permohonan</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('usr.permohonan.s')}}" class="px-sm-4" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" value="{{auth()->user()->nama}}" disabled />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="npm">NPM</label>
                                    <input type="text" class="form-control" id="npm" value="{{auth()->user()->username}}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="telp">No.HP</label>
                                    <input type="text" class="form-control" id="telp" value="{{auth()->user()->no_hp}}" disabled />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <input type="text" class="form-control" id="status" value="{{auth()->user()->role}}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="alamat">Status</label>
                                    <textarea class="form-control" id="alamat" disabled> {{auth()->user()->alamat}} </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="proposal" class="form-label">Upload Proposal Penelitian</label>
                                <input class="form-control" name="proposal" type="file" id="proposal" accept="application/pdf">
                            </div>
                            <div class="col">
                                <label for="surat" class="form-label">Upload Surat Permohonan</label>
                                <input class="form-control" name="surat" type="file" id="surat" accept="application/pdf">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
