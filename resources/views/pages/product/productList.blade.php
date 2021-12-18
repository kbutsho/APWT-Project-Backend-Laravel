<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
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
    <div class="col-3" style="min-height: 88vh; background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
        <div>
            @if(session('role') == 'admin')
            @include('pages.admin.adminSideBar')
            @elseif(session('role') == 'seller')
            @include('pages.seller.sellerSideBar')
            @endif
        </div>
    </div>

    @if(session('role') == 'admin')
    <div class="col-9">
        <div>
            <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh; width: 100%">
                <div>
                    {{-- update message --}}
                    @if(session('product-update'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('product-update') }}</span>
                    </div>
                    @endif
                    {{-- delete message --}}
                    @if(session('product-delete'))
                    <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                        <span class="fw-bold">
                            {{ session('product-delete') }}
                        </span>
                    </div>
                    @endif
                    <h4 class="my-4 fw-bold  text-uppercase">Product List</h4>
                    <table class="table table-borded table-striped table-hover">
                        <tr class="text-center">
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Seller Id</th>
                            <th>Seller Name</th>
                            <th>Seller Phone</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach($allProducts as $product)
                        <tr class="text-center">
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->sellerId}}</td> 
                            <td>{{$product->sellerName}}</td>    
                            <td>{{$product->sellerNumber}}</td>                        
                            <td>{{$product->category}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <img src="{{ asset('uploads/products/'.$product->image) }}" height="50px" width="50px"
                                    alt="img">
                            </td>
                            <td>
                                <a class="btn  btn-warning btn-sm mt-3" href={{ "editProduct/" .$product->id
                                    }}>Update</a>
                                <a class="btn btn-danger btn-sm mt-3" href={{ "deleteProduct/" .$product->id
                                    }}>Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('adminDashboard')}}">Home</a>
                </div>
            </div>
        </div>
    </div>
    @else
    {{-- for seller --}}
    <div class="col-9">
        <div>
            <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh; width: 100%">
                <div>
                    {{-- update message --}}
                    @if(session('product-update'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('product-update') }}</span>
                    </div>
                    @endif
                    {{-- delete message --}}
                    @if(session('product-delete'))
                    <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                        <span class="fw-bold">
                            {{ session('product-delete') }}
                        </span>
                    </div>
                    @endif
                    <h4 class="my-4 fw-bold  text-uppercase">Product List</h4>
                    <table class="table table-borded table-striped table-hover">
                        <tr class="text-center">
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach($allProducts as $product)
                            @if(session('id') == $product->sellerId)
                            <tr class="text-center">
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    <img src="{{ asset('uploads/products/'.$product->image) }}" height="50px" width="50px"
                                        alt="img">
                                </td>
                                <td> <a class="btn  btn-primary btn-sm mt-3" href={{ "productOrders/" .$product->id
                                        }}>Orders</a>
                                    <a class="btn  btn-success btn-sm mt-3" href={{ "productRatings/" .$product->id
                                        }}>Reviews</a>
                                    <a class="btn  btn-warning btn-sm mt-3" href={{ "editProduct/" .$product->id
                                        }}>Update</a>
                                    <a class="btn btn-danger btn-sm mt-3" href={{ "deleteProduct/" .$product->id
                                        }}>Delete</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </table>

                    <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('addProduct')}}">Add</a>
                    <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('sellerDashboard')}}">Home</a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

</html>