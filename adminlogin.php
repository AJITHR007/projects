<?php
include 'dbconnection.php';

session_start();

$emailError = false; // Initialize $emailError variable
$passError = false; // Initialize $passError variable
$message = []; // Initialize message array

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    // Check if the email and password match the records in the database
    $selectEmail = $conn->prepare("SELECT * FROM recordadd WHERE BINARY email = ?");
    $selectEmail->execute([$email]);

    if ($selectEmail->rowCount() == 0) {
        // No matching email found, set email error flag
        $emailError = true;
        $message[] = 'Invalid email address.';
    } else {
        // Fetch the user record
        $row = $selectEmail->fetch(PDO::FETCH_ASSOC);
        // Compare the password
        if ($row['pass'] != $pass) {
            // Password doesn't match, set password error flag
            $passError = true;
            $message[] = 'Invalid password.';
        } else {
            // Password matches, proceed with login
            if ($row['active'] == '0') {
                if ($row['usertype'] == 'admin') {
                    $_SESSION['admin_id'] = $row['id'];
                    header('Location: http://localhost/final/ray.php');
                    exit; // Ensure script execution stops after redirection
                } else {
                    $message[] = 'No user found!';
                }
            } else {
                $message[] = 'Your account is inactive. Please contact HR to enable your account.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display:flex;
            background-color:#e3ebed;
       }
        .container {
            max-width: 400px;
            margin: 80px auto;
            margin-left:0px;
            padding: 20px;
            background-color:white;
        }
        .logo{
            display:flex;
            max-width: 400px;
            margin-left:400px;
            margin-top:80px;
            margin-bottom:80px;
            margin-right:0px;
            padding: 20px;
            width:240px;
            height:425px;
            background-color:#249bb3;
        }
        .logo img {
            width: 200px;
            height: 200px;
            margin-top: 115px;
            border-radius: 50px;
            margin-left: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 30px);
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid black;
            border-radius: 4px;
            outline: none;
            font-size:16px;
        }
        .password-icon {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 30px;
            cursor: pointer;
            margin-left: -30px;
        }
        .password-icon img {
            width: 100%;
            height: 100%;
        }
        input[type="submit"] {
            width: 50%;
            background-color: #249bb3;
            color: white;
            padding: 10px 25px;
            margin: 10px 100px;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 18px;
         }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .container a{
            display: block;
            text-align:left;
            margin-top: 10px;
            font-size: 18px;
            color: darkblue;
            text-decoration: none;
         }

         .container a:hover {
            color: green;
         }
         #closeButton {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>
<body><div class="logo">
        <img src="assets\bg0.png">
        </div>
        <div class="container">
    <center>   <p> <h2>Welcome Admin</h2>  <p> </center>
       <center> <h2>Login</h2></center>
        <?php if (!empty($message)) { ?>
            <div class="error">
                <?php foreach ($message as $msg) { echo $msg . "<br>"; } ?>
            </div>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter your email">
            <div id="emailError" class="error"></div>
            <label for="pass">Password:</label>
            <div class="password-container">
                <input type="password" id="pass" name="pass" placeholder="Enter your password">
                <span class="password-icon" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <div id="passError" class="error"></div>
            <a href="password1.php">Forgot Password?</a> <!-- Link to the forgot password page -->
            <input type="submit" name="submit" value="Login">
          
        </form>
    </div>

    <script>
    function validateForm() {
    var email = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;
    var emailError = document.getElementById("emailError");
    var passError = document.getElementById("passError");
    var isValid = true;

        if (email.trim() === "") {
            emailError.innerHTML = "Email is required";
            isValid = false;
        } else if (!isValidEmail(email)) {
            emailError.innerHTML = "Please enter a valid email";
            isValid = false;
        } else {
            emailError.innerHTML = "";
        }

            // Password validation
            if (pass.trim() === "") {
                passError.innerHTML = "Password is required";
                isValid = false;
            } else if (!isValidPassword(pass)) {
                passError.innerHTML = "Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be between 8 and 15 characters long";
                isValid = false;
            } else {
                passError.innerHTML = "";
            }

            return isValid;
        }
        function isValidEmail(email) {
            // Regular expression for validating email
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }
        function isValidPassword(password) {
            // Password validation
            var isValid = true;

            if (password.length < 8 || password.length > 15) {
                isValid = false;
            } else if (!/[a-z]/.test(password)) {
                isValid = false;
            } else if (!/[A-Z]/.test(password)) {
                isValid = false;
            } else if (!/\d/.test(password)) {
                isValid = false;
            } else if (!/[!@#$%^&*()_+]/.test(password)) {
                isValid = false;
            }

            return isValid;
        }

        function togglePassword() {
            var passField = document.getElementById("pass");
            var passIcon = document.querySelector(".password-icon img");

            if (passField.type === "password") {
                passField.type = "text";
                passIcon.src = "eye-close-icon.png";
            } else {
                passField.type = "password";
                passIcon.src = "eye-icon.png";
            }
        }
    </script>
     <button id="closeButton" class="btn-close" aria-label="Close">X</button>
    <script>
        // Get a reference to the close button
        var closeButton = document.getElementById('closeButton');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function() {
            // Redirect to the desired page (e.g., "welcome.php")
            window.location.href = "welcome.php";
        });
    </script>
</body>
</html> 