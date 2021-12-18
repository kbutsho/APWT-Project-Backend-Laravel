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
                    @if(session('service-review-delete'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('service-review-delete') }}</span>
                    </div>
                    @endif
                    @if(session('service-review-update'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('service-review-update') }}</span>
                    </div>
                    @endif
                    @if(session('rating-done'))
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <span class="fw-bold"> {{ session('rating-done') }}</span>
                    </div>
                    @endif
                    <h4 class="my-4 fw-bold text-uppercase">Service Provider Reviews</h4>
                    <table class="table table-borded table-striped table-hover">
                        <tr class="text-center">
                            <th>Review Id</th>
                            <th>Service_P Id</th>
                            <th>Service_P Name</th>
                            <th>Rating</th>
                            <th>Review</th>  
                            <th>Action</th>
                         
                        </tr>

                        @foreach ($ratings as $rating)
                        <tr class="text-center">
                            <td>{{ $rating->id }}</td>
                            <td>{{ $rating->serviceProviderId }}</td>
                            <td>{{ $rating->s_ProviderName }}</td>
                            <td> <span class="fw-bold" style="margin-right: 5px">{{ $rating->rating }}</span>
                                @for($i=0; $i< $rating->rating; $i++)
                                <i class="text-danger fa fa-star"></i>
                                 @endfor
                            <td>{{ $rating->review }}</td>                               
                           <td> 
                            <a class="btn btn-warning btn-sm" href={{ "/updateServiceReview/" .$rating->id }}>Update</a>
                            <a class="btn btn-danger btn-sm" href={{ "/deleteServiceReview/" .$rating->id
                            }}>Delete</a>
                           </td>
                           
                        </tr>
                        @endforeach
                    </table>
                    <a  href={{ route('customerDeliveries')}} class="btn btn-primary btn-sm mt-3">Delivery List</a>
                    <a href={{route('customerDashboard')}} class="btn btn-danger btn-sm mt-3 px-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

</html>