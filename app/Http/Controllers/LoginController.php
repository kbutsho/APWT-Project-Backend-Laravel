<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Admin;
use App\Models\Token;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('pages.login.login');
    }
    public function loginValidation(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'role' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:5',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/',
                ],
            ],

            [
                'password.regex' => 'Invalid password formate!',
                'password.required' => 'Password is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'role.required' => 'Select your user role!'
            ]
        );
        $role = $request->role;
        if ($role == 'customer') {
            $check = Customer::where([
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ])->first();


            if ($check) {
                session([
                    'id' => $check->id,
                    'name' => $check->name,
                    'email' => $check->email,
                    'role' => $check->role,
                    'image' => $check->image,
                    'phone' => $check->phone,
                    'address' => $check->address
                ]);
                return redirect()->route('customerDashboard');
            }
            $request->session()->flash(
                'database-error',
                'User Not Found!'
            );
            return redirect('login');
        } elseif ($role == 'seller') {
            $check = Seller::where([
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ])->first();

            if ($check) {
                if ($check->status == 'Pending') {
                    $request->session()->flash(
                        'pending-message',
                        'Your account is not approved! Try again Later!'
                    );
                } else {
                    session([
                        'id' => $check->id,
                        'name' => $check->name,
                        'email' => $check->email,
                        'role' => $check->role,
                        'image' => $check->image,
                        'phone' => $check->phone,
                        'address' => $check->address
                    ]);
                    // return view('pages.dashboard.dashboard');
                    return redirect()->route('sellerDashboard');
                }
            }
            $request->session()->flash(
                'database-error',
                'User Not Found!'
            );
            return redirect('login');
        } elseif ($role == 'service') {

            $check = ServiceProvider::where([
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ])->first();

            if ($check) {
                if ($check->status == 'Pending') {
                    $request->session()->flash(
                        'pending-message',
                        'Your account is not approved! Try again Later!'
                    );
                } else {
                    session([
                        'id' => $check->id,
                        'name' => $check->name,
                        'email' => $check->email,
                        'role' => $check->role,
                        'image' => $check->image,
                        'phone' => $check->phone,
                        'address' => $check->address
                    ]);
                    return redirect()->route('serviceProviderDashboard');
                }
            }

            $request->session()->flash(
                'database-error',
                'User Not Found!'
            );
            return redirect('login');
        } else {
            $check = Admin::where([
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ])->first();
            if ($check) {
                if ($check->status == 'Pending') {
                    $request->session()->flash(
                        'pending-message',
                        'Your account is not approved! Try again Later!'
                    );
                } else {
                    session([
                        'id' => $check->id,
                        'name' => $check->name,
                        'email' => $check->email,
                        'role' => $check->role,
                        'image' => $check->image,
                        'phone' => $check->phone,
                        'address' => $check->address
                    ]);
                    // return view('pages.dashboard.dashboard');
                    return redirect()->route('adminDashboard');
                }
            }
            $request->session()->flash(
                'database-error',
                'User Not Found!'
            );
            return redirect('login');
        }
    }
    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/');
    }








    // Login API
    public function  login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'role' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:5',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/',
                ],
            ],

            [
                'password.regex' => 'Invalid password formate!',
                'password.required' => 'Password is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'role.required' => 'Select your user role!'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {

            $role = $request->role;
            if ($role == 'seller') {
                $user = Seller::where([
                    ['email', '=', $request->email],
                    ['password', '=', $request->password]
                ])->first();

                if ($user) {
                    if ($user->status == 'Pending') {
                        return response()->json([
                            'pending_error' => 'Your account is not approved! Try again Later!',
                        ]);
                    } 
                    else {
                        $api_token = Str::random(64);
                        $token = new Token();
                        $token->role = $user->role;
                        $token->token = $api_token;
                        $token->userId = $user->id;
                        $token->created_at = new DateTime();
                        $token->save();

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Login Successfully',
                            'token' => $api_token,
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'role' => $user->role,
                            'image' => $user->image,
                            'phone' => $user->phone,
                            'address' => $user->address
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'notFound',
                        'message' => 'User not Found'
                    ]);
                }
            }
            
            
            elseif ($role == 'admin') {
                $user = Admin::where([
                    ['email', '=', $request->email],
                    ['password', '=', $request->password]
                ])->first();

                if ($user) {
                    if ($user->status == 'Pending') {
                        return response()->json([
                            'pending_error' => 'Your account is not approved! Try again Later!',
                        ]);
                    } else {
                        $api_token = Str::random(64);
                        $token = new Token();
                        $token->role = $user->role;
                        $token->token = $api_token;
                        $token->userId = $user->id;
                        $token->created_at = new DateTime();
                        $token->save();

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Login Successfully!',
                            'token' => $api_token,
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'role' => $user->role,
                            'image' => $user->image,
                            'phone' => $user->phone,
                            'address' => $user->address
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'notFound',
                        'message' => 'User not Found'
                    ]);
                }
            }
            elseif ($role == 'service') {
                $user = ServiceProvider::where([
                    ['email', '=', $request->email],
                    ['password', '=', $request->password]
                ])->first();

                if ($user) {
                    if ($user->status == 'Pending') {
                        return response()->json([
                            'pending_error' => 'Your account is not approved! Try again Later!',
                        ]);
                    } else {
                        $api_token = Str::random(64);
                        $token = new Token();
                        $token->role = $user->role;
                        $token->token = $api_token;
                        $token->userId = $user->id;
                        $token->created_at = new DateTime();
                        $token->save();

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Login Successfully',
                            'token' => $api_token,
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'role' => $user->role,
                            'image' => $user->image,
                            'phone' => $user->phone,
                            'address' => $user->address
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'notFound',
                        'message' => 'User not Found'
                    ]);
                }
            }else{
                $user = Customer::where([
                    ['email', '=', $request->email],
                    ['password', '=', $request->password]
                ])->first();

                if ($user) {
                    if ($user->status == 'Pending') {
                        return response()->json([
                            'pending_error' => 'Your account is disable! Try again Later!',
                        ]);
                    } else {
                        $api_token = Str::random(64);
                        $token = new Token();
                        $token->role = $user->role;
                        $token->token = $api_token;
                        $token->userId = $user->id;
                        $token->created_at = new DateTime();
                        $token->save();

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Login Successfully',
                            'token' => $api_token,
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'role' => $user->role,
                            'image' => $user->image,
                            'phone' => $user->phone,
                            'address' => $user->address
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'notFound',
                        'message' => 'User not Found'
                    ]);
                }
            }
        }
           
    }
    public function loggedOut(Request $request){
        $token = Token::where('token', $request->token)->first();
        $token->expired_at = new DateTime();
        $token->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully!'
        ]);
        
    }
}
