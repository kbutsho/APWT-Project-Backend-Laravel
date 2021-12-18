<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .cart-btn {
            display: inline-block;
            background: #ff523b;
            color: white;
            padding: 8px 30px;
            margin: 30px 0;
            border-radius: 30px;
            transition: background 0.5s;
            text-decoration: none;
        }

        .cart-btn:hover {
            background: #563434;
            color: white;
        }
    </style>
</head>

@extends('../../layouts.app')
@section('content')
<!-- Single Products -->
<div class="small-container single-product">
    <div class="row">
        <div class="col-2">
            <img  src="{{ asset('uploads/products/'.$details->image) }}" height="300px" width="300px">
        </div>
        <div class="col-2">
            <h4>Category : {{$details->category}}</h4>
            <h2>{{$details->name}}</h2>
            <h4>Price : {{$details->price}}</h4>
            <input type="number" value="1">
            <a href={{ "/order/" .$details->id }} class="cart-btn">Buy Now</a>

            <h3>Product Details <i class="fa fa-indent"></i></h3>
            <br>
            <p>{{$details->productDetails}}</p>
        </div>
    </div>
</div>
<!-- title -->
<div class="small-container">
    <div class="row row-2">
        <h2>Related Products</h2>
        <p class="fw-bold text-danger">Category : {{$details->category}}</p>
    </div>
</div>
<!-- Products -->
<div class="small-container">
    <div class="row">
        @foreach($categories as $category)
        @if($category->category == $details->category)
        <div class="col-4">
            <a href="{{ url('products/'. $category->id) }}">
                <img src="{{ asset('uploads/products/'.$category->image) }}"></a>
            <div class="d-flex mt-2">
                <h5>{{$category->category}}</h5>
                <h6 class="ms-auto">{{$category->category}}</h6>
            </div>
            <div class="d-flex w-100">
                <p class="fw-bold text-danger">Price : {{$category->price}}</p>
                <div class="ms-auto">
                    <a class="btn btn-primary btn-sm ms-auto" href={{  $category->id }}>Buy Now</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach

    </div>
</div>



@endsection

</html>