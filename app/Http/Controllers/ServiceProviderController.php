<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\support\Facades\File;
use Illuminate\Support\Facades\Validator;



class ServiceProviderController extends Controller
{

    //display service Provider all information for (service Provider)
    public function showServiceProviderProfile()
    {
        $ServiceProvider = ServiceProvider::where('id', session()->get('id'))->first();
        return view('pages.dashboard.dashboard')->with('serviceProvider', $ServiceProvider);
    }
    //Edit ServiceProvider profile info by (ServiceProvider)
    function EditServiceProviderProfile($id)
    {
        $ServiceProvider = ServiceProvider::find($id);
        return view('pages.serviceProvider.editServiceProviderProfile', ['serviceProvider' => $ServiceProvider]);
    }
    // update ServiceProvider profile info by (ServiceProvider)
    function updateServiceProviderProfile(Request $request)
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
        $check = ServiceProvider::where([
            ['email', '=', $email]
        ])->first();
        $ServiceProvider = ServiceProvider::find($request->id);
        if ($ServiceProvider->email == $request->email) {
            $var = ServiceProvider::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('serviceProvider-info-update', 'Profile Update successfully');
            return redirect('serviceProviderDashboard');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editServiceProviderProfile/' . $request->id);
        } else {
            $var = ServiceProvider::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = ($request->password);
            $var->update();
            $request->session()->flash('serviceProvider-info-update', 'Profile Update successfully');
            return redirect('serviceProviderDashboard');
        }
    }
    //add ServiceProvider profile image by (ServiceProvider)
    public function addServiceProviderPhoto(Request $request)
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
        $var = ServiceProvider::where('id', session()->get('id'))->first();
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
            $file->move('uploads/serviceProviderProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-added', 'Uploaded profile picture!');
        return redirect('serviceProviderDashboard');
    }
    // send data to changeServiceProviderImage page for change image by (ServiceProvider)
    function changeServiceProviderImage($id)
    {
        $ServiceProvider = ServiceProvider::find($id);
        return view('pages.serviceProvider.changeServiceProviderImage', ['serviceProvider' => $ServiceProvider]);
    }
    //change profile image by (ServiceProvider)
    function updateServiceProviderImage(Request $request)
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
        $var = ServiceProvider::find($request->id);
        $var->name = $request->name;
        $var->email = $request->email;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->phone = $request->phone;
        $var->role = $request->role;
        $var->status = $request->status;

        if ($request->hasFile('image')) {
            $destination = 'uploads/serviceProviderProfile/' . $var->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/ServiceProviderProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-update', 'Image changed successfully!');
        return redirect('serviceProviderDashboard');
    }

    public function serviceProviderList()
    {
        $allServiceProviders = ServiceProvider::all();

        // if (session('role') == 'admin') {
        //     return view('pages.serviceProvider.serviceProviderList', ['allServiceProviders' => $allServiceProviders]);
        // } else
        //     return view('pages.error.error');
        return view('pages.serviceProvider.serviceProviderList', ['allServiceProviders' => $allServiceProviders]);
    }
    function approvedServiceProviderEdit($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        return view('pages.serviceProvider.updateServiceProviderStatus', ['status' => $serviceProvider]);
    }
    function approvedServiceProvider(Request $request)
    {
        $this->validate(
            $request,
            [
                'status' => 'required'
            ],
        );
        $serviceProvider = ServiceProvider::find($request->id);
        $serviceProvider->id = $request->id;
        $serviceProvider->status = $request->status;
        $serviceProvider->update();
        $request->session()->flash('serviceProvider-approved', 'serviceProvider Approved!');
        return redirect('serviceProviderList');
    }

    // pass value for addSeller add page
    public function allServiceProvider()
    {
        $allServiceProviders = ServiceProvider::all();
        return view('pages.serviceProvider.addServiceProvider', ['allServiceProviders' => $allServiceProviders]);
    }

    // ADD seller
    public function listingServiceProvider(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'status' => 'required',
                'role' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:10',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/' // must contain a special character

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
                'role.required' => 'Select your user role!'
            ]
        );
        $email = $request->email;
        //duplicate email check
        $check = ServiceProvider::where([
            ['email', '=', $email]
        ])->first();
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken!');
            return redirect('addServiceProvider');
        } else {
            $var = new ServiceProvider();
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->save();
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $extension = $file->getClientOriginalExtension();
            //     $fileName = time() . '.' . $extension;
            //     $file->move('uploads/products/', $fileName);
            //     $var->image =  $fileName;
            // }
            $request->session()->flash('serviceProvider-added', 'ServiceProvider Added!');
            return redirect('addServiceProvider');
        }
    }

    // delete service provider
    function deleteServiceProvider(Request $request)
    {
        $product = ServiceProvider::where('id', $request->id)->first();
        $destination = 'uploads/serviceProviderProfile/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        $request->session()->flash('serviceProvider-delete', 'Service Provider Deleted Successfully!');
        return redirect('serviceProviderList');
    }
    // delete service provider  account by seller own
    function deleteServiceProviderAccount(Request $request)
    {
        $ServiceProvider = ServiceProvider::where('id', $request->id)->first();
        $destination = 'uploads/serviceProviderProfile/' . $ServiceProvider->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $ServiceProvider->delete();
        session()->flush();
        return redirect('/');
    }
    // send data to editServiceProvider page for edit by admin
    function EditServiceProvider($id)
    {
        $serviceProviders = ServiceProvider::find($id);
        return view('pages.serviceProvider.editServiceProvider', ['serviceProviders' => $serviceProviders]);
    }
    //update serviceProvider info by admin
    function updateServiceProvider(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'status' => 'required',
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
                'role.required' => 'Select your user role!'
            ]
        );
        $email = $request->email;
        $check = ServiceProvider::where([
            ['email', '=', $email]
        ])->first();
        $ServiceProvider = ServiceProvider::find($request->id);

        if ($ServiceProvider->email == $request->email) {
            $var = ServiceProvider::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('serviceProvider-update', 'ServiceProvider Updated Successfully!');
            return redirect('serviceProviderList');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editServiceProvider/' . $request->id);
        } else {
            $var = ServiceProvider::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('serviceProvider-update', 'ServiceProvider Updated Successfully!');
            return redirect('serviceProviderList');
        }
    }
    /// show all deliveries to signle service provider
    public function showDeliveries($id)
    {
        $Deliveries = ServiceProvider::find($id);
        $Delivery = ServiceProvider::where('id', $Deliveries->id)->first();
        $allDeliveries =  $Delivery->deliveries; // function 
        return view('pages.delivery.deliveryList')->with(['deliveries' => $Deliveries, 'Deliveries' => $allDeliveries]);
    }
    // show each service provider their own service rating
    public function providerS_rating($id)
    {
        $serviceProviders = ServiceProvider::find($id);
        $serviceProvider = ServiceProvider::where('id', $serviceProviders->id)->first();
        $Provider_S_ratings =  $serviceProvider->s_ratings; // function 
        return view('pages.rating.serviceProviderReview')->with(['serviceProvider' => $serviceProviders, 'ratings' => $Provider_S_ratings]);
    }
    public function serviceNotes($id)
    {
        $services = ServiceProvider::find($id);
        $service = ServiceProvider::where('id', $services->id)->first();
        $serviceNotes =  $service->serviceNotes; // function 
        return view('pages.s_ProviderServiceNote.listProviderServiceNote')->with(['services' => $services, 'notes' => $serviceNotes]);
    }




    //api
    // service provider image
    public function ServiceProviderImageAPI(Request $request)
    {
        $service = ServiceProvider::where('id', $request->id)->first();
        $service->image  =  $request->image;
        $service->save();
        return response()->json([
            'message' => 'Upload Successfully',
            'image' => $service->image,
        ]);
    }
    // get service Provider info
    public function GetServiceProviderInfoAPI($id)
    {
        $user = ServiceProvider::find($id);
        return $user;
    }
    // get all orders
    public function serviceProviderOrders()
    {
        $order = Order::all();
        return $order;
    }
    //get single order details
    public function GetSingleOrderDetails($id)
    {
        $var = Order::find($id);
        return $var;
    }
    // confirm delivery
    public function addToDeliveryAPI(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'Address' => 'required',
                'customerName' => 'required',
                'customerId' => 'required',
                'productName' => 'required',
                'productId' => 'required',
                's_ProviderName' => 'required',
                'serviceProviderId' => 'required',
                'status' => 'required',
                'comment' => 'required',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $var = new Delivery();
            $var->Address = $request->Address;
            $var->customerName = $request->customerName;
            $var->customerId = $request->customerId;
            $var->productName = $request->productName;
            $var->productId = $request->productId;
            $var->s_ProviderName = $request->s_ProviderName;
            $var->serviceProviderId = $request->serviceProviderId;
            $var->status = $request->status;
            $var->comment = $request->comment;
            $var->save();
            return response()->json([
                'success' => 'Added Successfully!',
            ]);
        }
    }
    public function serviceProviderDeliveries($id)
    {
        $Deliveries = ServiceProvider::find($id);
        $Delivery = ServiceProvider::where('id', $Deliveries->id)->first();
        $allDeliveries =  $Delivery->deliveries; // function 
        return $allDeliveries;
    }
    public function deleteDeliveryAPI($id)
    {
        $delivery = Delivery::find($id);
        $delivery->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully!',
        ]);
    }
    //get single delivery details
    public function GetSingleDelivery($id)
    {
        $var = Delivery::find($id);
        return $var;
    }
    public function MakeNoteAPI(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                's_ProviderName' => 'required',
                'productName' => 'required',
                'Address' => 'required',
                'status' => 'required',
                'note' => 'required',
                'serviceProviderId' => 'required',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'id' => $request->id
            ]);
        } else {
            $var = new Service();
            $var->s_ProviderName = $request->s_ProviderName;
            $var->productName = $request->productName;
            $var->Address = $request->Address;
            $var->status = $request->status;
            $var->note = $request->note;
            $var->serviceProviderId = $request->serviceProviderId;
            $var->save();
            return response()->json([
                'success' => 'Added Successfully!',
            ]);
        }
    }
    // one to many relation
    public function getServiceNotesAPI($id)
    {
        $services = ServiceProvider::find($id);
        $service = ServiceProvider::where('id', $services->id)->first();
        $serviceNotes =  $service->serviceNotes; // function 
        return $serviceNotes;
    }
    //delete note
    function deleteNoteAPI($id)
    {
        $order = Service::find($id);
        $order->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully!',
        ]);
    }
    //get single note details
    public function GetSingleNote($id)
    {
        $var = Service::find($id);
        return $var;
    }
    public function UpdateNoteAPI(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                's_ProviderName' => 'required',
                'productName' => 'required',
                'Address' => 'required',
                'status' => 'required',
                'note' => 'required',
                'serviceProviderId' => 'required',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'id' => $request->id
            ]);
        } else {
            $id = $request->id;
            $var = Service::where([
                ['id', '=', $id]
            ])->first();
            $var->s_ProviderName = $request->s_ProviderName;
            $var->productName = $request->productName;
            $var->Address = $request->Address;
            $var->status = $request->status;
            $var->note = $request->note;
            $var->update();
            return redirect('http://localhost:3000/serviceProviderNotes/' . $request->id);
        }
    }

    // show each service provider their own service rating
    public function s_ProviderServiceReview($id)
    {
        $serviceProviders = ServiceProvider::find($id);
        $serviceProvider = ServiceProvider::where('id', $serviceProviders->id)->first();
        $Provider_S_ratings =  $serviceProvider->s_ratings; // function 
       return $Provider_S_ratings;
    }
     // update seller profile
     function updateServiceProviderProfileAPI(Request $request)
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
         $var = ServiceProvider::find($request->id);
         $var->name = $request->name;
         $var->phone = $request->phone;
         $var->address = $request->address;
         $var->password = $request->password;
         $var->update();
         return redirect('http://localhost:3000/dashboard');
     }
     
     function UpdateDeliveryAPI(Request $request)
     {
         $this->validate(
             $request,
             [
                 's_ProviderName' => 'required',
                 'comment' => 'required',
                 'Address' => 'required',
                 'status' => 'required',
                 
             ]
             
         );
         $var = Delivery::find($request->id);
         $var->s_ProviderName = $request->s_ProviderName;
         $var->status = $request->status;
         $var->Address = $request->Address;
         $var->comment = $request->comment;
         $var->update();
         return redirect('http://localhost:3000/serviceProviderDeliveries/' . $request->id);
        
     }





    // Not working
    public function AddOrderAPI(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'productName' => 'required',
                'customerName' => 'required',
                'Address' => 'required',
                'phone' => 'required',
                'price' => 'required',
                'status' => 'required',
                'productId' => 'required',
                'customerId' => 'required',
                'sellerId' => 'required',
                'method' => 'required',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $var = new Order();
            $var->productName = $request->productName;
            $var->customerName = $request->customerName;
            $var->Address = $request->Address;
            $var->phone = $request->phone;
            $var->price = $request->price;
            $var->status = "Pending";
            $var->productId = $request->productId;
            $var->customerId = $request->customerId;
            $var->sellerId = $request->sellerId;
            $var->method = $request->method;
            $var->save();
            return response()->json([
                'success' => 'Added Successfully!',
            ]);
        }
    }
}
