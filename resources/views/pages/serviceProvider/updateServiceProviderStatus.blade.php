<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update Service Provider Status</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: black">
    <div style=" 
      border-radius: 10px;
      width: 400px;
      background-color:aqua;
      padding: 20px 10px;
    color: white;">
      <form action="{{route('approveServiceProvider')}}" method="post">
        {{csrf_field()}}
        <input type="text" name="id" hidden value={{ $status->id }}>
        <select name="status" style="
            padding: 3px 15px;
            border-radius: 20px;
            border: 2px solid transparent;
            background-color:gray);
            color: black;
            font-weight: 600;
            transition: 0.5s;
            width: 200px;    
            margin-left:25px;
        ">
          <option value="Pending">Pending</option>
          <option value="Approved">Approve</option>
        </select>
        <input type="submit" value="Approve" class="btn btn-sm btn-danger ml-5">
      </form>
    </div>
  </div>
</body>

</html>