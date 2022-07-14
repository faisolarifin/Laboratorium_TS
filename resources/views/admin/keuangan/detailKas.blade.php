@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Keuangan / Kas /</span> Detail</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0"><a href="{{route('adm.keu.kas')}}"><span class="badge rounded-circle bg-primary"><i
                                        class='bx bx-chevron-left '></i></span></a> Detail Kas</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="150">Tanggal</th>
                                <td width="10">:</td>
                                <td>{{ Date::tglIndo($kas->tgl) }}</td>
                            </tr>
                            <tr>
                                <th width="150">Kode</th>
                                <td width="10">:</td>
                                <td>{{ $kas->kode->nm_kode }}</td>
                            </tr>
                            <tr>
                                <th width="150">Keterangan</th>
                                <td width="10">:</td>
                                <td>{{ $kas->kode->ket }}</td>
                            </tr>
                            <tr>
                                <th width="150">Nama</th>
                                <td width="10">:</td>
                                <td>{{ $kas->nama }}</td>
                            </tr>
                            <tr>
                                <th width="150">Harga</th>
                                <td width="10">:</td>
                                <td>{{ $kas->harga }}</td>
                            </tr>
                            <tr>
                                <th width="150">Nama</th>
                                <td width="10">:</td>
                                <td>{{ $kas->nama }}</td>
                            </tr>
                            <tr>
                                <th width="150">Jumlah</th>
                                <td width="10">:</td>
                                <td>{{ $kas->jumlah }}</td>
                            </tr>
                            <tr>
                                <th width="150">Total</th>
                                <td width="10">:</td>
                                <td>{{ $kas->total }}</td>
                            </tr>
                            <tr>
                                <th width="150">Debit</th>
                                <td width="10">:</td>
                                <td>Rp. {{ $kas->tipe == 'debit' ? 'Rp. ' . number_format($kas->total, 2) : '-' }}</td>
                            </tr>
                            <tr>
                                <th width="150">Kredit</th>
                                <td width="10">:</td>
                                <td>Rp. {{ $kas->tipe == 'kredit' ? 'Rp. ' . number_format($kas->total, 2) : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
