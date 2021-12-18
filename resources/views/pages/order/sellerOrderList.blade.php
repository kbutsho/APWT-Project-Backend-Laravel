<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seller Order List</title>
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
    <div class="col-3"  style="min-height: 88vh; background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
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
            <div class="d-flex justify-content-center align-items-center"
                style="min-height: 88vh; width: 100%">
                <div>
                    {{-- update message --}}
                    @if(session('order-update'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('order-update') }}</span>
                    </div>
                    @endif
                    {{-- delete message --}}
                    @if(session('order-delete'))
                    <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                        <span class="fw-bold">
                            {{ session('order-delete') }}
                        </span>
                    </div>
                    @endif
                    <h4 class="my-4 fw-bold  text-uppercase">Order List</h4>
                    <table class="table table-borded table-striped table-hover">
                        <tr class="text-center">
                            <th>Order Id</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Phone</th>                           
                            <th>price</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($orders as $order)
                            @if(session('id') == $order->sellerId)
                                <tr class="text-center">
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->productName}}</td>
                                    <td>{{$order->customerName}}</td>
                                    <td>{{$order->Address}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->price}}</td>
                                    <td>{{$order->method}}</td>
                                    <td>
                                        @if($order->status == 'Pending')
                                            <span class="text-danger fw-bold">{{$order->status}}</span>
                                        @elseif($order->status == 'Accept')
                                            <span class="text-success fw-bold">{{$order->status}}</span>
                                        @elseif($order->status == 'Going')
                                            <span class="text-primary fw-bold">{{$order->status}}</span>
                                        @else
                                            <span class="text-black fw-bold">{{$order->status}}</span>
                                        @endif
                                    </td>

                                    <td> 
                                        <a class="btn btn-primary btn-sm" href={{ "/updateOrderStatus/" .$order->id }}>Update</a>
                                        <a class="btn btn-danger btn-sm" href={{ "/sellerOrderDelete/" .$order->id }}>Delete</a>       
                                    </td>
                                </tr>       
                            @endif
                        @endforeach
                    </table>
                    @if(session('role') == 'seller')
                        {{-- <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('addProduct')}}">Add</a> --}}
                        <a class="btn btn-danger btn-sm mb-3 px-3" href="{{route('sellerDashboard')}}">Back</a>
                        @else
                        <a class="btn btn-danger btn-sm mb-3 px-3" href="{{route('adminDashboard')}}">Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

</html>