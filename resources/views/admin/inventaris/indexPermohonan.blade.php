@extends('templates.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Inventaris /</span> Permohonan</h5>

        @include('templates.alert')

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Permohonan</h5>
                        <a href="{{ route('adm.inv.permohon.t') }}"><button class="btn btn-sm btn-primary"><i
                                    class='bx bx-plus'></i> Tambah</button></a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="table-primary">
                                    <td>#</td>
                                    <td>Item Name</td>
                                    <td>Request By</td>
                                    <td>Lab Name</td>
                                    <td>Vendor</td>
                                    <td>Catalog #</td>
                                    <td>Type</td>
                                    <td>Send Tracking Code</td>
                                    <td>Other Details</td>
                                    <td>Qty</td>
                                    <td>Unit Size</td>
                                    <td>Url</td>
                                    <td>Unit Price</td>
                                    <td>Total Price</td>
                                    <td>Shipping & Handling</td>
                                    <td>PO #</td>
                                    <td>Requisition #</td>
                                    <td>Confirmation #</td>
                                    <td>Invoice #</td>
                                    <td>Tracking #</td>
                                    <td>Bought From</td>
                                    <td>Status</td>
                                    <td>Date Requested</td>
                                    <td>Date Approved</td>
                                    <td>Approved By</td>
                                    <td>Date Order</td>
                                    <td>Order By</td>
                                    <td>Date Cancelled</td>
                                    <td>Cancelled By</td>
                                    <td>Date Backorder</td>
                                    <td>Backorder Expected Date</td>
                                    <td>Backorder By</td>
                                    <td>Data Received</td>
                                    <td>Received By</td>
                                    <td>Notes</td>
                                    <td>Approved Message</td>
                                    <td>Ordered Message</td>
                                    <td>Cancelled Message</td>
                                    <td>Received Message</td>
                                    <td>Backorder Message</td>
                                    <td>Aksi</td>
                                </tr>
                                @php($no = 0)
                                @foreach ($permohonan as $row)
                                    <tr class="align-top">
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->item_name }}</td>
                                        <td>{{ $row->req_by }}</td>
                                        <td>{{ $row->lab_name }}</td>
                                        <td>{{ $row->vendor }}</td>
                                        <td>{{ $row->catalog }}</td>
                                        <td>{{ $row->type }}</td>
                                        <td>{{ $row->spend_track }}</td>
                                        <td>{{ $row->other_detail }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>{{ $row->unit_size }}</td>
                                        <td>{{ $row->url }}</td>
                                        <td>{{ $row->unit_price }}</td>
                                        <td>{{ (int) $row->qty * (float) $row->unit_price }}</td>
                                        <td>{{ $row->shipping }}</td>
                                        <td>{{ $row->po }}</td>
                                        <td>{{ $row->req }}</td>
                                        <td>{{ $row->confirm }}</td>
                                        <td>{{ $row->invoice }}</td>
                                        <td>{{ $row->tracking }}</td>
                                        <td>{{ $row->bought }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ $row->req_date }}</td>
                                        <td>{{ $row->approve_date }}</td>
                                        <td>{{ $row->approve_by }}</td>
                                        <td>{{ $row->order_date }}</td>
                                        <td>{{ $row->order_by }}</td>
                                        <td>{{ $row->cancel_date }}</td>
                                        <td>{{ $row->cancel_by }}</td>
                                        <td>{{ $row->backorder_date }}</td>
                                        <td>#</td>
                                        <td>{{ $row->backorder_by }}</td>
                                        <td>{{ $row->reveice_date }}</td>
                                        <td>{{ $row->reveice_by }}</td>
                                        <td>{{ $row->notes }}</td>
                                        <td>{{ $row->approve_msg }}</td>
                                        <td>{{ $row->order_msg }}</td>
                                        <td>{{ $row->cancel_msg }}</td>
                                        <td>{{ $row->backorder_msg }}</td>
                                        <td>{{ $row->receive_msg }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('adm.inv.permohon.e', $row->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form class="d-inline" action="{{ route('adm.inv.permohon.d') }}"
                                                        method="post">
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
