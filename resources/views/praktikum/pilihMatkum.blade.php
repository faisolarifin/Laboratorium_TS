@extends('templates.user')

@section('content')

    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Rencana Praktikum</h5>
                </div>
                <div class="card-body">

                    @if (@$pendaftar && @$matkum_pilih)
                        <table class="table table-striped">
                            <tr>
                                <td>Nama : {{ strtoupper($pendaftar->mhs->nama) }}</td>
                            </tr>
                            <tr>
                                <td>NIM : {{ $pendaftar->mhs->username }}</td>
                            </tr>
                            <tr>
                                <td>Periode Praktikum :{{ $pendaftar->periode->thn_ajaran }}</td>
                            </tr>
                            <tr>
                                <td>Status Bayar : <span class="badge {{ $pendaftar->status_bayar != 'belum' ? 'bg-label-success' : 'bg-label-danger' }}">{{ $pendaftar->status_bayar }}
                                    </span></td>
                            </tr>
                            <tr>
                                <td>Status Diterima : <span
                                            class="badge {{ $pendaftar->status_acc_fix != 'belum' ? 'bg-label-success' : 'bg-label-danger' }}">{{ $pendaftar->status_acc_fix }}</span></td>
                            </tr>

                        </table>

                        <table class="table table-striped">
                            <thead>
                            <tr class="table-primary">
                                <th>Nama Matkul</th>
                                <th>Harga</th>
                                @if ($pendaftar->status_bayar == 'belum')
                                    <th>Hapus</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @php($total = 0)
                            @foreach ($matkum_pilih as $row)
                                <tr>
                                    <td>{{ $row->matkum->nama_mp }}</td>
                                    <td>Rp. {{ number_format($row->matkum->harga) }}</td>
                                    @if ($pendaftar->status_bayar == 'belum')
                                        <td>
                                            <form action="{{ route('mhs.matkum') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id_daftar"
                                                       value="{{ $row->id_daftarmp }}">
                                                <input type="hidden" name="id_matkum" value="{{ $row->id_mp }}">
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class='bx bx-trash-alt'></i></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @php($total += $row->matkum->harga)
                            @endforeach

                            <tr>
                                <td class="text-end">Total Bayar:</td>
                                <td colspan="2">Rp. {{ number_format($total) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger mb-0">
                            Belum ada praktikum yang diambil!
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
