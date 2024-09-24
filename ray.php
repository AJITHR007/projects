<?php
include 'dbconnection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:adminlogin.php');
    exit(); // Terminate script after redirection
}

// Fetch data for active and inactive employees from the database
$stmt = $conn->prepare("SELECT COUNT(*) AS total, active FROM recordadd GROUP BY active");
$stmt->execute();
$employee_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$active_total = 0;
$inactive_total = 0;

foreach ($employee_data as $data) {
    if ($data['active'] == 0) {
        $active_total += $data['total']; // Accumulate the count of active employees
    } elseif ($data['active'] == 1) {
        $inactive_total += $data['total']; // Accumulate the count of inactive employees
    }
}
$totalEmployees = $active_total + $inactive_total;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="ray.css">
    <title>Admin Dashboard</title>
    <style>
        .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
   
    padding: 20px;
    border-radius: 10px;
}

#employeeChart {
    width: 100%; /* Adjust the width as needed */
    max-width: 350px; /* Adjust the maximum width as needed */
    height: auto;
}

body {
    overflow: hidden; /* Hide the scrollbars */
}

.employee-stats {
    background-color: #249bb3;
    padding: 20px; /* Reduce the padding to decrease the space */
    border-radius: 5px;
    box-shadow: 0 0 10px rgb(16 16 16);
    width: 100%; /* Ensure full width */
    max-width: 400px; /* Set a maximum width */
    color: #fff; /* Set text color */
    margin-bottom: 20px;
}

.employee-stats h2 {
    text-align: center;
    margin-bottom: 10px; /* Reduce the bottom margin */
    font-size: 24px;
}
.employee-table {
    width: 100%;
}

.employee-table tr {
    border-bottom: 1px solid #ddd;
}

.employee-table td {
    padding: 10px;
}

.active-employees {
    background-color: green; /* Blue background for active employees */
    color: #fff; /* White text color for active employees */
}

.inactive-employees {
    background-color:#ff00f1; /* Red background for inactive employees */
    color: #fff; /* White text color for inactive employees */
}
#closeButton {
    position: absolute;
    top: 5px;
    right: 225px;
    background-color: transparent;
    border: none;
    font-size: 15px;
    cursor: pointer;
    color: black;
}

/* Style for the close button on hover */
#closeButton:hover {
    color: #ff0000;
    /* Change the color on hover as per your design */
}
    </style>
</head>

<body> 
    <?php
             $select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
             $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
             ?> 
            
    <div class="header">
        <div class="menu">
            <div class="menu-line"></div>
            <div class="menu-line "></div>
            <div class="menu-line "></div>
        </div>
        <div class="logo">
            <img src="assets/pic4.webp">
        </div>
        <div class="profile">
        <div class="notification-icon" id="notificationIcon">
    <i class="fa-solid fa-bell" style="color:black;"></i>
    <span class="unread-count clickable">0</span>
</div>
<div class="notification-dropdown" id="notificationDropdown" style="display: none;">
<button id="closeButton" class="btn-close" aria-label="Close">X</button>

    <div id="notificationMessages">
        <!-- Notification messages will be displayed here -->
    </div>
