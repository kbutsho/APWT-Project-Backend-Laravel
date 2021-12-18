<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    @extends('../../layouts.app')
    @section('content')
    <div class="d-flex justify-content-center align-items-center" style="
    min-height: 100vh;
    width: 100%;
    background-image: url('../../images/add-area.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    ">
        <div>
            <div class="form-area">
                <div class="p-4" style=" 
                    /* border:2px solid white; */
                    border-radius: 10px;
                    width: 1000px;
                    min-height: 90vh;
                    color: white;
                ">
                    <form action="{{route('addProduct')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <table class="mb-4">
                            <tr>
                                <td>
                                    <h4 class="fw-bold">Add Product</h4>
                                </td>
                                <td>
                                    @if(session('product-added'))
                                    <div class="text-center text-white" style="width: 100%; padding: 10px 80px; margin-left: 20px; border-radius: 10px; background-color: #C32BAD">
                                        <span class="fw-bold"> {{ session('product-added') }}</span>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <td><label class="pr-3">Product Name</label></td>
                                <td class="pr-3 py-2"> <input type="text" value="{{old('name')}}" name="name"
                                        class="form-control w-100"></td>
                                <td>
                                    <div>
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <label class="pr-3">Product Category</label></td>
                                <td class="pr-3 py-2"> <select value="{{old('category')}}" name="category"
                                        class="form-control w-100">
                                        <option value="Phone">Phone</option>
                                        <option value="Laptop">Laptop</option>
                                        <option value="Camera">Camera</option>
                                        <option value="Television">Television</option>
                                    </select></td>
                                <td>
                                    <div>
                                        @error('category')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pr-3">Product Quantity</label></td>
                                <td class="pr-3 py-2"><input value="{{old('quantity')}}" type="text" name="quantity"
                                        class="form-control w-100"></td>
                                <td>
                                    <div>
                                        @error('quantity')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <label class="pr-3">Product Price</label></td>
                                <td class="pr-3 py-2"><input value="{{old('price')}}" type="text" name="price"
                                        class="form-control w-100"></td>
                                <td>
                                    <div>
                                        @error('price')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pr-3">Product Image</label></td>
                                <td class="pr-3 py-2"><input value="{{old('image')}}" type="file" name="image"
                                     class="form-control w-100"></td>
                                <td>
                                    <div>
                                        @error('images')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pr-3">Product Details</label></td>
                                <td class="pr-3 py-2"> <input value="{{old('productDetails')}}" type="text"
                                        name="productDetails" class="form-control w-100"></td>
                                <td>
                                    <div>
                                        @error('productDetails')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>

                        </table>
                        <input type="text" hidden name="sellerName" value="{{ session('name') }}"
                            class="form-control w-100">
                        <input type="text" hidden name="sellerNumber" value="{{ session('phone') }}"
                            class="form-control w-100">
                            <input type="text" hidden name="sellerId" value="{{ session('id') }}"
                            class="form-control w-100">
                        <input type="text" hidden name="role" value="{{ session('role') }}" class="form-control w-100">



                        <div class="d-flex">
                            <a href={{route('productList')}} class="btn btn-danger btn-sm mt-3 px-3">Back</a>
                            <div class="mx-3">
                                    <input type="submit" value="Add Product" class="btn btn-primary btn-sm mt-3">    
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</body>
@endsection

</html>