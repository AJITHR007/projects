<?php
include 'dbconnection.php';

session_start();


$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit;
}

// Fetch user profile from the database
$select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Leave Request</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .row .error-input {
            border-color: red;
        }

        .row input,
        .row select {
            border-color: #8F4B84;
        }

        .row textarea {
            border-color: #8F4B84;
            background-color: #fff;
            /* Set the background color to white or any other desired color */
        }

        #closeButton {
            position: fixed;
            top: 20px;
            /* Adjust the top position as needed */
            right: 20px;
            /* Adjust the right position as needed */
            z-index: 9999;
            /* Ensure it's above other elements */
        }
    </style>
</head>

<body>
    <img src="" class="img-fluid position-absolute" alt="" />
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                    <h4 class="text-white" style="margin-top: 200px;"><i class="fas fa-calendar-alt"></i> Leave
                        Request</h4>
                    <img src="" class="img-fluid position-absolute" alt="" />
                </div>

                <div class="col-md-9 bg-white p-3 rounded-end-2">
                    <form id="form" action="request1.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
                        <div class="row pb-4 mt-4">
                            <h4>
                                <center> LEAVE REQUEST FORM </center>
                            </h4>
                        </div>
                        <div class="row g-2 m-3">
                            <label for="empRec" class="form-label">Employee code</label>
                            <input type="text" id="empRec" name="empRec" class="form-control"
                                value="<?= $fetch_profile['empRec']; ?>" readonly />
                        </div>
                        <div class="row g-2 m-3">
                            <label for="empName" class="form-label">Employee Name</label>
                            <input type="text" id="empName" name="empName" class="form-control"
                                value="<?= $fetch_profile['empName']; ?>" readonly />
                        </div>
                        <div class="row g-2 m-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" name="department" id="department" readonly>
                                <!-- Add options based on your database values -->
                                <option value="<?= $fetch_profile['department']; ?>">
                                    <?= $fetch_profile['department']; ?></option>
                            </select>
                        </div>
                        <div class="row g-2 m-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control"
                                value="<?= $fetch_profile['email']; ?>" readonly />
                        </div>
                        <div class="row g-2 m-3">
                            <label for="leave_type" class="form-label">Leave Type</label>
                            <select class="form-select" name="leave_type" id="leave_type" onkeydown="leave_typeValidation()" onblur="leave_typeValidation(event)" >
                                <option selected value="">Choose here...</option>
                                <option value="casual leave">Casual Leave</option>
                                <option value="sick leave">Sick Leave</option>
                            </select>
                            <span id="error_leave_type" style="color:red"></span>
                        </div>
                        <div class="row g-2 m-3">
                            <label for="leave_start" class="form-label">Leave Start</label>
                            <input type="date" class="form-control" name="leave_start" id="leave_start"
                                oninput="calculateTotalDays()" onkeyup="leave_startValidation(event)" onblur="leave_startValidation(event)" >
                            <span id="error_leave_start" style="color:red"></span>
                        </div>
                        <div class="row g-2 m-3">
                            <label for="leave_end" class="form-label">Leave End</label>
                            <input type="date" class="form-control" name="leave_end" id="leave_end"
                                maxlength="10" oninput="calculateTotalDays()" onkeyup="leave_endValidation(event)" onblur="leave_endValidation(event)" >
                            <span id="error_leave_end" style="color:red"></span>
                        </div>
                        <div class="row g-2 m-3">
                            <label for="total_days" class="form-label">Total Days</label>
                            <input type="text" class="form-control" name="total_days" id="total_days" readonly>
                            <span id="error_total_days" style="color:red"></span>
                        </div>

                        <div class="row g-2 m-3">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" name="reason" id="reason" rows="3" 
                            onkeyup="reasonValidation(event)" onblur="reasonValidation(event)"></textarea>
                            <span id="error_reason" style="color:red"></span>
                        </div>
                        <div class="row g-2 m-3">
                <label for="documentInput" class="form-label">Required Documents</label>
                        <input type="file" name="documentInput" id="documentInput" accept=".pdf " class="form-control" onchange="validateDocument()" >
                        <span id="error_documentInput" style="color:red"></span>
                </div>
                        <div class="row pt-2">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"> Request</button>
                                <button type="reset" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <div id="success-msg" style="color:green">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
