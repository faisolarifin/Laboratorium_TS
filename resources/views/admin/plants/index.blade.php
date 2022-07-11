@extends('templates.admin_template')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Master Data /</span> Plants</h4>
      
      <div class="alert alert-info shadow-sm alert-dismissible" role="alert">
        This is an info dismissible alert — check it out!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      
      <!-- Basic Bootstrap Table -->
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Data Plants</h5>
          <a href="{{ route('plants.tambah') }}" class="btn btn-sm btn-primary">Tambah Plant</a>
        </div>
          <div class="table-responsive text-nowrap">
           <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Plant</th>
                <th>Harga</th>
                <th>Kadaluarsa</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($plants_data as $plant)
              <tr>
                  <td><strong>{{ ++$i }}</strong></td>
                  <td>{{ $plant->nm_plant }}</td>
                  <td>{{ $plant->price }}</td>
                  <td><span class="badge bg-label-primary me-1">{{ $plant->expired }} hari</span></td>
                  <td>
                      <a href="{{route('plants.edit', $plant->id_plant)}}" class="btn btn-info btn-sm">Edit</a>
                      <form class="d-inline" action="{{route('plants.hapus', $plant->id_plant)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                  </td>
                </tr>
                @endforeach
                
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Basic Bootstrap Table -->
    </div>
</div>
    
@endsection