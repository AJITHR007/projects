
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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

    h2 {
        text-align: center;
        color: #333;
    }

    h3 {
        text-align: center;
        color: black;
        margin-bottom: 20px;
    }

    form {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
        border: 1px solid #ddd;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    input {
        width: 100%;
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
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Style for error messages */
    .error-message {
        color: red;
        margin-top: -8px; /* Adjust as needed to align with the input field */
    }
    #closeButton {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #333; /* Set the color of the close button */
}

#closeButton:hover {
    color: #000; /* Change the color of the close button on hover */
}
</style>

</head>
<body>

<form id="forgotPasswordForm" onsubmit="return validateForm()" method="post" action="forgot-password1.php">
<h3> Forgot Password</h3>
    <label for="resetEmail">Enter your email to reset password</label>
    <input type="text" id="resetEmail" name="resetEmail">
    <div class="error-message" id="resetEmailError"></div>
    <button type="submit">Send </button>
</form>

<script>
    function validateForm() {
        var resetEmail = document.getElementById('resetEmail').value;
        var resetEmailError = document.getElementById('resetEmailError');

        // Reset previous error message
        resetEmailError.textContent = '';

        // Simple validation for email
        if (resetEmail.trim() === '') {
            resetEmailError.textContent = 'Please enter your email address.';
            return false;
        } else if (!isValidEmail(resetEmail)) {
            resetEmailError.textContent = 'Please enter a valid email address.';
            return false;
        }

        // If everything is valid, return true
        return true;
    }

    function isValidEmail(email) {
        // A simple email validation regex
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function sendResetEmail() {
        // Validate email before sending
        if (validateForm()) {
            // Get the entered email
            var resetEmail = document.getElementById('resetEmail').value;

            // Placeholder for actual reset logic
            // In a real-world scenario, generate a unique token and save it in the database
            var resetToken = 'your_generated_token';

            // Construct the reset link with the token
            var resetLink = 'http://yourdomain.com/reset-password?token=' + resetToken;

            // Here, you would send an email to resetEmail with the resetLink
            // This is a placeholder alert; replace it with your email sending logic
            alert('Reset link sent to ' + resetEmail + '! Check your inbox.');

            
        }
    }
</script>
<button id="closeButton" class="btn-close" aria-label="Close">X</button>
   <script>
    // Get a reference to the close button
    var closeButton = document.getElementById('closeButton');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Redirect to the desired page (e.g., "emdash.html")
        window.location.href = "ray.php";
    });
</script>

</body>
</html>
