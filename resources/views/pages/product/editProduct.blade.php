<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<body>
    @extends('../../layouts.app')
    @section('content')
    <div class="d-flex justify-content-center align-items-center" style="
    min-height: 100vh;
    width: 100%;
    background-image: url('../../images/edit-area.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    ">
        <div>
            <div class="p-4" style=" 
       border-radius: 10px;
                    width: 1000px;
                    min-height: 90vh;
                    color: white;
       ">
                <form action="{{route('updateProduct')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h4 class="fw-bold mb-4">Update Product</h4>
                    <input type="text" name="id" hidden value={{ $products->id }} class="form-control w-100">
                    <table>
                        <tr>
                            <td><label class="my-2">Product Name</label></td>
                            <td  class="pr-3 py-2"><input type="text" name="name" value={{ $products->name }} class="form-control w-100">
                            </td>
                            <td>
                                <div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="my-2">Product Category</label></td>
                            <td  class="pr-3 py-2"><select name="category" class="form-control w-100">
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
                            <td><label class="my-2">Product Quantity</label></td>
                            <td  class="pr-3 py-2"> <input type="text" name="quantity" value={{ $products->quantity }}
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
                            <td> <label class="my-2">Product Price</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="price" value={{ $products->price }}
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
                            <td> <label class="my-2">Product Details</label></td>
                            <td  class="pr-3 py-2"><input type="text" name="productDetails" value={{ $products->productDetails }}
                                    class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('productDetails')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="my-2">Product Image</label></td>
                            <td  class="pr-3 py-2"><input type="file" name="image" class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                    </table>
                    <input type="text" hidden name="sellerName" value={{ $products->sellerName }}>
                    <input type="text" hidden name="sellerNumber" value={{ $products->sellerNumber }}>
                    {{-- <input type="text" hidden name="sellerEmail" value={{ $products->sellerEmail }}> --}}
                    {{-- <input type="text" hidden name="role" value={{ $products->role }}> --}}
                    <div class="d-flex">
                        <a href={{route('productList')}} class="btn btn-danger btn-sm mt-3 px-3">Back</a>
                        <div class="mx-3">
                            <input type="submit" value="Update" class="btn btn-primary btn-sm mt-3">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection
</html>