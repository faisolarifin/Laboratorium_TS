@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Setting /</span> Home</h5>

        @if (Session::has('success'))
            <div class="alert alert-success shadow-sm alert-dismissible" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Pengaturan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adm.setting') }}" method="post">
                            @csrf
                            @method('PUT')
                            <table class="table tab-table">
                                <tr>
                                    <th width="150">Dekan</th>
                                    <td width="10">:</td>
                                    <td>
                                        <input type="text" name="dekan" class="form-control form-control-sm w-50"
                                            value="{{ $setting->dekan }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th width="150">Ka. Prodi</th>
                                    <td width="10">:</td>
                                    <td>
                                        <input type="text" name="kaprodi" class="form-control form-control-sm w-50"
                                            value="{{ $setting->kaprodi }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th width="150">Ka. Lab</th>
                                    <td width="10">:</td>
                                    <td>
                                        <input type="text" name="kalab" class="form-control form-control-sm w-50"
                                            value="{{ $setting->kalab }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Periode Aktif</th>
                                    <td>:</td>
                                    <td>
                                        <select class="form-select form-select-sm w-50" name="periode">
                                            @foreach ($periode as $row)
                                                <option value="{{ $row->id_periode }}"
                                                    {{ $row->id_periode == $setting->periode_aktif ? 'selected' : '' }}>
                                                    {{ $row->thn_ajaran . ' ' . $row->semester }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="150">Pendaftaran Praktikum</th>
                                    <td width="10">:</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="sw_prak" value="on" {{$setting->praktikum == 'on' ? 'checked' : ''}}>
                                          </div>
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
