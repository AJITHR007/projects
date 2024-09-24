<?php
session_start();

$recordHost = "localhost";
$recordUser = "root";
$recordPassword = "";
$recordDB = "srays";

try {
    // Attempt to connect to the record database using PDO
    $recordConn = new PDO("mysql:host=$recordHost;dbname=$recordDB", $recordUser, $recordPassword);

    // Set the PDO error mode to exception
    $recordConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if user_id is set in session
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if user is not logged in
        header('location: login.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve compensation request form data using prepared statements
        $empName = $_POST["empName"];
        $empRec = $_POST["empRec"];
        $department = $_POST["department"];
        $email = $_POST["email"];
        $leave_type = $_POST["leave_type"];
        $leave_start = $_POST["leave_start"];
        $leave_end = $_POST["leave_end"];
        $total_days = $_POST["total_days"];
        $reason = $_POST["reason"];

        // File upload handling
        $targetDirectory = __DIR__ . "/uploads/";
        $documentInputName = null;

        if (isset($_FILES["documentInput"])) {
            $documentInputName = basename($_FILES["documentInput"]["name"]);
            $targetPath = $targetDirectory . $documentInputName;

            // Move the uploaded file to the desired directory using move_uploaded_file
            move_uploaded_file($_FILES["documentInput"]["tmp_name"], $targetPath);
        }

        // Insert new compensation leave_type data into the database using prepared statements
        $insertSql = "INSERT INTO leave_approvals (empName, empRec, department, email, leave_type, leave_start, leave_end, total_days, reason, documentInput) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $recordConn->prepare($insertSql);
        $stmt->execute([$empName, $empRec, $department, $email, $leave_type, $leave_start, $leave_end, $total_days, $reason, $documentInputName]);

       // Identify the admin user ID (This could be retrieved from a configuration file, database, or any other source)
$adminUserId = 1; // Replace 123 with the actual admin user ID

// Insert notification into the notifications table
$notificationMessage = "New leave request submitted by $empName";

$insertNotificationSql = "INSERT INTO notifications (user_id, message, status, created_at) 
    VALUES (?, ?, 'unread', NOW())";
$stmt = $recordConn->prepare($insertNotificationSql);
$stmt->execute([$adminUserId, $notificationMessage]);

        // Display success message as a JavaScript alert
        echo "<script>alert('Leave request submitted successfully'); window.location.href = 'empdash.php';</script>";

    }
} catch (PDOException $ex) {
    // Handle PDO exceptions
    echo "Error: " . $ex->getMessage();
} catch (Exception $ex) {
    // Handle other exceptions
    echo "Error: " . $ex->getMessage();
}
?>
