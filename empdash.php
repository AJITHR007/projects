<?php

include 'dbconnection.php';

session_start();


$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
     <link rel="stylesheet" href="dash.css">
    <title>Employee Dashboard</title>
    <style>
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
.benefit {
    margin-bottom: 30px;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
    width:50%;
    margin-left:25px;
}

.benefit:hover {
    box-shadow: 0px 0px 10px #ff00f7;
}

.benefit h4 {
    color: #333;
    font-size: 20px;
    margin-bottom: 10px;
}

.benefit p {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
}
.flexcard{
    justify-content:space-between;
    display:flex;
    flex-direction:row;

}
</style>
</head>

<body>
<?php
             $select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
             $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
             ?>         
   <div class="header">
    <div class="menu">
        <div class="menu-line"></div>
        <div class="menu-line "></div>
        <div class="menu-line "></div>
    </div>
    <div class="logo">
        <img src="assets/pic4.webp" alt="Logo">
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
                <span><?= $fetch_profile['empName']; ?></span>
            </div>
           
            <div class="item ">
                <a class="sub-btn ">
                    <i class="fas fa-angle-down dropdown " style="color:black; "></i>
                </a>
                <div class="sub-menu ">
                    <a href="http://localhost/final/userprofile.php" class="sub-item "><i class="fas fa-angle-right "></i>My Profile</a>
                    <a href="http://localhost/final/change.php" class="sub-item "><i class="fas fa-angle-right "></i>Change Password</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-body ">
        <div class="side-bar ">
            <div class="item "> <a class="active " href="# "><i class="fas fa-desktop "></i>Dashboard</a></div>
           
            <div class="item ">
                <a class="sub-btn "><i class="fas fa-clipboard-user"></i>Attendance<i class="fas fa-angle-right dropdown "></i></a>
                <div class="sub-menu ">
                <a href="http://localhost/final/attendance.php" class="sub-item "><i class="fas fa-angle-right "></i>Mark Attendance</a>
                </div>
            </div>
            <div class="item ">
                <a class="sub-btn "><i class="fas fa-clock "></i>Leave System<i class="fas fa-angle-right dropdown "></i></a>
                <div class="sub-menu ">
                <a href="http://localhost/final/view.php" class="sub-item "><i class="fas fa-angle-right "></i>Holiday Calendar View</a>
                    <a href="leaverequest.php"><i class="fas fa-angle-right "></i>Leave Request</a>
                </div>
            </div>
            <div class="item ">
                <a class="sub-btn "><i class="fas fa-money-bill "></i>My Pay<i class="fas fa-angle-right dropdown "></i></a>

                <div class="sub-menu ">
                    <a href="http://localhost/final/compensationrequest.php"><i class="fas fa-angle-right "></i>Compensation Request</a>
                    <a href="payslipuser.php"><i class="fas fa-angle-right "></i>My Pay Slip</a>
                </div>
            </div>
            
            <div class="item "><a href="http://localhost/final/logout1.php"><i class="fas fa-sign-out-alt "></i>Logout</a></div>
        </div>

        <div class="container-side-area">
        <div class="box1" id="box1">
        <h3>Welcome<?= $fetch_profile['empName']; ?> </h3>
        <h4><?php echo date('l, M j, Y'); ?></h4>
        <div class="box2">
        <h4>Every moment is a fresh beginning</h4>
        </div>
    </div>
            <div class="box3">
                <div class="box3-1">

                </div>
            </div>
            
           <center> <h3>Employee Benefits</h3> </center>
           <div  class="flexcard">
           <div class="benefit">
            <h4>Professional Development</h4>
            <p>Tuition reimbursement and training programs to support career growth.</p>
        </div>
        <div class="benefit">
            <h4>Flexible Work Hours</h4>
            <p>Opportunity to choose flexible work schedules to accommodate personal needs.</p>
        </div>
        </div>
        <div  class="flexcard">
            <div class="benefit">
            <h4>Health Insurance</h4>
            <p>Comprehensive health coverage including medical, dental, and vision.</p>
        </div>
        <div class="benefit">
            <h4>Retirement Plan</h4>
            <p>401(k) retirement savings plan with employer matching contributions.</p>
        </div>
</div>
<div  class="flexcard">
        <div class="benefit">
            <h4>Paid Time Off (PTO)</h4>
            <p>Generous paid time off policy for vacation, sick leave, and holidays.</p>
        </div>
        <div class="benefit">
        <h4>New Benefit</h4>
        <p>A remote work allowance that enables employees to create a productive home office environment. </p>
    </div>
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

                box1.innerHTML = `<h3>Welcome  <?= $fetch_profile['empName']; ?></h3>
                              <h4>${formattedDate}</h4>
                              <div class="box2">
                              <h4>Every moment is a fresh beginning</h4>
                              </div>`;
            }

            // Call the function to update the day on page load
            updateDay();

            // Update the day every second (you can adjust the interval as needed)
            setInterval(updateDay, 1000);
        });
    </script> <script>

$(document).ready(function() {
    // Click event handler for the close button
    $('#closeButton').click(function() {
        // Make an AJAX request to mark notifications as read
        $.ajax({
            url: 'mark_notifications_as_read.php',
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
            url: 'check_notifications.php',
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