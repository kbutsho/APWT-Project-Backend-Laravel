



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Review</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; background:black">
        <div>
            <form action="{{route('productRating')}}" method="post">
                {{csrf_field()}}
                <input type="text" class="form-control" name="review" placeholder="Review"> <br>
                @error('review')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <select name="rating" class="form-control"> <br>
                    <option value="1">Rating</option>
                    <option value="1">1 star</option>
                    <option value="2">2 star</option>
                    <option value="3">3 star</option>
                    <option value="4">4 star</option>
                    <option value="5">5 star</option>
                </select> <br>
                @error('rating')
                <span  class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="productId" hidden value="{{ $review->id }}">
                <input type="text" name="productName" hidden value="{{ $review->name }}">
                <input type="text" hidden name="customerName" value={{ session('name') }}>
                <input type="text" hidden name="customerId" value={{ session('id') }}>
                <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                <a class="btn btn-danger btn-sm px-3 mx-2"  href={{ "/customerOrders/" .session('id') }}> Back</a>
            </form>
        </div>
    </div>
</body>
</html>