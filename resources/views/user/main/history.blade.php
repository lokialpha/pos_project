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
            <div class="col-lg-8 offset-2 table-responsive mb-5" style="height: 450px">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{ $o->created_at->format('j-F-Y') }}</td>
                            <td class="align-middle">{{ $o->order_code }}</td>
                            <td class="align-middle">{{ $o->total_price }}</td>
                            <td class="align-middle">
                                @if($o->status == 0)
                                    <span class=" text-primary"><i class="fa-regular fa-clock me-2 "></i>Pending</span>
                                @elseif($o->status == 1)
                                    <span class="text-success"><i class="fa-regular fa-circle-check me-2 "></i>Success</span>
                                @elseif ($o->status == 2)
                                    <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2 "></i>Reject</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $order->links() }}
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->

@endsection

