@extends('templates.mhs')

@section('content')

<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Sertifikat Praktikum</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Praktikum</th>
                        <th>Periode</th>
                        <th>Semester</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (count($matkum) == 0)
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-danger text-center mb-0">
                                    Nilai praktikum tidak ditemukan!
                                </div>
                            </td>
                        </tr>
                    
                    @else
                        @foreach ($matkum as $row)
                            <tr>
                                <td>{{$row->matkum->nama_mp}}</td>
                                <td>{{$row->periode->thn_ajaran}}</td>
                                <td>{{$row->periode->semester}}</td>
                                <td><span class="badge bg-info">{{$row->detail->first()->nilai}}</span></td>
                            </tr>                     
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
      </div>
    </div>
   </div>
</div>
    
@endsection