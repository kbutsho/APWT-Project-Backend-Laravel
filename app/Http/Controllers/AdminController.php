<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //display admin all information for (admin)
    public function showAdminProfile()
    {
        $admin = Admin::where('id', Session()->get('id'))->first();

        return view('pages.dashboard.dashboard')->with('admin', $admin);
    }
    // send data to editAdminProfile page for (admin)
    function EditAdminProfile($id)
    {
        $admin = Admin::find($id);
        return view('pages.admin.editAdminProfile', ['admin' => $admin]);
    }
    // update admin information by (admin)
    function updateAdminProfile(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ],
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 5 characters!',
                'name.max' => 'Insert less than 20 characters!',
            ]
        );
        $email = $request->email;
        $check = Admin::where([
            ['email', '=', $email]
        ])->first();

        $admin = Admin::where('id', session()->get('id'))->first();
        if ($admin->email == $request->email) {
            $var = Admin::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('admin-info-update', 'Profile Update successfully!');
            return redirect('adminDashboard');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editAdminProfile/' . $request->id);
        } else {
            $var = Admin::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('admin-info-update', 'Profile Update successfully!');
            return redirect('adminDashboard');
        }
    }
    //add admin profile image by (admin)
    public function addAdminPhoto(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => 'required',
                'role' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'status' => 'required',
            ],
        );
        $var = Admin::where('id', session()->get('id'))->first();
        $var->name = $request->name;
        $var->email = $request->email;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->phone = $request->phone;
        $var->role = $request->role;
        $var->status = $request->status;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/adminProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-added', 'Uploaded profile picture!');
        return redirect('adminDashboard');
    }
    // send data to changeAdminImage page for change image by (admin)
    function changeAdminImage($id)
    {
        $admin = admin::find($id);
        return view('pages.admin.changeAdminImage', ['admin' => $admin]);
    }
    //change profile image for (admin)
    function updateAdminImage(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => 'required',
                'role' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'status' => 'required'
            ],
        );
        $var = Admin::find($request->id);
        $var->name = $request->name;
        $var->email = $request->email;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->phone = $request->phone;
        $var->role = $request->role;
        $var->status = $request->status;

        if ($request->hasFile('image')) {
            $destination = 'uploads/adminProfile/' . $var->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/adminProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-update', 'Image changed successfully!');
        return redirect('adminDashboard');
    }
    // delete admin account by admin own
    function deleteAdminAccount(Request $request)
    {
        $admin = Admin::where('id', $request->id)->first();
        $destination = 'uploads/adminProfile/' . $admin->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $admin->delete();
        session()->flush();
        return redirect('/');
    }




    // set Admin photo
    public function AdminImageAPI(Request $request)
    {
        $admin = Admin::where('id', $request->id)->first();
        $admin->image  =  $request->image;
        $admin->save();
        return response()->json([
            'message' => 'Upload Successfully',
            'image' => $admin->image,
        ]);
    }
    // get admin info
    public function GetAdminInfoAPI($id)
    {
        $user = Admin::find($id);
        return $user;
    }


    // seller operation
    public function AddSellerAPi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $email = $request->email;
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
                $var->role = "seller";
                $var->status = "Pending";
                $var->save();
                return response()->json([
                    'success' => 'Added Successfully!',
                ]);
            }
        }
    }
    public function sellerList()
    {
        return Seller::all();
    }
    function deleteSeller($id)
    {
        $seller = Seller::find($id);
        $seller->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully!',
        ]);
    }
    public function GetSeller($id)
    {
        $seller = Seller::find($id);
        return $seller;
    }
    public function UpdateSellerAPi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|max:20',
                'status' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
                'status.required' => 'Status is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'id' => $request->id
            ]);
        } else {
            $id = $request->id;
            $var = Seller::where([
                ['id', '=', $id]
            ])->first();
            $var->id = $request->id;
            $var->name = $request->name;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->status = $request->status;
            $var->update();
            return redirect('http://localhost:3000/sellerList');
        }
    }




    // customer operation
    public function AddCustomerAPi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
               
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
               
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'message' => $request,
            ]);
        } else {
            $email = $request->email;
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
                $var->status = "Pending";
                $var->role = "customer";
                $var->save();
                return response()->json([
                    'success' => 'Added Successfully!',
                ]);
            }
        }
    }
    public function customerList()
    {
        return Customer::all();
    }
    function deleteCustomer($id)
    {
        $var = Customer::find($id);
        $var->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully!',
        ]);
    }
    public function GetCustomer($id)
    {
        $var = Customer::find($id);
        return $var;
    }
    public function UpdateCustomerAPi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|max:20',
                'status' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
                'status.required' => 'Status is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'id' => $request->id
            ]);
        } else {
            $id = $request->id;
            $var = Customer::where([
                ['id', '=', $id]
            ])->first();
            $var->id = $request->id;
            $var->name = $request->name;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->status = $request->status;
            $var->update();
            return redirect('http://localhost:3000/customerList');
        }
    }

    // service provider operation

    public function AddServiceProviderAPi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
              
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
               
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',

            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $email = $request->email;
            $user = ServiceProvider::where([
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
                $var->role = "service";
                $var->status = "Pending";
                $var->save();
                return response()->json([
                    'success' => 'Added Successfully!',
                ]);
            }
        }
    }
    public function serviceProviderList()
    {
        return ServiceProvider::all();
    }
    function deleteServiceProvider($id)
    {
        $var = ServiceProvider::find($id);
        $var->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully!',
        ]);
    }
    public function GetServiceProvider($id)
    {
        $var = ServiceProvider::find($id);
        return $var;
    }
    public function UpdateServiceProviderAPi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|max:20',
                'status' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ]
            ],
            [
                'phone.required' => 'Phone is required!',
                'status.required' => 'Status is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'name.min' => 'Insert more than 4 characters!',
                'name.max' => 'Insert less than  20 characters!',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'id' => $request->id
            ]);
        } else {
            $id = $request->id;
            $var = ServiceProvider::where([
                ['id', '=', $id]
            ])->first();
            $var->id = $request->id;
            $var->name = $request->name;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->status = $request->status;
            $var->update();
            return redirect('http://localhost:3000/serviceProviderList');
        }
    }
    // get all orders api
    public function orderListForAdmin()
    {
        $order = Order::all();
        return $order;
    }
    // update admin profile
    function updateAdminProfileAPI(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ],
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'name.min' => 'Insert more than 5 characters!',
                'name.max' => 'Insert less than 20 characters!',
            ]
        );
        $var = Admin::find($request->id);
        $var->name = $request->name;
        $var->phone = $request->phone;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->update();
        return redirect('http://localhost:3000/dashboard');
    }
}
