<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer List</title>
    <style>
        body { max-width: 100%; overflow-x: hidden; }
    </style>
</head>

@extends('../../layouts.app')
@section('content')
<div class="row">
    <div class="col-3"  style="min-height: 88vh; background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
        @if(session('role') == 'admin')
        @include('pages.admin.adminSideBar')
        @endif
    </div>
    <div class="col-9">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh;  width: 100%;
       ">
            <div>
                {{-- update message --}}
                @if(session('customer-update'))
                <div class="alert alert-warning w-100 text-center" role="alert">
                    <span class="fw-bold"> {{ session('customer-update') }}</span>
                </div>
                @endif
                {{-- delete message --}}
                @if(session('customer-delete'))
                <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('customer-delete') }}
                    </span>
                </div>
                @endif
                @if(session('customer-approved'))
                <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('customer-approved') }}
                    </span>
                </div>
                @endif
                <h4 class="my-4 fw-bold  text-uppercase">Customer List</h4>
                <table class="table table-borded table-striped table-hover">
                    <tr class="text-center">
                        <th class="">Id</th>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="">Address</th>
                        <th class="">Phone</th>
                        {{-- <th class="px-4">Password</th> --}}
                        <th class="px-4">Status</th>
                        <th class="px-4">Action</th>
                    </tr>
                    @foreach($allCustomers as $customer)
                    <tr class="text-center ">
                        <td class="">{{$customer->id}}</td>
                        <td class="">{{$customer->name}}</td>
                        <td class="">{{$customer->email}}</td>
                        <td class="">{{$customer->address}}</td>
                        <td class="">{{$customer->phone}}</td>
                        {{-- <td class="px-4">{{$seller->password}}</td> --}}
                        @if($customer->status == 'Pending')
                        <td class="">
                            <span class="fw-bold" style="color: red;">{{$customer->status}}</span>
                        </td>
                        @else
                        <td class="">
                            <span class="fw-bold">{{$customer->status}}</span>
                        </td>
                        @endif
                        <td class="">
                            <a class="btn  btn-warning btn-sm" href={{"updateCustomerStatus/".$customer->id }}>Status</a>
                            <a class="btn  btn-success btn-sm" href={{ "customerOrders/".$customer->id }}>Orders</a>
                            <a class="btn btn-primary btn-sm" href={{ "editCustomer/".$customer->id }}>Update</a>
                            <a class="btn btn-danger btn-sm" href={{ "deleteCustomer/".$customer->id }}>Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('addCustomer')}}">Add</a>
                <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('adminDashboard')}}">Home</a>
            </div>
        </div>
    </div>
</div>

@endsection

</html>