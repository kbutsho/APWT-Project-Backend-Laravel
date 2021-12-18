<?php

use App\Models\Admin;
use Illuminate\View\View;
use App\Http\Middleware\ValidAdmin;
use App\Http\Middleware\ValidSeller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidCustomer;
use App\Http\Middleware\ValidSProvider;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\ValidAdminOrSeller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Middleware\ValidAdminOrCustomer;
use App\Http\Middleware\ValidSProviderOrAdmin;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\ServiceRatingController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Middleware\ValidSellerOrCustomer;
use App\Http\Middleware\ValidSProviderOrCustomer;
use App\Http\Middleware\ValidSProviderOrSeller;

Route::get('/',[ProductController::class,'showProducts'])->name('/');
Route::get('/error', function () {
    return view('pages.error.error');
})->name('error');
Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard');
})->name('dashboard');
Route::get('/checkout', function () {
    return view('pages.checkout.checkout');
})->name('checkout');
// category (Product COntroller)
Route::get('/phone',[ProductController::class,'phone'])->name('phone');
Route::get('/laptop',[ProductController::class,'laptop'])->name('laptop');
Route::get('/television',[ProductController::class,'television'])->name('television');
Route::get('/camera',[ProductController::class,'camera'])->name('camera');
// product controller
Route::get('/products',[ProductController::class,'showAllProducts'])->name('products');
Route::get('/products/{id}',[ProductController::class,'showProductDetails'])->name('products/{id}');
// login controller
Route::get('/login',[LoginController::class,'showLogin'])->name('login');
Route::post('/dashboard',[LoginController::class,'loginValidation'])->name('dashboard'); 
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
// Registration controller
Route::get('/registration',[RegistrationController::class,'showRegistration'])->name('registration');
Route::post('/login',[RegistrationController::class,'RegistrationValidation'])->name('login'); 

//  admin controller
// edit admin Profile 
Route::get('/adminDashboard',[AdminController::class,'showAdminProfile'])->name('adminDashboard')->middleware([ValidAdmin::class]);
Route::get('/editAdminProfile/{id}',[AdminController::class,'EditAdminProfile'])->name('editAdminProfile/{id}')->middleware([ValidAdmin::class]);
Route::post('/updateAdminProfile',[AdminController::class,'updateAdminProfile'])->name('updateAdminProfile');
//add and show admin profile picture
Route::post('/adminDashboard',[AdminController::class,'addAdminPhoto'])->name('adminDashboard');
Route::get('/changeAdminImage/{id}',[AdminController::class,'changeAdminImage'])->name('changeAdminImage/{id}')->middleware([ValidAdmin::class]);
Route::post('/updateAdminImage',[AdminController::class,'updateAdminImage'])->name('updateAdminImage');
// delete admin account by admin own
Route::get('deleteAdminAccount/{id}',[AdminController::class,'deleteAdminAccount'])->name('deleteAdminAccount/{id}')->middleware([ValidAdmin::class]);




// customer controller 
Route::get('/customerList',[CustomerController::class,'customerList'])->name('customerList')->middleware([ValidAdmin::class]);
Route::get('/updateCustomerStatus/{id}',[CustomerController::class,'approvedCustomerEdit'])->name('updateCustomerStatus/{id}')->middleware([ValidAdmin::class]);
Route::post('/approveCustomer',[CustomerController::class,'approvedCustomer'])->name('approveCustomer');
// add customer
Route::post('/addCustomer',[CustomerController::class,'listingCustomer'])->name('addCustomer')->middleware([ValidAdmin::class]);
Route::get('/addCustomer',[CustomerController::class,'allCustomer'])->name('addCustomer')->middleware([ValidAdmin::class]);
// delete customer 
Route::get('deleteCustomer/{id}',[CustomerController::class,'deleteCustomer'])->name('deleteCustomer/{id}')->middleware([ValidAdmin::class]);
// update customer all info by admin
Route::get('/editCustomer/{id}',[CustomerController::class,'EditCustomer'])->name('editCustomer/{id}')->middleware([ValidAdmin::class]);
Route::post('/updateCustomer',[CustomerController::class,'updateCustomer'])->name('updateCustomer');




