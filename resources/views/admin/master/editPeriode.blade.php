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
                        <h5 class="mb-0">Tambah Periode</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adm.master.uperiode')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="kode_periode" value="{{$periode->id_periode}}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="thn_ajaran">Tahun Ajaran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="thn_ajaran"
                                        placeholder="Tahun Ajaran" name="thn_ajaran" value="{{$periode->thn_ajaran}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="hg">Semester</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="smt" id="ganjil"
                                            value="Ganjil" {{($periode->semester == 'Ganjil') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="ganjil">
                                            Ganjil
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="smt" id="genap"
                                            value="Genap"  {{($periode->semester == 'Genap') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="genap">
                                            Genap
                                        </label>
                                    </div>
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
