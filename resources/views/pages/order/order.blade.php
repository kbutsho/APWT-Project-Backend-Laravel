<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
@extends('../../layouts.app')
@section('content')
<div class="container">
    <div style="margin: 100px 200px 50px 200px; border: 2px solid red; border-radius: 15px" class="px-5 py-2">
        <h3 class="text-center">Confirm Order</h3>
        <h5>{{ $products->name }}</h5>
        <h6>Price {{ $products->price }}/-</h6>
        <form action="{{route('order')}}" method="post">
            {{csrf_field()}}
            <div class="form-group  my-2">
                <label class="my-2">Your Name</label>
                <input type="text" class="form-control" name="customerName" placeholder="Your Name" value={{
                    session('name') }}>
                <small class="error">
                    @error('customerName'){{$message}}
                    @enderror
                </small>
            </div>

            <div class="form-group  my-2">
                <label class="my-2">Your Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone" value={{ session('phone')}}>
                <small class="phone">
                    @error('phone'){{$message}}
                    @enderror
                </small>
            </div>

            <div class="form-group  my-2">
                <label class="my-2">Your Address</label>
                <input type="text" class="form-control" name="Address" placeholder="Address" value={{
                    session('address')}}>
                <small class="error">
                    @error('Address'){{$message}}
                    @enderror
                </small>
            </div>

            <div class="form-group my-2">
                <label class="my-2">Select Method</label>
                <select name="method"  class="form-control">
                    <option value="COD">Select Method</option>
                    <option value="COD">Cash on Delivery</option>
                </select>
                <small class="error">
                    @error('method'){{$message}}
                    @enderror
                </small>
            </div>

            <input type="text" hidden name="productName" value={{$products->name }}>
            <input type="text" hidden name="price" value={{ $products->price }}>
            <input type="text" hidden name="status" value="Pending">
            <input type="text" hidden name="productId" value={{ $products->id }}>
            <input type="text" hidden name="sellerId" value={{ $products->sellerId }}>
            <input type="text" hidden name="customerId" placeholder="customer Id" value={{ session('id') }}>
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </form>
    </div>
</div>

@endsection

</html>