<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use Illuminate\support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    // show all sellers in sellerList page for (admin)
    public function sellerList()
    {
        $allSellers = Seller::all();
        return view('pages.seller.sellerList', ['allSellers' => $allSellers]);
    }
    // send data to updateSellerStatus page for  approved seller status by (admin)
    function approvedSellerEdit($id)
    {
        $Seller = Seller::find($id);
        return view('pages.seller.updateSellerStatus', ['status' => $Seller]);
    }
    //approved seller status by (admin)
    function approvedSeller(Request $request)
    {
        $this->validate(
            $request,
            [
                'status' => 'required'
            ],
        );
        $seller = Seller::find($request->id);
        $seller->id = $request->id;
        $seller->status = $request->status;
        $seller->update();

        $request->session()->flash('seller-approved', 'Seller Status update!');
        return redirect('sellerList');
    }
    // pass value for addSeller page for add seller by (admin)
    public function allSeller()
    {
        $allSellers = Seller::all();
        return view('pages.seller.addSeller', ['allSellers' => $allSellers]);
    }
    // ADD seller by (admin)
    public function listingSeller(Request $request)
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
        $check = Seller::where([
            ['email', '=', $email]
        ])->first();
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken!');
            return redirect('addSeller');
        } else {
            $var = new Seller();
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->save();

            $request->session()->flash('seller-added', 'Seller Added!');
            return redirect('addSeller');
        }
    }
    // delete sellers by (admin)
    function deleteSeller(Request $request)
    {
        $product = Seller::where('id', $request->id)->first();
        $destination = 'uploads/sellerProfile/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        $request->session()->flash('seller-delete', 'Seller Deleted Successfully!');
        return redirect('sellerList');
    }

    // send data to editSeller page for edit by (admin)
    function EditSeller($id)
    {
        $sellers = Seller::find($id);
        return view('pages.seller.editSeller', ['sellers' => $sellers]);
    }
    //update seller info by (admin)
    function updateSeller(Request $request)
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
        $check = Seller::where([
            ['email', '=', $email]
        ])->first();
        $sellers = Seller::find($request->id);

        if ($sellers->email == $request->email) {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('seller-update', 'Seller Updated Successfully!');
            return redirect('sellerList');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editSeller/' . $request->id);
        } else {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('seller-update', 'Seller Updated Successfully!');
            return redirect('sellerList');
        }
    }
    //every single seller Products for (seller)
    public function sellerProduct($id)
    {
        $sellers = Seller::find($id);
        $seller = Seller::where('id', $sellers->id)->first();
        $sellerProducts =  $seller->products; // function
        return view('pages.product.sellerProduct')->with(['seller' => $sellers, 'products' => $sellerProducts]);
    }
    //every single seller all order for (seller)
    public function sellerOrder($id)
    {
        $sellers = Seller::find($id);
        $seller = Seller::where('id', $sellers->id)->first();
        $sellerOrders =  $seller->orders; // function 
        return view('pages.order.sellerOrderList')->with(['seller' => $sellers, 'orders' => $sellerOrders]);
    }

    //Show seller profile for (seller)
    public function showSellerProfile()
    {
        if (session('role') == 'seller') {
            $seller = Seller::where('id', Session()->get('id'))->first();
            return view('pages.dashboard.dashboard')->with('seller', $seller);
        }
    }

    // delete seller account by seller own (seller)
    function deleteSellerAccount(Request $request)
    {
        $seller = Seller::where('id', $request->id)->first();
        $destination = 'uploads/sellerProfile/' . $seller->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $seller->delete();
        session()->flush();
        return redirect('/');
    }
    //Edit seller profile info by (seller)
    function EditSellerProfile($id)
    {
        $seller = Seller::find($id);
        return view('pages.seller.editSellerProfile', ['seller' => $seller]);
    }
    // update seller profile info by (seller)
    function updateSellerProfile(Request $request)
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
        $check = Seller::where([
            ['email', '=', $email]
        ])->first();
        $sellers = Seller::find($request->id);
        if ($sellers->email == $request->email) {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('seller-update', 'Profile Update successfully');
            return redirect('sellerDashboard');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editSellerProfile/' . $request->id);
        } else {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('seller-update', 'Profile Update successfully');
            return redirect('sellerDashboard');
        }
    }

    //add seller profile image by (seller)
    public function addSellerPhoto(Request $request)
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
        $var = Seller::where('id', session()->get('id'))->first();
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
            $file->move('uploads/sellerProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-added', 'Uploaded profile picture!');
        return redirect('sellerDashboard');
    }
    // send data to changeSellerImage page for change image by (seller)
    function changeSellerImage($id)
    {
        $seller = Seller::find($id);
        return view('pages.seller.changeSellerImage', ['seller' => $seller]);
    }
    //change profile image by (seller)
    function updateSellerImage(Request $request)
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
        $var = Seller::find($request->id);
        $var->name = $request->name;
        $var->email = $request->email;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->phone = $request->phone;
        $var->role = $request->role;
        $var->status = $request->status;

        if ($request->hasFile('image')) {

            $destination = 'uploads/sellerProfile/' . $var->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/sellerProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-update', 'Image changed successfully!');
        return redirect('sellerDashboard');
    }













    // Api 
    // set seller photo
    public function SellerImageAPI(Request $request)
    {
        $seller = Seller::where('id', $request->id)->first();
        $seller->image  =  $request->image;
        $seller->save();
        return response()->json([
            'message' => 'Upload Successfully',
            'image' => $seller->image,
        ]);
    }
    // get seller info
    public function GetSellerInfoAPI($id)
    {
        $user = Seller::find($id);
        return $user;
    }
    // every single seller order 
    public function SellerOrdersAPI($id)
    {
        $sellers = Seller::find($id);
        $seller = Seller::where('id', $sellers->id)->first();
        $sellerOrders =  $seller->orders; // function 
        return $sellerOrders;
    }
    //every single seller Products for (seller)
    public function SellerProductsAPI($id)
    {
        // Request $request
        $sellers = Seller::find($id);
        $seller = Seller::where('id', $sellers->id)->first();
        $sellerProducts =  $seller->products; // function
        return $sellerProducts;
    }
    // add product
    public function AddProductAPI(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sellerName' => 'required',
                'sellerNumber' => 'required',
                'sellerId' => 'required',
                'productDetails' => 'required',
                'name' => 'required',
                'category' => 'required',
                'image' => 'required',
                'quantity' => 'required|regex:/[0-9]/',
                'price' => 'required|regex:/[0-9]/',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $var = new Product();
            $var->name = $request->name;
            $var->price = $request->price;
            $var->quantity = $request->quantity;
            $var->category = $request->category;
            $var->sellerName = $request->sellerName;
            $var->sellerNumber = $request->sellerNumber;
            $var->productDetails = $request->productDetails;
            $var->sellerId = $request->sellerId;
            $var->image = $request->image;
            $var->save();
            return response()->json([
                'success' => 'Added Successfully!',
            ]);
        }
    }
    //delete product
    function deleteProductAPI($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully!',
        ]);
    }
    public function GetSingleProduct($id)
    {
        $var = Product::find($id);
        return $var;
    }
    public function UpdateProductAPI(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
               
                'productDetails' => 'required',
                'name' => 'required',
                'quantity' => 'required|regex:/[0-9]/',
                'price' => 'required|regex:/[0-9]/',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'id' => $request->id
            ]);
        } else {
            $id = $request->id;
            $var = Product::where([
                ['id', '=', $id]
            ])->first();
            $var->id = $request->id;
            $var->name = $request->name;
            $var->quantity = $request->quantity;
            $var->price = $request->price;
            $var->productDetails = $request->productDetails;
            $var->update();
            if($request->role === 'seller'){
                return redirect('http://localhost:3000/sellerProducts/' . $request->id);
            }
            else{
                return redirect('http://localhost:3000/ProductList/');
            }
            
        }
    }
    // delete order
    function deleteSellerOrderAPI($id)
    {
        $order = Order::find($id);
        $order->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully!',
        ]);
    }
    public function updateSellerOrderAPI(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [

                'status' => 'required',
               
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
                'id' => $request->id
            ]);
        } else {
            $id = $request->id;
            $var = Order::where([
                ['id', '=', $id]
            ])->first();
            $var->status = $request->status;
            $var->update();
            return redirect('http://localhost:3000/sellerOrders/' . $request->id);
        }
    }
     //show every single product all rating
     public function productRatingsAPI($id)
     {
         $products = Product::find($id);
         $product = Product::where('id', $products->id)->first();
         $productRatings =  $product->productRatings; // function 
         return $productRatings;
     }
     
     // update seller profile
    function updateSellerProfileAPI(Request $request)
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
        $var = Seller::find($request->id);
        $var->name = $request->name;
        $var->phone = $request->phone;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->update();
        return redirect('http://localhost:3000/dashboard');
    }
}
