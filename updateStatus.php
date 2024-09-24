<?php
// Include your database connection file
include 'dbconnection.php';

function updateStatus($newStatus, $requestId)
{
    global $conn; // Add this line to access the global connection variable

    // Example of using prepared statements
    $updateRequest = $conn->prepare("UPDATE compensation SET status = ? WHERE id = ?");
    $updateRequest->execute([$newStatus, $requestId]);

    if ($updateRequest->rowCount() > 0) {
        echo $newStatus;
    } else {
        echo 'Failed to update status';
    }
}

function updateStatusAndNotify($requestId, $newStatus, $emailSubject, $emailBody)
{
    global $conn; // Add this line to access the global connection variable

    // Example of using prepared statements
    $updateRequest = $conn->prepare("UPDATE compensation SET status = ? WHERE id = ?");
    $updateRequest->execute([$newStatus, $requestId]);

    if ($updateRequest->rowCount() > 0) {
        // The status has been successfully updated, implement your notification logic here
        // ...

        echo $newStatus;
    } else {
        echo 'Failed to update status';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requestId'])) {
    $requestId = $_POST['requestId'];

    // Adjust status based on the specific file
    if (basename($_SERVER['PHP_SELF']) === 'approve.php') {
        updateStatus('Approved', $requestId);
    } elseif (basename($_SERVER['PHP_SELF']) === 'deny.php') {
        updateStatus('Denied', $requestId);
    } elseif (basename($_SERVER['PHP_SELF']) === 'pending.php') {
        updateStatus('Pending', $requestId);
    } else {
        // Invalid request
        header('HTTP/1.1 400 Bad Request');
        exit();
    }
} else {
    // Invalid request
    header('HTTP/1.1 400 Bad Request');
    exit();
}
?>
