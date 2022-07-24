@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Inventaris /</span> Alat dan Bahan</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Alat dan Bahan</h5>
                        <a href="{{ route('adm.inv.bahan.t') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i> Tambah</button></a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="table-primary">
                                    <td>Serial Number</td>
                                    <td>Item Name</td>
                                    <td>Vendor</td>
                                    <td>Catalog #</td>
                                    <td>Owner</td>
                                    <td>Location</td>
                                    <td>Sub Location</td>
                                    <td>Location Details</td>
                                    <td>Price</td>
                                    <td>Amount In Stock</td>
                                    <td>Unit Size</td>
                                    <td>URL</td>
                                    <td>Technical Details</td>
                                    <td>Expiration Date</td>
                                    <td>Lot Number</td>
                                    <td>CAS Number</td>
                                    <td>Contact Phone</td>
                                    <td>Contact Person</td>
                                    <td>Date Installed</td>
                                    <td>Date Purchased</td>
                                    <td>Maintenance History</td>
                                    <td>Serial #</td>
                                    <td>University Tag #</td>
                                    <td>Aksi</td>
                                </tr>
                                @foreach ($bahan as $row)
                                    <tr class="align-top">
                                        <td>{{ $row->serial_num }}</td>
                                        <td>{{ $row->item_name }}</td>
                                        <td>{{ $row->vendor }}</td>
                                        <td>{{ $row->catalog }}</td>
                                        <td>{{ $row->owner }}</td>
                                        <td>{{ $row->location }}</td>
                                        <td>{{ $row->sub_loc }}</td>
                                        <td>{{ $row->loc_detail }}</td>
                                        <td>{{ $row->price }}</td>
                                        <td>{{ $row->amount_ins }}</td>
                                        <td>{{ $row->unit_size }}</td>
                                        <td>{{ $row->url }}</td>
                                        <td>{{ $row->tech_detail }}</td>
                                        <td>{{ $row->expired_date }}</td>
                                        <td>{{ $row->lot_num }}</td>
                                        <td>{{ $row->cas_num }}</td>
                                        <td>{{ $row->cont_person }}</td>
                                        <td>{{ $row->cont_number }}</td>
                                        <td>{{ $row->install_date }}</td>
                                        <td>{{ $row->publish_date }}</td>
                                        <td>{{ $row->mntc_hist }}</td>
                                        <td>{{ $row->serial }}</td>
                                        <td>{{ $row->univ_tag }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('adm.inv.bahan.e', $row->id)}}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form class="d-inline" action="{{route('adm.inv.bahan.d')}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="kode" value="{{ $row->id }}">
                                                        <button type="submit" class="dropdown-item"><i
                                                                class='bx bx-trash-alt'></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
