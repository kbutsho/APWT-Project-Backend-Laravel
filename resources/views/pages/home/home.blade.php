<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

@extends('../../layouts.app')
@section('content')
<div>
    
    <div style=" background: linear-gradient(#fff,whitesmoke);">
        {{-- header start --}}
        <div class="header">
            <div class="container">
                <div class="navbar">
                    <div class="logo mt-3">
                        <a href="{{ url('/') }}"><img src= "{{ asset('images/store.png') }}" alt="logo" width="80px"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <h2 class="mt-5">Shopping Here!</h2>
                       <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo quibusdam molestiae aut porro delectus nulla quia nisi suscipit odio excepturi!</p>
                        <a href={{ route('products') }} class="button btn btn-info">Explore Now</a>
                    </div>
                    <div class="col-2">
                        <img src= "{{ asset('images/images.jpg') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- header end --}}
        <div class="container">
            <h3 class="title">All Products</h3>
            <div class="row">
                @foreach ($allProducts as $product)
                <div class="col-3">
                    <div class="card-group ">
                        <div class="card mb-4">
                            <img class="card-img-top" height="140px" width="260px"
                                src="{{ asset('uploads/products/'.$product->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h5 class="card-title text-primary">{{ $product->category }}</h5>
                                    <h6 class="card-title ms-auto mt-1">{{ $product->name }}</h6>
                                </div>
                                <span></span>
                                <div class="d-flex">
                                    <p class="card-text"><small class="text-danger fw-bold">Price:
                                            {{ $product->price }}</small></p>
                                    <p class="card-text  ms-auto"><small class="text-muted">Available:
                                            {{ $product->quantity }}</small></p>

                                </div>
                                <div class="d-flex">
                                    <p>Author: {{ $product->sellerName }}</p>

                                    <div class="ms-auto">
                                        <a class="btn btn-primary btn-sm ms-auto"  href={{ "products/" .$product->id }}>Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="">
                {{  $allProducts->links('vendor.pagination.bootstrap-4')  }}
            </div>


            <div class="small-container">
                <h3 class="title">Featured Products</h3>
                <div class="row">
                    @foreach($featuredProducts as $product)
                    <div class="col-4">
                        <img class="" height="300" width="200"
                        src="{{ asset('uploads/products/'.$product->image) }}">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-title text-primary">{{ $product->category }}</h5>
                                <h6 class="card-title ms-auto mt-1">{{ $product->name }}</h6>
                            </div>
                            <span></span>
                            <div class="d-flex">
                                <p class="card-text"><small class="text-danger fw-bold">Price:
                                        {{ $product->price }}</small></p>
                                <p class="card-text  ms-auto"><small class="text-muted">Available:
                                        {{ $product->quantity }}</small></p>

                            </div>
                            <div class="d-flex">
                                <p>Author: {{ $product->sellerName }}</p>

                                <div class="ms-auto">
                                    <a class="btn btn-primary btn-sm ms-auto"  href={{ "products/" .$product->id }}>Buy
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <h3 class="title">Latest Products</h3>
                <div class="row">
                    @foreach($latestProducts as $product)
                        <div class="col-4">
                            <img class="" height="300" width="200"
                            src="{{ asset('uploads/products/'.$product->image) }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h5 class="card-title text-primary">{{ $product->category }}</h5>
                                    <h6 class="card-title ms-auto mt-1">{{ $product->name }}</h6>
                                </div>
                                <span></span>
                                <div class="d-flex">
                                    <p class="card-text"><small class="text-danger fw-bold">Price:
                                            {{ $product->price }}</small></p>
                                    <p class="card-text  ms-auto"><small class="text-muted">Available:
                                            {{ $product->quantity }}</small></p>

                                </div>
                                <div class="d-flex">
                                    <p>Author: {{ $product->sellerName }}</p>

                                    <div class="ms-auto">
                                        <a class="btn btn-primary btn-sm ms-auto"  href={{ "products/" .$product->id }}>Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

</html>