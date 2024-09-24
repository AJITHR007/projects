<?php
include 'dbconnection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    echo json_encode([]); // Return an empty array if admin is not logged in
    exit();
}

// Fetch unread notifications for the admin user
$stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? AND status = 'unread'");
$stmt->execute([$admin_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notifications); // Return notifications as JSON data
?>
