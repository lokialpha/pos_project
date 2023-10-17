@extends('user.layouts.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <a href="{{ route('user#home') }}">
                <div class="ms-1 mb-3">
                    <i class="fa-solid fa-circle-arrow-left text-dark fs-3"></i>
                </div>
            </a>
            <div class="col-lg-6 offset-3 table-responsive mb-5">
               <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Contact Me</h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#sentMessage') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="form-group">
                                        <label class="control-label mb-1 ">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control shadow-sm @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name...">
                                        @error('name')
                                            <div class=" invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" value="{{ old('email',Auth::user()->email) }}" class="form-control shadow-sm @error('email') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email...">
                                        @error('email')
                                            <div class=" invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Message</label>
                                        <textarea name="message" class=" form-control shadow-sm @error('address') is-invalid  @enderror" id="" cols="30" rows="10" placeholder="Enter Your Message..."></textarea>
                                        @error('address')
                                            <div class=" invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-4 col-4 offset-8">
                                        <button type="submit" class="btn btn-dark text-white p-2 shadow">
                                            <i class="fa-solid fa-paper-plane me-2"></i> Send Message
                                        </button>
                                    </div>
                                </div>
                            </div>
                       </form>
                    </div>
               </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->

@endsection

