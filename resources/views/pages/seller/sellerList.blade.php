<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seller List</title>
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
        @include('pages.admin.adminSideBar')
    </div>
    <div class="col-9">
        <div class="d-flex py-5 justify-content-center align-items-center
      "  style="min-height: 88vh; width: 100%">
            <div>
                {{-- update message --}}
                @if(session('seller-update'))
                <div class="alert alert-warning w-100 text-center" role="alert">
                    <span class="fw-bold"> {{ session('seller-update') }}</span>
                </div>
                @endif
                {{-- delete message --}}
                @if(session('seller-delete'))
                <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('seller-delete') }}
                    </span>
                </div>
                @endif
                @if(session('seller-approved'))
                <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('seller-approved') }}
                    </span>
                </div>
                @endif
                <h4 class="my-4 fw-bold text-uppercase">Seller List</h4>
                {{-- {{ $admin->name }} --}}
                <table class="table table-borded table-striped">
                    <tr class="text-center">
                        <th class="">Seller Id</th>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="">Address</th>
                        <th class="">Phone</th>
                        {{-- <th class="px-4">Password</th> --}}
                        <th class="">Status</th>
                        <th class="">Action</th>
                    </tr>
                    @foreach($allSellers as $seller)
                    <tr class="text-center">
                        <td class="">{{$seller->id}}</td>
                        <td class="">{{$seller->name}}</td>
                        <td class="">{{$seller->email}}</td>
                        <td class="">{{$seller->address}}</td>
                        <td class="">{{$seller->phone}}</td>
                        {{-- <td class="px-4">{{$seller->password}}</td> --}}
                        @if($seller->status == 'Pending')
                        <td class="">
                            <span class="fw-bold" style="color: red">{{$seller->status}}</span>
                        </td>
                        @else
                        <td class="">
                            <span class="fw-bold">{{$seller->status}}</span>
                        </td>
                        @endif
                        <td class="">
                            <a class="btn  btn-warning btn-sm" href={{"updateSellerStatus/".$seller->id }}>status</a>
                            <a class="btn  btn-success btn-sm" href={{ "sellerProduct/" .$seller->id }}>Products</a>
                            <a class="btn btn-primary btn-sm" href={{ "editSeller/" .$seller->id }}>Update</a>
                            <a class="btn btn-danger btn-sm" href={{ "deleteSeller/" .$seller->id }}>Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('addSeller')}}">Add</a>
                <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('adminDashboard')}}">Home</a>
            </div>
        </div>
    </div>
</div>

@endsection

</html>