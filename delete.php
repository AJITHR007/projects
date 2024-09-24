<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == '1') {
        // Use prepared statement to delete the record
        $stmt = $conn->prepare("DELETE FROM recordadd WHERE empRec = ?");
        $stmt->bind_param("s", $id); // assuming empRec is a string, adjust the type if needed
        $stmt->execute();
        $stmt->close();

        // Redirect to the main page after deletion
        header("Location: viewemployee.php");
        exit;
    } else {
        // Display JavaScript confirmation message
        echo '<script>';
        echo 'var result = confirm("Are you sure you want to delete?");';
        echo 'if (result) {';
        echo '  window.location.href = "delete.php?id=' . urlencode($id) . '&confirm=1";';
        echo '}';
        echo '</script>';
    }
}

$conn->close();
?>
