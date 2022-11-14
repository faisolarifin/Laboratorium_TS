@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Form Penyewaan</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('usr.sewa')}}" method="POST">
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
                            <div class="col-12 col-sm-4">
                                <div class="mb-3">
                                    <label for="alat" class="form-label">Nama Alat</label>
                                    <select class="form-select" id="alat" name="alat">
                                        @foreach ($alat as $row)
                                            <option value="{{ $row->id_alat }}">
                                                {{$row->nm_alat}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah Sewa</label>
                                    <input type="number" class="form-control" id="jumlah"
                                           placeholder="Jumlah Sewa" name="jumlah"/>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="mb-3">
                                    <label for="keperluan" class="form-label">Keperluan</label>
                                    <select class="form-select" id="keperluan" name="keperluan">
                                        <option value="praktikum">Praktikum</option>
                                        <option value="pengujian">Pengujian</option>
                                        <option value="peminjaman">Peminjaman</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-sm btn-primary">Sewa Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
