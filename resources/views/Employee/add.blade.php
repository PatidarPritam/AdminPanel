<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/add.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Employee</title>
</head>
<body>
    <h2>Add Employee</h2>
    <form id="add-employee-form" enctype="multipart/form-data">
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
        </div>
        <button type="submit">Submit</button>
        <br><br>
        <a href="{{ url('/show') }}">Back</a>
    </form>

    <script>
        $(document).ready(function() {
            // Setup CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            $('#add-employee-form').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: '{{ route("addEmployee") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Employee added successfully!');
                        window.location.href = '{{ route("show") }}'; // Redirect to the employee list
                    },
                    error: function(response) {
                        alert('Failed to add employee.');
                    }
                });
            });
        });
    </script>
</body>
</html> -->
