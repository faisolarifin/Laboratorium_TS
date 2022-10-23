@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Form Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('usr.penelitian.daftar')}}" class="px-sm-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label" for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" value="{{auth()->user()->nama}}" disabled />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="npm">NPM</label>
                                    <input type="text" class="form-control" id="npm" value="{{auth()->user()->username}}" disabled />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="telp">No.HP</label>
                                    <input type="text" class="form-control" id="telp" value="{{auth()->user()->no_hp}}" disabled />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <input type="text" class="form-control" id="status" value="{{auth()->user()->role}}" disabled />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" disabled> {{auth()->user()->alamat}} </textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="dikirim">Dikirim Oleh</label>
                                    <input type="text" class="form-control" id="dikirim" name="dikirim" placeholder="Dikirim Oleh" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="diterima">Diterima Oleh</label>
                                    <input type="text" class="form-control" id="diterima" name="diterima" placeholder="Diterima Oleh" />
                                </div>

                            </div>
                            <div class="col">
                                <div class="row justify-content-center mx-sm-2">
                                    <div class="col-sm-6">
                                        <p class="mb-0"><strong>BAHAN</strong></p>
                                        @foreach($pengujian_a as $row)
                                            <p class="mb-0 mt-2">{{$row->nm_pengujian}}</p>
                                            @foreach($row->pcb as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{$item->id_percobaan}}" name="pengujian[]" id="check-{{$item->id_percobaan}}">
                                                    <label class="form-check-label" for="check-{{$item->id_percobaan}}">
                                                        {{$item->nm_percobaan}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-0"><strong>PERKERASAN JALAN RAYA</strong></p>
                                        @foreach($pengujian_b as $row)
                                            <p class="mb-0 mt-2">{{$row->nm_pengujian}}</p>
                                            @foreach($row->pcb as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{$item->id_percobaan}}" name="pengujian[]" id="check-{{$item->id_percobaan}}">
                                                    <label class="form-check-label" for="check-{{$item->id_percobaan}}">
                                                        {{$item->nm_percobaan}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-sm btn-primary">Daftar Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
