<?php
// Include the database connection
include 'dbconnection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, return an empty response
    echo json_encode(array('success' => false, 'message' => 'User is not logged in'));
    exit(); // Stop further execution
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Update the status of notifications for the current user to "read"
$update_notifications = $conn->prepare("UPDATE notifications SET status = 'read' WHERE user_id = ?");
$update_notifications->execute([$user_id]);

// Check if the update was successful
if ($update_notifications) {
    echo json_encode(array('success' => true, 'message' => 'Notifications marked as read successfully'));
} else {
    echo json_encode(array('success' => false, 'message' => 'Failed to mark notifications as read'));
}
?>
