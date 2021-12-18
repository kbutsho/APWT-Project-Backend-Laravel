<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; margin: 0px auto">
        <div class="container">
            <form class="" action="{{route('updateOrder')}}" method="post">
                {{csrf_field()}}
                @error('customerName')
                {{ $message }}
                @endif
                <br>
                @error('Address')
                {{ $message }}
                @endif
                <br>
                @error('phone')
                {{ $message }}
                @endif
                <br>
                <input type="text" hidden name="id" placeholder="product Name" value={{ $order->id }}>
                <input type="text" hidden name="productName" placeholder="product Name" value={{ $order->productName }}>
                <label for="">Name</label>
                <input type="text" name="customerName" placeholder="Customer Name" value={{ session('name') }}>
                <label for="">Address</label>
                <input type="text" name="Address" placeholder="Address" value={{ session('address') }}>
                <label for="">Phone</label>
                <input type="text" name="phone" placeholder="Phone" value={{ session('phone') }}>
                <input type="text" hidden name="price" placeholder="price" value={{ $order->price }}>
                <input type="text" hidden name="status" placeholder="status" value={{ $order->status }}>
                <input type="text" hidden name="method" placeholder="method" value={{ $order->method }}>
                <input type="text" hidden name="productId" placeholder="product Id" value={{ $order->productId }}>
                <input type="text" hidden name="sellerId" placeholder="product Id" value={{ $order->sellerId }}>
                <input type="text" hidden name="customerId" placeholder="customer Id" value={{ session('id') }}>
                <input type="submit">
                <a class="btn btn-danger btn-sm mx-3" href={{ "/customerOrders/" .session('id') }}>Back</a>
            </form>
        </div>
    </div>
</body>

</html>