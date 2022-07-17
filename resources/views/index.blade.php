@extends('templates.mhs')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-body py-5 text-center">
                    <h2>Selamat Datang di Aplikasi Laboratorium
                    </h2>
                    <h2> Sipil Universitas Wiraraja</h2>

                    <div class="mt-5 d-flex justify-content-center">
                        <a href="{{ route('mhs.listmatkum') }}"><button
                                class="btn btn-outline-primary mx-3 py-4">PRAKTIKUM</button></a>
                        <button class="btn btn-outline-primary mx-3">SEWA ALAT</button>
                        <button class="btn btn-outline-primary mx-3">PENELITIAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
