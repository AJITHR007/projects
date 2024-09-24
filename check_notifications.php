<?php
// Include the database connection
include 'dbconnection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, return an empty array
    echo json_encode([]);
    exit(); // Stop further execution
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Query to fetch unread notifications for the current user
$select_notifications = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? AND status = 'unread'");
$select_notifications->execute([$user_id]);
$unread_notifications = $select_notifications->fetchAll(PDO::FETCH_ASSOC);

// Return the unread notifications in JSON format
echo json_encode($unread_notifications);
?>
