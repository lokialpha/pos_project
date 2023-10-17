@extends('admin.layout.master')

@section('title','Category')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="ms-1">
                                    <i class="fa-solid fa-circle-arrow-left text-dark fs-3" onclick="history.back()"></i>
                                </div>
                                <h3 class="text-center title-2">Edit Pizza Info</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">

                                        <img class="img-thumbnail shadow-sm" src="{{ asset('storage/'.$pizza->image) }}"/>

                                        <div class="mt-4">
                                            <input type="file" name="pizzaImage" class=" form-control @error('pizzaImage') is-invalid  @enderror">
                                            @error('pizzaImage')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-dark text-white col-12">
                                                <i class="fa-solid fa-arrow-up-from-bracket me-2"></i> Update
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-6 offset-1">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName',$pizza->name) }}" class="form-control @error('pizzaName') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Product Name...">
                                            @error('pizzaName')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class=" form-control @error('pizzaDescription') is-invalid  @enderror" id="" cols="30" rows="10" placeholder="Enter New Description...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class=" form-control @error('pizzaCategory') is-invalid  @enderror">
                                                <option value="" selected >Choose Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}" @if($pizza->category_id == $c->id) selected  @endif>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="pizzaPrice" value="{{ old('pizzaPrice',$pizza->price) }}" class="form-control @error('pizzaPrice') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Price...">
                                            @error('pizzaPrice')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" class="form-control @error('pizzaWaitingTime') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Waiting Time...">
                                            @error('pizzaWaitingTime')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="pizzaViewCount" disabled type="number" value="{{ old('pizzaViewCount',$pizza->view_count) }}" class="form-control @error('pizzaViewCount') is-invalid  @enderror" aria-required="true" aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
