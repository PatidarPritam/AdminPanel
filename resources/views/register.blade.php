<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <title>Register</title>
</head>
<body>
 <h2>Register User</h2>
<form action="{{url('/register')}}" method="post">
   @csrf
  <input type="text" name="name"  placeholder="enter name here"   required>
  <br> <br>
  <input type="text" name="email" placeholder="enter email here"  required>
  <br> <br>
  <input type="number" name="phone" placeholder="enter phone number here"    required>
  <br> <br>
  <input type="text" name="address" placeholder="enter address here"    required>
  <br> <br>
  <input type="password" name="password" placeholder="enter passowrd here" required>
  <br> <br> 
  
  <input type="password" name="password_confirmation" placeholder="Enter confirm password here" required>
  <br> <br> 
  
  <button type="submit">Submit</button>

  <br> <br>

  <p>Already have an account? <a href="{{ url('/login') }}">login here</a></p>
 </form>


</body>
</html>