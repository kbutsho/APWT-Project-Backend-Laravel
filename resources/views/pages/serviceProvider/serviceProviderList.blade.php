<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Provider List</title>
    <style>
        body { max-width: 100%; overflow-x: hidden; }
    </style>
</head>

@extends('../../layouts.app')
@section('content')
<div class="row">
    <div class="col-3"  style="background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
        @if(session('role') == 'admin')
        @include('pages.admin.adminSideBar')
        @endif
    </div>
    <div class="col-9">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh;   width: 100%;
       ">
            <div>
                {{-- update message --}}
                @if(session('serviceProvider-update'))
                <div class="alert alert-warning w-100 text-center" role="alert">
                    <span class="fw-bold"> {{ session('serviceProvider-update') }}</span>
                </div>
                @endif
                {{-- delete message --}}
                @if(session('serviceProvider-delete'))
                <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('serviceProvider-delete') }}
                    </span>
                </div>
                @endif
                <h4 class="my-4 fw-bold text-uppercase">service Provider List</h4>
                <table class="table table-borded table-striped table-hover">
                    <tr class="text-center">
                        <th class="">Id</th>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="">Address</th>
                        <th class="">Phone</th>
                        {{-- <th class="px-4">Password</th> --}}
                        <th class="">Status</th>
                        <th class="">Action</th>
                    </tr>
                    @foreach($allServiceProviders as $serviceProvider)
                    <tr class="text-center">
                        <td class="">{{$serviceProvider->id}}</td>
                        <td class="">{{$serviceProvider->name}}</td>
                        <td class="">{{$serviceProvider->email}}</td>
                        <td class="">{{$serviceProvider->address}}</td>
                        <td class="">{{$serviceProvider->phone}}</td>
                        {{-- <td class="px-4">{{$seller->password}}</td> --}}
                        @if($serviceProvider->status == 'Pending')
                            <td class="">
                                <span class="fw-bold" style="color: red">{{$serviceProvider->status}}</span>
                            </td>
                        @else
                        <td class="">
                            <span class="fw-bold">{{$serviceProvider->status}}</span>
                        </td>
                        @endif
                        <td class="">
                            <a class="btn  btn-warning btn-sm" href={{"updateServiceProviderStatus/".$serviceProvider->id }}>Status</a>
                            <a class="btn btn-success btn-sm" href={{ "deliveryList/" .$serviceProvider->id }} >Service</a>
                            <a class="btn btn-primary btn-sm"  href={{ "editServiceProvider/".$serviceProvider->id }}>Update</a>
                            <a class="btn btn-danger btn-sm" href={{ "deleteServiceProvider/".$serviceProvider->id }}>Delete</a>
                        </td> 
                    </tr>
                    @endforeach
                </table>
                <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('addServiceProvider')}}">Add</a>
                <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('adminDashboard')}}">Home</a>
            </div>
        </div>
    </div>
</div>

@endsection

</html>