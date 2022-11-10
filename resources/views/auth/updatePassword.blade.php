@extends('templates.user')

@section('content')

    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic">
            <div class="authentication-inner">
                <div class="row justify-content-center">
                    <div class="col-sm-6">

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

                                <form class="mb-3" action="{{route('mhs.password')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="last_pwd" class="form-label">Password Lama</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="last_pwd"
                                            name="last_pwd"
                                            placeholder="Password Lama"
                                            autofocus
                                            required
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_pwd" class="form-label">Password Baru</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="new_pwd"
                                            name="new_pwd"
                                            placeholder="Password Baru"
                                            required
                                        />
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="confirm_pwd">Konfirmasi Password</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                id="confirm_pwd"
                                                class="form-control"
                                                name="confirm_pwd"
                                                placeholder="Konfirmasi Password"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->

@endsection
