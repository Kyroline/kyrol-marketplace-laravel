@extends('layouts.user-settings', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="card card-body" id="profile">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-auto col-4">
            <div class="avatar avatar-xl position-relative">
                <img src="../../../assets/img/team-3.jpg" alt="bruce" class="w-100 border-radius-lg shadow-sm">
            </div>
        </div>
        <div class="col-sm-auto col-8 my-auto">
            <div class="h-100">
                <h5 class="mb-1 font-weight-bolder">
                    Mark Johnson
                </h5>
                <p class="mb-0 font-weight-bold text-sm">
                    CEO / Co-Founder
                </p>
            </div>
        </div>
        <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
            <label class="form-check-label mb-0">
                <small id="profileVisibility">
                    Switch to invisible
                </small>
            </label>
            <div class="form-check form-switch ms-2">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked="" onchange="visible()">
            </div>
        </div>
    </div>
</div>

<div class="card mt-4" id="password">
    <div class="card-header">
        <h5>Change Password</h5>
    </div>
    <div class="card-body pt-0">
        <label class="form-label">Current password</label>
        <div class="form-group">
            <input class="form-control" type="password" placeholder="Current password" onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
        <label class="form-label">New password</label>
        <div class="form-group">
            <input class="form-control" type="password" placeholder="New password" onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
        <label class="form-label">Confirm new password</label>
        <div class="form-group">
            <input class="form-control" type="password" placeholder="Confirm password" onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
        <h5 class="mt-5">Password requirements</h5>
        <p class="text-muted mb-2">
            Please follow this guide for a strong password:
        </p>
        <ul class="text-muted ps-4 mb-0 float-start">
            <li>
                <span class="text-sm">One special characters</span>
            </li>
            <li>
                <span class="text-sm">Min 6 characters</span>
            </li>
            <li>
                <span class="text-sm">One number (2 are recommended)</span>
            </li>
            <li>
                <span class="text-sm">Change it often</span>
            </li>
        </ul>
        <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
    </div>
</div>
@endsection