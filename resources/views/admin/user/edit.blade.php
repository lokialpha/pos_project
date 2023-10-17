@extends('admin.layout.master')

@section('title','Category')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="{{ route('admin#userList') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit User</h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#userUpdate',$user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if ($user->image==null)
                                            @if ($user->gender=='male')
                                                <img src="{{ asset('image/default_male_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                            @else
                                                <img src="{{ asset('image/default_female_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                            @endif
                                        @else
                                            <img class="img-thumbnail shadow-sm rounded-circle" src="{{ asset('storage/'.$user->image) }}"/>
                                        @endif

                                        <div class="mt-4">
                                            <input type="file" name="image" class=" form-control @error('image') is-invalid  @enderror">
                                            @error('image')
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
                                            <input id="cc-pament" name="name" type="text" value="{{ old('name',$user->name) }}" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Admin Name...">
                                            @error('name')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{ old('email',$user->email) }}" class="form-control @error('email') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Admin Name...">
                                            @error('email')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" value="{{ old('phone',$user->phone) }}" class="form-control @error('phone') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Admin Name...">
                                            @error('phone')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class=" form-control @error('address') is-invalid  @enderror" id="" cols="30" rows="10" placeholder="Enter New Admin Name...">{{ old('address',$user->address) }}</textarea>
                                            @error('address')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class=" form-control @error('gender') is-invalid  @enderror">
                                                <option value="" selected >Choose Gender</option>
                                                <option value="male" @if($user->gender=='male') selected  @endif>Male</option>
                                                <option value="female" @if($user->gender=='female') selected  @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
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
