@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Keuangan / Kas /</span> Tambah</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kelola Kas</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adm.keu.skas') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="kasp">Kas Periode</label>
                                <div class="col-sm-10">
                                    <select class="form-select w-50" id="kasp" name="kasp">
                                        @foreach ($kasp as $row)
                                            <option value="{{ $row->id_kasp }}">
                                                {{ $row->periode->thn_ajaran . ' ' . $row->periode->semester }} |
                                                {{ $row->ket }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="kode_kas">Kode Kas</label>
                                <div class="col-sm-10">
                                    <select class="form-select w-50" id="kode_kas" name="kode_kas">
                                        @foreach ($kode as $row)
                                            <option value="{{ $row->id }}">{{ $row->nm_kode . ' | ' . $row->ket }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="x">Tipe Kas</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe" id="debit"
                                            value="debit" checked>
                                        <label class="form-check-label" for="debit">
                                            Debit
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe" id="kredit"
                                            value="kredit">
                                        <label class="form-check-label" for="kredit">
                                            Kredit
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tgl">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control w-50" id="tgl" name="tgl" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control w-50" id="nama" rows="3" name="nama" placeholder="Nama"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="harga">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" placeholder="Harga" class="form-control w-50" id="harga"
                                        name="harga" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="number" placeholder="Jumlah" class="form-control w-50" id="jumlah"
                                        name="jumlah" />
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
