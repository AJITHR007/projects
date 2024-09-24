<?php
include 'dbconnection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    exit(); // Terminate script if admin is not logged in
}

// Update notification status to 'read' for the admin user
$stmt = $conn->prepare("UPDATE notifications SET status = 'read' WHERE user_id = ?");
$stmt->execute([$admin_id]);
?>