</div>
        <img class="img-profile" src="<?= $fetch_profile['image']; ?>" alt="Profile Image">
                       
            <div class="user-name ">
                <span><?= $fetch_profile['empName']; ?><br>Admin</span>
            </div>
            <div class="item ">
                <a class="sub-btn ">
                    <i class="fas fa-angle-down dropdown " style="color:black; "></i>
                </a>
                <div class="sub-menu ">
                    <a href="http://localhost/final/myprofle.php" class="sub-item "><i class="fas fa-angle-right "></i>My Profile</a>
                    <a href="changepassword.php" class="sub-item "><i class="fas fa-angle-right "></i>Change Password</a>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="container-body ">
        <div class="side-bar ">
            <div class="item "> <a class="active " href="# "><i class="fas fa-desktop "></i>Dashboard</a></div>
            <div class="item ">
                <a class="sub-btn "><i class="fas fa-users "></i>Employee Management<i class="fas fa-angle-right dropdown "></i></a>
                <div class="sub-menu ">
                    <a href="addentry.php" class="sub-item "><i class="fas fa-angle-right "></i>On Boarding</a>
                    <a href="viewemployee.php" class="sub-item "><i class="fas fa-angle-right "></i>View Employee</a>
             
                </div>
            </div>
            <div class="item ">
                <a class="sub-btn "><i class="fas fa-clock "></i>Leave Management<i class="fas fa-angle-right dropdown "></i></a>
                <div class="sub-menu ">
                <a href="http://localhost/final/calender.php" class="sub-item "><i class="fas fa-angle-right "></i>Holiday Calendar</a>
                    <a href="demo.php"><i class="fas fa-angle-right "></i>Leave Approvals</a>
                </div>
            </div>

            <div class="item ">
                <a class="sub-btn "><i class="fas fa-money-bill "></i>Salary Management<i class="fas fa-angle-right dropdown "></i></a>

                <div class="sub-menu ">
                    <a href="payprocess.php"><i class="fas fa-angle-right "></i>Employee Pay Structure</a>
                    <a href="paymodify.php"><i class="fas fa-angle-right "></i>Employee Pay Modify</a>
                    <a href="http://localhost/final/payslip.php"><i class="fas fa-angle-right "></i>Employees Pay View</a>
                </div>
            </div>

            <div class="item ">
                <a class="sub-btn "><i class="fas fa-user "></i>Claim Management<i class="fas fa-angle-right dropdown "></i></a>
                <div class="sub-menu ">
                    <a href="http://localhost/final/compen.php"><i class="fas fa-angle-right "></i>Compensation Approval</a>
                                   </div>
            </div>
            <div class="item ">
                <a class="sub-btn "><i class="fas fa-clipboard-user"></i>Employee Attendance<i class="fas fa-angle-right dropdown "></i></a>
                <div class="sub-menu ">
                <a href="http://localhost/final/atten.php" class="sub-item "><i class="fas fa-angle-right "></i>View Attendance</a>
                </div>
            </div>
            <div class="item "><a href="http://localhost/final/logout.php"><i class="fas fa-sign-out-alt "></i>Logout</a></div>
        </div>

        <div class="container-side-area ">
        <div class="box1" id="box1">
        <h3>Welcome <?= $fetch_profile['empName']; ?></h3>
        <h4><?php echo date('l, M j, Y'); ?></h4>
        <div class="box2">
        <h4>Every Moment Is a Fresh Beginning</h4>
        </div>
    </div>
            <div class="box3 ">
                <div class="box3-1 ">

                </div>
            </div>
            <div class="container">
                <div class="employee-stats">
                    <h2>Employee Status</h2>
                    <table class="employee-table">
                        <tr>
                            <td>Total Employees</td>
                            <td><?= $totalEmployees ?></td>
                        </tr>
                        <tr class="active-employees">
                            <td>Active Employees</td>
                            <td><?= $active_total ?></td>
                        </tr>
                        <tr class="inactive-employees">
                            <td>Inactive Employees</td>
                            <td><?= $inactive_total ?></td>
                        </tr>
                    </table>
                </div>
                <!-- Adjusted width for the pie chart -->
                <canvas id="employeeChart" width="300" height="300"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menu = document.querySelector('.menu');
            const sidenav = document.querySelector('.side-bar');
            menu.addEventListener('click', () => {
                sidenav.classList.toggle('showmenu');
            });
        });
    </script>
    <script type="text/javascript ">
        $(document).ready(function() {
            //jquery for toggle sub menus
            $('.sub-btn').click(function() {
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update the day in box1
            function updateDay() {
                const box1 = document.getElementById('box1');
                const today = new Date();
                const options = {
                    weekday: 'long',
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                };
                const formattedDate = today.toLocaleDateString('en-US', options);

                box1.innerHTML = `<h3>Welcome   <?= $fetch_profile['empName']; ?></h3>
                              <h4>${formattedDate}</h4>
                              <div class="box2 ">
                              <h4>Every moment is a fresh beginning</h4>
                              </div>`;
            }

            // Call the function to update the day on page load
            updateDay();

            // Update the day every second (you can adjust the interval as needed)
            setInterval(updateDay, 1000);
        });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from PHP variables
    const activeEmployees = <?= $active_total ?>;
    const inactiveEmployees = <?= $inactive_total ?>;

    // Render pie chart using Chart.js
    const ctx = document.getElementById('employeeChart').getContext('2d');
    const employeeChart = new Chart(ctx, {
        type: 'pie', // Use pie chart type
        data: {
            labels: ['Active Employees', 'Inactive Employees'],
            datasets: [{
                label: 'Employee Status',
                data: [activeEmployees, inactiveEmployees],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)', // Blue for active employees
                    'rgba(255, 99, 132, 0.6)', // Red for inactive employees
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)', // Blue border for active employees
                    'rgba(255, 99, 132, 1)', // Red border for inactive employees
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Ensure the chart is not stretched
            plugins: {
                legend: {
                    display: true,
                    position: 'right', // Position the legend on the left side
                    labels: {
                        font: {
                            size: 12, // Set the font size
                            weight: 'bold' // Set the font weight to bold
                        },
                        color: 'black' // Set the font color to black
                    }
                },
                title: {
                    display: true,
                    text: 'Employee Status',
                    font: {
                        size: 18, // Set the font size for the title
                        color: 'black' // Set the font color for the title
                    }
                }
            }
        }
    });
});
</script>
<script>

$(document).ready(function() {
    // Click event handler for the close button
    $('#closeButton').click(function() {
        // Make an AJAX request to mark notifications as read
        $.ajax({
            url: 'mark_notifications_as_read1.php',
            method: 'POST',
            success: function(response) {
                // Hide the dropdown after marking notifications as read
                $('#notificationDropdown').hide();
                // You can also update the unread count if needed
                $('.unread-count').text('0');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log the error for debugging
            }
        });
    });

    // Click event handler for the unread count to display notifications
    $('.unread-count').click(function() {
        $('#notificationDropdown').toggle();
    });

    // Function to fetch and display notifications
    function fetchNotifications() {
        $.ajax({
            url: 'check_notifications1.php',
            method: 'GET',
            success: function(response) {
                var notifications = JSON.parse(response);
                var notificationMessages = $('#notificationMessages');

                notificationMessages.empty();

                if (notifications.length > 0) {
                    notifications.forEach(function(notification) {
                        notificationMessages.append('<div class="notification-item">' + notification.message + '</div>');
                    });

                    $('.unread-count').text(notifications.length);
                } else {
                    notificationMessages.append('<div class="notification-item">No new notifications</div>');
                    $('.unread-count').text('0');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Fetch notifications when the page loads
    fetchNotifications();

    // Check for new notifications every 30 seconds
    setInterval(fetchNotifications, 30000);
});

</script>
</body>

</html>