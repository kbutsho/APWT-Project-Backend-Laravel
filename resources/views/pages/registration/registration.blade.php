<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registration/registration.css">
</head>

<body>
    <div class="backgroundArea">

    </div>
    <div class="contentArea">
        <div class="main">
            <div class="registration-area">
                <div class="row">
                    <div class="col-6 registration-content">
                        <div class="ml-4">
                            <div class="d-flex justify-content-center">
                                <img src="images/login/login.png" alt="img">
                                <h3 class="ml-3 mb-5" style="color: white">REGISTRATION</h3>
                            </div>
                            <div class=" mb-3">
                                <div class="w-100">
                                    @if(session('database-error')) 
                                    <div class="text-danger d-flex justify-content-center align-items-center"
                                        style="height: 35px; width:100%; background: black; border-radius: 10px">
                                        {{ session('database-error') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <form action="{{route('login')}}" method="post">
                                {{csrf_field()}}
                                <div class="row ">
                                    <div class="col-6">

                                        {{-- name --}}
                                        <div class=" mb-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img class="mr-2" src="images/registration/name.png" alt="">
                                                <input type="text" name="name" value="{{old('name')}}"
                                                    placeholder="Your Name">
                                            </div>
                                            @error('name')
                                            <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>

                                        {{-- address --}}
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img class="mr-2" src="images/registration/address.png" alt="">
                                                <input type="text" name="address" value="{{old('address')}}"
                                                    placeholder="Your Address">
                                            </div>
                                            @error('address')
                                            <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>

                                        {{-- password--}}
                                        <div class=" mb-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img class="mr-2" src="images/registration/password.png" alt="">
                                                <input type="password" name="password" value="{{old('password')}}"
                                                    placeholder="Your Password">
                                            </div>
                                            @error('password')
                                            <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>

                                        {{-- user role --}}
                                        <div class=" mb-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img class="mr-2" src="images/registration/user.png" alt="">
                                                <div>
                                                    <select name="role">
                                                        <option value="">Register As</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="customer">Customer</option>
                                                        <option value="seller">Seller</option>
                                                        <option value="service">Service Provider</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @error('role')
                                            <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <input type="text" hidden name="status"
                                        placeholder="">
                                    </div>

                                    <div class="col-6">

                                        {{-- email --}}
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img class="mr-2" src="images/registration/email.png" alt="">
                                                <input type="text" name="email" value="{{old('email')}}"
                                                    placeholder="Your Email">
                                            </div>
                                            @error('email')
                                            <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>

                                        {{-- phone --}}
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img class="mr-2" src="images/registration/phone.png" alt="">
                                                <input type="text" name="phone" value="{{old('phone')}}"
                                                    placeholder="Your Phone">
                                            </div>
                                            @error('phone')
                                            <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>

                                        {{-- confirm-pass --}}
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img class="mr-2" src="images/registration/confirm.png" alt="">
                                                <input type="password" name="confirm-password"
                                                    value="{{old('confirm-password')}}" placeholder="Confirm Password">
                                            </div>
                                            @error('confirm-password')
                                            <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4 d-flex justify-content-end">
                                            <button type="submit"
                                                class="registration-button font-weight-bold">Submit</button>
                                           
                                        </div>
                                    </div>
                                </div>

                            </form>


                            {{-- bottom  --}}

                            <div class="h5 d-flex justify-content-center align-items-center" style="color: black">
                                <div class="header-dash"
                                    style="height: 2px; width: 50%; background: gray; borderRadius: 10px;"></div>
                                <div className="">
                                    <span class="mx-2">or</span>
                                </div>
                                <div class="header-dash"
                                    style="height: 2px; width: 50%; background: gray; borderRadius: 10px;"></div>
                            </div>

                            <div class="mb-4 d-flex justify-content-end">
                                <div>
                                    <div style="color: white; font-weight: bold" class="mr-3">
                                        <span>Have an account?</span>
                                    </div>
                                    <div class="mr-auto">
                                        <div>
                                            <a class="font-weight-bold underline login-link"
                                                href="{{route('login')}}">Please login here</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="registration-banner">
                            <div class="img-area">
                                <img src="images/registration/registration-banner.jpg" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>