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
        $user_id = $_SESSION['user_id']; // Retrieve user_id from session

        $empRec = $_POST["empRec"];
        $empName = $_POST["empName"];
        $department = $_POST["department"];
        $designation = $_POST["designation"];
        $email = $_POST["email"];
        $request = $_POST["request"];
        $healthInsuranceNumber = isset($_POST["healthInsuranceNumber"]) ? $_POST["healthInsuranceNumber"] : null;

        $amount = $_POST["amount"];
        $dateOnRequest = $_POST["dateOnRequest"];
        $reason = $_POST["reason"];

        // File upload handling
        $targetDirectory = __DIR__ . "/uploads/";
        $targetPath = $targetDirectory . basename($_FILES["documentInput"]["name"]);
        $documentInputName = null;

        if (isset($_FILES["documentInput"])) {
            if ($_FILES["documentInput"]["error"] == UPLOAD_ERR_OK) {
                $documentInputName = basename($_FILES["documentInput"]["name"]);

                // Check if the file already exists
                if (file_exists($targetPath)) {
                    throw new Exception("File already exists.");
                }

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($_FILES["documentInput"]["tmp_name"], $targetPath)) {
                    // File uploaded successfully
                } else {
                    throw new Exception("Error moving uploaded file. Target Path: $targetPath");
                }
            } else {
                throw new Exception("File upload error: " . $_FILES["documentInput"]["error"]);
            }
        }

        // Insert compensation request data into the database using prepared statement
        $compensationSql = "INSERT INTO compensation (user_id, empRec, empName, department, designation, email, request, healthInsuranceNumber, documentInput, amount, dateOnRequest, reason)  
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $recordConn->prepare($compensationSql);
        $stmt->execute([$user_id, $empRec, $empName, $department, $designation, $email, $request, $healthInsuranceNumber, $documentInputName, $amount, $dateOnRequest, $reason]);

        // Admin user ID for notification
        $adminUserId = 1; // Replace 1 with the actual admin user ID

        // Insert notification into the notifications table
        $notificationMessage = "New Compensation request submitted by $empName";
        
        $insertNotificationSql = "INSERT INTO notifications (user_id, message, status, created_at) 
            VALUES (?, ?, 'unread', NOW())";
        $stmt = $recordConn->prepare($insertNotificationSql);
        $stmt->execute([$adminUserId, $notificationMessage]);
        // Display success message as a JavaScript alert and redirect to empdash.php
        echo "<script>alert('Compensation request submitted successfully!'); window.location='empdash.php';</script>";
    }
} catch (Exception $e) {
    // Handle exceptions, e.g., print error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection after all operations are done
$recordConn = null;
?>
