@extends('layouts.user-settings', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="card" id="password">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h5>Address List</h5>
            </div>
            <div class="col-4">
                <a href="{{route('user.address.store')}}">
                    <button class="btn bg-gradient-dark btn-sm float-end mt-0 mb-0">Add New Address</button>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        @foreach($addresses as $address)
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h6>{{ $address->label }}</h6>
                    </div>
                    <div class="col-4">
                        <a href=""><i class="fa fa-trash float-end"></i></a>
                    </div>
                </div>
                <strong>{{ $address->receiver }}</strong>
                <span>{{ $address->phone }}</span><br>
                <span>{{ $address->address }}</span><br>
                <p class="mb-0">{{ $address->province }}, {{ $address->city }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection