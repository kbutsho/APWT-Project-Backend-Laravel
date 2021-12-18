<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order List</title>
    <style>
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        th,
        td {
            font-size: 15px;
        }
    </style>
</head>

@extends('../../layouts.app')
@section('content')
<div class="row">
    <div class="col-3" style="background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
        <div>
            @if(session('role') == 'admin')
            @include('pages.admin.adminSideBar')
            @elseif(session('role') == 'seller')
            @include('pages.seller.sellerSideBar')
            @endif
        </div>
    </div>
    <div class="col-9">
        <div>
            <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh; width: 100%">
                <div>
                    <h4 class="my-4 fw-bold text-uppercase"> <span class="text-danger">Product {{ $product->name }}'s</span> all orders</h4>
                    <table class="table table-borded table-striped table-hover">
                        <tr class="text-center">
                            <th>Order Id</th>
                            <th>Product Id</th>
                            <th>Customer Id</th>
                            <th>Product Name</th>
                            <th> Customer Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Price</th>
                            <th>status</th>
                            <th>Method</th>
                        </tr>

                        @foreach ($orders as $order)
                        <tr  class="text-center">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->productId }}</td>
                            <td>{{ $order->customerId }}</td>
                            <td>{{ $order->productName }}</td>
                            <td>{{ $order->customerName }}</td>
                            <td>{{ $order->Address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->method }}</td>
                        </tr>

                        @endforeach

                    </table>
                  
                    <a href={{route('sellerDashboard')}} class="btn btn-success btn-sm mt-3 px-3">Home</a>
                    <a href={{route('productList')}} class="btn btn-danger btn-sm mt-3 px-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

</html>