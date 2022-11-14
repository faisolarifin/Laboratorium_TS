@extends('templates.admin')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Praktikum /</span> Pendaftar</h5>

    @include('templates.alert')

    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Pendaftar Praktikum</h5>
          </div>
          <div class="card-body">

  <table class="table table-striped table-bordered" id="mytable">
      <thead>
        <tr class="table-primary">
            <th>#</th>
            <th>Nama</th>
            <th>N P M</th>
            <th>No. Hp</th>
            <th>Status Bayar</th>
            <th>Status Terima</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php($no=0)
        @foreach ($pendaftar as $row)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{strtoupper($row->mhs->nama)}}</td>
                <td>{{$row->mhs->username}}</td>
                <td>{{$row->mhs->no_hp}}</td>
                <td><span class="badge {{ $row->status_bayar != 'belum' ? 'bg-success' : 'bg-danger' }}">{{$row->status_bayar}}</span></td>
                <td><span class="badge {{ $row->status_acc_fix != 'belum' ? 'bg-success' : 'bg-danger' }}">{{$row->status_acc_fix}}</span></td>
                <td>
                    <form class="d-inline" action="{{route('adm.prak.bayar')}}" method="post">
                        @csrf
                        <input type="hidden" name="kode_daftar" value="{{ $row->id_daftarmp }}">
                        <button type="submit" class="btn btn-sm btn-warning">Bayar</button>
                    </form>

                    <form class="d-inline" action="{{route('adm.prak.accfix')}}" method="post">
                        @csrf
                        <input type="hidden" name="kode_daftar" value="{{ $row->id_daftarmp }}">
                        <input type="hidden" name="kode_mhs" value="{{$row->mhs->id_user}}">
                        <button type="submit" class="btn btn-sm btn-success">Terima</button>
                    </form>
                    <a href="{{route('adm.prak.listdaftar', $row->id_daftarmp)}}"><button class="btn btn-sm btn-primary">Detail</button></a>
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
