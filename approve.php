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
        $updateRequest = $conn->prepare("UPDATE compensation SET status = ? WHERE id = ?");
        $updateRequest->execute([$newStatus, $requestId]);

        return $updateRequest->rowCount() > 0;
    } catch (PDOException $e) {
        // Handle database error
        echo 'Database Error: ' . $e->getMessage();
        return false;
    }
}

// Check if the request method is POST and 'compensation_id' is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compensation_id'])) {
    $requestId = filter_input(INPUT_POST, 'compensation_id', FILTER_SANITIZE_NUMBER_INT);

    // Update the status to 'approved' for the given request ID
    if (updateStatus($requestId, '1')) {
        // Fetch request details after updating the status
        try {
            $getRequestDetails = $conn->prepare("SELECT * FROM compensation WHERE id = ?");
            $getRequestDetails->execute([$requestId]);
            $requestDetails = $getRequestDetails->fetch(PDO::FETCH_ASSOC);

            // Send an email to the user using PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'umaatc@gmail.com';
            $mail->Password = 'kwhf znks pfrv dnzw';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('umaatc@gmail.com', 'Srays');
            $mail->addAddress($requestDetails['email'], $requestDetails['empName']);
            $mail->Subject = 'Your Compensation Request has been Approved';
            $mail->Body = 'Dear ' . $requestDetails['empName'] . ',Congratulations! Your compensation request has been approved.';

            if ($mail->send()) {
                // Email sent successfully
                echo 'Request with ID ' . $requestId . ' approved and email sent to the user.';
                
                // Insert the notification into the database
                $action_user_id = $_SESSION['user_id']; // Get the user ID from the session
                $notification_message = "Your Compensation request has been approved";
                $insert_notification = $conn->prepare("INSERT INTO notifications (user_id, message, status) VALUES (?, ?, 'unread')");
                $insert_notification->execute([$action_user_id, $notification_message]);

            } else {
                // Email failed to send
                echo 'Request with ID ' . $requestId . ' approved, but email failed to send.';
                echo ' Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (PDOException | Exception $e) {
            // Handle database or PHPMailer error
            echo 'An error occurred: ' . $e->getMessage();
        }
    } else {
        // Failed to update the status
        echo 'Failed to approve request with ID ' . $requestId;
    }
} else {
    // Invalid request
    echo 'Invalid request';
}
?>
