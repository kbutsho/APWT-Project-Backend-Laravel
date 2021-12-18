<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add to Deliveries</title>
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
                <form action="{{route('addToDelivery')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h4 class="fw-bold mb-4">Add to Delivery</h4>

                    <table>
                        <tr>
                            <td><label class="my-2">Product Name</label></td>
                            <td  class="pr-3 py-2"><input type="text" name="productName" value={{ $order->productName }}
                                class="form-control " style="width: 300px">
                            </td>
                            <td>
                                <div>
                                    @error('productName')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr hidden>
                            <td><label class="my-2">Customer Id</label></td>
                            <td  class="pr-3 py-2"><input type="text" name="customerId" value={{ $order->customerId }}
                                class="form-control " style="width: 300px">
                            </td>
                            <td>
                                <div>
                                    @error('customerId')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="my-2">S_Provider Name</label></td>
                            <td  class="pr-3 py-"><input type="text" name="s_ProviderName" value={{ session('name') }}
                                class="form-control " style="width: 300px">
                            </td>
                            <td>
                                <div>
                                    @error('s_ProviderName')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr hidden>
                            <td><label class="my-2">Product Id</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="productId" value={{ $order->productId }}
                                class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('productId')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> <label class="my-2">Customer Name</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="customerName" value={{ $order->customerName }}
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
                            <td> <label class="my-2">Order Status</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="status" value={{ $order->status }}
                                class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> <label class="my-2">Address</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="Address" value={{ $order->Address }}
                                class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('Address')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> <label class="my-2">Comment</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="comment"
                                class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('comment')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr hidden>
                            <td> <label class="my-2">Provider Id</label></td>
                            <td class="pr-3 py-2"><input type="text" name="serviceProviderId" value={{
                                   session('id') }}
                                class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('serviceProviderId')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                       
                    </table>
                    
                    <div class="d-flex">
                        <a href={{route('orderList')}} class="btn btn-danger btn-sm mt-3 px-3">Back</a>
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