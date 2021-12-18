<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Notes</title>
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
                <form action="{{route('addedNote')}}" method="post">
                    {{csrf_field()}}
                    <h4 class="fw-bold mb-4 text-uppercase">Add Your Note</h4>
                    <table>
                        <tr>
                            <td> <label class="my-2">Your Name</label></td>
                            <td class="pr-3 py-2"> <input type="text" value={{ session('name') }} name="s_ProviderName" class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('s_ProviderName')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> <label class="my-2">Product Name</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="productName" class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('productName')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="my-2">Delivery Address</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="Address" class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('Address')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> <label class="my-2">Delivery Status</label></td>
                            <td class="pr-3 py-2"> <input type="text" name="status" class="form-control w-100"></td>
                            <td>
                                <div>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> <label class="my-2">Short Note</label></td>
                            <td class="pr-3 py-2">
                                <textarea type="text" class="form-control" name="note" rows="4"
                                    cols="50"></textarea>
                            </td>
                            <td>
                                <div>
                                    @error('note')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <input type="text" hidden name="serviceProviderId" value={{ session('id') }}>

                    </table>

                    <div class="d-flex">
                        <a href={{('/serviceNoteList/'.session('id'))}} class="btn btn-danger btn-sm mt-3 px-3">Back</a>
                        <div class="mx-3">
                            <input type="submit" value="Submit" class="btn btn-primary btn-sm mt-3">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection

</html>