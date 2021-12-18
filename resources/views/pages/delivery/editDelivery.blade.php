<form  action="{{route('deliveryUpdate')}}" method="post" style="margin:100px">
    {{csrf_field()}}

    <input type="text" hidden name="id" value={{ $delivery->id }}>
    <input type="text" hidden name="customerName" value={{ $delivery->customerName }}>
    <input type="text" hidden name="productName" value={{ $delivery->productName }}>
    <input type="text" hidden name="productId" value={{ $delivery->productId }}>
    <input type="text" hidden name="customerId" value={{ $delivery->customerId }}>
    <input type="text" hidden name="serviceProviderId" value={{ $delivery->serviceProviderId }}>


    <label for="">Your Name</label>
    <input type="text" name="s_ProviderName" value={{ $delivery->s_ProviderName }}> <br> <br>
    <label for="">Customer Name</label>
    <input type="text" name="customerName" value={{ $delivery->customerName }}> <br> <br>
    <label for="">Address</label>
    <input type="text" name="Address" value={{ $delivery->Address }}> <br> <br>
    <label for="">Order Status</label>
    <input type="text"  name="status" value={{ $delivery->status }}> <br> <br>
    <label for="">Comment</label>
    <input type="text" name="comment" value={{ $delivery->comment }}> <br> <br>
    <input type="submit" value="submit">
</form>