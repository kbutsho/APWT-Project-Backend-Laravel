<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login/login.css">
</head>

<body>
    <div class="backgroundArea">

    </div>
    <div class="contentArea">
        <div class="main">
            <div class="login-area">
                <div class="row">
                    <div class="col-6 login-banner">
                        <div class="img-area">
                            <img src="images/login/login-banner.jpg" alt="img">
                        </div>
                    </div>
                    <div class="col-6 login-content">
                        <div>
                            <div class="mb-3">
                                <div class="w-100">
                                    @if(session('database-success'))
                                    <div class="text-white d-flex justify-content-center align-items-center"
                                    style="height: 30px; font-size:13px; color:red; padding:10px; width:100%; background: rgba(0, 0, 0, 0.329)
                                    ; border-radius: 20px">
                                        {{ session('database-success') }}
                                    </div>
                                    @endif
                                </div>
                               
                            </div>
                            <div class="d-flex justify-content-center">
                                <img src="images/login/login.png" alt="img">
                                <h3 class="ml-3 mb-5" style="color: white">LOGIN</h3>
                            </div>
                           
                            <div class="w-100 mb-3">
                                @if(session('pending-message'))
                                <div class="d-flex justify-content-center align-items-center"
                                    style="height: 30px; font-size:13px; color:red; padding:10px; width:100%; background: black; border-radius: 20px">
                                    {{ session('pending-message') }}
                                </div>
                                @else
                                <div class="mb-3">
                                    <div class="w-100">
                                        @if(session('database-error'))
                                        <div class="d-flex justify-content-center align-items-center"
                                        style="height: 30px; font-size:13px; color:red; padding:10px; width:100%; background: black; border-radius: 20px">
                                            {{ session('database-error') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif                                   
                            </div>
                            <form action="{{route('dashboard')}}" method="post">
                                {{csrf_field()}}
                                <div class="mb-3">
                                    <img class="mr-2 " src="images/login/user.png" alt="">

                                    <select name="role" style="padding: 3px 65px 3px 15px">
                                        <option value="">Login as</option>
                                        <option value="admin">Admin</option>
                                        <option value="customer">Customer</option>
                                        <option value="seller">Seller</option>
                                        <option value="service">Service Provider</option>
                                    </select> <br>
                                    @error('role')
                                    <span class="error">{{$message}}</span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <img class="mr-2" src="images/login/email.png" alt="">
                                    <input type="text" name="email" value="{{old('email')}}" placeholder="Your Email">
                                    <br>
                                    @error('email')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <img class="mr-2" src="images/login/password.png" alt="">
                                    <input type="password" name="password" value="{{old('password')}}"
                                        placeholder="Your Password"> <br>
                                    @error('password')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                </div>





                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="submit" class="login-button font-weight-bold">Login</button>
                                    {{-- <input type="submit" value="submit"> --}}
                                </div>
                            </form>
                            <div class="h5 d-flex justify-content-center align-items-center" style="color: black">
                                <div class="header-dash"
                                    style="height: 2px; width: 50%; background: gray; borderRadius: 10px;"></div>
                                <div className="">
                                    <span class="mx-2">or</span>
                                </div>
                                <div class="header-dash"
                                    style="height: 2px; width: 50%; background: gray; borderRadius: 10px;"></div>
                            </div>

                            <div class="mb-3 d-flex">
                                <div style="color: white; font-weight: bold">
                                    <span>Are you new user?</span>
                                </div>
                                <div class="ml-auto">
                                    <div>
                                        <a class="font-weight-bold underline reg-link"
                                            href="{{route('registration')}}">create an account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>