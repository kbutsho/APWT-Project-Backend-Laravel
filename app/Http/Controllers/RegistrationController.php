<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Admin;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function showRegistration()
    {
        return view('pages.registration.registration');
    }
    public function registrationValidation(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'role' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',             
                    'regex:/[a-z]/',    
                    'regex:/[A-Z]/',     
                    'regex:/[0-9]/',      
                    'regex:/[@$!%*#?&]/'
                ],
                'confirm-password' => [
                    'required',
                    'same:password',
                    'min:10'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'confirm-password.required' => 'Confirm Password is Required!',
                'confirm-password.same' => 'Confirm Password not match!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',
                'role.required' => 'Select your user role!'
            ]
        );
        $email = $request->email;
        $role = $request->role;
        if ($role == 'admin') {
            //duplicate user check
          $check = Admin::where([
              ['email', '=', $email]
          ])->first();
          
          if ($check) {
              $request->session()->flash('database-error', 'Email already taken! use another one!');
              return redirect('registration');
          } else {
              $var = new Admin();
              $var->name = $request->name;
              $var->email = $request->email;
              $var->phone = $request->phone;
              $var->address = $request->address;
              $var->password = $request->password;
              $var->role = $request->role;
              $var->status = 'Pending';
              $var->save();
              $request->session()->flash('database-success', 'Registration Successful. wait for approval!');
              return redirect('login');
          }
      }
        if ($role == 'seller') {
              //duplicate user check
            $check = Seller::where([
                ['email', '=', $email]
            ])->first();
            if ($check) {
                $request->session()->flash('database-error', 'Email already taken! use another one!');
                return redirect('registration');
            } else {
                $var = new Seller();
                $var->name = $request->name;
                $var->email = $request->email;
                $var->phone = $request->phone;
                $var->address = $request->address;
                $var->password = $request->password;
                $var->role = $request->role;
                $var->status = 'Pending';
                $var->save();
                $request->session()->flash('database-success', 'Registration Successful. wait for approval!');
                return redirect('login');
            }
        }
        if($role == 'customer'){
             //duplicate user check
            $check = Customer::where([
                ['email', '=', $email]
            ])->first();
            if ($check) {
                $request->session()->flash('database-error', 'Email already taken! use another one!');
                return redirect('registration');
            } else {
                $var = new Customer();
                $var->name = $request->name;
                $var->email = $request->email;
                $var->phone = $request->phone;
                $var->address = $request->address;
                $var->password = $request->password;
                $var->role = $request->role;
                $var->status = 'Approved';
                $var->save();
                $request->session()->flash('database-success', 'Registration Successful. Login Here!');
                return redirect('login');
            }
        }else{
            $check = ServiceProvider::where([
                 //duplicate user check
                ['email', '=', $email]
            ])->first();
            if ($check) {
                $request->session()->flash('database-error', 'Email already taken! use another one!');
                return redirect('registration');
            } else {
                $var = new ServiceProvider();
                $var->name = $request->name;
                $var->email = $request->email;
                $var->phone = $request->phone;
                $var->address = $request->address;
                $var->password = $request->password;
                $var->role = $request->role;
                $var->status = 'Pending';
                $var->save();
                $request->session()->flash('database-success', 'Registration Successful. wait for approval!');
                return redirect('login');
            }
        }
    }
    








    // API
    public function Registration(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'role' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ],
                'confirmPassword' => [
                    'required',
                    'same:password',
                    'min:10'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'confirmPassword.required' => 'Confirm Password is Required!',
                'confirmPassword.same' => 'Confirm Password not match!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',
                'role.required' => 'Select your user role!'
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        }else{
            $email = $request->email;
            $role = $request->role; 
            if ($role == 'admin') {
                $user = Admin::where([
                    ['email', '=', $email]
                ])->first();
    
                if ($user) {
                    return response()->json([    
                        'duplicateEmail' => 'Email already taken! use another one!',
                    ]);
                } else {
                    $var = new Admin();
                    $var->name = $request->name;
                    $var->email = $request->email;
                    $var->phone = $request->phone;
                    $var->address = $request->address;
                    $var->password = $request->password;
                    $var->role = $request->role;
                    $var->status = 'Pending';
                    $var->save();
                    return response()->json([    
                        'success' => 'Registration Successful. wait for approval!',
                    ]);
                }
            }
            if ($role == 'seller') {
                $user = Seller::where([
                    ['email', '=', $email]
                ])->first();
                if ($user) {
                    return response()->json([    
                        'duplicateEmail' => 'Email already taken! use another one!',
                    ]);
                } else {
                    $var = new Seller();
                    $var->name = $request->name;
                    $var->email = $request->email;
                    $var->phone = $request->phone;
                    $var->address = $request->address;
                    $var->password = $request->password;
                    $var->role = $request->role;
                    $var->status = 'Pending';
                    $var->save();
                    return response()->json([    
                        'success' => 'Registration Successful. wait for approval!',
                    ]);
                }
            }
            if ($role == 'customer') {
                $user = Customer::where([
                    ['email', '=', $email]
                ])->first();
                if ($user) {
                    return response()->json([    
                        'duplicateEmail' => 'Email already taken! use another one!',
                    ]);
                } else {
                    $var = new Customer();
                    $var->name = $request->name;
                    $var->email = $request->email;
                    $var->phone = $request->phone;
                    $var->address = $request->address;
                    $var->password = $request->password;
                    $var->role = $request->role;
                    $var->status = 'Approved';
                    $var->save();
                    return response()->json([    
                        'success' => 'Registration Successful. Login Here!',
                    ]);
                }
            } else {
                $user = ServiceProvider::where([
                    //duplicate user check
                    ['email', '=', $email]
                ])->first();
                if ($user) {
                    return response()->json([    
                        'duplicateEmail' => 'Email already taken! use another one!',
                    ]);
                } else {
                    $var = new ServiceProvider();
                    $var->name = $request->name;
                    $var->email = $request->email;
                    $var->phone = $request->phone;
                    $var->address = $request->address;
                    $var->password = $request->password;
                    $var->role = $request->role;
                    $var->status = 'Pending';
                    $var->save();
                    return response()->json([    
                        'success' => 'Registration Successful. wait for approval!',
                    ]);
                }
            }
        }
    }
}
