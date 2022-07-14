@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Master / Periode /</span> Edit</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Kode Kas</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adm.keu.ukode')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="kode" value="{{$kode->id}}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nm_kode">Kode</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="nm_kode"
                                        placeholder="Kode" name="nm_kode" value="{{$kode->nm_kode}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nm_prak">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="harga"
                                        placeholder="Harga" name="harga" value="{{$kode->harga}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="desk">Deskipsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control w-50" id="desk" rows="3" name="desk" placeholder="Deksripsi">{{$kode->ket}}</textarea>
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
