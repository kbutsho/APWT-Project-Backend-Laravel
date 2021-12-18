<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\ServiceRating;
use Illuminate\Http\Request;

class ServiceRatingController extends Controller
{
    function showServiceRatingForm($id)
    {
        $delivery = Delivery::find($id);
        return view('pages.rating.serviceRatingForm', ['delivery' => $delivery]);
    }
    
    public function confirmServiceRating(Request $request)
    {
        $this->validate(
            $request,
            [
                'rating' => 'required',
                'review' => 'required',
                'customerId' => 'required',
                'serviceProviderId' => 'required',
                'customerName' => 'required',
                's_ProviderName' => 'required',
            ],
        );
        $var = new ServiceRating();
        $var->rating = $request->rating;
        $var->review = $request->review;
        $var->customerId = $request->customerId;
        $var->customerName = $request->customerName;
        $var->serviceProviderId = $request->serviceProviderId;
        $var->s_ProviderName = $request->s_ProviderName;
        $var->save();
        $request->session()->flash('rating-done', 'Service Rating Done!');
        return redirect('serviceReviews/'. $request->customerId);
    }
    function deleteServiceReview(Request $request)
    {
        $productRating = ServiceRating::where('id', $request->id)->first();
        $productRating->delete();
        $request->session()->flash('service-review-delete', 'Service Reviews Successfully Deleted!');
        if(session('role') == 'customer'){
            return redirect('/serviceReviews/'. session('id'));
        }
        else{
            return redirect('/serviceProviderReviews/'. session('id'));
        } 
       
    }
    // edit product review
    public function editServiceReview($id){
        $review = ServiceRating::find($id);
        return view('pages.rating.serviceRatingEdit', ['review' => $review]);
    }
    // updateProductReview by customer
    function updateServiceReview(Request $request)
    {
        $this->validate(
            $request,
            [
                'rating' => 'required',
                'review' => 'required',
                'customerId' => 'required',
                'serviceProviderId' => 'required',
                'customerName' => 'required',
                's_ProviderName' => 'required',
            ],
        );
        $var = ServiceRating::find($request->id);
        $var->rating = $request->rating;
        $var->review = $request->review;
        $var->customerId = $request->customerId;
        $var->customerName = $request->customerName;
        $var->serviceProviderId = $request->serviceProviderId;
        $var->s_ProviderName = $request->s_ProviderName;
        $var->update();
        $request->session()->flash('service-review-update', 'Review Updated Successfully!');
       if(session('role') == 'customer'){
        return redirect('serviceReviews/'. session('id'));
       }
       else{
        return redirect('serviceProviderReviews/'. session('id'));
       }
    
    }
}
