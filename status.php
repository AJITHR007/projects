<?php
include 'dbconnection.php';

// Check if the parameters are set and valid
echo 'Parameters: ' . print_r($_GET, true); // Debugging line

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: adminlogin.php');
    exit();
}

// Check if the parameters are set and valid
if (isset($_GET['employeecode']) && is_numeric($_GET['employeecode']) && isset($_GET['status'])) {
    $employeecode = $_GET['employeecode'];
    $status = ($_GET['status'] == 'enabled') ? 'disabled' : 'enabled';

    $updateQuery = "UPDATE recordadd SET status1 = :status WHERE empRec = :employeecode";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':employeecode', $employeecode, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "Status Updated successfully";
        header("Location: http://localhost/final/viewemployee.php");
        exit;
    } catch (PDOException $e) {
        echo "Error updating status: " . $e->getMessage();
    }
} else {
    echo 'Invalid parameters: ' . print_r($_GET, true);
}
?>
