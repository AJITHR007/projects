<?php
session_start();
include 'dbconnection.php';

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
    exit();
}
// Check if a request has already been submitted for the current day
$currentDate = date('Y-m-d');
$checkRequest = $conn->prepare("SELECT COUNT(*) AS count FROM attendance WHERE user_id = ? AND DATE(date) = ?");
$checkRequest->execute([$user_id, $currentDate]);
$requestCount = $checkRequest->fetchColumn();

if ($requestCount > 0) {
    // If a request has already been submitted for the current day, display an error message
    $errorMessage = "You Are Already Loggedout Today!Please Login Tomorrow.";
    echo "<script>alert('$errorMessage'); window.location='empdash.php';</script>";
    exit(); // Stop further execution
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentDate = date("Y-m-d"); // Get the current date

    // Fetch other values from the form or JavaScript
    $intime = isset($_POST['intime']) ? $_POST['intime'] : null; 
    $outtime = isset($_POST['outtime']) ? $_POST['outtime'] : null; 
    $totalduration = isset($_POST['totalduration']) ? $_POST['totalduration'] : null; 
    
    // Set status based on whether it's clock-in or clock-out
    $status = isset($_POST['outtime']) ? 1 : 0; // If outtime is set, it's clock-out, else clock-in
    
    // Fetch employee name from the form
    $empName = isset($_POST['empName']) ? $_POST['empName'] : null;

    $insertAttendance = $conn->prepare("INSERT INTO attendance (user_id, date, intime, outtime, totalduration, status, empName) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $success = $insertAttendance->execute([$user_id, $currentDate, $intime, $outtime, $totalduration, $status, $empName]);

    if ($success) {
        // Store the last logout date in session
        $_SESSION['last_logout_date'] = $currentDate;

        // Redirect to the attendance.php page
        echo "<script>window.location = 'attendance.php';</script>";
        exit();
    } else {
        echo "Error inserting record: ";
        print_r($insertAttendance->errorInfo());
    }
}
$select_attendance = $conn->prepare("SELECT * FROM attendance WHERE user_id = ? ORDER BY date DESC");
$select_attendance->execute([$user_id]);
$attendance_records = $select_attendance->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Attendance</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        .vertical-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .purpleBox {
            background-color: #8F4B84;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            min-height: 600px;
        }

        .btn-primary {
            background-color: #8F4B84;
            border-color: #8F4B84;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #95598b;
            border-color: #95598b;
        }

        .purpleBox img {
            bottom: 0;
        }

        /* Adjust table styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #8F4B84;
            color: white;
        }

        #closeButton {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        #attendanceButton {
        background-color: #8F4B84;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #attendanceButton:hover {
        background-color: #10098b;
    }
    input[type="text"] {
        border: none;
        background: none;
        width: 100%;
        outline: none;
    }
    </style>
</head>

<body>
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                    <h4 class="text-white" style="margin-top: 200px;"><i class="fas fa-clock"></i>Mark Attendance</h4>
                    <img src="" class="img-fluid position-absolute" alt="" />
                </div>
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                    <?php
                    $select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
                    $select_profile->execute([$user_id]);
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="row pb-4 mt-4">
                        <h4>
                            <center>Clock in/Clock out </center>
                        </h4>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <form id="attendanceForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <tr>
                                    <!-- Your HTML content -->
                                    <td><input type="text" id="currentDate" name="currentDate" disabled></td>
                                    <td><input type="text" id="empName" name="empName" value="<?= $fetch_profile['empName']; ?>" readonly></td>
                                    <td><input type="text" id="timeIn" name="intime" disabled></td>
                                    <td><input type="text" id="timeOut" name="outtime" disabled></td>
                                    <td><input type="text" id="totalDuration" name="totalduration" disabled></td>
                                    <!-- Hidden inputs for intime, outtime, and totalduration -->
                                    <input type="hidden" id="intimeInput" name="intime">
                                    <input type="hidden" id="outtimeInput" name="outtime">
                                    <input type="hidden" id="totaldurationInput" name="totalduration">
                                    <td><button type="button" id="attendanceButton">Clock In</button></td>
                                </tr>
                            </form>
                           
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Duration</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($attendance_records as $record) : ?>
                                <tr>
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
            </div>
        </div>
    </section>

    <script>
        // Get the current date and format it as "YYYY-MM-DD"
        var currentDate = new Date().toISOString().slice(0, 10);

        // Set the value of the input field to the current date
        document.getElementById('currentDate').value = currentDate;

        document.addEventListener("DOMContentLoaded", function() {
            var attendanceButton = document.getElementById('attendanceButton');
            var timeInField = document.getElementById('timeIn');
            var timeOutField = document.getElementById('timeOut');
            var totalDurationField = document.getElementById('totalDuration');

            // Add event listener to the button
            attendanceButton.addEventListener('click', function() {
                var currentTime = new Date().toLocaleTimeString(); // Get current time in HH:MM:SS format

                if (attendanceButton.textContent === 'Clock In') {
                    timeInField.value = currentTime; // Set the value of Time In field
                    document.getElementById('intimeInput').value = currentTime;
                    attendanceButton.textContent = 'Clock Out'; // Update button text
                    // Show the Time Out field
                    timeOutField.style.display = 'block';
                } else {
                    timeOutField.value = currentTime; // Set the value of Time Out field
                    document.getElementById('outtimeInput').value = currentTime;

                    // Calculate total duration and update the field
                    var timeIn = new Date('1970-01-01 ' + timeInField.value);
                    var timeOut = new Date('1970-01-01 ' + timeOutField.value);
                    var duration = (timeOut - timeIn) / 1000; // Duration in seconds

                    // Convert seconds to HH:MM:SS format
                    var hours = Math.floor(duration / 3600);
                    var minutes = Math.floor((duration % 3600) / 60);
                    var seconds = duration % 60;

                    // Format the duration properly
                    var formattedDuration = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

                    totalDurationField.value = formattedDuration;
                    document.getElementById('totaldurationInput').value = formattedDuration;

                    // Show the Total Duration field
                    totalDurationField.style.display = 'block';

                    // Submit the form
                    document.getElementById('attendanceForm').submit();
                }
            });
        });
    </script>
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
