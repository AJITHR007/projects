<?php
// getStatus.php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);

if($conn->connect_error) {
    die("connection failed:" .$conn->connect_error);
}
// Simulate a response (replace this with your actual logic)
    function getStatusForRequest($requestId,$conn) {
        // Your logic to fetch the status for a specific request
        // Replace the following line with your actual database query or status retrieval logic
        $ids = implode(",", $requestId);
        // Fetch all compensation requests from the database
        $leave_approvalsQuery = "SELECT * from leave_approvals where Id IN($ids)";

        $leave_approvalsQueryExe = $conn->query($leave_approvalsQuery);

        $leave_approvalsData = [];
        if ($leave_approvalsQueryExe->num_rows > 0) {
            while($row = $leave_approvalsQueryExe->fetch_assoc()) {
                $leave_approvalsData[] = $row;
            }
            
        }

        return $leave_approvalsData;
    }
    
    
    // return 'Status for request ' . $requestId;


$requestIds = $_GET['requestIds'] ?? [];

// echo "<pre>";
// print_r(json_decode($_GET['requestIds']));
// Fetch statuses for each request
$response = [];
$status_data = getStatusForRequest(json_decode($requestIds), $conn);
// foreach ($requestIds as $requestId) {
//     try {
//         $response[$requestId] = getStatusForRequest($requestId);
//     } catch (Exception $e) {
//         // Handle the exception and set an error status
//         $response[$requestId] = 'Error fetching status: ' . $e->getMessage();
//     }
// }

// Ensure a JSON response with proper content type
// header('Content-Type: application/json');

// Output the JSON response
echo json_encode(['statuses' => $status_data]);
?>
