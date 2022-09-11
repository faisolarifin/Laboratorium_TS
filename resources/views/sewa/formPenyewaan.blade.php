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
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="alat">Nama Alat</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="alat" name="alat">
                                            @foreach ($alat as $row)
                                                <option value="{{ $row->id_alat }}">
                                                    {{$row->nm_alat}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="jumlah">Jumlah Sewa</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="jumlah"
                                               placeholder="Jumlah Sewa" name="jumlah"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="keperluan">Keperluan</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="keperluan" name="keperluan">
                                            <option value="">Peminjaman</option>
                                            <option value="">Praktikum</option>
                                            <option value="">Pengujian</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="role">Status</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="role"
                                               placeholder="Status" name="role" value="{{ucfirst(Auth::user()->role)}}" readonly/>
                                    </div>
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
