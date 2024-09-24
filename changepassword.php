<?php

include 'dbconnection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:adminlogin.php');
    exit();
}

$message = []; // Initialize an empty array for messages

if (isset($_POST['update'])) {

    $empName = $_POST['empName'];
    $empName = filter_var($empName, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE recordadd SET empName = ?, email = ? WHERE id = ?");
    $update_profile->execute([$empName, $email, $admin_id]);

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'uploaded_img/' . $image;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $message[] = 'Image size is too large';
        } else {
            $update_image = $conn->prepare("UPDATE recordadd SET image = ? WHERE id = ?");
            $update_image->execute([$image, $admin_id]);
    
            if ($update_image) {
                move_uploaded_file($image_tmp_name, $image_folder);
    
                // Check if the old image file exists before unlinking
                $old_image_path = 'uploaded_img/' . $old_image;
    
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                    $message[] = 'Image has been updated!';
                } else {
                    $message[] = 'Old image file not found!';
                }
            } else {
                $message[] = 'Failed to update image!';
            }
        }
    }

$old_pass = $_POST['old_pass'];
$previous_pass = md5($_POST['previous_pass']);
$previous_pass = filter_var($previous_pass, FILTER_SANITIZE_STRING);
$new_pass = md5($_POST['new_pass']);
$new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
$confirm_pass = md5($_POST['confirm_pass']);
$confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

