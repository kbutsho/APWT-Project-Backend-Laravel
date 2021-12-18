<div class="px-2 py-5">
    <div class="text-center">
        <a style="text-align: left" class="btn btn-warning my-2 w-75 fw-bold" href="{{ route ('adminDashboard') }}"><i
                class="fas fa-user-circle px-2 me-2"></i>{{ session('name')
            }}</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route ('adminDashboard') }}"><i
                class="fas fa-bars me-2 px-2"></i>My Profile</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route ('sellerList') }}"><i
                class="fas fa-bars me-2 px-2"></i>Seller List</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route('orderList') }}"><i
                class="fas fa-bars me-2 px-2"></i>Order
            List</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route ('productList') }}"><i
                class="fas fa-bars me-2 px-2"></i>Product List</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route ('customerList') }}"><i
                class="fas fa-bars me-2 px-2"></i>Customer List</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route ('serviceProviderList') }}"><i
                class="fas fa-bars me-2 px-2"></i>Service Provider List</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-danger fw-bold my-2 w-75" href="{{ route ('logout') }}"><i
                class="fas fa-sign-out-alt me-2 px-2"></i>Logout</a>
    </div>
</div>
