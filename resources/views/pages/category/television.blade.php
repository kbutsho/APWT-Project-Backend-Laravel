<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Telivision Category</title>

</head>
@extends('../../layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h3 class="my-3 fw-bold">Telivision Category</h3>
        @foreach ($television as $product)
        <div class="col-3">
            <div class="card-group">
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
                                <a class="btn btn-primary btn-sm ms-auto" href={{ "products/" .$product->id }}>Buy
                                    Now</a>
                            </div>
                        </div>
                        <div class="d-flex fw-bold">
                            <div style="margin-right: 10px">Rating : </div>
                            <div> @foreach ($ratings as $rating)
                                @if($rating->productId == $product->id)
                                <div class="fw-bold">
                                    <span style="margin-right: 5px">{{ $rating->rating }}
                                    @for($i=0; $i< $rating->rating; $i++)
                                       <i class="text-danger fa fa-star"></i>
                                        @endfor
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- <div class="page-btn">
        {{ $allProducts->links('vendor.pagination.bootstrap-4') }}
    </div> --}}
</div>
@endsection

</html>