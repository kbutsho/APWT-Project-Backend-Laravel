<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function addToDelivery($id)
    {
        $order = Order::find($id);
        return view('pages.delivery.delivery', ['order' => $order]);
    }
    public function addDelivery(Request $request)
    {
        $this->validate(
            $request,
            [
                'Address' => 'required',
                'customerName' => 'required',
                'productName' => 'required',
                'productId' => 'required',
                'serviceProviderId' => 'required',
                'comment' => 'required',
                'status' => 'required',
                's_ProviderName' => 'required',
                'customerId' => 'required'
            ],
        );
        $var = new Delivery();
        $var->Address = $request->Address;
        $var->customerName = $request->customerName;
        $var->productName = $request->productName;
        $var->productId = $request->productId;
        $var->customerId = $request->customerId;
        $var->serviceProviderId = $request->serviceProviderId;
        $var->comment = $request->comment;
        $var->status = $request->status;
        $var->s_ProviderName = $request->s_ProviderName;
        $var->save();
        $request->session()->flash('delivery-added', 'Product Delivery  Done!');
        return redirect('deliveryList/'.session('id'));
    }
    // delivery delete by service provider
    function deliveryDelete(Request $request)
    {
        $Delivery = Delivery::where('id', $request->id)->first();
        $Delivery->delete();
        $request->session()->flash('delivery-delete', 'Delivery Deleted Successfully!');
        return redirect('deliveryList/'.session('id'));
    }
    function EditDelivery($id)
    {
        $Delivery = Delivery::find($id);
        return view('pages.delivery.editDelivery', ['delivery' => $Delivery]);
    }
    function updateDelivery(Request $request)
    {
        $this->validate(
            $request,
            [
                'Address' => 'required',
                'customerName' => 'required',
                'productName' => 'required',
                'productId' => 'required',
                'serviceProviderId' => 'required',
                'comment' => 'required',
                'status' => 'required',
                's_ProviderName' => 'required',
                'customerId' => 'required'
            ],
        );
        $delivery = Delivery::find($request->id);
        $delivery->Address = $request->Address;
        $delivery->customerName = $request->customerName;
        $delivery->productName = $request->productName;
        $delivery->productId = $request->productId;
        $delivery->serviceProviderId = $request->serviceProviderId;
        $delivery->comment = $request->comment;
        $delivery->customerId = $request->customerId;
        $delivery->status = $request->status;
        $delivery->s_ProviderName = $request->s_ProviderName;
        $delivery->update();
        $request->session()->flash('delivery-update', 'Delivery Updated Successfully!');
        return redirect('deliveryList/'.session('id'));
    }
    // show deliveries to customer
    public function customerDeliveries()
    {
        $Deliveries = Delivery::all();
        return view('pages.delivery.CustomerDelivery', ['Deliveries' => $Deliveries]);
    }

}