if (!empty($old_pass)) {
    // Old password is provided, check if new and confirm passwords are provided
    if (empty($new_pass) || empty($confirm_pass)) {
        $message[] = 'Please fill in both new and confirm passwords.';
    } elseif ($new_pass != $confirm_pass) {
        $message[] = 'Confirm password does not match the new password.';
    } else {
        // Old password is provided and new/confirm passwords match, proceed with validation
        // Define the password pattern using a regular expression
        $password_pattern = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,15}$/';

        // Validate the new password against the pattern
        if (!preg_match($password_pattern, $_POST['new_pass'])) {
            // Password does not meet the criteria
            $message[] = 'Password must be 8-15 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
        } else {
            // Password meets the criteria
            // Proceed with updating the password
            $update_pass = $conn->prepare("UPDATE recordadd SET pass = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $admin_id]);
            $message[] = 'Password has been updated!';
        }
    }
} else {
    // Old password not provided, skip the password update process
    $message[] = 'Old password is required.';
}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>user profile update</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600&display=swap');

        body {
            font-family: Arial, sans-serif;
            background-color: #e3ebed;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .inputBox .box {
    width: calc(100% - 20px); /* Adjusted width */
    padding: 12px; /* Adjusted padding */
    font-size: 14px;
    color: #333;
    margin: 12px 0;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
}
        .message {
            max-width: 1200px;
            padding: 24px 32px; /* Converted from rem to px */
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px; /* Converted from rem to px */
            background-color: #fff;
            margin: 0 auto;
            border-bottom: 2px solid #3498db; /* Added border at the bottom */
        }

        .message span {
            color: #000;
            font-size: 16px; /* Converted from rem to px */
        }

        .message i {
            color: #e74c3c;
            font-size: 32px; /* Converted from rem to px */
            cursor: pointer;
        }

        .message i:hover {
            color: #c0392b;
        }

        .title {
    padding: 10px 16px;
    text-align: center;
    background-color:  #e3ebed;
    font-size: 20px;
    text-transform: uppercase;
    color: black;
}

        .title span {
            color: black;
        }

        .update-profile-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0px; /* Converted from rem to px */
            min-height: 100vh;
            background-color: #e3ebed;
        }

        .update-profile-container form {
            width: 600px; /* Converted from rem to px */
            background:linear-gradient( #249bb3, #f6f6f6);
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           padding: 10px; /* Converted from rem to px */
           text-align: center;
          
        }

        .update-profile-container form img {
            height: 125px; /* Converted from rem to px */
            width: 125px; /* Converted from rem to px */
            border-radius: 50%;
            margin-bottom: 16px; /* Converted from rem to px */
            object-fit: cover;
            border: 2px solid #3498db;
        }

        .update-profile-container form .flex {
            text-align: left;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-left:25px;
        }

        .update-profile-container form .flex .inputBox {
            width: 50%;
        }

        .update-profile-container form .flex .inputBox span {
            font-size: 16px; /* Converted from rem to px */
            color: #555;
            display: block;
            padding-top: 16px; /* Converted from rem to px */
        }

        .update-profile-container form .flex .inputBox .box {
    width: 80%;
    padding: 10px 10px;
    border-radius: 8px;
    font-size: 14px;
    color: #333;
    margin: 10px 0;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
}

.btn {
    margin-top: 20px;
    display: block;
    width: 41%;
    border-radius: 8px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    padding: 10px 10px;
    text-transform: capitalize;
    text-align: center;
    background-color: #3498db;
    transition: background-color 0.3s ease;
    border: none;
    margin-left: -75px;
}
.btn:hover {
    background-color: #2980b9;
}
        #closeButton {
            position: fixed;
            top: 10px;
            right: 20px;
            z-index: 9999;
            background-color: transparent; /* Set background color to transparent */
            border: none;
            font-size: 20px; /* Converted from rem to px */
            color: black;
            cursor: pointer;
        }

        #closeButton:hover {
            color: #2980b9;
        }

        .inputBox .box {
            width: 80%;
            padding: 16px; /* Converted from rem to px */
            font-size: 14px; /* Converted from rem to px */
            color: #333;
            margin: 16px 0; /* Converted from rem to px */
            background-color: #f5f5f5;
            border: 1px solid #ddd;
        }
        .error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}

        @media (max-width: 768px) {
            .update-profile-container form .flex .inputBox {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
        }
    }
    ?>

    <h1 class="title"> Update <span>user</span> profile </h1>

    <section class="update-profile-container">

        <?php
        $select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
        $select_profile->execute([$admin_id]);
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <div class="flex">
                <div class="inputBox">
                    <span>Username: </span>
                    <input type="text" name="empName" required class="box" placeholder="Enter your name"
                        value="<?= $fetch_profile['empName']; ?>">
                    <span>Email: </span>
                    <input type="email" name="email" required class="box" placeholder="Enter your email"
                        value="<?= $fetch_profile['email']; ?>">
                    <span>Profile pic: </span>
                    <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
                    <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                </div>
                <div class="inputBox">
                   <input type="hidden" name="old_pass" value="<?= $fetch_profile['pass']; ?>">
                   <span>Old password:</span>
                   <input type="password" class="box" name="previous_pass" placeholder="Enter previous password">
                   <span>New password:</span>
                   <input type="password" class="box" name="new_pass" placeholder="Enter new password">
                   <span>Confirm password:</span>
                   <input type="password" class="box" name="confirm_pass" placeholder="Confirm new password">
                   
                    <div class="flex-btn">
                        <input type="submit" value="Update Profile" name="update" class="btn">
                    </div>
        </form>

    </section>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get references to password input fields and eye icons
    var previousPassInput = document.getElementById('previous_pass');
    var newPassInput = document.getElementById('new_pass');
    var confirmPassInput = document.getElementById('confirm_pass');

    var togglePreviousPass = document.getElementById('toggle-previous-pass');
    var toggleNewPass = document.getElementById('toggle-new-pass');
    var toggleConfirmPass = document.getElementById('toggle-confirm-pass');

    // Add click event listeners to eye icons
    togglePasswordVisibility(togglePreviousPass, previousPassInput);
    togglePasswordVisibility(toggleNewPass, newPassInput);
    togglePasswordVisibility(toggleConfirmPass, confirmPassInput);
});

function togglePasswordVisibility(toggleElement, passwordInput) {
    toggleElement.addEventListener('click', function() {
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Change eye icon based on password visibility
        if (type === 'password') {
            toggleElement.classList.remove('fa-eye-slash');
            toggleElement.classList.add('fa-eye');
        } else {
            toggleElement.classList.remove('fa-eye');
            toggleElement.classList.add('fa-eye-slash');
        }
    });
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