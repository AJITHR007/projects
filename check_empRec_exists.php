<?php
// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if empRec exists in the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empRec"])) {
    $empRec = $_POST["empRec"];

    // Prepare SQL statement
    $sql = "SELECT * FROM recordadd WHERE empRec = '$empRec'";

    // Execute SQL statement
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // empRec exists in the database
        echo "true";
    } else {
        // empRec does not exist in the database
        echo "false";
    }
}

// Close database connection
$conn->close();
?>
