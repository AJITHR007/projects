<?php
include 'dbconnection.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:adminlogin.php');
    exit(); // Make sure to stop the script after redirecting
}

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$row = [];
$fetch_profile = [];
$empRectosearch = isset($_POST["empRec"]) ? $_POST["empRec"] : ''; // Initialize empRectosearch variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pay_monthtosearch = $_POST["pay_month"];

    if (!empty($empRectosearch)) {
        $sql = "SELECT * FROM payslip WHERE empRec = ? AND pay_month = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $empRectosearch, $pay_monthtosearch);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Fetch additional profile information
            $select_profile = $conn->prepare("SELECT * FROM payslip WHERE id = ?");
            $select_profile->bind_param("i", $row['id']); // Corrected to use "i" for integer
            $select_profile->execute();
            $fetch_profile_result = $select_profile->get_result();

            if ($fetch_profile_result->num_rows > 0) {
                $fetch_profile = $fetch_profile_result->fetch_assoc();
            }
        } 
    } else {
        echo "Employee Code is required for searching.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pay Slip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
 body {
    background-image: url(data:image/jpeg;base64,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);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}

.vertical-center {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 1500px;
    margin-left:50px;
   
}

.container {
    width: 100%;
    max-width: 1500px;
    padding: 0 15px;
}

.purpleBox {
    background-color: #249bb3;
         display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 200px;
        position: relative;
    }
.btn-primary {
    background-color: #249bb3;
    border-color: #8F4B84;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #95598b;
    border-color: #95598b;
}
.table {
    margin-top: 50px;
    width: 100%; /* Adjusted width */
}

h6 {
    margin-top: 20px;
}
.form-container {
    display: flex;
    flex-direction: column;
    margin-top: 50px;
    align-content: center;
    justify-content: space-between;
    align-items: center;
}

.form-container label {
    width: 150px;
    text-align: center;
    margin-bottom: 5px; /* Reduce the bottom margin */
}

.form-container input[type="text"],
.form-container input[type="month"] {
    width: 300px; /* Adjusted width */
    margin-bottom: 10px; /* Reduce the bottom margin */
    padding: 8px; /* Adjusted padding */
    border: 1px solid black;
    border-radius: 5px;
}

.form-container input[type="submit"] {
    width: 150px; /* Adjusted width */
    padding: 8px; /* Adjusted padding */
    background-color: #249bb3;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.form-container input[type="submit"]:hover {
    background-color: #8F4B84;
}

.error-input {
    border: 1px solid red; /* Change the border color to red */
}

.error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px; /* Adjusted margin-top */
}
#closeButton {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

    #empRec::placeholder {
        text-align: center;
    }
    #pay_month::placeholder {
    text-align: center;
}
.left-section,
.right-section {
    width: 50%; /* Each section takes up 50% of the container */
    padding: 10px; /* Add padding for better spacing */
}

.left-section {
    float: left; /* Float the left section to the left */
}

.right-section {
    float: right; /* Float the right section to the right */
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
h6 {
    font-weight: bold;
}
.pay-slip {
    display: flex;
    justify-content: space-between;
    align-items: flex-start; /* Adjust as needed */
}
    </style>
  
  <script>
    function displayErrorMessage(message) {
    const errorMessageContainer = document.getElementById('empRecError'); // Corrected ID
    errorMessageContainer.innerHTML = `<p class="error-message">${message}</p>`;
}

function hideErrorMessage() {
    const errorMessageContainer = document.getElementById('empRecError'); // Corrected ID
    errorMessageContainer.innerHTML = '';
}


    async function validateEmpCode() {
        const empCodeInput = document.getElementById('empRec');
        const empCodeValue = empCodeInput.value;

        // Check if the input is empty
        if (empCodeValue.trim() === '') {
            empCodeInput.classList.add('error-input'); // Apply error style to the input
            displayErrorMessage('Please enter Employee Code.');
            return false;
        }

        // Define a regular expression pattern for uppercase letters and numbers
        const pattern = /^[A-Z0-9]{6}$/;

        // Check if the code matches the pattern
        if (!pattern.test(empCodeValue)) {
            empCodeInput.classList.add('error-input'); // Apply error style to the input
            displayErrorMessage('Employee Code must be alphanumeric, and no spaces are allowed.');
            return false;
        } else {
            empCodeInput.classList.remove('error-input'); // Remove error style
            hideErrorMessage();

            // Check if the employee code exists in the database
            const isUserValid = await checkEmployeeCodeInDatabase(empCodeValue);

            if (!isUserValid) {
                empCodeInput.classList.add('error-input'); // Apply error style to the input
                displayErrorMessage('Invalid Employee Code. User not found.');
                return false;
            }

            return true; // Allow form submission
        }
    }

    async function checkEmployeeCodeInDatabase(empCode) {
        // Simulate an asynchronous database check
        return new Promise((resolve) => {
            // Perform an actual database query to check if the employee code exists
            // Replace the logic below with your actual database check
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resolve(xhr.responseText === 'true');
                }
            };
            xhr.open('GET', 'checkEmployeeCode.php?empCode=' + empCode, true);
            xhr.send();
        });
    }

    function validateForm(event) {
        // Validate Employee Code
        const isValidEmpCode = validateEmpCode();

        // Validate Pay Month
        const payMonthInput = document.getElementById('pay_month');
        const payMonthValue = payMonthInput.value.trim(); // Trim the value

        // Check if the pay month field is empty after trimming
        if (payMonthValue === '') {
            document.getElementById('payMonthError').innerText = 'Please select a pay month.';
            return false;
        } else {
            document.getElementById('payMonthError').innerText = ''; // Clear the error message
        }

        // If both validations pass, return true to allow form submission
        return isValidEmpCode && payMonthValue !== '';
    }

    // Add an event listener to the form for validation
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission behavior
            const isValid = validateForm();
            if (isValid) {
                form.submit(); // Submit the form if it's valid
            }
        });
    });

    // Add the input event listener to the input
    document.addEventListener('DOMContentLoaded', function () {
        const empCodeInput = document.getElementById('empRec');
        empCodeInput.addEventListener('input', validateEmpCode);
    });
