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
    </style>
</head>

@extends('../../layouts.app')
@section('content')
<div class="row">
    <div class="col-3" style="min-height: 88vh; background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
        @if(session('role') == 'admin')
        @include('pages.admin.adminSideBar')
        @elseif (session('role') == 'service')
        @include('pages.serviceProvider.serviceProviderSideBar')
        @endif
    </div>
    <div class="col-9">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh;  width: 100%;
       ">
            <div>


                <h4 class="my-4 fw-bold  text-uppercase">Order List</h4>
                <table class="table table-borded table-striped table-hover">
                    <tr class="text-center">
                        <th>o_Id</th>
                        <th>S_Id</th>
                        <th>P_Id</th>
                        <th>P_Name</th>
                        <th>C_Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Method</th>
                        @if(session('role') == 'service')
                        <th>Action</th>
                        @endif
                    </tr>
                    @foreach($orders as $order)
                    <tr class="text-center ">
                        <td>{{$order->id}}</td>
                        <td>{{$order->sellerId}}</td>
                        <td>{{$order->productId}}</td>
                        <td>{{$order->productName}}</td>
                        <td>{{$order->customerName}}</td>
                        <td>{{$order->Address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->price}}</td>
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
                        <td>{{$order->method}}</td>
                        @if(session('role') == 'service')
                        <td>
                            @if($order->status == 'Pending')
                            <a style="pointer-events: none; " class="btn btn-warning btn-sm"
                                href={{ "/updateOrderStatus/" .$order->id }}>Update</a>
                            <a style="pointer-events: none; " class="btn btn-primary btn-sm" href={{ "/addToDelivery/"
                                .$order->id }}>Add Delivery</a>
                            @elseif($order->status == 'Accept')
                            <a class="btn btn-warning btn-sm" href={{ "/updateOrderStatus/" .$order->id }}>Update</a>
                            <a style="pointer-events: none; " class="btn btn-primary btn-sm" href={{ "/addToDelivery/"
                                .$order->id }}>Add Delivery</a>
                            @elseif($order->status == 'Going')
                            <a class="btn btn-warning btn-sm" href={{ "/updateOrderStatus/" .$order->id }}>Update</a>
                            <a style="pointer-events: none; " class="btn btn-primary btn-sm" href={{ "/addToDelivery/"
                                .$order->id }}>Add Delivery</a>
                            @else
                            <a class="btn btn-warning btn-sm" href={{ "/updateOrderStatus/" .$order->id }}>Update</a>
                            <a class="btn btn-primary btn-sm" href={{ "/addToDelivery/" .$order->id }}>Add Delivery</a>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </table>
                <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('adminDashboard')}}">Home</a>
            </div>
        </div>
    </div>
</div>

@endsection

</html>