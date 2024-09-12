<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forogt password</title>
</head>
<body>
    <form action="{{ route('reset_password.post')}}" method="post">
         {{ csrf_field() }}
         <input type="text" name="token" value="{{$token}}">
         <label class="form-label">Email address</label>
         <input type="email" name="email" id="email" class="form-control">

         <label class="form-label">Enter new password</label>
         <input type="password" name="password" id="password" class="form-control">

         <label class="form-label">Confirm password</label>
         <input type="password" name="password" id="password_confirm" class="form-control">
         <button type="submit">Submit</button>
         
    </form>
</body>
</html>