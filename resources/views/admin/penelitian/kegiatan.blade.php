@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Penelitian /</span> Kegiatan</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Daftar Penelitian</h5>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Tgl Daftar</th>
                                    <th>Dikirim Oleh</th>
                                    <th>Diterima Oleh</th>
                                    <th>Total Bayar</th>
                                    <th width="30">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($no = 0)
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->user->nama }}</td>
                                        <td>{{ $row->user->username }}</td>
                                        <td>{{ Date::tglReverse($row->tgl_daftar) }}</td>
                                        <td>{{ $row->dikirim_oleh }}</td>
                                        <td>{{ $row->diterima_oleh }}</td>
                                        <td>Rp. {{ number_format($row->total_bayar,2) }}</td>
                                        <td>
                                            <a href="{{route('adm.plt.detail', $row->id_plt)}}" class="btn p-1 btn-sm btn-primary" title="Terima Permohonan">
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
