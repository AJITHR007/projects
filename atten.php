<?php
session_start();
include 'dbconnection.php';

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header('location:login.php');
    exit();
}

// Retrieve clock-in and clock-out details for all users including employee code from the recordadd table
$select_attendance = $conn->prepare("SELECT a.*, r.empRec FROM attendance a JOIN recordadd r ON a.user_id = r.id ORDER BY a.date DESC");
$select_attendance->execute();
$attendance_records = $select_attendance->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
     
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

section {
    padding: 20px;
}

h4 {
    margin-bottom: 20px;
    text-align:center;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color:  #249bb3;
    color: #fff;
}

tbody tr:hover {
    background-color: #f2f2f2;
}
#closeButton {
        position: fixed;
        top: 20px; /* Adjust the top position as needed */
        right: 20px; /* Adjust the right position as needed */
        z-index: 9999; /* Ensure it's above other elements */
    }
    </style>
</head>
<body>
    <section>
        <div>
            <h4>Employee Attendance Details</h4>
            <table>
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Total Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendance_records as $record) : ?>
                        <tr>
                            <td><?= $record['empRec'] ?></td>
                            <td><?= $record['date'] ?></td>
                            <td><?= $record['empName'] ?></td>
                            <td><?= $record['intime'] ?></td>
                            <td><?= $record['outtime'] ?></td>
                            <td><?= $record['totalduration'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <button id="closeButton" class="btn-close" aria-label="Close"></button>
   <script>
    // Get a reference to the close button
    var closeButton = document.getElementById('closeButton');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Redirect to the desired page (e.g., "emdash.html")
        window.location.href = "ray.php";
    });
</script>
</body>
</html>
