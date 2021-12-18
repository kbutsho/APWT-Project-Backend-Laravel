<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductRating;

class ProductRatingController extends Controller
{
    // send product data to ProductRatingForm page
    function showProductRatingForm($id)
    {
        $review = Product::find($id);
        return view('pages.product.productRatingForm', ['review' => $review]);
    }
    
    public function confirmProductRating(Request $request)
    {
        $this->validate(
            $request,
            [
                'rating' => 'required',
                'review' => 'required',
                'customerId' => 'required',
                'productId' => 'required',
                'customerName' => 'required',
                'productName' => 'required',
            ],
        );
        $var = new ProductRating();
        $var->rating = $request->rating;
        $var->review = $request->review;
        $var->customerId = $request->customerId;
        $var->customerName = $request->customerName;
        $var->productName = $request->productName;
        $var->productId = $request->productId;
        $var->save();
        $request->session()->flash('rating-done', 'Product Rating Done!');
        return redirect('customerOrders/'. $request->customerId);
    }
    //product rating delete by customer
    function deleteProductReview(Request $request)
    {
        $productRating = ProductRating::where('id', $request->id)->first();
        $productRating->delete();
        $request->session()->flash('review-delete', 'Product Reviews Successfully Deleted!');
        if(session('role') == 'seller'){
            return redirect('/productRatings/'. session('id'));
        }
        else{
            return redirect('/productReviews/'. session('id'));
        } 
    }
    // edit product review
    public function editProductReview($id){
        $review = ProductRating::find($id);
        return view('pages.product.productRatingEdit', ['review' => $review]);
    }
    // updateProductReview by customer
    function updateProductReview(Request $request)
    {
        $this->validate(
            $request,
            [
                'rating' => 'required',
                'review' => 'required',
                'customerId' => 'required',
                'productId' => 'required',
                'customerName' => 'required',
                'productName' => 'required',
            ],
        );
        $var = ProductRating::find($request->id);
        $var->rating = $request->rating;
        $var->review = $request->review;
        $var->customerId = $request->customerId;
        $var->customerName = $request->customerName;
        $var->productId = $request->productId;
        
        $var->update();
        $request->session()->flash('review-update', 'Review Updated Successfully!');
       if(session('role') == 'seller'){
        return redirect('productRatings/'. session('id'));
       }
       else{
        return redirect('productReviews/'. session('id'));
       }
    }
}
