@extends('admin.layout.master')

@section('title','Category')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="ms-1">
                        <i class="fa-solid fa-circle-arrow-left text-dark fs-3" onclick="history.back()"></i>
                    </div>

                    <div class="row col-5">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h3><i class="fa-solid fa-file-lines me-3"></i>Order Info</h3>
                                <small class="text-success"><i class="fa-solid fa-triangle-exclamation me-3"></i>Include Delivery Charges</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-user me-3"></i>Name</div>
                                    <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row">
                                    <div class="col"></i><i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row">
                                    <div class="col"><i class="fa-regular fa-calendar-days me-3"></i>Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                </div>
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-money-bill-wave me-3"></i>Total</div>
                                    <div class="col">{{ $order->total_price }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                <tr class="tr-shadow">
                                    <td class="col-2"><img src="{{ asset('storage/'.$o->product_image) }}" class="img-thumbnail shadow-sm"></td>
                                    <td>{{ $o->id }}</td>
                                    <td>{{ $o->product_name }}</td>
                                    <td>{{ $o->qty }}</td>
                                    <td>{{ $o->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
