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
            <h5 class="mb-0">Edit Plan</h5>
          </div>
          <div class="card-body">

  <table class="table table-striped">
    <tr class="table-primary">
        <td>Nama</td>
        <td>N P M</td>
        <td>No. Hp</td>
        <td>Status Bayar</td>
        <td>Status Terima</td>
        <td>Aksi</td>
    </tr>
    @foreach ($pendaftar as $row)
        <tr>
            <td>{{strtoupper($row->mhs->nama)}}</td>
            <td>{{$row->mhs->nim}}</td>
            <td>{{$row->mhs->no_hp}}</td>
            <td><span class="badge bg-success">{{$row->status_bayar}}</span></td>
            <td><span class="badge bg-success">{{$row->status_acc_fix}}</span></td>
            <td>
                <form class="d-inline" action="{{route('adm.prak.bayar')}}" method="post">
                    @csrf
                    <input type="hidden" name="kode_daftar" value="{{ $row->id_daftarmp }}">
                    <button type="submit" class="btn btn-sm btn-warning">Bayar</button>
                </form>

                <form class="d-inline" action="{{route('adm.prak.accfix')}}" method="post">
                    @csrf
                    <input type="hidden" name="kode_daftar" value="{{ $row->id_daftarmp }}">
                    <input type="hidden" name="kode_mhs" value="{{$row->mhs->id_mhs}}">
                    <button type="submit" class="btn btn-sm btn-success">Terima</button>
                </form>
                <a href="{{route('adm.prak.listdaftar', $row->id_daftarmp)}}" class="btn btn-sm btn-primary">Detail</a>

            </td>
        </tr>
        
    @endforeach
  </table>

</div>
</div>
</div>
</div>
</div>
    
@endsection