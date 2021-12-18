<div class="py-5">
    <div class="text-center">
        <a style="text-align: left" class="btn btn-warning my-2 w-75 fw-bold" href="{{ route ('sellerDashboard') }}"><i
                class="fas fa-user-circle px-2 me-2"></i>{{ session('name') }}</a>
    </div>
    <div class="text-center">
        <a class="btn btn-primary my-2 w-75" style="text-align: left" href="{{ route ('sellerDashboard') }}"><i
                class="fas fa-bars px-2 me-2"></i>My Profile</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href={{ "/sellerOrder/" .session('id') }}><i
                class="fas fa-bars me-2 px-2"></i>My Orders</a>
    </div>

    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route ('products') }}"><i
                class="fas fa-bars me-2 px-2"></i>All Products</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-primary my-2 w-75" href="{{ route ('productList') }}"><i
                class="fas fa-bars me-2 px-2"></i>My Products</a>
    </div>
    <div class="text-center">
        <a style="text-align: left" class="btn btn-danger my-2 w-75" href="{{ route('logout') }}"><i
                class="fas fa-sign-out-alt me-2 px-2"></i>Logout</a>
    </div>
</div>