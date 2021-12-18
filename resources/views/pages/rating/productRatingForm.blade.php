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
            <form action="{{route('updateProductReview')}}" method="post">
                {{csrf_field()}}
                <input  type="text" hidden name="id" value="{{ $review->id }}">
                <input class="form-control my-2" type="text"  name="review" value="{{ $review->review }}">
                @error('review')
                <span>{{$message}}</span>
                @enderror
                <span class="fw-bold text-danger">hello world</span>
                <select class="form-control my-2" name="rating">
                    <option value="0">Rating</option>
                    <option value="1">1 star</option>
                    <option value="2">2 star</option>
                    <option value="3">3 star</option>
                    <option value="4">4 star</option>
                    <option value="5">5 star</option>
                </select>
                @error('rating')
                <span>{{$message}}</span>
                @enderror
                <input type="text" hidden name="productId" value="{{ $review->productId }}">
                <input type="text" hidden name="productName" value="{{ $review->productName }}">
                <input type="text" hidden name="customerName" value={{ session('name') }}>
                <input type="text" hidden name="customerId" value={{ session('id') }}>
                <input type="submit" class="btn btn-success btn-sm" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>