<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <title>Register</title>
    <style>
      .error-message {
            color: red;
            display: none; /* Initially hidden */
      }
        .visible {
            display: block; /* Display error message */
        }
    </style>
</head>
<body>
    <h2>Register User</h2>
    <form id="registration-form" action="{{ url('/register') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Enter name here" required>
        <br><br>

        <!-- Display Email Error -->
        @error('email')
            <div class="error-message email-error visible">
                {{ $message }}
            </div>
        @enderror
        <input type="text" name="email" placeholder="Enter email here" required>
        <br><br>

        @error('phone')
            <div class="error-message phone-error visible">
                {{ $message }}
            </div>
        @enderror
        <input type="number" name="phone" placeholder="Enter phone number here" required>
        <br><br>

        <input type="text" name="address" placeholder="Enter address here" required>
        <br><br>

        @error('password')
            <div class="error-message password-error visible">
                {{ $message }}
            </div>
        @enderror
        <input type="password" id="password" name="password" placeholder="Enter password here" required>
        <br><br>
        
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter confirm password here" required>
        <br><br>

        <!-- Error message for password mismatch -->
        <div id="password-mismatch-error" class="error-message">
            Passwords do not match.
        </div>
        
        <!-- Error message for password length -->
        <div id="password-length-error" class="error-message">
            Password must be at least 6 characters long.
        </div>
        
        <button type="submit">Submit</button>
        <br><br>

        <p>Already have an account? <a href="{{ url('/login') }}">login here</a></p>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('registration-form');
            var password = document.getElementById('password');
            var passwordConfirmation = document.getElementById('password_confirmation');
            var passwordMismatchError = document.getElementById('password-mismatch-error');
            var passwordLengthError = document.getElementById('password-length-error');

            function showErrorMessage(element, message) {
                element.textContent = message;
                element.classList.add('visible');
                setTimeout(function() {
                    element.classList.remove('visible');
                }, 5000); 
            }

            function checkPasswords() {
                var passwordValue = password.value.trim();
                var passwordConfirmationValue = passwordConfirmation.value.trim();

                // Check password length
                if (passwordValue.length > 0 && passwordValue.length < 6) {
                    showErrorMessage(passwordLengthError, 'Password must be at least 6 characters long.');
                } else {
                    passwordLengthError.classList.remove('visible');
                }

                // Check password match
                if (passwordConfirmationValue.length > 0) {
                    if (passwordValue !== passwordConfirmationValue) {
                        showErrorMessage(passwordMismatchError, 'Passwords do not match.');
                    } else {
                        passwordMismatchError.classList.remove('visible');
                    }
                }
            }

            // Real-time validation on input change
            password.addEventListener('input', checkPasswords);
            passwordConfirmation.addEventListener('input', checkPasswords);

            // Check password mismatch and length on form submit
            form.addEventListener('submit', function(event) {
                var passwordValue = password.value.trim();
                var passwordConfirmationValue = passwordConfirmation.value.trim();

                // Show errors and prevent form submission if there are issues
                if (passwordValue !== passwordConfirmationValue || passwordValue.length < 6) {
                    event.preventDefault();
                    checkPasswords(); // Ensure error messages are shown before submission
                }
            });
        });
    </script>
</body>
</html>
