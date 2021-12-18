<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use Illuminate\support\Facades\File;

class ProductController extends Controller
{
    //product page for all users
    public function showAllProducts()
    {
        $allProducts = Product::paginate(8);
        $ratings = ProductRating::all();
        return view(
            'pages.product.allProducts',
            ['allProducts' => $allProducts],
            ['ratings' => $ratings]
        );
    }

    // show product on homePage 
    public function showProducts()
    {
        $featuredProduct = Product::orderBy('price', 'desc')->limit(2)->get();
        $latestProduct = Product::orderBy('created_at', 'desc')->limit(3)->get();
        $allProducts = Product::paginate(4);
        return view('pages.home.home')->with(['allProducts' => $allProducts, 'featuredProducts' => $featuredProduct, 'latestProducts' => $latestProduct]);
    }

   

   







    // category page
    public function phone()
    {
        $ratings = ProductRating::all();
        $product = Product::where('category', 'phone')->get();
        return view('pages.category.phone', ['phone' => $product], ['ratings' => $ratings]);
    }
    public function camera()
    {
        $ratings = ProductRating::all();
        $product = Product::where('category', 'camera')->get();
        return view('pages.category.camera', ['camera' => $product], ['ratings' => $ratings]);
    }
    public function television()
    {
        $ratings = ProductRating::all();
        $product = Product::where('category', 'television')->get();
        return view('pages.category.television', ['television' => $product], ['ratings' => $ratings]);
    }
    public function laptop()
    {
        $ratings = ProductRating::all();
        $product = Product::where('category', 'laptop')->get();
        return view('pages.category.laptop', ['laptop' => $product], ['ratings' => $ratings]);
    }
    // show single product details
    public function showProductDetails(Request $request)
    {

        $product = Product::where('id', $request->id)->first();
        $productCategory = Product::all();

        return view('pages.product.productDetails', ['details' => $product], ['categories' => $productCategory]);
    }
    //show product on productList page for (both admin & seller)
    public function productList()
    {
        $allProducts = Product::all();
        return view('pages.product.productList', ['allProducts' => $allProducts]);
    }
    // pass product data on addProduct page for (seller)
    public function allProduct()
    {
        $allProducts = Product::all();
        return view('pages.product.addProduct', ['allProducts' => $allProducts]);
    }

    // add product by (seller)
    public function listingProduct(Request $request)
    {
        $this->validate(
            $request,
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

            ],
        );
        $var = new Product();
        $var->name = $request->name;
        $var->price = $request->price;
        $var->quantity = $request->quantity;
        $var->category = $request->category;
        $var->sellerName = $request->sellerName;
        $var->sellerNumber = $request->sellerNumber;
        $var->productDetails = $request->productDetails;
        $var->sellerId = $request->sellerId;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'product' . time() . '.' . $extension;
            $file->move('uploads/products/', $fileName);
            $var->image =  $fileName;
        }
        $var->save();
        $request->session()->flash('product-added', 'Product Added!');
        return redirect('addProduct');
    }


    //send product data for edit product (both admin & seller)
    function EditProduct($id)
    {
        $products = Product::find($id);
        return view('pages.product.editProduct', ['products' => $products]);
    }

    //update product by both (admin & seller)
    public function updateProduct(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'category' => 'required',
                'quantity' => 'required|regex:/[0-9]/',
                'price' => 'required',
                'image' => 'required',
                'sellerName' => 'required',
                'sellerNumber' => 'required',
                // 'sellerEmail' => 'required',
                // 'role' => 'required',
                'productDetails' => 'required',
            ],
        );
        $product = Product::find($request->id);
        // $product->id = $request->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $product->sellerName = $request->sellerName;
        $product->sellerNumber = $request->sellerNumber;
        // $product->sellerEmail = $request->sellerEmail;
        // $product->role = $request->role;
        $product->productDetails = $request->productDetails;

        if ($request->hasFile('image')) {
            $destination = 'uploads/products/' . $product->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/products/', $fileName);
            $product->image =  $fileName;
        }
        $product->update();
        $request->session()->flash('product-update', 'Product Updated Successfully!');
        return redirect('productList');
    }
    //delete product by (both admin & seller)
    function deleteProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $destination = 'uploads/products/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        $request->session()->flash('product-delete', 'Product Deleted Successfully!');
        return redirect('productList');
    }
    //show every single product all orders
    public function productOrders($id)
    {
        $products = Product::find($id);
        // $products = Seller::find($id);
        // $user = User::where('id',Session()->get('id'))->first();
        $product = Product::where('id', $products->id)->first();
        $productOrders =  $product->orders; // function 
        return view('pages.order.productOrders')->with(['product' => $products, 'orders' => $productOrders]);
    }
    //show every single product all rating
    public function productRatings($id)
    {
        $products = Product::find($id);
        $product = Product::where('id', $products->id)->first();
        $productRatings =  $product->productRatings; // function 
        return view('pages.product.productRatings')->with(['product' => $products, 'ratings' => $productRatings]);
    }


    // API For Home Page
    public function ProductsApi()
    {
        return [
            Product::orderBy('price', 'desc')->limit(2)->get(),
            Product::orderBy('created_at', 'desc')->limit(4)->get(),
            Product::all()
        ];
    }

}


