@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-body py-5 text-center">
                    <h2 class="mb-2">Selamat Datang di Aplikasi Laboratorium</h2>
                    <h2>Teknik Sipil Universitas Wiraraja</h2>

                    <div class="mt-5 mb-5 d-flex justify-content-center">
                        <a href="{{ route('mhs.listmatkum') }}">
                            <button class="btn btn-outline-primary mx-3 py-4">
                                <i class="bx bxs-user-check fs-3"></i> <br> PRAKTIKUM
                            </button>
                        </a>
                        <a href="{{route('usr.alat')}}">
                            <button class="btn btn-outline-primary mx-3 py-4">
                                <i class="bx bx-paint fs-3"></i> <br> SEWA ALAT
                            </button>
                        </a>
                        <a href="{{route('usr.alat')}}">
                            <button class="btn btn-outline-primary mx-3 py-4">
                                <i class="bx bxs-microchip fs-3"></i> <br> PENELITIAN
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
