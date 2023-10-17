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
                            <div class="ms-1">
                                <i class="fa-solid fa-circle-arrow-left text-dark fs-3" onclick="history.back()"></i>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <img class="img-thumbnail shadow-sm" src="{{ asset('storage/'.$pizza->image) }}"/>
                                    <h3 class="mt-2 text-center"><i class="fa-solid fa-feather"></i> {{ $pizza->name }}</h3>

                                </div>
                                <div class="col-7">
                                    <span class="my-4 btn btn-dark text-white "><i class="fa-solid fa-money-bill-wave"></i> {{ $pizza->price }} Kyats</span>
                                    <span class="my-4 btn btn-dark text-white "><i class="fa-solid fa-stopwatch"></i> {{ $pizza->waiting_time }}mins</span>
                                    <span class="my-4 btn btn-dark text-white "><i class="fa-solid fa-eye"></i> {{ $pizza->view_count }}</span>
                                    <span class="my-4 btn btn-dark text-white "><i class="fa-solid fa-clone"></i> {{ $pizza->category_name }}</span>
                                    <span class="my-4 btn btn-dark text-white "><i class="fa-solid fa-user-clock me-2"></i> {{ $pizza->created_at->format('j-F-Y') }}</span>
                                    <h5 class="my-4"><i class="fa-solid fa-circle-info"></i> Detail</h5>
                                    <div class="">{{ $pizza->description }}</div>

                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-2 offset-10 mt-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
