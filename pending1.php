<?php
// Include your database connection file
include 'dbconnection.php';
include 'PHPMailer/PHPMailer.php';
include 'PHPMailer/Exception.php';
include 'PHPMailer/SMTP.php';
include 'updateStatus.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requestId'])) {
    $requestId = $_POST['requestId'];

    // Get the request details before updating the status
    $getRequestDetails = $conn->prepare("SELECT * FROM leave_approvals WHERE id = ?");
    $getRequestDetails->execute([$requestId]);
    $requestDetails = $getRequestDetails->fetch(PDO::FETCH_ASSOC);

    // Update the status to 'pending' for the given request ID
    $updateRequest = $conn->prepare("UPDATE leave_approvals SET status = 'pending' WHERE id = ?");
    $updateRequest->execute([$requestId]);

    if ($updateRequest->rowCount() > 0) {
        // Send an email to the user using PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';   // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'ajithajithr546@gmail.com';   // SMTP username
        $mail->Password = 'mfcm gujp zmvs ycwq';  // Replace with your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('ajithajithr546@gmail.com', 'Srays'); $mail->addAddress($requestDetails['email'], $requestDetails['empName']);  // Use user's email and name
        $mail->Subject = 'Your Leave  Request is Pending';
        $mail->Body = 'Dear ' . $requestDetails['empName'] . ' Your leave approvals request is pending.';

        if ($mail->send()) {
            // Email sent successfully
            echo 'Request with ID ' . $requestId . ' set to pending, and email sent to the user.';
        } else {
            // Email failed to send
            echo 'Request with ID ' . $requestId . ' set to pending, but email failed to send.';
        }
    } else {
        // Failed to update the status
        echo 'Failed to set request with ID ' . $requestId . ' to pending.';
    }
} else {
    // Invalid request
    echo 'Invalid request';
}
