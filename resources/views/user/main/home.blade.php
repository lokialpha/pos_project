@extends('user.layouts.master')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4"  style="height: 900px">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-white pr-3">Filter by Catigories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class=" mt-2" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}"><label class=" text-dark" for="price-1">All</label></a>
                        </div>

                        @foreach ($category as $c)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter',$c->id) }}"><label class=" text-dark" for="price-1">{{ $c->name }}</label></a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <!-- Size Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-white pr-3">Filter by size</span></h5> --}}
                {{-- <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div> --}}
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                          {{ count($cart) }}
                                          <span class="visually-hidden">unread messages</span>
                                        </span>
                                      </button>
                                </a>
                                <a href="{{ route('user#history') }}" class=" ml-2">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-clock-rotate-left mr-2"></i> History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                          {{ count($history) }}
                                          <span class="visually-hidden">unread messages</span>
                                        </span>
                                      </button>
                                </a>
                            </div>

                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class=" form-control">
                                        <option value="asc">Ascending</option>
                                        <option value="desc" selected>Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 220px" src="{{ asset('storage/'.$p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetail',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                                {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5>
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="col-2 offset-5 shadow-sm text-center fs-4 py-4"><i class="fa-solid fa-ban mr-2"></i>Empty!</p>
                        @endif
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('scriptSource')

<script>

    $(document).ready(function(){
        $('#sortingOption').change(function(){
            $eventOption = $('#sortingOption').val();
            if($eventOption == 'asc'){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizza/list',
                    data : {'status' : 'asc'},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for ( $i = 0; $i < response.length; $i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 220px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        $('#dataList').html($list);
                        // console.log($list);
                    }
                })
            }else if($eventOption == 'desc'){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizza/list',
                    data : {'status' : 'desc'},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for ( $i = 0; $i < response.length; $i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 220px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        $('#dataList').html($list);
                        // console.log($list);
                    }
                })
            }
        })
    });

</script>

@endsection
