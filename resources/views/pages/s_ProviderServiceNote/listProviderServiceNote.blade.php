<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Note List</title>
    <style>
        body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

@extends('../../layouts.app')
@section('content')
<div class="row">
    <div class="col-3" style="min-height: 88vh; background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
        @include('pages.serviceProvider.serviceProviderSideBar')
    </div>
    <div class="col-9">
        <div class="d-flex py-5 justify-content-center align-items-center
      "  style="min-height: 88vh; width: 100%">
            <div>
                {{-- update message --}}
                @if(session('note-update'))
                <div class="alert alert-warning w-100 text-center" role="alert">
                    <span class="fw-bold"> {{ session('note-update') }}</span>
                </div>
                @endif
                {{-- delete message --}}
                @if(session('note-delete'))
                <div class="alert alert-danger font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('note-delete') }}
                    </span>
                </div>
                @endif
                @if(session('note-added'))
                <div class="alert alert-success font-weight-bold w-100 text-center" role="alert">
                    <span class="fw-bold">
                        {{ session('note-added') }}
                    </span>
                </div>
                @endif
                <h4 class="my-4 fw-bold text-uppercase">Your all notes (Share Your experience)</h4>
                <table class="table table-borded table-striped">
                    <tr class="text-center">
                        <th>Service Id</th>
                        <th>Your Name</th>
                        <th>Product Name</th>
                        <th>Delivery Address</th>
                        <th>Delivery Status</th>
                        <th>Short Note</th>
                        <th>Action</th>
                    </tr>
                    @foreach($notes as $note)
                    <tr class="text-center">
                        <td>{{$note->id}}</td>
                        <td>{{$note->s_ProviderName}}</td>
                        <td>{{$note->productName}}</td>
                        <td>{{$note->Address}}</td>
                        <td>{{$note->status}}</td>
                        <td>{{$note->note}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href={{ "/updateNote/" .$note->id }}>Update</a>
                            <a class="btn btn-danger btn-sm" href={{ "/deleteNote/" .$note->id }}>Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <a class="btn btn-primary btn-sm mb-3 px-3" href="{{route('addNote')}}">Add</a>
                <a class="btn btn-success btn-sm mb-3 px-3" href="{{route('serviceProviderDashboard')}}">Home</a>
            </div>
        </div>
    </div>
</div>

@endsection

</html>
