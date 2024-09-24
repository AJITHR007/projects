<?php
// Start session
session_start();

// Include database connection file
include 'dbconnection.php';



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if pay_month is set
    if (isset($_POST['pay_month'])) {
        // Initialize variables
        $payMonth = $_POST['pay_month']; // Get the pay month from the form
        // print_r($_SESSION);
        try {
            // Retrieve user_id from session
            if (isset($_SESSION['user_id'])) {
                $loggedInUserID = $_SESSION['user_id'];

                // Query to fetch payslip details based on user_id and pay_month

                $sql = "SELECT
                        rd.*,
                        p.*
                    FROM
                        `recordadd` AS rd
                    JOIN paySlip AS p
                    ON
                        p.user_id = rd.id
                    WHERE
                        rd.id = {$loggedInUserID} AND p.pay_month = '{$payMonth}'";
                        // echo $sql;
                $stmt = $conn->prepare($sql);
                
                $stmt->execute();
                $fetch_profile = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($fetch_profile) {

                  // echo "<pre>";
                  // print_r($fetch_profile);
                    // Payslip details found, display them
                    // Your HTML code to display payslip details goes here
                } else {
                    // No payslip details found for the specified pay month
                    $fetch_profile = false; // Set $fetch_profile to false
                }
            } else {
                echo "User is not logged in."; // Handle the case where user is not logged in
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Display error if pay_month is not set
        echo "Pay month is not set.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pay Slip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>
         body {
            background-color: #f2f2f2;
            font-family: 'Roboto', sans-serif;
        }

        .purpleBox {
            background-color: #8F4B84;
            color: #fff;
            padding: 20px;
            text-align: center; /* Center text */
        }

        .text-white {
            margin-top: 50px; /* Adjust margin for positioning */
        }

        .custom-submit {
    background-color: #95598b;
    border-color: #8F4B84;
    padding: 8px 16px; /* Adjust padding as needed */
    font-size: 14px; /* Adjust font size as needed */
    border-radius: 5px;
    cursor: pointer;
    color: black; /* Text color */
}

.custom-submit:hover,
.custom-submit:focus {
    background-color: #b983c1;
    border-color: #7e4472;
}
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        input[type="month"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;

        }

        .vertical-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }

        #closeButton {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        .pay-slip {
    display: flex;
    justify-content: space-between;
    align-items: flex-start; /* Adjust as needed */
}

.left-section,
.right-section {
    width: 48%; /* Adjust the width as needed */
}

.left-section {
    margin-right: 2%; /* Adjust margin between sections */
}

.right-section {
    margin-left: 2%; /* Adjust margin between sections */
}
h6 {
    font-weight: bold;
}
#pay_month_error {
        color: red;
        margin-left: -50px;
        font-size: 14px;
        margin-top: 5px; /* Add some space between the input field and the error message */
    }
    #pay_slip_form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 30vh; /* Adjust as needed */
}

/* Additional styles for form elements */
.mb-3 {
    margin-bottom: 20px; /* Adjust spacing between form elements */
}
    </style>

</head>

<body>

    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
            <div class="col-md-3 purpleBox rounded-start-2 position-relative">
            <h4 class="text-white">Employee Pay Slip</h4>
            <i class="fas fa-money-bill-alt fa-3x"></i> <!-- Icon related to pay -->
            <img src="image3.png" class="img-fluid position-absolute" alt="" />
        </div>
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                <form id="pay_slip_form" method="POST" action="">

                <div class="mb-3 d-flex align-items-center">
                    <label for="pay_month" class="me-2">Pay Month</label>
                    <input type="month" id="pay_month" name="pay_month" class="form-control me-2">
                    <input type="submit" value="Submit" class="custom-submit" onclick="return validateForm()">
                </div>
                <!-- Error message below the input field -->
                <span id="pay_month_error" style="color: red;"></span>
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
   function validateForm() {
    var payMonth = document.getElementById("pay_month").value;
    var payMonthError = document.getElementById("pay_month_error");
    
    // Check if payMonth is empty
    if (payMonth === "") {
        payMonthError.textContent = "Pay Month is required";
        return false; // Prevent form submission
    } else {
        payMonthError.textContent = ""; // Clear the error message
        return true; // Allow form submission
    }
}
</script>
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
        window.location.href = "empdash.php";
    });
</script>
  </body>

</html>
