@if(session('role') == 'admin')
@include('pages.admin.adminDashboard')
@elseif(session('role') == 'seller')
@include('pages.seller.sellerDashboard')
@elseif(session('role') == 'customer')
@include('pages.customer.customerDashboard')
@elseif(session('role') == 'service')
@include('pages.serviceProvider.serviceProviderDashboard')
@else
@include('pages.login.login');
@endif