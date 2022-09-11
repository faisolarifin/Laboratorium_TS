@extends('templates.user')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">

            @include('templates.alert')

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Pilihan Praktikum</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="mytable">
                        <thead>
                            <tr class="table-primary">
                                <th>Nama Matkul</th>
                                <th>Harga</th>
                                <th>Daftar</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($matkum as $row)
                                <tr>
                                    <td>{{ $row->nama_mp }}</td>
                                    <td>Rp. {{ number_format($row->harga, 2) }}</td>
                                    <td>
                                        <form action="{{ route('mhs.matkum') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_matkum" value="{{ $row->id_mp }}">
                                            <button type="submit" class="btn btn-sm btn-primary" title="Tambah Praktikum"><i
                                                        class='bx bx-add-to-queue'></i></button>
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
