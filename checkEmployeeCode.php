<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empCode = isset($_GET['empCode']) ? $_GET['empCode'] : '';
$isUserValid = false;

if (!empty($empCode)) {
    // Perform a database query to check if the employee code exists
    $sql = "SELECT COUNT(*) as count FROM recordadd WHERE empRec = '$empCode'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $isUserValid = $row['count'] > 0;
    }
}

echo json_encode($isUserValid);
$conn->close();
?>
