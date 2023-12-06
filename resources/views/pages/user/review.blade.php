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
                                        <th data-sortable="" style="width: 41.043%;">Item</th>
                                        <th>#</th>
                                        <th data-sortable="" style="width: 41.1187%;">Score</th>
                                        <th data-sortable="" style="width: 48.0294%;">Desc</th>
                                        <th data-sortable="" style=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                    <form action="{{ route('user.review.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="review_id" value="{{$review->id}}">
                                        <tr>
                                            @if ($review->score == null)
                                            <td class="text-sm">{{ $review->product->product_name }} ({{ $review->product_variant->variant_name}})</td>
                                            <td class="text-sm">{{$review->qty}}</td>
                                            <td class="text-sm">
                                                <select class="form-control" name="score">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="description" id="" cols="30" rows="6"></textarea>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" type="submit">+</button>
                                            </td>
                                            @else
                                            <td class="text-sm">{{ $review->product->product_name }} ({{ $review->product_variant->variant_name}})</td>
                                            <td class="text-sm">{{$review->qty}}</td>
                                            <td class="text-sm">{{ $review->score }}</td>
                                            <td>{{ $review->review }}</td>
                                            @endif
                                        </tr>
                                    </form>
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