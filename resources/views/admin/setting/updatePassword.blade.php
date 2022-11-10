@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Setting /</span> Ubah Password</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Ubah Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adm.setting.pwd.save') }}" method="post">
                            @csrf
                            @method('PUT')
                            <table class="table tab-table">
                                <tr>
                                    <th width="200">Password Lama</th>
                                    <td width="10">:</td>
                                    <td>
                                        <input type="text" name="last_pwd" class="form-control form-control-sm w-50" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="200">Password Baru</th>
                                    <td width="10">:</td>
                                    <td>
                                        <input type="text" name="new_pwd" class="form-control form-control-sm w-50" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="200">Konfirmasi Password</th>
                                    <td width="10">:</td>
                                    <td>
                                        <input type="text" name="confirm_pwd" class="form-control form-control-sm w-50" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                class='bx bx-save'></i></button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
