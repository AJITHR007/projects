<?php

include 'dbconnection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:adminlogin.php');
}

// Fetch all Leave requests from the database
$selectRequests = $conn->prepare("SELECT id, empRec, empName, department, designation, email, leave_type, leave_start, leave_end, total_days,documentInput, status, reason FROM leave_approvals");
$selectRequests->execute();
$requests = $selectRequests->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Admin View - Leave Approvals Requests</title>
    <style>
            body {
               font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
                }

                    .container {
                        max-width: 100%;
                        margin: 20px auto;
                    }

                    h3 {
                        text-align: center;
                        color: black;
                        margin-top: 20px;
                    }

                    .table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    .table th,
                    .table td {
                        border: 1px solid #dee2e6;
                        padding: 12px;
                        text-align: center;
                    }

                    .table th {
                        background-color: #249bb3;
                        color: #fff;
                    }

                    .table tbody {
                        background-color: lightgray; /* Set the background color for the entire tbody */
                    }

                    .table tbody tr:hover {
                        background-color: #f2f2f2; /* Adjust hover color as needed */
                    }
                    .btn {
                        padding: 8px 16px;
                        cursor: pointer;
                        border: none;
                        border-radius: 4px;
                    }

                    .btn-success {
                        background-color: #28a745;
                        color: #fff;
                    }

                    .btn-danger {
                        background-color: #dc3545;
                        color: #fff;
                    }

                    .btn-warning {
                        background-color: #ffc107;
                        color: #333;
                    }
                    .date-column {
                        width: 150px;
                    }
                    .btn-approved {
                        background-color: #28a745;
                        color: #fff;
                    }
                    .btn-denied {
                        background-color: #dc3545;
                        color: #fff;
                    }
                    .table th:nth-child(1),
                    .table th:nth-child(8) {
                        white-space: nowrap; /* Prevent text wrapping */
                        max-width: 150px; /* Adjust the maximum width as needed */
                    }

                    .table th:nth-child(10) {
                        white-space: nowrap; /* Prevent text wrapping */
                        max-width: 120px; /* Adjust the maximum width as needed */
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
    <h3>Admin View - Leave Requests</h3>
    <section class="vertical-center">
        <div class="container m-0">
            <div class="row rounded">
                    <table class="table">
       
        <thead>
            <tr>
                <th>Employee Code</th>
                <th>Name</th>
                <th>Department</th>
                <th>Email</th>
                <th>Leave Type</th>
                <th>Start</th>
                <th>End</th>
                <th>Total days</th>
                <th>Reason</th>
                <th>Document</th>
                <th scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($requests as $request) : ?>
                <tr>
                    
                    <td><?= $request['empRec']; ?></td>
                    <td><?= $request['empName']; ?></td>
                    <td><?= $request['department']; ?></td>
                    <td><?= $request['email']; ?></td>
                    <td><?= $request['leave_type']; ?></td>
                    <td><?= $request['leave_start']; ?></td>
                    <td><?= $request['leave_end']; ?></td>
                    <td><?= $request['total_days']; ?></td>
                    <td><?= $request['reason']; ?></td>
                    <td>
                    <?php
                    // Check if a document is available
                    if (!empty($request['documentInput'])) {
                        echo '<a href="/final/uploads/' . $request['documentInput'] . '" target="_blank">View Document</a>';

                    } else {
                        echo 'No Document';
                    }
                    ?>
                </td>
                    <td>
                    <button class='btn btn-success' data-request-id="<?php echo $request['id']?>" onclick='approveRequest(<?= $request['id']; ?>)'>Approve</button>
                   
                    </td>
                    <td>
                    <button class='btn btn-danger'  data-request-id="<?php echo $request['id']?>"onclick='denyRequest(<?= $request['id']; ?>)'>Deny</button>
                    </td>
                    
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
      
      $(document).ready(function () {
        // Fetch and update the status for all requests
        var ids = <?= json_encode(array_column($requests, 'id'))?>; 
        var stringifiedIds = <?= json_encode(array_map('strval', array_column($requests, 'id'))); ?>;
        $.ajax({
            type: 'GET',
            url: 'getStatus1.php',
            data: { requestIds: JSON.stringify(stringifiedIds)},
            traditional: true, // Add this line to ensure proper serialization of the array
            success: function (response) {
                try {
                    const parsedResponse = JSON.parse(response);
                    // console.log(parsedResponse);
                    if (parsedResponse.statuses) {
                        console.log(parsedResponse.statuses)
                        // Iterate through each request and update the button status
                        $.each(parsedResponse.statuses, function (index, statusData) {
                            
                            updateButtonStatus(statusData.id, statusData.status);
                        });
                    } else {
                        console.log('Invalid response from server:', parsedResponse);
                    }
                } catch (error) {
                    console.log('Error parsing JSON:', error);
                }
            }
        });
    });

    function updateButtonStatus(requestId, status) {

        
    // Update the button text based on the status
    const approveButton = $(`button[data-request-id="${requestId}"].btn-success`);
    const denyButton = $(`button[data-request-id="${requestId}"].btn-danger`);
    //const pendingButton = $(`button[data-request-id="${requestId}"].btn-warning`);

    // Disable all buttons
    // if(status == 1 ){
    //     approveButton.prop('disabled', true);
    // }
    // if(status == 0){
    //     denyButton.prop('disabled', true);
    // }
    // if(status == 2){
    //     pendingButton.prop('disabled', true);
    // }

    if(status !== null){
        approveButton.prop('disabled', true);
        denyButton.prop('disabled', true);
        //pendingButton.prop('disabled', true);
    }

    // Update button text and style based on the status
    switch (status) {
        case '1':
            approveButton.text('Approved');
            break;
        case '0':
            denyButton.text('Denied');
            break;
        //case '2':
          //  pendingButton.text('Pending');
            //break;
        default:
            console.log('Invalid status:', status);
    }
}


    function approveRequest(requestId) {
    // Check if the request is already approved, denied, or pending
    if (
        $(`button[data-request-id="${requestId}"].btn-success`).prop('disabled') ||
        $(`button[data-request-id="${requestId}"].btn-danger`).prop('disabled')
        
    ) {
        return; // Do nothing if the button is already disabled
    }

    let postData = {
        leave_approvals_id:requestId, 
        status:1
    }
    // Implement logic to handle approval using AJAX
    $.ajax({
        type: 'POST',
        url: 'approve1.php',
        data:  postData,
        success: function (response) {
            // Update the button status or perform any other actions
            if (response.includes('approved')) {
                // Change the button text to 'Approved' and disable the button
                updateButtonStatus(requestId, '1');
                console.log('Request approved');
            } else {
                console.log('Error approving request. Server Response:', response);
            }
        },
        error: function (xhr, status, error) {
            console.log('Failed to communicate with the server. Error:', error);
        }
    });
}

function denyRequest(requestId) {
    // Check if the request is already approved, denied, or pending
    if ($(`button[data-request-id="${requestId}"].btn-success`).prop('disabled') ||
        $(`button[data-request-id="${requestId}"].btn-danger`).prop('disabled')
        ) {
        return; // Do nothing if the button is already disabled
    }

    let postData = {
        leave_approvals_id: requestId,
        status: 0
    }
    // Implement logic to handle denial using AJAX
    $.ajax({
        type: 'POST',
        url: 'deny1.php',
        data: postData,
        success: function(response) {
            // Update the button status or perform any other actions
            if (response.includes('denied')) {
                // Change the button text to 'Denied' and disable the button
                updateButtonStatus(requestId, '0');
                console.log('Request denied');
            } else {
                console.log('Error denying request');
            }
        },
        error: function() {
            console.log('Failed to communicate with the server.');
        }
    });
}
// JavaScript to periodically check for notifications
function checkNotifications() {
    $.ajax({
        url: 'check_notifications.php', // PHP script to check notifications
        method: 'GET',
        success: function(response) {
            // Update the notification icon or count based on the response
            // Example:
            if (response.unread_count > 0) {
                $('.notification-icon').addClass('has-notifications');
            } else {
                $('.notification-icon').removeClass('has-notifications');
            }
        }
    });
}

// Check for notifications every 30 seconds
setInterval(checkNotifications, 30000); // Adjust the interval as needed


</script>
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
