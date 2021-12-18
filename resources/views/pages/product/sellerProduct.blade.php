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
                    <h4 class="my-4 fw-bold text-uppercase"> <span class="text-danger">{{ $seller->name }}'s</span> all products</h4>
                    <table class="table table-borded table-striped table-hover">
                        <tr>
                            <th class="px-4">Product Id</th>
                            <th  class="px-4">Seller Id</th>
                            <th class="px-4">Product Name</th>
                            <th  class="px-4">Price</th>
                            <th  class="px-4">Quantity</th>
                            <th  class="px-4">Category</th>
                        </tr>

                        @foreach ($products as $product)
                        <tr>
                            <td  class="px-4">{{ $product->id }}</td>
                            <td  class="px-4">{{ $product->sellerId }}</td>
                            <td  class="px-4">{{ $product->name }}</td>
                            <td  class="px-4">{{ $product->price }}</td>
                            <td  class="px-4">{{ $product->quantity }}</td>
                            <td  class="px-4">{{ $product->category }}</td>
                        </tr>

                        @endforeach

                    </table>
                    <a href={{route('productList')}} class="btn btn-primary btn-sm mt-3">All Product</a>
                    <a href={{route('adminDashboard')}} class="btn btn-success btn-sm mt-3 px-3">Home</a>
                    <a href={{route('sellerList')}} class="btn btn-danger btn-sm mt-3 px-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

</html>