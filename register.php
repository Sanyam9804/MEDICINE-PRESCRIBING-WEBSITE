	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <meta name="description" content="Register for a new account">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
	    background-image: url('login.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            text-align: left;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #1e7e34;
        }
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
        .login-link {
            margin-top: 20px;
            font-size: 0.9em;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
        <form action="process_registration.php" method="post" onsubmit="return validateRegistrationForm()">
            <div class="form-group">
                <label for="new_username">Username:</label>
                <input type="text" id="new_username" name="new_username" required>
                <div class="validation-error" id="newUsernameError"></div>
            </div>
            <div class="form-group">
                <label for="new_password">Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <div class="validation-error" id="newPasswordError"></div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <div class="validation-error" id="confirmPasswordError"></div>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
        <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
        function validateRegistrationForm() {
            let newUsername = document.getElementById("new_username").value.trim();
            let newPassword = document.getElementById("new_password").value;
            let confirmPassword = document.getElementById("confirm_password").value;
            let newUsernameError = document.getElementById("newUsernameError");
            let newPasswordError = document.getElementById("newPasswordError");
            let confirmPasswordError = document.getElementById("confirmPasswordError");
            let isValid = true;

            newUsernameError.textContent = "";
            newPasswordError.textContent = "";
            confirmPasswordError.textContent = "";

            if (newUsername === "") {
                newUsernameError.textContent = "Username is required";
                isValid = false;
            }

            if (newPassword === "") {
                newPasswordError.textContent = "Password is required";
                isValid = false;
            } else if (newPassword.length < 6) {
                newPasswordError.textContent = "Password must be at least 6 characters long";
                isValid = false;
            }

            if (confirmPassword === "") {
                confirmPasswordError.textContent = "Please confirm your password";
                isValid = false;
            } else if (newPassword !== confirmPassword) {
                confirmPasswordError.textContent = "Passwords do not match";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>