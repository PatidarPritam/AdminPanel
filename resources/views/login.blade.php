<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toast.css') }}" rel="stylesheet">
    <!-- <script src="{{ asset('js/toast.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="{{ url('/login') }}" method="post">
            @csrf
            
            <!-- Display Email Error -->
            @error('email')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <input type="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
            </div>
            
            <!-- Display Password Error -->
            @error('password')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
            <p>Don't have an account? <a href="{{ url('/register') }}">Register here</a></p>
        </form>
    </div>
    @if(Session::has('success'))
        <div class="toast" id="toast">
            {{ Session::get('success') }}
            <span class="close" id="toast-close">&times;</span>
        </div>
    @endif

    <script>

        $(document).ready(function() {
            // Show toast notification and auto-hide
            function showToast(message) {
                let toast = $('#toast');
                toast.text(message);
                toast.addClass('show');
                setTimeout(function() {
                    toast.removeClass('show');
                }, 5000); // 5 seconds
            }

            // Automatically show the toast if a success message exists
            @if(Session::has('success'))
                showToast('{{ Session::get('success') }}');
            @endif

            // Close toast notification manually
            $('#toast-close').on('click', function() {
                $('#toast').removeClass('show');
            });
        });
    </script>
     
</body>
</html>
