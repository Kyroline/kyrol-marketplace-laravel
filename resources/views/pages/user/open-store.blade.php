@extends('layouts.user-settings', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="card" id="password">
    <div class="card-header">
        <h5>New Store</h5>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('user.store.store') }}" method="POST">
            @csrf
            <label class="form-label">Store Name</label>
            <div class="form-group">
                <input class="form-control" id="name" name="name" type="text" placeholder="Label" onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
            <label class="form-label">Store Domain</label>
            <div class="form-group">
                <input class="form-control" name="domain" id ="domain" type="text" placeholder="Name" onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
            <label class="form-label">Phone Number</label>
            <div class="form-group">
                <input class="form-control" name="phone" id ="phone" type="text" placeholder="Phone" onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
            <label class="form-label">Address</label>
            <div class="form-group">
                <textarea class="form-control" name="address" id ="address" rows="3"></textarea>
            </div>
            <div class="row">
            <div class="form-group col-6">
                <label for="exampleFormControlSelect2">Province</label>
                <select class="form-control" name="province" id="province">
                    <option></option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="exampleFormControlSelect2">City</label>
                <select class="form-control" name="city" id="city">
                    <option></option>
                </select>
            </div>
            </div>
            <div class="form-group row">
                <input class="btn bg-gradient-dark btn-sm float-end mt-0 mb-0" type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>
<script>
    $("#province").change(function() {
      var selectedVariant = $(this).children("option:selected").val();
      var selectedProvince = $(this).children("option:selected").text();
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "{{ route('api.rajaongkir.getcity') }}",
        data: {
            province: selectedVariant
        },
        success: function(msg) {
          $("select#city").html(msg);
        }
      });
    });
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "{{ route('api.rajaongkir.getprovince') }}",
            success: function(msg) {
                $("select#province").html(msg);
            }
        });
    });
</script>
@endsection