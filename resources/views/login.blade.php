<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
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
</body>
</html>
