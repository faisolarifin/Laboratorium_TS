@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard /</span></h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h2>Selamat Datang di Aplikasi Laboratorium 
                        </h2><h2> Sipil Universitas Wiraraja</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
