@extends('admin.layout.master')

@section('title','Category')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">

                    <div class="row">
                        <div class="col-3 offset-9 mb-2">
                            {{-- alert box --}}
                            @if (session('updateSuccess'))
                                <div class="">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-circle-check"></i> {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('category#list') }}">
                                <div class="ms-1">
                                    <i class="fa-solid fa-circle-arrow-left text-dark fs-3"></i>
                                </div>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Admin Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image==null)
                                        @if (Auth::user()->gender=='male')
                                            <img src="{{ asset('image/default_male_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                        @else
                                            <img src="{{ asset('image/default_female_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm rounded-circle"/>
                                    @endif
                                </div>
                                <div class="col-6 offset-1">
                                    <h4 class="my-4"><i class="fa-solid fa-user me-2"></i> {{ Auth::user()->name }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-envelope me-2"></i> {{ Auth::user()->email }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-phone me-2"></i> {{ Auth::user()->phone }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-map-location-dot me-2"></i> {{ Auth::user()->address }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-venus-mars me-2"></i> {{ Auth::user()->gender }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-user-clock me-2"></i> {{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 offset-10 mt-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