// Seller controller 
// show sellers 
Route::get('/sellerList',[SellerController::class,'sellerList'])->name('sellerList')->middleware([ValidAdmin::class]);
//Update sellers status
Route::get('/updateSellerStatus/{id}',[SellerController::class,'approvedSellerEdit'])->name('updateSellerStatus/{id}')->middleware([ValidAdmin::class]);
Route::post('/approveSeller',[SellerController::class,'approvedSeller'])->name('approveSeller');
// Seller delete
Route::get('deleteSeller/{id}',[SellerController::class,'deleteSeller'])->name('deleteSeller/{id}')->middleware([ValidAdmin::class]);
// add seller
Route::post('/addSeller',[SellerController::class,'listingSeller'])->name('addSeller')->middleware([ValidAdmin::class]);
Route::get('/addSeller',[SellerController::class,'allSeller'])->name('addSeller')->middleware([ValidAdmin::class]);
// update seller all info by admin
Route::get('/editSeller/{id}',[SellerController::class,'EditSeller'])->name('editSeller/{id}')->middleware([ValidAdmin::class]);
Route::post('/updateSeller',[SellerController::class,'updateSeller'])->name('updateSeller');
//product for per seller
Route::get('/sellerProduct/{id}',[SellerController::class,'sellerProduct'])->name('sellerProduct/{id}')->middleware([ValidAdmin::class]);
// every seller their own order
Route::get('/sellerOrder/{id}',[SellerController::class,'sellerOrder'])->name('/sellerOrder/{id}');
// delete seller account by own
Route::get('deleteSellerAccount/{id}',[SellerController::class,'deleteSellerAccount'])->name('deleteSellerAccount/{id}');




// service provider controller
Route::get('/serviceProviderList',[ServiceProviderController::class,'serviceProviderList'])->name('serviceProviderList')->middleware([ValidAdmin::class]);
Route::get('/updateServiceProviderStatus/{id}',[ServiceProviderController::class,'approvedServiceProviderEdit'])->name('updateServiceProviderStatus/{id}')->middleware([ValidAdmin::class]);
Route::post('/approveServiceProvider',[ServiceProviderController::class,'approvedServiceProvider'])->name('approveServiceProvider');
// add Service Provider
Route::post('/addServiceProvider',[ServiceProviderController::class,'listingServiceProvider'])->name('addServiceProvider')->middleware([ValidAdmin::class]);
Route::get('/addServiceProvider',[ServiceProviderController::class,'allServiceProvider'])->name('addServiceProvider')->middleware([ValidAdmin::class]);
//delete service provider
Route::get('deleteServiceProvider/{id}',[ServiceProviderController::class,'deleteServiceProvider'])->name('deleteServiceProvider/{id}')->middleware([ValidAdmin::class]);
// update service Providers  all info by admin
Route::get('/editServiceProvider/{id}',[ServiceProviderController::class,'EditServiceProvider'])->name('editServiceProvider/{id}')->middleware([ValidAdmin::class]);
Route::post('/updateServiceProvider',[ServiceProviderController::class,'updateServiceProvider'])->name('updateServiceProvider');

// show all order for admin
Route::get('/orderList',[OrderController::class,'allOrderList'])->name('orderList')->middleware([ValidSProviderOrAdmin::class]);

































// for seller
Route::post('/addProduct',[ProductController::class,'listingProduct'])->name('addProduct')->middleware([ValidSeller::class]);
Route::get('/addProduct',[ProductController::class,'allProduct'])->name('addProduct')->middleware([ValidSeller::class]);
// seller controller for seller 
// seller controller for seller own
Route::get('/sellerDashboard',[SellerController::class,'showSellerProfile'])->name('sellerDashboard')->middleware([ValidSeller::class]);
Route::get('/editSellerProfile/{id}',[SellerController::class,'EditSellerProfile'])->name('editSellerProfile/{id}')->middleware([ValidSeller::class]);
Route::post('/updateSellerProfile',[SellerController::class,'updateSellerProfile'])->name('updateSellerProfile');
//add and show seller profile picture
Route::post('/sellerDashboard',[SellerController::class,'addSellerPhoto'])->name('sellerDashboard');
Route::get('/changeSellerImage/{id}',[SellerController::class,'changeSellerImage'])->name('changeSellerImage/{id}')->middleware([ValidSeller::class]);
Route::post('/updateSellerImage',[SellerController::class,'updateSellerImage'])->name('updateSellerImage');
//single product many rating
Route::get('/productRatings/{id}',[ProductController::class,'productRatings'])->name('productRatings/{id}')->middleware([ValidSeller::class]);
// delete order by {seller}
Route::get('sellerOrderDelete/{id}',[OrderController::class,'sellerOrderDelete'])->name('sellerOrderDelete/{id}')->middleware([ValidSeller::class]);













