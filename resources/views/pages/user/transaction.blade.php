@extends('layouts.user-settings', ['class' => 'g-sidenav-show bg-gray-100', 'title' => 'Transaction | Kyroshopu'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="card" id="password">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h5>Transaction List</h5>
            </div>
            <div class="col-4">
                <a href="{{route('user.address.store')}}">
                    <button class="btn bg-gradient-dark btn-sm float-end mt-0 mb-0"></button>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="card mb-2">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-top">
                        </div>
                        <div class="dataTable-container">
                            <table class="table table-flush dataTable-table" id="products-list">
                                <thead class="thead-light">
                                    <tr class="text-sm">
                                        <th data-sortable="" style="width: 41.043%;">Invoice</th>
                                        <th data-sortable="" style="width: 41.1187%;">Total</th>
                                        <th data-sortable="" style="width: 48.0294%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td class="text-sm"><a href="{{ route('user.transaction.detail', $invoice->invoice_id) }}">{{ $invoice->invoice_id }}</a></td>
                                        <td class="text-sm">{{ $invoice->invoice_item->sum('price') }}</td>
                                        <td>
                                            @if ($invoice->status == 0)
                                            <span class="badge badge-primary">Waiting for Payment</span>
                                            @elseif ($invoice->status == 1)
                                            <span class="badge badge-primary">Waiting for Confirmation</span>
                                            @elseif ($invoice->status == 2)
                                            <span class="badge badge-primary">Confirmed</span>
                                            @elseif ($invoice->status == 3)
                                            <span class="badge badge-primary">Sent</span>
                                            @elseif ($invoice->status == 4)
                                            <span class="badge badge-primary">Delivered</span>
                                            @elseif ($invoice->status == 5)
                                            <span class="badge badge-primary">Done</span>
                                            @endif
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
    </div>
</div>
@endsection