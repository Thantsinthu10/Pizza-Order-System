@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                       <div class="table-responsive table-responsive-data2">

                        <a class="text-dark mb-3" href="{{ route('admin#orderList') }}"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>

                       <div class="row col-5">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h3><i class="fa-solid fa-clipboard me-3"></i>Order Info</h3>
                                <small class="text-warning mt-3"><i class="fa-solid fa-triangle-exclamation"></i> Include Delivery Charges</small>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-user me-3"></i>Customer Name</div>
                                    <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-clock me-3"></i>Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('F j Y')}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-money-bill-wave me-3"></i>Total</div>
                                    <div class="col">{{ $order->total_price}}</div>
                                </div>
                            </div>
                        </div>
                       </div>

                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                <tr class="tr-shadow">
                                    <td></td>
                                    <td class="">{{ $o->user_id }}</td>
                                    <td class="">{{ $o->user_name }}</td>
                                    <td class="col-2"><img src="{{ asset('storage/'.$o->product_image) }}" class="img-thumbnail shadow-sm" alt=""></td>
                                    <td class="">{{ $o->product_name }}</td>
                                    <td class="">{{ $o->created_at->format('F j Y')}}</td>
                                    <td class="">{{ $o->qty }}</td>
                                    <td class="">{{ $o->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="mt-3">
                            {{ $order->links() }}
                        </div> --}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
