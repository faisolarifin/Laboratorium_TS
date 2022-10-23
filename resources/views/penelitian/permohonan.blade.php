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
                                <th>Tgl Permohonan</th>
                                <th>Proposal Penelitian</th>
                                <th>Surat Permohonan</th>
                                <th>Link Formulir</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 0)
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ Date::tglReverse($row->tgl_permohonan) }}</td>
                                    <td><a href="{{ Storage::url($row->proposal) }}">{{ basename(Storage::url($row->proposal)) }}</a></td>
                                    <td><a href="{{ Storage::url($row->srt_permohonan) }}">{{ basename(Storage::url($row->srt_permohonan)) }}</a></td>
                                    <td>
                                        @if($row->link_formulir)
                                            <a href="{{ route('usr.penelitian.form', $row->link_formulir) }}" class="text-decoration-underline">Link Daftar</a>
                                        @endif
                                    </td>
                                    <td> <span class="badge {{ ($row->status == 'diterima') ? 'bg-success' : (($row->status == 'ditolak') ? 'bg-danger' : 'bg-info') }}">{{ $row->status }}</span></td>
                                    <td>
                                        @if($row->status == "permohonan")
                                            <form class="d-inline" action="" method="post"
                                                  title="Batalkan Permohonan">
                                                @csrf
                                                @method("DELETE")
                                                <input type="hidden" name="kode_sewa" value="">
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
