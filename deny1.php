<?php
include 'dbconnection.php';
include 'PHPMailer/PHPMailer.php';
include 'PHPMailer/Exception.php';
include 'PHPMailer/SMTP.php';
session_start();
// Function to update status in the database
function updateStatus($requestId, $newStatus) {
    global $conn;

    try {
        $updateRequest = $conn->prepare("UPDATE leave_approvals SET status = ? WHERE id = ?");
        $updateRequest->execute([$newStatus, $requestId]);

        return $updateRequest->rowCount() > 0;
    } catch (PDOException $e) {
        // Handle database error
        return false;
    }
}

// Check if the request method is POST and 'requestId' is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['leave_approvals_id'])) {
    $requestId = filter_input(INPUT_POST, 'leave_approvals_id', FILTER_SANITIZE_NUMBER_INT);

    // Update the status to 'denied' for the given request ID
    if (updateStatus($requestId, '0')) {
        // Fetch request details after updating the status
        try {
            $getRequestDetails = $conn->prepare("SELECT * FROM leave_approvals WHERE id = ?");
            $getRequestDetails->execute([$requestId]);
            $requestDetails = $getRequestDetails->fetch(PDO::FETCH_ASSOC);

            // Send an email to the user using PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';   // Replace with your SMTP host
            $mail->SMTPAuth = true;
            $mail->Username = 'ajithajithr546@gmail.com';   // SMTP username
            $mail->Password = 'mfcm gujp zmvs ycwq';  // Replace with your SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('ajithajithr546@gmail.com', 'Srays');  // Replace with your email and name
            $mail->addAddress($requestDetails['email'], $requestDetails['empName']);  // Use user's email and name
            $mail->Subject = 'Your Leave Request has been Denied';
            $mail->Body = 'Dear ' . $requestDetails['empName'] . ',Your Leave Approvals has been denied.';

            if ($mail->send()) {
                // Email sent successfully
                echo 'Request with ID ' . $requestId . ' denied and email sent to the user.';
                // Insert the notification into the database
                $action_user_id = $_SESSION['user_id']; // Get the user ID from the session
                $notification_message = "Your Leave Request Has been Denied";
                $insert_notification = $conn->prepare("INSERT INTO notifications (user_id, message, status) VALUES (?, ?, 'unread')");
                $insert_notification->execute([$action_user_id, $notification_message]);
            } else {
                // Email failed to send
                echo 'Request with ID ' . $requestId . ' denied, but email failed to send.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (PDOException | Exception $e) {
            // Handle database or PHPMailer error
            echo 'An error occurred: ' . $e->getMessage();
        }
    } else {
        // Failed to update the status
        echo 'Failed to deny request with ID ' . $requestId;
    }
} else {
    // Invalid request
    echo 'Invalid request';
}
?>
