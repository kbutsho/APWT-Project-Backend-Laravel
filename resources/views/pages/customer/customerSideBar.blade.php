<div class="py-5">
    <div class="text-center">
        <a style="text-align: left" class="btn btn-warning my-2 w-75 fw-bold"
            href="{{ route ('customerDashboard') }}"><i class="fas fa-user-circle px-2 me-2"></i>{{ session('name')
            }}</a>
    </div>
    <div class="text-center">
        <a class="btn btn-primary my-2 w-75" style="text-align: left"
            href="{{ route ('customerDashboard') }}"><i class="fas fa-bars px-2 me-2"></i>My Profile</a>
    </div>
    <div class="text-center">
        <a class="btn btn-primary my-2 w-75" style="text-align: left" href={{ "/customerOrders/" .session('id') }}><i
                class="fas fa-bars px-2 me-2"></i>My order</a>
    </div>
    <div class="text-center">
        <a class="btn btn-primary my-2 w-75" href={{ '/productReviews/' .session('id') }} style="text-align: left"><i
                class="fas fa-bars me-2 px-2"></i>P_Review</a>
    </div>
    <div class="text-center">
        <a class="btn btn-primary my-2 w-75"href={{ '/customerDeliveries'}} style="text-align: left"><i class="fas fa-bars  px-2 me-2"></i>P_Delivery</a>
    </div>
    <div class="text-center">
        <a class="btn btn-primary my-2 w-75" style="text-align: left" href={{ '/serviceReviews/' .session('id') }}><i class="fas fa-bars  px-2 me-2"></i>S_Review</a>
    </div>
    
    <div class="text-center">
        <a class="btn btn-primary my-2 w-75" style="text-align: left" href="{{ route ('products') }}"><i
                class="fas fa-bars me-2 px-2 "></i>All Product</a>
    </div>
    <div class="text-center">
        <a class="btn btn-danger fw-bold my-2 w-75" style="text-align: left" href="{{ route ('logout') }}"><i
                class="fas fa-sign-out-alt me-2 px-2"></i>Logout</a>
    </div>
</div>