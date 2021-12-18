<form action="{{route('updateServiceReview')}}" method="post">
    {{csrf_field()}}
    <input type="text" hidden name="id" value="{{ $review->id }}">
    <input type="text"  name="review" value="{{ $review->review }}">
    @error('review')
    {{ $message }}
    @enderror
    <select name="rating">
        <option value="0">Rating</option>
        <option value="1">1 star</option>
        <option value="2">2 star</option>
        <option value="3">3 star</option>
        <option value="4">4 star</option>
        <option value="5">5 star</option>
    </select>
    @error('rating')
    {{ $message }}
    @enderror
    <input type="text" hidden name="serviceProviderId" value="{{ $review->serviceProviderId }}">
    <input type="text" hidden name="s_ProviderName" value={{ $review->s_ProviderName }}>
    <input type="text" hidden  name="customerName" value={{ session('name') }}>
    <input type="text"  hidden name="customerId" value={{ session('id') }}>
    <input type="submit" value="Submit">
</form>