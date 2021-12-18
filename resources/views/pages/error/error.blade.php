<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; background: black;">
        <div>
            <div class="text-danger font-weight-bold mb-4">
                You are not allow in this page!
              </div>
             <div class="text-center">
                <a class="btn btn-primary px-4 btn-sm" href="{{ route('/') }}">Back</a>
             </div>
        </div>
    </div>
</body>



</html>