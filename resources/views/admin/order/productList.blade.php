@extends('admin.layouts.master')

@section('title', 'Products List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <a href="{{ route('admin#orderList')}}" class="text-dark"><i class="fa-solid fa-arrow-left-long"></i>Back</a>

                    <div class="row col-6">

                        <div class="card mt-4 rounded-5 bg-dark">
                            <div class="card-body">
                                <h3 class="text-white"> <i class="fa-solid fa-clipboard me-2 text-white"></i>Order Info</h3>
                                <small class="text-info mt-3"><i class="fa-solid fa-truck me-2"></i>Includes Delivery Charges</small>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col text-white"><i class="fa-solid fa-user me-2 text-white"></i> Customer Name</div>
                                    <div class="col text-white">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col text-white"><i class="fa-solid fa-tachograph-digital me-2"></i>Order Code</div>
                                    <div class="col text-white">{{ $orderList[0]->order_code}}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col text-white"><i class="fa-regular fa-calendar me-2"></i>Order Date</div>
                                    <div class="col text-white">{{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col text-white"><i class="fa-brands fa-shopify me-2"></i>Total Price</div>
                                    <div class="col text-white">{{ $order->total_price }} Kyats</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow" style="margin-bottom: 2px !important">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->id }}</td>
                                        <td class="col-2"> <img src="{{ asset('storage/'.$o->product_image) }}" class="img-thumbnail shadow-sm"></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
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

