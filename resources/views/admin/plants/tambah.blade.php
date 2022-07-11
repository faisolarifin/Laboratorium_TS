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

      <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Tambah Plan</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('plants.tambah') }}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="nm">Nama Plant</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nm" placeholder="Nama Plant" name="nm_plant" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="hg">Harga</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="hg" placeholder="Harga" name="price" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="hg">Expired (Hari)</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="hg" placeholder="Expired" name="expired" />
                  </div>
                </div>
                
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    
@endsection