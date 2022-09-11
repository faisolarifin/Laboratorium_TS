@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Keuangan /</span> Kas Periode</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kas Periode</h5>
                        <a href="{{ route('adm.keu.fkasp') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i></button></a>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th>Tahun</th>
                                    <th>Keterangan</th>
                                    <th>Saldo Awal</th>
                                    <th>Sisa Saldo</th>
                                    {{-- <td>Total Debit</td> --}}
                                    {{-- <td>Total Kredit</td> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($kas as $row)
                                    <tr>
                                        <td>{{ $row->periode->thn_ajaran. ' '.$row->periode->semester }}</td>
                                        <td>{{ $row->ket ?? '-' }}</td>
                                        <td>Rp. {{ number_format($row->saldo_awal, 2) }}</td>
                                        <td>Rp. {{ number_format($row->sisa_saldo, 2) }}</td>
                                        {{-- <td></td> --}}
                                        {{-- <td></td> --}}
                                        <td>
                                            <a href="{{ route('adm.keu.ekasp', $row->id_kasp) }}"><button
                                                    class="btn btn-sm btn-info"><i class='bx bxs-edit'></i></button></a>
                                            <form class="d-inline" action="{{ route('adm.keu.dkasp') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="kode_kasp" value="{{ $row->id_kasp }}">
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class='bx bx-trash-alt'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
