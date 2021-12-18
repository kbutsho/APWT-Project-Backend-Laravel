<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery List</title>
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
        @if(session('role') == 'service')
        @include('pages.serviceProvider.serviceProviderSideBar')
        @elseif(session('role') == 'customer')
        @include('pages.customer.customerSideBar')
        @elseif(session('role') == 'admin')
        @include('pages.admin.adminSideBar')
        @endif
    </div>
    <div class="col-9">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh;  width: 100%;">
            <div>
                {{-- update message --}}
                @if(session('delivery-update'))
                <div class="alert alert-warning w-100 text-center" role="alert">
                    <span class="fw-bold"> {{ session('delivery-update') }}</span>
                </div>
                @endif
                {{-- delete message --}}
                @if(session('delivery-delete'))
                <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('delivery-delete') }}
                    </span>
                </div>
                @endif
                @if(session('delivery-added'))
                <div class="alert alert-success font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('delivery-added') }}
                    </span>
                </div>
                @endif
                <h4 class="my-4 fw-bold  text-uppercase">Delivery List</h4>
                <table class="table table-borded table-striped table-hover">
                    <tr class="text-center">
                        <th>Delivery Id</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Comment</th>
                        @if(session('role') == 'service')
                        <th>Action</th>
                        @endif
                    </tr>
                    @foreach($Deliveries as $delivery)
                    <tr class="text-center ">
                        <td>{{$delivery->id}}</td>
                        <td>{{$delivery->customerName}}</td>
                        <td>{{$delivery->productName}}</td>
                        <td>{{$delivery->Address}}</td>
                        <td>{{$delivery->status}}</td>
                        <td>{{$delivery->comment}}</td>
                        @if(session('role') == 'service')
                        <td>
                            <a class="btn btn-primary btn-sm" href={{ "/deliveryUpdate/" .$delivery->id }}>Update</a>
                            <a class="btn btn-danger btn-sm" href={{ "/deliveryDelete/" .$delivery->id }}>Delete</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </table>
                @if(session('role') == 'service')
                <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('orderList')}}">Add</a>
                <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('serviceProviderDashboard')}}">Home</a>
                @elseif(session('role') == 'admin')
                <a class="btn btn-danger btn-sm mb-3 px-3" href="{{route('serviceProviderList')}}">Back</a>
                <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('adminDashboard')}}">Home</a>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection

</html>