<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the token from the URL
    $token = isset($_GET['token']) ? $_GET['token'] : null;

    // Check if the token is not empty
    if (!empty($token)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <title>Reset Password</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
        border: 1px solid #ddd;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    .input-container {
        position: relative;
    }

    input {
        width: calc(100% - 30px);
        padding: 10px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: calc(100% - 30px);
    }

    button:hover {
        background-color: #0056b3;
    }

    #password-message {
        color: red;
        margin-top: 5px;
        clear: both;
    }

    .toggle-password {
        position: absolute;
        top: 40%;
        right: 25px;
        transform: translateY(-50%);
        cursor: pointer;
        z-index: 1;
    }
    #closeButton {
        position: fixed;
        top: 20px; /* Adjust the top position as needed */
        right: 20px; /* Adjust the right position as needed */
        z-index: 9999; /* Ensure it's above other elements */
    }
    </style>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the token from the URL
    $token = isset($_GET['token']) ? $_GET['token'] : null;

    // Check if the token is not empty
    if (!empty($token)) {
?>
        <form action="update-password.php" method="post" onsubmit="return validatePassword()">
            <h2>Reset Password</h2>
            <input type="hidden" name="token" value="<?= $token ?>">
            <label for="new_password">New Password</label>
            <div class="input-container">
                <input type="password" id="new_password" name="new_password">
                <span class="toggle-password" onclick="togglePasswordVisibility('new_password')">
                    <i class="far fa-eye" id="newPasswordEye"></i>
                </span>
            </div>
            <div id="password-message" style="color: red;"></div>

            <label for="confirm_password">Confirm Password</label>
            <div class="input-container">
                <input type="password" id="confirm_password" name="confirm_password">
                <span class="toggle-password" onclick="togglePasswordVisibility('confirm_password')">
                    <i class="far fa-eye" id="confirmPasswordEye"></i>
                </span>
            </div>
            <div id="password-message" style="color: red;"></div>

            <button type="submit">Reset Password</button>
        </form>

        <script>
function validatePassword() {
    var passwordField = document.getElementById('new_password');
    var confirmPasswordField = document.getElementById('confirm_password');
    var password = passwordField.value.trim();
    var confirmPassword = confirmPasswordField.value.trim();
    var passwordMessage = document.getElementById('password-message');
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/;

    if (password.length === 0 || confirmPassword.length === 0) {
        passwordMessage.innerHTML = "Both fields are required";
        return false;
    }
    else if (!passwordPattern.test(password)) {
        passwordMessage.innerHTML = "Password must be 8-15 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (@ $ ! % * ? &)";
        return false;
    } 
    else if (password !== confirmPassword) {
        passwordMessage.innerHTML = "Passwords do not match";
        return false;
    } 
    else {
        passwordMessage.innerHTML = "";
        return true;
    }
}

function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = document.getElementById(inputId + 'Eye');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('far', 'fa-eye');
        eyeIcon.classList.add('far', 'fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('far', 'fa-eye-slash');
        eyeIcon.classList.add('far', 'fa-eye');
    }
}
</script>
  <button id="closeButton" class="btn-close" aria-label="Close" style="background: none; border: none; position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <i class="fas fa-times" style="color: black;"></i>
</button>

   <script>
    // Get a reference to the close button
    var closeButton = document.getElementById('closeButton');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Redirect to the desired page (e.g., "emdash.html")
        window.location.href = "login.php";
    });
</script>
<?php
    } else {
        echo "Token is missing or empty.";
    }
}
?>
</body>
</html>

<?php
    } // This closes the if (!empty($token)) block
} // This closes the if ($_SERVER["REQUEST_METHOD"] == "GET") block
?>
