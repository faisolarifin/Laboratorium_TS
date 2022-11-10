@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Penelitian /</span> Daftar Pengujian</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Daftar Pengujian</h5>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalTop" data-bs=""><i
                                    class='bx bx-plus'></i></button>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered" id="mytable">
                            <thead>
                                <tr class="table-primary">
                                    <th width="20">No.</th>
                                    <th width="330">Nama Kategori</th>
                                    <th width="190">Nama Pengujian</th>
                                    <th width="130">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($no = 0)
                                @foreach ($pengujian as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->nm_kategori }}</td>
                                        <td>{{ $row->nm_pengujian }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTop" data-bs="{{$row->id_pgj}}:{{ $row->nm_kategori }}:{{ $row->nm_pengujian }}"><i class='bx bxs-edit'></i></button>
                                            <form class="d-inline" action="{{ route('adm.plt.pengujian.delete', $row->id_pgj) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class='bx bx-trash-alt'></i></button>
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

@section('modal')
    <div class="modal modal-top fade" id="modalTop" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('adm.plt.pengujian.save')}}" method="post">
                @csrf
                <input type="hidden" id="_method" name="_method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTopTitle">Tambah Pengujian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="hidden" id="kode_pgj" name="kode_pgj">
                        <label class="form-label" for="kategori">Nama Kategori</label>
                        <select class="form-select" id="kategori" name="kategori">
                            <option value="BAHAN">BAHAN</option>
                            <option value="PERKERASAN JALAN RAYA">PERKERASAN JALAN RAYA</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label class="form-label" for="pgj">Nama Pengujian</label>
                        <input type="text" class="form-control" id="pgj" name="pgj" placeholder="Nama Pengujian" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let modalTop = document.getElementById('modalTop')
        modalTop.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget
            let data = button.getAttribute('data-bs').split(':')
            if (data.length == 1) return;
            modalTop.querySelector('form.modal-content').action = "{{route('adm.plt.pengujian.update')}}"
            modalTop.querySelector('.modal-title').textContent = "Edit Pengujian";
            modalTop.querySelector('#_method').value = "PUT";
            modalTop.querySelector('.modal-body #kode_pgj').value = data[0];
            modalTop.querySelector('.modal-body #kategori').value = data[1];
            modalTop.querySelector('.modal-body #pgj').value = data[2];
        });
        modalTop.addEventListener('hide.bs.modal', function (event) {
            modalTop.querySelector('.modal-title').textContent = "Tambah Pengujian";
            modalTop.querySelector('#_method').value = "POST";
            let form = modalTop.querySelector('form.modal-content');
            form.action = "{{route('adm.plt.pengujian.save')}}"
            form.reset();
        })
    </script>
@endsection