<script>
    function calculateTotalDays() {
        var leaveStart = document.getElementById("leave_start").value;
        var leaveEnd = document.getElementById("leave_end").value;

        // Check if both leave start and end dates are provided
        if (leaveStart && leaveEnd) {
            var startDate = new Date(leaveStart);
            var endDate = new Date(leaveEnd);

            // Calculate the difference in milliseconds
            var timeDifference = endDate.getTime() - startDate.getTime();

            // Convert the difference to days
            var totalDays = Math.ceil(timeDifference / (1000 * 3600 * 24)+1);

            // Display the total days in the corresponding input field
            document.getElementById("total_days").value = totalDays;
        } else {
            // If either leave start or end date is not provided, clear the total days field
            document.getElementById("total_days").value = "";
        }
    }
</script>
 <script>
        window.onload = function() {
            const form = document.querySelector("form");
            const leave_typeInput = document.getElementById("leave_type");
            const leave_startInput = document.getElementById("leave_start");
            const leave_endInput = document.getElementById("leave_end");
            const reasonInput = document.getElementById("reason");
            const documentInput = document.getElementById("documentInput"); // Corrected id for document input
            const errorLeave_type = document.getElementById("error_leave_type");
            const errorDocument = document.getElementById("error_documentInput"); // Corrected id for error message
            const errorLeave_start = document.getElementById("error_leave_start");
            const errorLeave_end = document.getElementById("error_leave_end");
            const errorReason = document.getElementById("error_reason");

           
        form.addEventListener("submit", function(event) {
            event.preventDefault();
    
            if (validateForm()) {
                form.submit();
            }
        });
        leave_typeInput.addEventListener("change", function (event) {
            leave_typeValidation(event);
        });
        leave_typeInput.addEventListener("blur", function (event) {
            leave_typeValidation(event);
        });
    
       leave_startInput.addEventListener("change", function (event) {
            leave_startValidation(event,leave_startInput,errorLeave_start);
          });
        
          leave_startInput.addEventListener("blur", function (event) {
            leave_startValidation(event,leave_startInput,errorLeave_start);
          });
          
          leave_endInput.addEventListener("change", function (event) {
            leave_endValidation(event,leave_endInput,errorLeave_end);
          });
          leave_endInput.addEventListener("blur", function (event) {
            leave_endValidation(event, leave_endInput,errorLeave_end);
          });
        
         
          
          reasonInput.addEventListener("blur", function (event) {
            reasonValidation(event);
        });
    
        reasonInput.addEventListener("input", function (event) {
            reasonValidation(event);
        });
         function calculateTotalDays() {
                const leaveStartDate = new Date(leave_startInput.value);
                const leaveEndDate = new Date(leave_endInput.value);

                // Check if both dates are valid
                if (!isNaN(leaveStartDate.getTime()) && !isNaN(leaveEndDate.getTime())) {
                    // Calculate the difference in days
                    const timeDifference = leaveEndDate.getTime() - leaveStartDate.getTime();
                    const totalDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)+1);

                    // Display the total days
                    document.getElementById("total_days").value = totalDays;
                } else {
                    // If either date is invalid, reset total days
                    document.getElementById("total_days").value = "";
                }
            }

            function validateForm() {
                let isValid = true;
                const totalDays = parseInt(document.getElementById('total_days').value);

                if (totalDays > 2 && documentInput.files.length === 0) {
                    showError(documentInput, errorDocument, 'Document is required for leaves more than 2 days.');
                    isValid = false;
                } else {
                    hideError(documentInput, errorDocument);
                }

                  
            if (leave_typeInput.value.trim() === "") {
                showError(leave_typeInput, errorLeave_type, "Leave type  is required"); // Provide errorElement argument
                isValid = false;
            } else {
                hideError(leave_typeInput, errorLeave_type);
            }
             
            if (leave_endInput.value.trim() === "") {
    showError(leave_endInput, errorLeave_end, "Leave end Date is Required");
    isValid = false;
} else {
    const currentDate = new Date();
    const selectedEndDate = new Date(leave_endInput.value);
    const selectedStartDate = new Date(leave_startInput.value);
    
    // Check if the selected date is within the current month and year
    const isCurrentMonthAndYear = (
        selectedEndDate.getMonth() === currentDate.getMonth() &&
        selectedEndDate.getFullYear() === currentDate.getFullYear()
    );
    
    // Calculate the date three months ago from the current date
    const threeMonthsAgo = new Date(currentDate);
    threeMonthsAgo.setMonth(currentDate.getMonth() - 3);
    
    if (!isCurrentMonthAndYear && selectedEndDate < threeMonthsAgo) {
        showError(leave_endInput, errorLeave_end, "Please choose a date within the current year, or the previous 3 months");
        isValid = false;
    } else if (selectedEndDate < selectedStartDate) {
        showError(leave_endInput, errorLeave_end, "End date cannot be before the start date");
        isValid = false;
    } else {
        hideError(leave_endInput, errorLeave_end);
    }
}

            
            if (leave_startInput.value.trim() === "") {
                showError(leave_startInput, errorLeave_start, "Leave start Date is Required");
                isValid = false;
            } else {
                const currentDate = new Date();
                const selectedDate = new Date(leave_startInput.value);
            
                // Check if the selected date is within the current month and year
                const isCurrentMonthAndYear = (
                    selectedDate.getMonth() === currentDate.getMonth() &&
                    selectedDate.getFullYear() === currentDate.getFullYear()
                );
            
                // Calculate the date three months ago from the current date
                const threeMonthsAgo = new Date(currentDate);
                threeMonthsAgo.setMonth(currentDate.getMonth() - 3);
            
                if (!isCurrentMonthAndYear && selectedDate < threeMonthsAgo) {
                    showError(leave_startInput, errorLeave_start, "Please choose a date within the current year, or the previous 3 months");
                    isValid = false;
                } else {
                    hideError(leave_startInput, errorLeave_start);
                }
            }
       
    
            const reason = reasonInput.value;

            if (reason === "") {
                showError(reasonInput, errorReason, "Reason  is Required");
                isValid = false;
            } else if (reason.startsWith(" ")) {
                showError(reasonInput, errorReason, 'Reason  should not start with a space.');
                isValid = false;
                hideErrorMessageOnFocus('reason', 'error_reason');
            } else if (/\s{2,}/.test(reasonInput.value)) {
                showError(reasonInput, errorReason, 'Reason  should not contain consecutive spaces.');
                isValid = false;
                hideErrorMessageOnFocus('reason', 'error_reason');
            } else if (reason.length < 5) {
                showError(reasonInput, errorReason, 'Reason should be at least 5 characters.');
                isValid = false;
                hideErrorMessageOnFocus('reason', 'error_reason');
            } else if (reason.length > 250) {
                showError(reasonInput, errorReason, 'Reason should not exceed 250 characters.');
                isValid = false;
                hideErrorMessageOnFocus('reason', 'error_reason');
            } else {
                hideError(reasonInput, errorReason);
            }
        
                return isValid;
            }
            
    function leave_typeValidation() {
        const leave_typeInput = document.getElementById('leave_type');
        const error_leave_type = document.getElementById('error_leave_type');

             
            if (leave_typeInput.value.trim() === "") {
                showError(leave_typeInput, errorLeave_type, "Leave type  is required"); // Provide errorElement argument
                isValid = false;
            } else {
                hideError(leave_typeInput, errorLeave_type);
            }
        }

            function leave_startValidation(event) {
            const leave_startInput = event.target;
            const errorElement = document.getElementById("error_leave_start");
            const leave_endInput = document.getElementById("leave_end"); // Assuming the ID is "leave_end" for the leave end date input
        
            if (leave_startInput.value.trim() === "" || leave_startInput.value.startsWith(" ")) {
                showError(leave_startInput, errorElement, "Please fill in the field.");
            } else {
                const currentDate = new Date();
                const inputStartDate = new Date(leave_startInput.value);
        
                // Calculate the date three months ago from the current date
                const threeMonthsAgo = new Date(currentDate);
                threeMonthsAgo.setMonth(currentDate.getMonth() - 3);
        
                // Calculate the date one year in the future from the current date
                const nextYear = new Date(currentDate);
                nextYear.setFullYear(currentDate.getFullYear() + 1);
        
                // Check if the input date is within the previous 3 months and up to one year in the future
                if (inputStartDate < threeMonthsAgo || inputStartDate > nextYear) {
                    showError(leave_startInput, errorElement, "Please enter a date within the previous 3 months and up to one year in the future.");
                } else {
                    hideError(leave_startInput, errorElement);
        
                    // If leave end date is specified, check if it's after leave start date
                    if (leave_endInput.value.trim() !== "") {
                        const inputEndDate = new Date(leave_endInput.value);
                        if (inputEndDate <= inputStartDate) {
                            showError(leave_endInput, document.getElementById("error_leave_end"), "End date must be after start date and within the allowed range.");
                        } else {
                            hideError(leave_endInput, document.getElementById("error_leave_end"));
                        }
                    }
                }
            }
        }
        
        function leave_endValidation(event) {
            const leave_endInput = event.target;
            const errorElement = document.getElementById("error_leave_end");
            const leave_startInput = document.getElementById("leave_start"); // Assuming the ID is "leave_start" for the leave start date input
        
            if (leave_endInput.value.trim() === "" || leave_endInput.value.startsWith(" ")) {
                showError(leave_endInput, errorElement, "Please fill in the field.");
            } else {
                const currentDate = new Date();
                const inputEndDate = new Date(leave_endInput.value);
        
                // Calculate the date three months ago from the current date
                const threeMonthsAgo = new Date(currentDate);
                threeMonthsAgo.setMonth(currentDate.getMonth() - 3);
        
                // Calculate the date one year in the future from the current date
                const nextYear = new Date(currentDate);
                nextYear.setFullYear(currentDate.getFullYear() + 1);
        
                // Check if the input date is within the previous 3 months and up to one year in the future
                if (inputEndDate < threeMonthsAgo || inputEndDate > nextYear) {
                    showError(leave_endInput, errorElement, "Please enter a date within the previous 3 months and up to one year in the future.");
                } else {
                    hideError(leave_endInput, errorElement);
        
                    // If leave start date is specified, check if it's before leave end date
                    if (leave_startInput.value.trim() !== "") {
                        const inputStartDate = new Date(leave_startInput.value);
                        if (inputEndDate < inputStartDate) {
                            showError(leave_endInput, document.getElementById("error_leave_end"), "End date must be after start date and within the allowed range.");
                        } else {
                            hideError(leave_endInput, document.getElementById("error_leave_end"));
                        }
                    }
                }
            }
        }
        
        function reasonValidation(event) {
    const errorElement = document.getElementById("error_reason");
    const reasonInput = document.getElementById("reason");
    const reason = reasonInput.value;

    if (reason === "") {
        showError(reasonInput, errorElement, "Reason is Required");
        isValid = false; // Make sure isValid is defined elsewhere
    } else if (reason.startsWith(" ")) {
        showError(reasonInput, errorElement, 'Reason should not start with a space.');
        isValid = false; // Make sure isValid is defined elsewhere
        hideErrorMessageOnFocus('reason', 'error_reason'); // If defined
    } else if (/\s{2,}/.test(reason)) {
        showError(reasonInput, errorElement, 'Reason should not contain consecutive spaces.');
        isValid = false; // Make sure isValid is defined elsewhere
        hideErrorMessageOnFocus('reason', 'error_reason'); // If defined
    } else if (reason.length < 5) {
        showError(reasonInput, errorElement, 'Reason should be at least 5 characters.');
        isValid = false; // Make sure isValid is defined elsewhere
        hideErrorMessageOnFocus('reason', 'error_reason'); // If defined
    } else if (reason.length > 250) {
        showError(reasonInput, errorElement, 'Reason should not exceed 250 characters.');
        isValid = false; // Make sure isValid is defined elsewhere
        hideErrorMessageOnFocus('reason', 'error_reason'); // If defined
    } else {
        hideError(reasonInput, errorElement); // If defined
    }
}
            function showError(inputElement, errorElement, errorMessage) {
                inputElement.classList.add("error-input");
                errorElement.textContent = errorMessage;
                errorElement.classList.remove("hide");
                errorElement.classList.add("show");
            }

            function hideError(inputElement, errorElement) {
                inputElement.classList.remove("error-input");
                errorElement.classList.remove("show");
                errorElement.classList.add("hide");
                errorElement.textContent = "";
            }
        };
        function validateDocument() {
    var input = document.getElementById('documentInput');
    var errorSpan = document.getElementById('error_documentInput');

    if (input.files.length > 0) {
        var file = input.files[0];
        var fileName = file.name.toLowerCase();

        // Check if the file is a PDF
        if (!fileName.endsWith('.pdf')) {
            showError(input, errorSpan, 'Please upload a PDF document.');
            input.value = '';
            return false;
        }

        var fileSizeKB = file.size / 1024; // Convert size to KB

        if (fileSizeKB < 100 || fileSizeKB > 1024 * 1) { // Check size range in KB (1 MB = 1024 KB)
            showError(input, errorSpan, 'Document size must be between 100 KB and 1 MB.');
            input.value = '';
            return false;
        }

        hideError(input, errorSpan);
        return true;
    } else {
        showError(input, errorSpan, 'Please select a document.');
        return false;
    }
}

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