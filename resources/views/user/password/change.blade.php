@extends('user.layouts.master')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('user#home') }}">
                                <div class="ms-1">
                                    <i class="fa-solid fa-circle-arrow-left text-dark fs-3"></i>
                                </div>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            @if (session('success'))
                                <div class="">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            @if (session('notMatch'))
                                <div class="">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-circle-xmark"></i> {{ session('notMatch') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Old Password</label>
                                    <input name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                    @error('oldPassword')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input name="newPassword" type="password" class="form-control @error('newPassword') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                    @error('newPassword')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm Password</label>
                                    <input name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                    @error('confirmPassword')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg bg-dark text-white btn-block ">
                                        <i class="fa-solid fa-key mr-1"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
