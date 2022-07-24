@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Inventaris / Alat dan Bahan/</span> Tambah</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Alat dan Bahan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adm.inv.bahan.s')}}" method="post">
                            @csrf
                            <div class="row mt-sm-2">
                                {{-- kiri --}}
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="serial_num">Serial Number</label>
                                        <input type="text" class="form-control" id="serial_num"
                                            placeholder="Serial Number" name="serial_num" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="item_name">Item Name</label>
                                        <input type="text" class="form-control" id="item_name" placeholder="Item Name"
                                            name="item_name" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="vendor">Vendor</label>
                                        <input type="text" class="form-control" id="vendor" placeholder="Vendor"
                                            name="vendor" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="catalog">Catalog #</label>
                                        <input type="text" class="form-control" id="catalog" placeholder="Catalog #"
                                            name="catalog" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="owner">Owner</label>
                                        <input type="text" class="form-control" id="owner" placeholder="Owner"
                                            name="owner" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="location">Location</label>
                                        <input type="text" class="form-control" id="location" placeholder="Location"
                                            name="location" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="sub_loc">Sub-Location</label>
                                        <input type="text" class="form-control" id="sub_loc" placeholder="Sub-Location"
                                            name="sub_loc" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="loc_detail">Location Details</label>
                                        <input type="text" class="form-control" id="loc_detail"
                                            placeholder="Location Details" name="loc_detail" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="price">Price</label>
                                        <input type="number" class="form-control" id="price" placeholder="Price"
                                            name="price" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="amount_ins">Mount in Stock</label>
                                        <input type="number" class="form-control" id="amount_ins"
                                            placeholder="Mount in Stock" name="amount_ins" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="unit_size">Unit Size</label>
                                        <input type="text" class="form-control" id="unit_size" placeholder="Unit Size"
                                            name="unit_size" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="url">URL</label>
                                        <input type="url" class="form-control" id="url" placeholder="URL"
                                            name="url" />
                                    </div>
                                </div>

                                {{-- kanan --}}
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="tech_detail">Technical Details</label>
                                        <input type="text" class="form-control" id="tech_detail"
                                            placeholder="Technical Details" name="tech_detail" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="expired_date">Expiration Date</label>
                                        <input type="date" class="form-control" id="expired_date"
                                            placeholder="Expiration Date" name="expired_date" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lot_num">Lot Number</label>
                                        <input type="number" class="form-control" id="lot_num"
                                            placeholder="Lot Number" name="lot_num" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="cas_num">CAS Number</label>
                                        <input type="number" class="form-control" id="cas_num"
                                            placeholder="CAS Number" name="cas_num" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="cont_person">Contact Person</label>
                                        <input type="number" class="form-control" id="cont_person"
                                            placeholder="Contact Person" name="cont_person" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="cont_phone">Contact Phone</label>
                                        <input type="number" class="form-control" id="cont_phone"
                                            placeholder="Contact Phone" name="cont_phone" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="install_date">Date Installed</label>
                                        <input type="date" class="form-control" id="install_date"
                                            placeholder="Date Installed" name="install_date" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="publish_date">Date Puchased</label>
                                        <input type="date" class="form-control" id="publish_date"
                                            placeholder="Date Puchased" name="publish_date" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="mntc_hist">Maintenance History</label>
                                        <input type="text" class="form-control" id="mntc_hist"
                                            placeholder="Maintenance History" name="mntc_hist" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="serial">Serial #</label>
                                        <input type="text" class="form-control" id="serial" placeholder="Serial #"
                                            name="serial" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="univ_tag">University Tag #</label>
                                        <input type="text" class="form-control" id="univ_tag"
                                            placeholder="University Tag #" name="univ_tag" />
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class='bx bx-save'></i>
                                            Simpan</button>
                                        <button type="reset" class="btn btn-sm btn-danger"><i class='bx bx-reset'></i>
                                            Reset</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