// for customer
// customer controller
// customer profile for customer 
// edit customer Profile  by customer own
Route::get('/customerDashboard',[CustomerController::class,'showCustomerProfile'])->name('customerDashboard')->middleware([ValidCustomer::class]);
Route::get('/editCustomerProfile/{id}',[CustomerController::class,'EditCustomerProfile'])->name('editCustomerProfile/{id}')->middleware([ValidCustomer::class]);
Route::post('/updateCustomerProfile',[CustomerController::class,'updateCustomerProfile'])->name('updateCustomerProfile');
// delete customer account by customer own
Route::get('deleteCustomerAccount/{id}',[CustomerController::class,'deleteCustomerAccount'])->name('deleteCustomerAccount/{id}')->middleware([ValidCustomer::class]);
//add and show customer profile picture
Route::post('/customerDashboard',[CustomerController::class,'addCustomerPhoto'])->name('customerDashboard');
Route::get('/changeCustomerImage/{id}',[CustomerController::class,'changeCustomerImage'])->name('changeCustomerImage/{id}')->middleware([ValidCustomer::class]);
Route::post('/updateCustomerImage',[CustomerController::class,'updateCustomerImage'])->name('updateCustomerImage');
Route::get('/productReviews/{id}',[CustomerController::class,'customerP_rating'])->name('productReviews/{id}')->middleware([ValidCustomer::class]);
Route::get('/serviceReviews/{id}',[CustomerController::class,'customerS_rating'])->name('serviceReviews/{id}')->middleware([ValidCustomer::class]);
// order CRUD by (customer)
Route::get('/order/{id}',[OrderController::class,'confirmProductShow'])->name('order/{id}')->middleware([ValidCustomer::class]);
Route::post('/order',[OrderController::class,'buyNow'])->name('order');
Route::get('deleteOrder/{id}',[OrderController::class,'deleteOrder'])->name('deleteOrder/{id}')->middleware([ValidCustomer::class]);
Route::get('updateOrder/{id}',[OrderController::class,'EditOrder'])->name('updateOrder/{id}')->middleware([ValidCustomer::class]);
Route::post('/updateOrder',[OrderController::class,'updateOrder'])->name('updateOrder');


// for service provider
// serviceProvider controller
// edit service provider Profile  by own
// service Provider profile
Route::get('/serviceProviderDashboard',[ServiceProviderController::class,'showServiceProviderProfile'])->name('serviceProviderDashboard')->middleware([ValidSProvider::class]);
Route::get('/editServiceProviderProfile/{id}',[ServiceProviderController::class,'EditServiceProviderProfile'])->name('editServiceProviderProfile/{id}')->middleware([ValidSProvider::class]);
Route::post('/updateServiceProviderProfile',[ServiceProviderController::class,'updateServiceProviderProfile'])->name('updateServiceProviderProfile');
//add and show customer profile picture
Route::post('/serviceProviderDashboard',[ServiceProviderController::class,'addServiceProviderPhoto'])->name('serviceProviderDashboard');
Route::get('/changeServiceProviderImage/{id}',[ServiceProviderController::class,'changeServiceProviderImage'])->name('changeServiceProviderImage/{id}')->middleware([ValidSProvider::class]);
Route::post('/updateServiceProviderImage',[ServiceProviderController::class,'updateServiceProviderImage'])->name('updateServiceProviderImage');
Route::get('/serviceProviderReviews/{id}',[ServiceProviderController::class,'providerS_rating'])->name('serviceProviderReviews/{id}')->middleware([ValidSProvider::class]);
// delete service provider account by own
Route::get('deleteServiceProviderAccount/{id}',[ServiceProviderController::class,'deleteServiceProviderAccount'])->name('deleteServiceProviderAccount/{id}')->middleware([ValidSProvider::class]);

// show service list for own service Provider
Route::get('serviceNoteList/{id}',[ServiceProviderController::class,'serviceNotes'])->name('serviceNoteList/{id}')->middleware([ValidSProvider::class]);
// service controller
Route::get('/addNote',[ServiceController::class,'showAddNoteForm'])->name('addNote')->middleware([ValidSProvider::class]);
Route::post('/addedNote',[ServiceController::class,'addNote'])->name('addedNote');
Route::get('/deleteNote/{id}',[ServiceController::class,'deleteNote'])->name('deleteNote/{id}')->middleware([ValidSProvider::class]);
Route::get('/updateNote/{id}',[ServiceController::class,'sendData'])->name('updateNote/{id}')->middleware([ValidSProvider::class]);
Route::post('/updateNote',[ServiceController::class,'updateNote'])->name('updateNote');


