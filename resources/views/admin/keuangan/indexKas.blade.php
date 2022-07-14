@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Keuangan /</span> Kas</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kas</h5>
                        <a href="{{ route('adm.keu.fkas') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i></button></a>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr class="table-primary">
                                <td>No</td>
                                <td>Kode</td>
                                <td>Tanggal</td>
                                <td>Nama</td>
                                <td>Harga</td>
                                <td>Jumlah</td>
                                <td>Debit</td>
                                <td>Kredit</td>
                                <td>Saldo</td>
                                <td>Aksi</td>
                            </tr>
                            @php($no = 0)
                            @php($saldo = $kasp->sisa_saldo)
                            @foreach ($kas as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $row->kode->nm_kode }}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>Rp. {{ number_format($row->harga, 2) }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>{{ $row->tipe == 'debit' ? 'Rp. ' . number_format($row->total, 2) : '-' }}</td>
                                    <td>{{ $row->tipe == 'kredit' ? 'Rp. ' . number_format($row->total, 2) : '-' }}</td>
                                    <td>
                                        @if ($row->tipe == 'debit')
                                            {{ 'Rp ' . number_format($saldo += $row->total, 2) }}
                                        @elseif ($row->tipe == 'kredit')
                                            {{ 'Rp ' . number_format($saldo -= $row->total, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('adm.keu.ekas', $row->id_kas) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <form class="d-inline" action="{{ route('adm.keu.dkas') }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="kode_kas" value="{{ $row->id_kas }}">
                                                    <button type="submit" class="dropdown-item"><i
                                                            class='bx bx-trash-alt'></i> Delete</button>
                                                </form>
                                                <form class="d-inline"
                                                    action="{{ route('adm.keu.dtkas', $row->id_kas) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"><i
                                                            class='bx bxs-share'></i> Detail</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
