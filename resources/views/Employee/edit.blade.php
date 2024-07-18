<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/add.css') }}" rel="stylesheet">
    <title>Edit Employee</title>
</head>
<body>
       
    <h2>Edit Employee</h2>
    
    <form action="{{ url('update/' . $employee->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="enter name here" value="{{ old('firstName', $employee->firstName) }}" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="enter last here" value="{{ old('lastName', $employee->lastName) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="enter email here" value="{{ old('email', $employee->email) }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="enter address here" value="{{ old('address', $employee->address) }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" placeholder="enter phone number here" value="{{ old('phone', $employee->phone) }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            @if($employee->img)
                <div>
                    <img src="{{ asset('storage/' . $employee->img) }}" alt="Current image" id="preview-image" style="width:100px;height:auto;">
                </div>
            @endif
            <input type="file" id="image" name="image">
        </div>
        <button>Submit</button>

        <br><br>

        <a href="/show">Back</a>
    </form>

</body>
</html>
