<?php
include 'PHPMailer/PHPMailer.php';
include 'PHPMailer/Exception.php';
include 'PHPMailer/SMTP.php';

if (isset($_GET['empRec'])) {
    $empRec = $_GET['empRec'];

    // Assuming you have a database connection, replace the connection details accordingly
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "srays";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM recordadd WHERE empRec = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $empRec);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Send email using PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'umaatc@gmail.com';
                $mail->Password = 'kwhf znks pfrv dnzw';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('umaatc@gmail.com', 'Srays');

                // Recipients
             
                $mail->addAddress($row['email']);  // Add recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Account Deactivation';
                $mail->Body    = 'Your account has been deactivated. Kindly please contact HR for reactivation';

                $mail->send();
                echo 'Email has been sent successfully';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    // Close the prepared statement
    $stmt->close();
}
?>
