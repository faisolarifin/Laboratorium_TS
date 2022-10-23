@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Penelitian /</span> Permohonan</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Daftar Permohonan</h5>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Tgl Permohonan</th>
                                    <th>Proposal Penelitian</th>
                                    <th>Surat Permohonan</th>
                                    <th>Status</th>
                                    <th width="60">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($no = 0)
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->user->nama }}</td>
                                        <td>{{ $row->user->username }}</td>
                                        <td>{{ Date::tglReverse($row->tgl_permohonan) }}</td>
                                        <td><a href="{{ Storage::url($row->proposal) }}">{{ basename(Storage::url($row->proposal)) }}</a></td>
                                        <td><a href="{{ Storage::url($row->srt_permohonan) }}">{{ basename(Storage::url($row->srt_permohonan)) }}</a></td>
                                        <td> <span class="badge {{ ($row->status == 'diterima') ? 'bg-success' : (($row->status == 'ditolak') ? 'bg-danger' : 'bg-info') }}">{{ $row->status }}</span></td>
                                        <td>
                                            <a href="{{route('adm.permohonan.acc', $row->id_pmh)}}" class="btn p-1 btn-sm btn-primary" title="Terima Permohonan">
                                                <span class="tf-icons bx bx-check-double"></span>
                                            </a>
                                            <a href="{{route('adm.permohonan.reject', $row->id_pmh)}}" class="btn p-1 btn-sm btn-danger" title="Tolak Permohonan">
                                                <span class="tf-icons bx bx-x"></span>
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
