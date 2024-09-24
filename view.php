<?php

$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="srays";
$conn=new mysqli($servername,$dbusername,$dbpassword,$dbname);
if($conn->connect_error)
{
    die("connection failed:" .$conn->connect_error);
}
$sql_fetch = "SELECT * FROM holidaytable";
$result = $conn->query($sql_fetch);

$holidays = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $holidays[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Holiday Calender</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/holiday.js" defer></script>
    
    <style>
        body {
    font-family: Arial, sans-serif; /* Set a common font family for better readability */
    background-Color:#8989631a;
}

.container {
    max-width: 800px; /* Adjust the maximum width of the container */
    margin: 0 auto; /* Center the container horizontally */
    padding: 20px; /* Add some padding for better spacing */
    background-color: #f8f9fa; /* Add a light background color */
    border-radius: 10px; /* Add some rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
}

h4 {
    color: #8F4B84; /* Set a custom color for headings */
}

.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff; /* Set the background color of the table */
    border-radius: 5px; /* Add some rounded corners to the table */
    overflow: hidden; /* Hide any overflowing content */
}

.table th,
.table td {
    padding: 12px; /* Increase padding for better spacing */
}

.table thead th {
    background-color: #8F4B84;
    color: #fff;
    font-weight: bold;
    text-align: center;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Add alternating row colors */
}

.table tbody tr:hover {
    background-color: #ddd; /* Add a hover effect to table rows */
}


#closeButton {
        position: fixed;
        top: 20px; /* Adjust the top position as needed */
        right: 20px; /* Adjust the right position as needed */
        z-index: 9999; /* Ensure it's above other elements */
    }
@media (max-width: 768px) {
    .container {
        padding: 10px; /* Adjust padding for smaller screens */
    }

    .table th,
    .table td {
        padding: 8px; /* Adjust padding for smaller screens */
    }
}
/* Responsive Table */
@media (max-width: 768px) {
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }

    .table-responsive > .table {
        margin-bottom: 0;
    }
}

    </style>
</head>
<body>
    <!-- Add this section after the form -->
    <div class="container mt-5">
    <h4 class="text-center mb-4"><i class="fas fa-calendar"></i> Holidays</h4>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Holiday Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($holidays as $holiday): ?>
                <tr>
                    <td><?php echo $holiday['dod']; ?></td>
                    <td><?php echo $holiday['holiday']; ?></td>
                    <td><?php echo $holiday['description']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<button id="closeButton" class="btn-close" aria-label="Close"></button>
<script>
    // Get a reference to the close button
    var closeButton = document.getElementById('closeButton');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Redirect to the desired page (e.g., "emdash.html")
        window.location.href = "empdash.php";
    });
</script>
</body>

</html>