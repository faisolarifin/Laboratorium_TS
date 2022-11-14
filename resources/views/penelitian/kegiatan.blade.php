@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Daftar Permohonan Penelitian</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" id="mytable">
                        <thead>
                            <tr class="table-primary">
                                <th>#</th>
                                <th>Tanggal Daftar</th>
                                <th>Dikirim Oleh</th>
                                <th>Diterima Oleh</th>
                                <th>Laporan Hasil</th>
                                <th>Total Biaya</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 0)
                            @foreach ($kegiatan as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ Date::tglIndo($row->tgl_daftar) }}</td>
                                    <td>{{ $row->dikirim_oleh }}</td>
                                    <td>{{ $row->diterima_oleh }}</td>
                                    <td>
                                        @if($row->laporan != null)
                                            <a href="{{ Storage::url($row->laporan) }}">{{ basename(Storage::url($row->laporan)) }}</a>
                                            <a href="{{ route('usr.laporan.download', $row->id_plt) }}" class="btn btn-sm btn-primary p-0 ms-2">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        @else
                                            null
                                        @endif
                                    </td>
                                    <td><strong>Rp.{{ number_format($row->total_bayar) }}</strong></td>
                                    <td class="text-center">
                                        <a href="{{route('usr.penelitian.detail', $row->id_plt)}}" class="btn p-1 btn-sm btn-primary">
                                            <span class="tf-icons bx bx-show"></span>
                                        </a>
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
