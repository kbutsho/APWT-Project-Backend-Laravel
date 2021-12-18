<?php

use Illuminate\Http\Request;
use App\Http\Middleware\validToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ServiceProviderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'loggedOut']);
Route::post('/registration',[RegistrationController::class,'Registration']);
Route::get('/products',[ProductController::class,'ProductsApi']);


// admin  area start
Route::post('/adminPhoto',[AdminController::class,'AdminImageAPI']);
Route::get('/adminInfo/{id}',[AdminController::class,'GetAdminInfoAPI']);
Route::post('/updateAdminProfile',[AdminController::class,'updateAdminProfileAPI']);
Route::get('/adminDashboard',[AdminController::class,'adminDashboard'])->middleware([validToken::class]);

// seller operation for admin
Route::post('/addSeller',[AdminController::class,'AddSellerAPi']);
Route::get('/sellerList',[AdminController::class,'sellerList']);
Route::get('/getSeller/{id}',[AdminController::class,'GetSeller']);
Route::delete('/deleteSeller/{id}',[AdminController::class,'deleteSeller']);
Route::post('/updateSeller',[AdminController::class,'UpdateSellerAPi']);
Route::get('/orderListForAdmin',[AdminController::class,'orderListForAdmin']);



// customer operation fro admin
Route::post('/addCustomer',[AdminController::class,'AddCustomerAPi']);
Route::get('/customerList',[AdminController::class,'customerList']);
Route::get('/getCustomer/{id}',[AdminController::class,'GetCustomer']);
Route::delete('/deleteCustomer/{id}',[AdminController::class,'deleteCustomer']);
Route::post('/updateCustomer',[AdminController::class,'UpdateCustomerAPi']);
// service provider operation for service provider
Route::post('/addServiceProvider',[AdminController::class,'AddServiceProviderAPi']);
Route::get('/serviceProviderList',[AdminController::class,'serviceProviderList']);
Route::get('/getServiceProvider/{id}',[AdminController::class,'GetServiceProvider']);
Route::delete('/deleteServiceProvider/{id}',[AdminController::class,'deleteServiceProvider']);
Route::post('/updateServiceProvider',[AdminController::class,'UpdateServiceProviderAPi']);


// admin area end


//  seller area start
Route::get('/sellerDashboard',[SellerController::class,'sellerDashboard'])->middleware([validToken::class]);
Route::post('/updateSellerProfile',[SellerController::class,'updateSellerProfileAPI']);
Route::post('/sellerPhoto',[SellerController::class,'SellerImageAPI']);
Route::get('/sellerInfo/{id}',[SellerController::class,'GetSellerInfoAPI']);
Route::get('/sellerProducts/{id}',[SellerController::class,'SellerProductsAPI']);
Route::post('/addProduct',[SellerController::class,'AddProductAPI']);
Route::delete('/deleteProduct/{id}',[SellerController::class,'deleteProductAPI']);
Route::get('/getSingleProduct/{id}',[SellerController::class,'GetSingleProduct']);
Route::post('/updateProductAPI',[SellerController::class,'UpdateProductAPI']);
Route::get('/sellerOrders/{id}',[SellerController::class,'SellerOrdersAPI']);
Route::delete('/deleteSellerOrder/{id}',[SellerController::class,'deleteSellerOrderAPI']);
Route::post('/updateSellerOrderAPI',[SellerController::class,'updateSellerOrderAPI']);
Route::get('/productRatingsAPI/{id}',[SellerController::class,'productRatingsAPI']);

// seller area end


// customer area start
Route::get('/customerDashboard',[CustomerController::class,'customerDashboard'])->middleware([validToken::class]);
Route::post('/updateCustomerProfile',[CustomerController::class,'updateCustomerProfileAPI']);
Route::get('/productDetails/{id}',[CustomerController::class,'GetSingleProductAPI']);
Route::post('/addOrder',[CustomerController::class,'AddOrderAPI']);
Route::post('/customerPhoto',[CustomerController::class,'CustomerImageAPI']);
Route::get('/customerInfo/{id}',[CustomerController::class,'GetCustomerInfoAPI']);
Route::get('/customerOrders/{id}',[CustomerController::class,'CustomerOrdersAPI']);
Route::delete('/deleteOrder/{id}',[CustomerController::class,'deleteOrderAPI']);
Route::get('/getSingleOrder/{id}',[CustomerController::class,'GetSingleOrder']);
Route::post('/updateOrderAPI',[CustomerController::class,'UpdateOrderAPI']);
Route::get('/getCustomerDeliveries',[CustomerController::class,'getDeliveries']);
Route::post('/addServiceRating',[CustomerController::class,'AddServiceRatingAPI']);
Route::get('/getSingleDelivery/{id}',[CustomerController::class,'GetSingleDelivery']);
Route::get('/customerServiceReview/{id}',[CustomerController::class,'CustomerServiceReview']);
Route::delete('/deleteServiceReview/{id}',[CustomerController::class,'DeleteServiceReview']);
Route::post('/updateServiceReviewAPI',[CustomerController::class,'UpdateServiceReviewAPI']);
Route::get('/getSingleServiceReview/{id}',[CustomerController::class,'GetSingleServiceReview']);
Route::post('/addProductRating',[CustomerController::class,'AddProductRatingAPI']);
Route::get('/customerProductReview/{id}',[CustomerController::class,'customerProductReview']);
Route::delete('/deleteProductReview/{id}',[CustomerController::class,'DeleteProductReview']);
Route::post('/updateProductReviewAPI',[CustomerController::class,'UpdateProductReviewAPI']);
Route::get('/getSingleProductReview/{id}',[CustomerController::class,'GetSingleProductReview']);

// customer area end



//  service provider area start
Route::get('/serviceDashboard',[ServiceProviderController::class,'serviceDashboard'])->middleware([validToken::class]);
Route::post('/updateServiceProviderProfile',[ServiceProviderController::class,'updateServiceProviderProfileAPI']);
Route::post('/serviceProviderPhoto',[ServiceProviderController::class,'ServiceProviderImageAPI']);
Route::get('/serviceProviderInfo/{id}',[ServiceProviderController::class,'GetServiceProviderInfoAPI']);
Route::get('/serviceProviderOrders',[ServiceProviderController::class,'serviceProviderOrders']);
Route::get('/getSingleOrderDetails/{id}',[ServiceProviderController::class,'GetSingleOrderDetails']);
Route::post('/addToDelivery',[ServiceProviderController::class,'addToDeliveryAPI']);
Route::delete('/deleteDelivery/{id}',[ServiceProviderController::class,'deleteDeliveryAPI']);
Route::get('/serviceProviderDeliveries/{id}',[ServiceProviderController::class,'serviceProviderDeliveries']);
Route::get('/getSingleDelivery/{id}',[ServiceProviderController::class,'GetSingleDelivery']);
Route::post('/updateDeliveryAPI',[ServiceProviderController::class,'UpdateDeliveryAPI']);
Route::get('/getServiceNotes/{id}',[ServiceProviderController::class,'getServiceNotesAPI']);
Route::post('/addNote',[ServiceProviderController::class,'MakeNoteAPI']);
Route::delete('/deleteNote/{id}',[ServiceProviderController::class,'deleteNoteAPI']);
Route::get('/getSingleNote/{id}',[ServiceProviderController::class,'GetSingleNote']);
Route::post('/updateNoteAPI',[ServiceProviderController::class,'UpdateNoteAPI']);
Route::get('/s_ProviderServiceReview/{id}',[ServiceProviderController::class,'s_ProviderServiceReview']);

// service provider area end