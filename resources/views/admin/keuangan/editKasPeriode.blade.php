@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Master / Kas Periode /</span> Edit</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Kas Periode</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adm.keu.ukasp')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="kode_kasp" value="{{$kas->id_kasp}}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="periode">Periode</label>
                                <div class="col-sm-10">
                                    <select class="form-select w-50" id="periode" name="periode">
                                        @foreach ($periode as $row)
                                            <option value="{{ $row->id_periode }}" {{($kas->id_periode==$row->id_periode) ? 'selected' : ''}}>{{ $row->thn_ajaran }} {{$row->semester}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="saldo_awal">Saldo Awal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="saldo_awal"
                                        placeholder="Saldo Awal" name="saldo_awal" value="{{$kas->saldo_awal}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sisa_saldo">Sisa Saldo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50" id="sisa_saldo"
                                        placeholder="Sisa Saldo" name="sisa_saldo" value="{{$kas->sisa_saldo}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ket">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control w-50" id="ket" rows="3" name="ket" placeholder="Keterangan">{{$kas->ket}}</textarea>
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
