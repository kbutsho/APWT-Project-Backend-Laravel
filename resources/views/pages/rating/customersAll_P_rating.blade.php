<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer's Product Review List</title>
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
            @elseif(session('role') == 'customer')
            @include('pages.customer.customerSideBar')
            @endif
        </div>
    </div>
    <div class="col-9">
        <div>
            <div class="d-flex justify-content-center align-items-center" style="min-height: 88vh; width: 100%">
                <div>
                    @if(session('review-delete'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('review-delete') }}</span>
                    </div>
                    @endif
                    @if(session('review-update'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('review-update') }}</span>
                    </div>
                    @endif
                    <h4 class="my-4 text-uppercase fw-bold">Your all Products Reviews</h4>
                    <table class="table table-borded table-striped table-hover">
                        <tr class="text-center">
                            <th>Review Id</th>
                            <th>Product Id</th>
                            <th>Rating</th>
                            <th>Comment</th>  
                            @if( session('role') == 'customer')
                            <th>Action</th>
                            @endif
                        </tr>

                        @foreach ($ratings as $rating)
                        <tr class="text-center">
                            <td>{{ $rating->id }}</td>
                            <td>{{ $rating->productId }}</td>
                            <td> <span class="fw-bold" style="margin-right: 5px">{{ $rating->rating }}</span>
                                @for($i=0; $i< $rating->rating; $i++)
                                <i class="text-danger fa fa-star"></i>
                                 @endfor
                            <td>{{ $rating->review }}</td>                               
                           <td> 
                            <a class="btn btn-warning btn-sm" href={{ "/updateProductReview/" .$rating->id }}>Update</a>
                            <a class="btn btn-danger btn-sm" href={{ "/deleteProductReview/" .$rating->id
                            }}>Delete</a>
                           </td>
                           
                        </tr>
                        @endforeach
                    </table>
                    <a  href={{ "/customerOrders/" .session('id') }} class="btn btn-primary btn-sm mt-3">Order List</a>
                    <a href={{route('customerDashboard')}} class="btn btn-success btn-sm mt-3 px-3">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

</html>