// common 
Route::get('/productList',[ProductController::class,'productList'])->name('productList')->middleware([ValidAdminOrSeller::class]);
// valid admin or seller 
Route::get('deleteProduct/{id}',[ProductController::class,'deleteProduct'])->name('deleteProduct/{id}')->middleware([ValidAdminOrSeller::class]);
Route::get('/editProduct/{id}',[ProductController::class,'EditProduct'])->name('editProduct/{id}')->middleware([ValidAdminOrSeller::class]);
Route::post('/updateProduct',[ProductController::class,'updateProduct'])->name('updateProduct');
// single product many orders
Route::get('/productOrders/{id}',[ProductController::class,'productOrders'])->name('productOrders/{id}')->middleware([ValidAdminOrSeller::class]);

// valid admin or customer 
// single customer many orders
Route::get('/customerOrders/{id}',[CustomerController::class,'customerOrders'])->name('customerOrders/{id}')->middleware([ValidAdminOrCustomer::class]);

// valid service provider or Admin
// show every single service provider deliveries
Route::get('deliveryList/{id}',[ServiceProviderController::class,'showDeliveries'])->name('deliveryList/{id}')->middleware([ValidSProviderOrAdmin::class]);

// update order status by (seller and service provider )
Route::get('/updateOrderStatus/{id}',[OrderController::class,'sellerOrderEdit'])->name('updateOrderStatus/{id}')->middleware([ValidSProviderOrSeller::class]);
Route::post('/updateOrderStatus',[OrderController::class,'updateOrderStatus'])->name('updateOrderStatus');
// product rating controller
Route::get('/productRating/{id}',[ProductRatingController::class,'showProductRatingForm'])->name('productRating/{id}')->middleware([ValidCustomer::class]);
Route::post('/productRating',[ProductRatingController::class,'confirmProductRating'])->name('productRating');
Route::get('/p_reviewList',[ProductRatingController::class,'p_ratingList'])->name('p_reviewList');
Route::get('deleteProductReview/{id}',[ProductRatingController::class,'deleteProductReview'])->name('deleteProductReview/{id}')->middleware([ValidSellerOrCustomer::class]);
Route::get('updateProductReview/{id}',[ProductRatingController::class,'editProductReview'])->name('updateProductReview/{id}')->middleware([ValidSellerOrCustomer::class]);
Route::post('updateProductReview',[ProductRatingController::class,'updateProductReview'])->name('updateProductReview');


// delivery controller
Route::get('addToDelivery/{id}',[DeliveryController::class,'addToDelivery'])->name('addToDelivery/{id}')->middleware([ValidSProvider::class]);
Route::post('addToDelivery',[DeliveryController::class,'AddDelivery'])->name('addToDelivery');
Route::get('deliveryDelete/{id}',[DeliveryController::class,'deliveryDelete'])->name('deliveryDelete/{id}')->middleware([ValidSProvider::class]);
Route::get('deliveryUpdate/{id}',[DeliveryController::class,'EditDelivery'])->name('deliveryUpdate/{id}')->middleware([ValidSProvider::class]);
Route::post('deliveryUpdate',[DeliveryController::class,'updateDelivery'])->name('deliveryUpdate');
Route::get('customerDeliveries',[DeliveryController::class,'customerDeliveries'])->name('customerDeliveries')->middleware([ValidCustomer::class]);
// serviceRating controller
Route::get('/serviceRating/{id}',[ServiceRatingController::class,'showServiceRatingForm'])->name('serviceRating/{id}')->middleware([ValidSProviderOrCustomer::class]);
Route::post('/serviceRating',[ServiceRatingController::class,'confirmServiceRating'])->name('serviceRating');
Route::get('deleteServiceReview/{id}',[ServiceRatingController::class,'deleteServiceReview'])->name('deleteServiceReview/{id}')->middleware([ValidSProviderOrCustomer::class]);
Route::get('updateServiceReview/{id}',[ServiceRatingController::class,'editServiceReview'])->name('updateServiceReview/{id}')->middleware([ValidSProviderOrCustomer::class]);
Route::post('updateServiceReview',[ServiceRatingController::class,'updateServiceReview'])->name('updateServiceReview');