</script>

</head>

<body>

    <section class="vertical-center">
    <div class="container m-3 clearfix">
            <div class="row rounded">
            <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                <h4 class="text-white">
                <i class="fas fa-file-invoice-dollar" style="margin-right: 10px;"></i>Employee Pay Slip </h4>
        </div>
        <div class="col-md-7 bg-white p-3 rounded-end-2">
            <form method="POST" action="" onsubmit="return validateForm(event);">
            <div class="form-container">
            <label for="empRec">Employee Code</label>
        <input type="text" id="empRec" name="empRec" placeholder="Employee code" value="<?php echo $empRectosearch; ?>">
        <div id="empRecError" class="error-message"></div> <!-- Error message container for Employee Code -->

        <label for="pay_month">Pay Month</label>
        <input type="month" id="pay_month" name="pay_month" placeholder="Pay month" value="<?php echo $pay_monthtosearch; ?>">
        <div id="payMonthError" class="error-message"></div> <!-- Error message container for Pay Month -->

        <input type="submit" value="Filter">
        </div>
        </form>
        <?php if (isset($fetch_profile) && $fetch_profile): ?>
                    <div id="printableArea"> 
                        <div class="pay-slip">
                            <div class="left-section">
                                <!-- Fields for the left section -->
                                <p><strong>Employee code:</strong> <?= $fetch_profile['empRec']; ?></p>
                                <p><strong>Name:</strong> <?= $fetch_profile['empName']; ?></p>
                                <p><strong>Department:</strong> <?= $fetch_profile['department']; ?></p>
                                <p><strong>Pay Month:</strong> <?= $fetch_profile['pay_month']; ?></p>
                                <p><strong>Total Days:</strong> <?= $fetch_profile['totaldays']; ?></p>
                            </div>

                            <div class="right-section">
                                <!-- Fields for the right section -->
                                <h6><strong>Account Details</strong></h6>
                                <p><strong>Bank Name:</strong> <?php echo isset($fetch_profile['bank_name']) ? $fetch_profile['bank_name'] : ''; ?></p>
                                <p><strong>Account Number:</strong> <?php echo isset($fetch_profile['account_number']) ? $fetch_profile['account_number'] : ''; ?></p>
                                <p><strong>IFSC Code:</strong> <?php echo isset($fetch_profile['ifsc_code']) ? $fetch_profile['ifsc_code'] : ''; ?></p>

                            
                            </div>
                        </div>
                        <h6><strong>Salary details</strong></h6>
                        <table class='table table-bordered'>
                        <tr>
                                <th>Earnings</th>  <th>Amount</th> <th>Deductions</th><th>Amount</th>
                              </tr>

                        <tr>
                                <td>Base Salary</td>
                                <td>  <?= $fetch_profile['base_salary']; ?></td>
                                <td>Insurence</td>
                                <td>  <?= $fetch_profile['insurence']; ?></td>    
                              </tr>

                        <tr>
                                <td>Bonus</td>
                                <td>  <?= $fetch_profile['bonus']; ?></td>
                                <td>Tax Deductions</td>
                                <td>  <?= $fetch_profile['tax_deductions']; ?></td>
                              </tr>

                        <tr>
                                <td>Allowance</td>
                                <td>  <?= $fetch_profile['allowances']; ?></td>
                                <td>Retirement Saving</td>
                                <td>  <?= $fetch_profile['retirement']; ?></td>
                              </tr>

                        <tr>
                                <td>Overtime</td>
                                <td>  <?= $fetch_profile['overtime']; ?></td>
                                <td> Commission</td>
                                <td>  <?= $fetch_profile['commission']; ?></td>
                              </tr>

                        <tr>
                                <td></td>
                                <td></td>
                                <td>Tax Deductions</td>
                                <td>  <?= $fetch_profile['total_deductions']; ?></td>
                              </tr>

                        <tr>
                                <td>Gross Earning</td>
                                <td>  <?= $fetch_profile['gross_earning']; ?></td>
                                <td>Total Deductions</td>
                                <td>  <?= $fetch_profile['total_deductions']; ?></td>
                              </tr>

                        <tr>
                                <td></td>
                                <td></td>
                                <td>Net Pay </td>
                                <td>  <?= $fetch_profile['net_pay']; ?></td>
                              </tr>
                            
                        </table>
                 
                  </div>       
                       
                       
                  <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-primary" onclick="printPaySlip()">Print</button>
                        </div>
                       
                            
                <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>
                        
                </div>
             
            </div>

        </div>
        
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function printPaySlip() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
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