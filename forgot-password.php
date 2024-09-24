<?php
include('./dbconnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



// echo "Test";
// Function to send a registered email
function registeredEmail($email, $token)
{
    require('PHPMailer/Exception.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/PHPMailer.php');

    $mail = new PHPMailer(true);

    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
        $mail->isSMTP();                        // Send using SMTP
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';         // Set the SMTP server to send through
        $mail->SMTPAuth = true;                 // Enable SMTP authentication
        $mail->Username = 'umaatc@gmail.com';   // SMTP username
        $mail->Password = 'kwhf znks pfrv dnzw';   // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Enable implicit TLS encryption
        $mail->Port = 465;                      // TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

        // Recipients
        $mail->setFrom('umaatc@gmail.com', 'Srays');
        $mail->addAddress($email);

        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Password RESET';
        $mail->Body = "Click the below link to change the password.<br>
            <a href='http://localhost/final/resetpassword.php?email=$email&token=$token'>Change Password</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log or echo the error message for debugging
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}

if (isset($_POST['resetEmail'])) {
    $email = $_POST['resetEmail'];

    // Query to check if the email exists and usertype is 'user'
    $query = "SELECT * FROM recordadd WHERE email = :email AND usertype = 'user'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Check if the email belongs to a user
    $result = $stmt->rowCount();

    if ($result == 0) {
        echo "1"; // Email not found or not a user
        echo "<script>alert('Email Not Found or Not a User'); window.location='login.php';</script>";
       
    } else {
        // Generate a unique token for password reset
        $token = bin2hex(random_bytes(16));

        // Update the user's record with the token
        $que = "UPDATE recordadd SET token = :token WHERE email = :email";
        $stmt = $conn->prepare($que);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);

        // Send password reset email and update token if successful
        if (registeredEmail($email, $token) && $stmt->execute()) {
            echo "<script>alert('Email Sent Successfully!'); window.location='login.php';</script>";
            // echo "2"; // Email sent successfully
        } else {
            echo "<script>alert('Email not Sent!!'); window.location='login.php';</script>";
            // echo "3"; // Email sending failed
        }
    }
}

?>
