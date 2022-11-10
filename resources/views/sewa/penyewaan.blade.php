@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Daftar Penyewaan</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" id="mytable">
                        <thead>
                            <tr class="table-primary">
                                <th>#</th>
                                <th>Nama Alat</th>
                                <th>Tgl Permohonan</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th>Jumlah</th>
                                <th>Total Biaya</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 0)
                            @foreach ($listsewa as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $row->alat->nm_alat }}</td>
                                    <td>{{ Date::tglReverse($row->tgl_permohonan) }}</td>
                                    <td>{{ Date::tglReverse($row->tgl_sewa) }}</td>
                                    <td>{{ Date::tglReverse($row->tgl_kembali) }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>Rp. {{ number_format($row->total_biaya, 2) }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>
                                        @if($row->status == "permohonan")
                                            <form class="d-inline" action="{{route('usr.sewa.c')}}" method="post"
                                                  title="Batalkan Penyewaan">
                                                @csrf
                                                @method("DELETE")
                                                <input type="hidden" name="kode_sewa" value="{{ $row->id_sewa }}">
                                                <button type="submit" class="btn p-1 btn-sm btn-danger">
                                                    <span class="tf-icons bx bx-x"></span>
                                                </button>
                                            </form>
                                        @endif
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
