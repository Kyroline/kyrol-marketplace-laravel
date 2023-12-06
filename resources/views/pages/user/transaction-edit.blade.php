@extends('layouts.user-settings', ['class' => 'g-sidenav-show bg-gray-100', 'title' => 'Transaction | Kyroshopu'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="row">
    <div class="col-7">
        <div class="card" id="password">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h5>Item List</h5>
                    </div>
                    <div class="col-4">
                        <a href="{{route('user.address.store')}}">
                            <a href="http://localhost:8000/util/print-invoice copy.php?id={{$invoice->invoice_id}}"></a>
                            <button class="btn bg-gradient-dark btn-sm float-end mt-0 mb-0">Print</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-top">
                        </div>
                        <div class="dataTable-container">
                            <table class="table table-flush dataTable-table" id="products-list">
                                <thead class="thead-light">
                                    <tr class="text-sm">
                                        <th data-sortable="" style="width: 41.043%;">Item</th>
                                        <th data-sortable="" style="width: 41.1187%;">Qty</th>
                                        <th data-sortable="" style="width: 48.0294%;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->invoice_item as $item)
                                    <tr>
                                        <td class="text-sm">{{ $item->product->product_name }} ({{$item->product_variant->variant_name}})</td>
                                        <td class="text-sm">{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Details</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                All Items ({{$invoice->invoice_item->count()}})
                            </div>
                            <div class="col-7">
                                @convert($invoice->invoice_item->sum('price'))
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                Courier Fee
                            </div>
                            <div class="col-7">
                                @convert($invoice->fee)
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                Total
                            </div>
                            <div class="col-7">
                                @convert($invoice->fee + $invoice->invoice_item->sum('price'))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Address</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            Receiver
                        </div>
                        <div class="col-8">
                            {{ $invoice->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Address
                        </div>
                        <div class="col-8">
                            {{ $invoice->address }}, {{ $invoice->city }}, {{ $invoice->province }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Courier
                        </div>
                        <div class="col-8">
                            {{ $invoice->courier }} - {{ $invoice->service }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Payment</h5>
                </div>
                <div class="card-body">
                    @if ($invoice->status != 0)
                    <div class="row">
                        <div class="col-5">
                            Receipt
                        </div>
                        <div class="col-7">
                            <a href="{{ asset('images/receipt/' . $invoice->image)}}" data-lightbox="{{ asset('images/receipt' . $invoice->image)}}" data-title="My caption">
                                <img class="img-fluid" src="{{ asset('images/receipt/' . $invoice->image)}}" alt=""></a>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-5">
                            Status
                        </div>
                        <div class="col-7">
                            @if ($invoice->status == 0)
                            Waiting for Payment
                            @elseif ($invoice->status == 1)
                            Wating for Confirmation
                            @elseif ($invoice->status == 2)
                            Confirmed
                            @elseif ($invoice->status == 3)
                            Sent
                            @elseif ($invoice->status == 4)
                            Delivered
                            @elseif ($invoice->status == 5)
                            Done
                            @endif
                        </div>
                    </div>
                    @if ($invoice->status == 0)
                    <div class="row">
                        <form action="{{route('user.transaction.update', $invoice->invoice_id  )}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-cotnrol"></div>
                            <input type="hidden" name="type" value="0">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="image">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                            </div>
                            
                            <button class="btn btn-sm btn-success" type="submit" name="confirm" value="1">Upload</button>
                        </form>
                    </div>
                    @elseif ($invoice->status == 3)
                    <div class="row">
                        <form action="{{route('user.transaction.update', $invoice->invoice_id)}}" method="post">
                            @csrf
                            <input type="hidden" name="type" value="3">
                            <button class="btn btn-sm btn-success" type="submit" name="confirm" value="1">Confirm Delivery</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection