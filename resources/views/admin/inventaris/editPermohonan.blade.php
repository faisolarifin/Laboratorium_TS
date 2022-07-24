@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Inventaris / Permohonan/</span> Tambah</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Alat dan Bahan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adm.inv.permohon.u') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mt-sm-2">
                                {{-- kiri --}}
                                <input type="hidden" name="kode" value="{{ $row->id }}">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="item_name">Item Name</label>
                                        <input type="text" class="form-control" id="item_name" placeholder="Item Name"
                                            name="item_name" value="{{ $row->item_name }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="req_by">Requested By</label>
                                        <input type="text" class="form-control" id="req_by" placeholder="Requested By"
                                            name="req_by" value="{{ $row->req_by }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lab_name">Lab Name</label>
                                        <input type="text" class="form-control" id="lab_name" placeholder="Lab Name"
                                            name="lab_name" value="{{ $row->lab_name }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="vendor">Vendor</label>
                                        <input type="text" class="form-control" id="vendor" placeholder="Vendor"
                                            name="vendor" value="{{ $row->vendor }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="catalog">Catalog #</label>
                                        <input type="text" class="form-control" id="catalog" placeholder="Catalog #"
                                            name="catalog" value="{{ $row->catalog }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="type">Type</label>
                                        <input type="text" class="form-control" id="type" placeholder="Type"
                                            name="type" value="{{ $row->type }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="spend_track">Spend Tracking Code</label>
                                        <input type="text" class="form-control" id="spend_track"
                                            placeholder="Spend Tracking Code" name="spend_track"
                                            value="{{ $row->spend_tack }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="other_detail">Other Details</label>
                                        <input type="text" class="form-control" id="other_detail"
                                            placeholder="Other Details" name="other_detail"
                                            value="{{ $row->other_detail }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="qty">Qty</label>
                                        <input type="number" class="form-control" id="qty" placeholder="Qty"
                                            name="qty" value="{{ $row->qty }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="unit_size">Unit Size</label>
                                        <input type="text" class="form-control" id="unit_size"
                                            placeholder="Unit Size" name="unit_size" value="{{ $row->unit_size }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="url">URL</label>
                                        <input type="text" class="form-control" id="url" placeholder="URL"
                                            name="url" value="{{ $row->url }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="unit_price">Unit Price</label>
                                        <input type="number" class="form-control" id="unit_price"
                                            placeholder="Unit Price" name="unit_price" value="{{ $row->unit_price }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="shipping">Shipping & Handling</label>
                                        <input type="text" class="form-control" id="shipping"
                                            placeholder="Shipping & Handling" name="shipping"
                                            value="{{ $row->shipping }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="po">PO #</label>
                                        <input type="text" class="form-control" id="po" placeholder="PO #"
                                            name="po" value="{{ $row->po }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="req">Requistion #</label>
                                        <input type="text" class="form-control" id="req"
                                            placeholder="Requistion #" name="req" value="{{ $row->req }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="confirm">Confirmation #</label>
                                        <input type="text" class="form-control" id="confirm"
                                            placeholder="Confirmation #" name="confirm" value="{{ $row->confirm }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="invoice">Invoice #</label>
                                        <input type="text" class="form-control" id="invoice"
                                            placeholder="Invoice #" name="invoice" value="{{ $row->invoice }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="tracking">Tracking</label>
                                        <input type="text" class="form-control" id="tracking" placeholder="Tracking"
                                            name="tracking" value="{{ $row->tracking }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="bought">Bought From</label>
                                        <input type="text" class="form-control" id="bought"
                                            placeholder="Bought From" name="bought" value="{{ $row->bought }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="status">Status</label>
                                        <input type="text" class="form-control" id="status" placeholder="Status"
                                            name="status" value="{{ $row->status }}" />
                                    </div>

                                </div>

                                {{-- kanan --}}
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="req_date">Date Requested</label>
                                        <input type="date" class="form-control" id="req_date"
                                            placeholder="Date Requested" name="req_date" value="{{ $row->req_date }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="appove_date">Date Approved</label>
                                        <input type="date" class="form-control" id="appove_date"
                                            placeholder="Date Approved" name="appove_date"
                                            value="{{ $row->appove_date }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="appove_by">Approved By</label>
                                        <input type="text" class="form-control" id="appove_by"
                                            placeholder="Approved By" name="appove_by" value="{{ $row->appove_by }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="order_date">Date Ordered</label>
                                        <input type="date" class="form-control" id="order_date"
                                            placeholder="Date Ordered" name="order_date"
                                            value="{{ $row->order_date }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="order_by">Ordered By</label>
                                        <input type="text" class="form-control" id="order_by"
                                            placeholder="Ordered By" name="order_by" value="{{ $row->order_by }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="cancel_date">Date Cancelled</label>
                                        <input type="date" class="form-control" id="cancel_date"
                                            placeholder="Date Cancelled" name="cancel_date"
                                            value="{{ $row->cancel_date }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="cancel_by">Cancelled By</label>
                                        <input type="text" class="form-control" id="cancel_by"
                                            placeholder="Cancelled By" name="cancel_by" value="{{ $row->cancel_by }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="backorder_date">Date Backorder</label>
                                        <input type="date" class="form-control" id="backorder_date"
                                            placeholder="Date Backorder" name="backorder_date"
                                            value="{{ $row->date_backorder }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="backorder_exp_date">Backorder - Expected
                                            Date</label>
                                        <input type="date" class="form-control" id="backorder_exp_date"
                                            placeholder="Backorder - Expected Date" name="backorder_exp_date"
                                            value="{{ $row->backorder_exp_date }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="backorder_by">Backorder By</label>
                                        <input type="text" class="form-control" id="backorder_by"
                                            placeholder="Backorder By" name="backorder_by"
                                            value="{{ $row->backorder_by }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="receiv_date">Date Received</label>
                                        <input type="date" class="form-control" id="receiv_date"
                                            placeholder="Date Received" name="receiv_date"
                                            value="{{ $row->receiv_date }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="receiv_by">Received By</label>
                                        <input type="text" class="form-control" id="receiv_by"
                                            placeholder="Received By" name="receiv_by" value="{{ $row->receiv_by }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="notes">Notes</label>
                                        <input type="text" class="form-control" id="notes" placeholder="Notes"
                                            name="notes" value="{{ $row->notes }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="appove_msg">Approved Message</label>
                                        <input type="text" class="form-control" id="appove_msg"
                                            placeholder="Approved Message" name="appove_msg"
                                            value="{{ $row->appove_msg }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="order_msg">Ordered Message</label>
                                        <input type="text" class="form-control" id="order_msg"
                                            placeholder="Ordered Message" name="order_msg"
                                            value="{{ $row->order_msg }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="cancel_msg">Cancelled Message</label>
                                        <input type="text" class="form-control" id="cancel_msg"
                                            placeholder="Cancelled Message" name="cancel_msg" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="receiv_msg">Received Message</label>
                                        <input type="text" class="form-control" id="receiv_msg"
                                            placeholder="Received Message" name="receiv_msg"
                                            value="{{ $row->receiv_msg }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="backorder_msg">Backorder Message</label>
                                        <input type="text" class="form-control" id="backorder_msg"
                                            placeholder="Backorder Message" name="backorder_msg"
                                            value="{{ $row->backorder_msg }}" />
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-info"><i class='bx bx-save'></i>
                                            Update</button>
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
