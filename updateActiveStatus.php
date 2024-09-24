<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['empRec']) && isset($_GET['isActive'])) {
    $empRec = $_GET['empRec'];
    $isActive = $_GET['isActive'];

    // Use prepared statement to update the active status
    $stmt = $conn->prepare("UPDATE recordadd SET active = ? WHERE empRec = ?");
    $stmt->bind_param("ss", $isActive, $empRec); // Use "s" for string
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

