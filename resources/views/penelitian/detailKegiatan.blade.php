@extends('templates.user')

@section('content')

    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Penelitian</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td width="140">Nama</td>
                            <td width="10">:</td>
                            <td>{{ strtoupper(auth()->user()->nama) }}</td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td>:</td>
                            <td>{{ auth()->user()->username }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Daftar</td>
                            <td>:</td>
                            <td>{{ Date::tglIndo($plt->tgl_daftar) }}</td>
                        </tr>
                    </table>

                    <table class="table table-striped">
                        <thead>
                        <tr class="table-primary">
                            <th>Nama Percobaan</th>
                            <th>Jumlah Percobaan</th>
                            <th>Total Biaya</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @php($total = 0)
                        @foreach ($plt->detail as $row)
                            <tr>
                                <td>{{ $row->pcb->nm_percobaan }}</td>
                                <td>{{ ($row->jml_percobaan) ? $row->jml_percobaan.' Kali' : '' }}</td>
                                <td>Rp. {{ number_format($row->total_biaya) }}</td>
                            </tr>
                            @php($total += $row->total_biaya)
                        @endforeach

                        <tr>
                            <td colspan="2" class="text-end">Total Bayar:</td>
                            <td>Rp. {{ number_format($total) }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
