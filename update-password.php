<?php
include('./dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = isset($_POST['token']) ? $_POST['token'] : null;
    $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : null;

    if (!empty($token) && !empty($newPassword)) {
        $passwordUpdateSuccess = updatePassword($token, $newPassword);

        if ($passwordUpdateSuccess) {
            echo "Password updated successfully!";
        } else {
            echo "Error updating password. Please try again.";
        }
    } else {
        echo "Token or new password is missing or empty.";
    }
}

function updatePassword($token, $newPassword) {
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "srays";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the password in the database using the token
    $stmt = $conn->prepare("UPDATE recordadd SET pass = ? WHERE token = ?");
    $stmt->bind_param("ss", $newPassword, $token);

    $passwordUpdateSuccess = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $passwordUpdateSuccess;
}
?>
