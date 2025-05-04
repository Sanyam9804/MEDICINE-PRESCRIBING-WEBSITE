<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="description" content="Login to your account">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4; /* Fallback color if the image fails to load */
            background-image: url('login.jpg'); /* Corrected relative path */
            background-size: cover; /* Ensures the image covers the entire viewport */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.9); /* Add a semi-transparent white background for better readability */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        /* ... rest of your existing CSS for .login-container, .form-group, etc. ... */
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .validation-error {
            color: orange;
            font-size: 0.9em;
            margin-top: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
        <form action="main.html" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <div class="validation-error" id="usernameError"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div class="validation-error" id="passwordError"></div>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            let username = document.getElementById("username").value.trim();
            let password = document.getElementById("password").value.trim();
            let usernameError = document.getElementById("usernameError");
            let passwordError = document.getElementById("passwordError");
            let isValid = true;

            usernameError.textContent = "";
            passwordError.textContent = "";

            if (username === "") {
                usernameError.textContent = "Username is required";
                isValid = false;
            }

            if (password === "") {
                passwordError.textContent = "Password is required";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>