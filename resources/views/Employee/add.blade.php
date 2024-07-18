<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/add.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
       
         <h2> Add Employee</h2>
    

  <form action="{{url('/addEmployee')}}" method="post" enctype="multipart/form-data"> 
   @csrf
   <div class="form-group">
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" placeholder="enter name here" required>
    </div>
    <div class="form-group">
      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" placeholder="enter last here" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="enter email here" required>
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" placeholder="enter address here" required>
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="tel" id="phone" name="phone" placeholder="enter phone number here" required>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" id="image" name="image">
      <!-- <img src="" alt="Preview image" id="preview-image"> -->
    </div>
    <button>Submit</button>

    <br> <br>

    <a href="/show"> back</a>
  </form>


</body>
</html>