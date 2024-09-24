
<?php
include 'dbconnection.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
    exit(); // Ensure script stops execution after redirect
}

// Check if a request has already been submitted for the current day
$currentDate = date('Y-m-d');
$checkRequest = $conn->prepare("SELECT COUNT(*) AS count FROM compensation WHERE user_id = ? AND DATE(dateOnRequest) = ?");
$checkRequest->execute([$user_id, $currentDate]);
$requestCount = $checkRequest->fetchColumn();

if ($requestCount > 0) {
    // If a request has already been submitted for the current day, display an error message
    $errorMessage = "A Request has Already been Submitted Today. You cannot submit more than one request per day.";
    echo "<script>alert('$errorMessage'); window.location='empdash.php';</script>";
    exit(); // Stop further execution
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    // Perform form validation and database insertion here
    // Remember to store the date of the request in the database
    // Example: Insert the request into the database
    $insertRequest = $conn->prepare("INSERT INTO compensation (user_id, date_requested) VALUES (?, ?)");
    $insertRequest->execute([$user_id, $currentDate]);
    // Redirect to dashboard or perform other actions after request submission

    header('location:empdash.php');
    exit(); // Ensure script stops execution after redirect
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Compensation Request</title>
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
        

/* Style the custom file input button */
.custom-file-input {
    cursor: pointer;
    padding: 6px 12px;
    display: inline-block;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    touch-action: manipulation;
    user-select: none;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #555;
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
    
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
            <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                <h4 class="text-white" style="margin-top: 200px;"><i class="fas fa-dollar-sign me-2"></i>Compensation Request</h4>
                <img src="" class="img-fluid position-absolute" alt="" />
            </div>
            
                
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                    <?php
                    $select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
                    $select_profile->execute([$user_id]);
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    ?>
                <form id="form" action="request.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
                           <div class="row pb-4 mt-4">
                            <h4>
                                <center>REQUEST FORM </center>
                            </h4>
                        </div>
                        <!-- Employee ID -->
                        <div class="row g-2 m-3">
                             <label for="empRec" class="form-label">Employee Code</label>
                             <input type="text" class="form-control" name="empRec" id="empRec" onkeyup="validateEmpCode(event)" maxlength="6" minlength="6" onblur="validateEmpCode(event)" value="<?= $fetch_profile['empRec']; ?>" readonly>
                        </div>

                        <!-- Employee Name -->
                        <div class="row g-2 m-3">
                        <label for="empName" class="form-label">Employee Name</label>             
                                <input type="text" class="form-control" name="empName" id="empName" minlength="3" maxlength="30" onkeyup="empNamevalidation(event)" onblur="empNamevalidation(event)" value="<?= $fetch_profile['empName']; ?>" readonly>
                        </div>
                        <div class="row g-2 m-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" name="department" id="department" readonly>
                                <!-- Add options based on your database values -->
                                <option value="<?= $fetch_profile['department']; ?>"><?= $fetch_profile['department']; ?></option>
                            </select>
                        </div>
                        <!-- Designation -->
                        <div class="row g-2 m-3">
                            <label for="designation" class="form-label">Designation</label>
                            <select class="form-select" name="designation" id="designation" readonly>
                                <!-- Add options based on your database values -->
                                <option value="<?= $fetch_profile['designation']; ?>"><?= $fetch_profile['designation']; ?></option>
                            </select>
                        </div>
                        <div class="row g-2 m-3">
                                <label for="email" class="form-label">Email-ID</label>
                                <input type="text" class="form-control" name="email" id="email"  value="<?= $fetch_profile['email']; ?>" readonly>
                                <span id="error" style="color:red"></span>
                            </div>
                        <!-- Claim Type Dropdown -->
                        <div class="row g-2 m-3">
                            <label for="request" class="form-label">Claim Type</label>
                            <select class="form-select" name="request" id="request" onkeydown="requestValidation()" onblur="validateField(this)">
                                <option value="">Choose Here</option>
                                <option value="medical">Medical</option>
                                <option value="health">Health</option>
                             
                            </select>
                            <span id="error_request" style="color:red"></span>
                        </div>

                        
                        <!-- Health Insurance Number -->
                        <div class="row g-2 m-3">
                            <label for="healthInsuranceNumber" class="form-label">Insurance Number</label>
                            <input type="text" class="form-control" name="healthInsuranceNumber" id="healthInsuranceNumber" minlength="2" maxlength="10" onkeyup="healthInsuranceNumberValidation()"onblur="validateField(this)">
                            <span id="error_healthInsuranceNumber" style="color:red"></span>
                        </div>
                        <div class="row g-2 m-3">
                            <label for="documentInput" class="form-label">Required Documents</label>
                            <input type="file" name="documentInput" id="documentInput" class="form-control" onchange="validateDocument()" onblur="validateField(this)">
                            <span id="error_documentInput" style="color:red"></span> <!-- Corrected id here -->
                        </div>
                                           
                        <!-- Reimbursement Amount -->
                        <div class="row g-2 m-3">
                            <label for="amount" class="form-label">Reimbursement Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" onkeypress="return isNumeric(event)" onkeyup="amountValidation()" onblur="validateField(this)">
                            <span id="error_amount" style="color:red"></span>
                        </div>

                        <script>
                            function isNumeric(event) {
                                return /^[0-9]*$/.test(event.key);
                            }
                        </script>

                        <!-- Date On Request -->
                        <div class="row g-2 m-3">
                            <label for="dateOnRequest" class="form-label">Date On Request</label>
                            <input type="date" class="form-control" name="dateOnRequest" id="dateOnRequest" style="width: 100%" value="<?php echo date('Y-m-d'); ?>" onkeyup="dateValidation()" onblur="validateField(this)">
                            <span id="error_dateOnRequest" style="color:red"></span>
                        </div>
                        <!-- Reason -->
                        <div class="row g-2 m-3">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" name="reason" id="reason" style="width: 100%" rows="3" onkeyup="reasonValidation()" onblur="validateField(this)"></textarea>
                            <span id="error_reason" style="color:red"></span>
                        </div>
                        
                      
                        <div class="row pt-2 ">
                            <div class="col-md-12 text-center ">
                            <input type="hidden" name="user_id" value="<?php echo isset($employeeDetails['id']) ?$employeeDetails['id'] : "" ?>">
                            <button type="submit" class="btn btn-primary">Request</button>
                                <button type="reset" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <div id="success-msg" style="color:green"></div>
                    <div id="error-msg" style="color:red"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function showError(inputElement, errorElement, errorMessage) {
        errorElement.innerHTML = errorMessage;
        addErrorClass(inputElement);
    }

    function hideError(inputElement, errorElement) {
        errorElement.innerHTML = "";
        removeErrorClass(inputElement);
    }

    function validateForm() {
    var formValid = true;

    // Get references to the input fields
    var requestInput = document.getElementById('request');
    var healthInsuranceNumberInput = document.getElementById('healthInsuranceNumber');
    var documentInput = document.getElementById('documentInput');
    var amountInput = document.getElementById('amount');
    var dateOnRequestInput = document.getElementById('dateOnRequest');
    var reasonInput = document.getElementById('reason');

    // Get references to the error message elements
    var error_request = document.getElementById('error_request');
    var error_healthInsuranceNumber = document.getElementById('error_healthInsuranceNumber');
    var error_documentInput = document.getElementById('error_documentInput');
    var error_amount = document.getElementById('error_amount');
    var error_dateOnRequest = document.getElementById('error_dateOnRequest');
    var error_reason = document.getElementById('error_reason');

    // Call individual validation functions for each field
    var requestValid = requestValidation();
    var healthInsuranceNumberValid = healthInsuranceNumberValidation();
    var documentValid = validateDocument();
    var amountValid = amountValidation();
    var dateOnRequestValid = dateValidation();
    var reasonValid = reasonValidation();

    // Update formValid based on individual field validations
    formValid = requestValid && healthInsuranceNumberValid && documentValid && amountValid && dateOnRequestValid && reasonValid;

    // Call validateField for each field to apply red border if necessary
    validateField(requestInput);
    validateField(healthInsuranceNumberInput);
    validateField(documentInput);
    validateField(amountInput);
    validateField(dateOnRequestInput);
    validateField(reasonInput);

    // If the form is valid, display the success message
    if (formValid) {
        document.getElementById('success-msg').innerText = 'Form submitted successfully.';
    } else {
        // If the form is not valid, display error messages for all fields
        showErrorMessages();
    }

    return formValid;
}
function showErrorMessages() {
    var requestInput = document.getElementById('request');
    var healthInsuranceNumberInput = document.getElementById('healthInsuranceNumber');
    var documentInput = document.getElementById('documentInput');
    var amountInput = document.getElementById('amount');
    var dateOnRequestInput = document.getElementById('dateOnRequest');
    var reasonInput = document.getElementById('reason');

    // Call individual validation functions for each field
    requestValidation() || showError(requestInput, document.getElementById('error_request'), 'Claim Type Is Required');
    validateDocument() || showError(documentInput, document.getElementById('error_documentInput'), 'Document Is Required');
    healthInsuranceNumberValidation() || showError(healthInsuranceNumberInput, document.getElementById('error_healthInsuranceNumber'), 'Insurance Number Is Required');
    amountValidation() || showError(amountInput, document.getElementById('error_amount'), 'Reimbursement amount Is Required');
    dateValidation() || showError(dateOnRequestInput, document.getElementById('error_dateOnRequest'), 'Date Is Required');
    reasonValidation() || showError(reasonInput, document.getElementById('error_reason'), 'Reason Is Required');
  
}

    function addErrorClass(input) {
        input.classList.add("error-input");
    }

    function removeErrorClass(input) {
        input.classList.remove("error-input");
    }

    function requestValidation() {
        var requestInput = document.getElementById('request');
        var error_request = document.getElementById('error_request');

        if (requestInput.value.trim() === "") {
            error_request.innerHTML = "Please select a Claim Type";
            return false;
        } else {
            error_request.innerHTML = "";
            return true;
        }
    }

    var healthInsuranceNumberInput = document.getElementById('healthInsuranceNumber');
    var error_healthInsuranceNumber = document.getElementById('error_healthInsuranceNumber');

    // Add an input event listener to check for spaces and remove them
    healthInsuranceNumberInput.addEventListener('input', function () {
        healthInsuranceNumberInput.value = healthInsuranceNumberInput.value.replace(/\s/g, '');
    });

    function healthInsuranceNumberValidation() {
        var noSpacePattern = /^[^\s]+$/;
        var insuranceNumberPattern = /^[A-Z]{2}\d{8}$/;
        var healthInsuranceNumber = healthInsuranceNumberInput.value.trim();

        if (healthInsuranceNumber === "") {
            error_healthInsuranceNumber.innerHTML = "Insurance Number is required";
            return false;
        } else if (!noSpacePattern.test(healthInsuranceNumber)) {
            error_healthInsuranceNumber.innerHTML = "Spaces are not allowed in the Insurance Number";
            return false;
        } else if (!insuranceNumberPattern.test(healthInsuranceNumber)) {
            error_healthInsuranceNumber.innerHTML = "Invalid Insurance Number format. Please enter two uppercase letters followed by 8 digits.";
            return false;
        } else {
            error_healthInsuranceNumber.innerHTML = "";
            return true;
        }
    }

    function amountValidation() {
        var amountInput = document.getElementById('amount');
        var error_amount = document.getElementById('error_amount');
        var amountValue = parseFloat(amountInput.value);

        if (amountInput.value.trim() === "") {
            error_amount.innerHTML = "Reimbursement Amount is required";
            return false;
        } else if (isNaN(amountValue) || amountValue < 1000 || amountValue > 100000) {
            showError(amountInput, error_amount, 'Reimbursement amount must be between 1000 and 100000');
            return false;
        } else {
            hideError(amountInput, error_amount);
            return true;
        }
    }

    function dateValidation() {
        var dateOnRequestInput = document.getElementById('dateOnRequest');
        var error_dateOnRequest = document.getElementById('error_dateOnRequest');
        var dateOnRequest = dateOnRequestInput.value;

        if (dateOnRequest === "") {
            showError(dateOnRequestInput, error_dateOnRequest, "Date On Request is required");
            return false;
        } else {
            var currentDate = new Date();
            var selectedDate = new Date(dateOnRequest);

            if (
                selectedDate.getFullYear() !== currentDate.getFullYear() ||
                selectedDate.getMonth() !== currentDate.getMonth() ||
                selectedDate.getDate() !== currentDate.getDate()
            ) {
                showError(dateOnRequestInput, error_dateOnRequest, "Date must be the current date");
                return false;
            } else {
                hideError(dateOnRequestInput, error_dateOnRequest);
                return true;
            }
        }
    }
    var reasonInput = document.getElementById('reason');
var error_reason = document.getElementById('error_reason');

// Add an input event listener to handle spaces at the start
reasonInput.addEventListener('input', function () {
    var currentInput = reasonInput.value;

    if (currentInput.startsWith(' ')) {
        // If the input starts with a space, remove it
        reasonInput.value = currentInput.trimStart();
    }
});
function reasonValidation() {
    var reasonValue = reasonInput.value.trim();

    if (reasonValue === "") {
        error_reason.innerHTML = "Reason is required";
        return false;
    } else if (reasonValue.length < 10 || reasonValue.length > 150) {
        error_reason.innerHTML = "Reason must be between 10 and 150 characters";
        return false;
    } else if (
        /[^A-Za-z0-9]/.test(reasonValue.charAt(0)) || // Check if the first character is a special character
        /\s{2,}/.test(reasonValue) ||
        /([.,-][^.,-]*[.,-]){2,}/.test(reasonValue)
    ) {
        error_reason.innerHTML = "Invalid input: Avoid consecutive spaces, or use only one dot, one comma, and one hyphen at a time. Also, do not start with a special character.";
        return false;
    } else {
        error_reason.innerHTML = "";
        return true;
    }
}
    function validateField(input) {
        var value = input.value.trim();
        var errorElementId = "error_" + input.id;

        var errorElement = document.getElementById(errorElementId);
        if (!errorElement) {
            console.error("Error element not found: " + errorElementId);
            return;
        }

        if (value === "") {
            errorElement.innerHTML = "This field is required";
            addErrorClass(input);
        } else {
            errorElement.innerHTML = "";
            removeErrorClass(input);
        }
    }

    function addErrorClass(input) {
        input.classList.add("error-input");
    }

    function removeErrorClass(input) {
        input.classList.remove("error-input");
    }


    function validateDocument() {
    var input = document.getElementById('documentInput');
    var errorSpan = document.getElementById('error_documentInput');

    if (input.files.length > 0) {
        var file = input.files[0];

        if (file.type !== 'application/pdf') {
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