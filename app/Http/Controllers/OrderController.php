<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // all order list fro admin
    public function allOrderList(){
        $orders = Order::all();
        return view('pages.order.allOrderList', ['orders' => $orders]);
    }
    // send product data to buy now page
    public function confirmProductShow($id){
        $products = Product::find($id);
        return view('pages.order.order', ['products' => $products]);
    }
   
    public function EditOrder($id){
        $order = Order::find($id);
        return view('pages.order.customerEditOrder', ['order' => $order]);
    }
    // buy now
    public function buyNow(Request $request)
    {
        $this->validate(
            $request,
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
            ],
            [
                'Address.required' => 'Address is Required',
                'phone.required' => 'Phone is Required',
                'customerName.required' => 'Your name is Required',
            ]
        );
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
        $request->session()->flash('order-done', 'Order Place Successfully!');
        return redirect('/customerOrders/'. session('id'));
    }
    // delete order  by customer
    function deleteOrder(Request $request)
    {
        $product = Order::where('id', $request->id)->first();
        $product->delete();
        $request->session()->flash('order-delete', 'Order Deleted Successfully!');
        return redirect('customerOrders/'. session('id'));
    }
     // delete order  by seller
     function sellerOrderDelete(Request $request)
     {
         $product = Order::where('id', $request->id)->first();
         $product->delete();
         $request->session()->flash('order-delete', 'Order Deleted Successfully!');
         return redirect('sellerOrder/'. session('id'));
     }
    //update order by customer
    function updateOrder(Request $request)
    {
        $this->validate(
            $request,
            [
                'productName' => 'required',
                'customerName' => 'required',
                'Address' => 'required',
                'phone' => 'required',
                'price' => 'required',
                'status' => 'required',
                'productId' => 'required',
                'customerId' => 'required',
                'method' => 'required',
            ],
        );
        $var = Order::find($request->id);
        $var->productName = $request->productName;
        $var->customerName = $request->customerName;
        $var->Address = $request->Address;
        $var->phone = $request->phone;
        $var->price = $request->price;
        $var->status = $request->status;
        $var->productId = $request->productId;
        $var->customerId = $request->customerId;
        $var->sellerId = $request->sellerId;
        $var->method = $request->method;

        $var->update();
        $request->session()->flash('order-update', 'Order Updated Successfully!');
        return redirect('customerOrders/'. session('id'));
    }
    // send data to updateOrderStatus page by seller and service provider
    function sellerOrderEdit($id)
    {
        $order = Order::find($id);
        return view('pages.order.updateOrderStatus', ['status' => $order]);
    }
    // updateOrderStatus by seller and service provider
    function updateOrderStatus(Request $request)
    {
        $this->validate(
            $request,
            [
                'status' => 'required'
            ],
        );
        $seller = Order::find($request->id);
        $seller->id = $request->id;
        $seller->status = $request->status;
        $seller->update();
        $request->session()->flash('order-update', 'Order Update!');
        if(session('role') == 'seller'){
            return redirect('sellerOrder/'. session('id'));
        }
        else{
            return redirect('orderList');
        }
        
    }
   
}
