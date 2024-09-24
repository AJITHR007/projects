<?php
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:adminlogin.php');
    exit(); // Ensure script stops execution after redirect
}
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empRec = '';
$errorMsg = '';
$employeeDetails = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empRec = isset($_POST["empRec"]) ? $_POST["empRec"] : '';

    if (empty($empRec)) {
        $errorMsg = 'Please enter Employee Code.';
    } else {
        $sql = "SELECT id,empRec,empName, department,bank_name,account_number, ifsc_code FROM recordadd WHERE empRec = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $empRec); // "s" represents a string, adjust if empRec is of a different type
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $employeeDetails = $row;
        } else {
            $errorMsg = 'Employee not found.';
        }
         
        $stmt->close();
        
    }
}

// Check if the user is already on the final_leave.php page
if (basename($_SERVER['PHP_SELF']) != 'payroll.php') {
    // Redirect to the final_leave.php page only if not already there
    $_SESSION['notification'] = 'payslip submitted successfully!';
    header('location: payroll.php');
    exit();
}
?>



<!doctype html>
<html lang="en">
  <head>
  <title>pay process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <script src="finalprocess.js" defer></script>

    <style>
    body {
        background-color: #f8f9fa; /* Adjust as needed */
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 50px auto;
        
    }
    .purpleBox{
        background-color:  #249bb3;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-between;
        text-align: center;
        min-height: 600px;
      }

    .content {
        margin-bottom: 20px;
    }

    input#empRec {
        width: 70%;
        padding: 8px;
        border: 2px solid #8F4B84;
        border-radius: 5px;
        margin-right: 10px;
    }

    button[type="submit"] {
        background-color:  #249bb3;
        border: 2px solid #8F4B84;
        color: white;
        width: 20%;
        padding: 8px;
        cursor: pointer;
        border-radius: 5px;
    }

    button[type="submit"]:hover,
    button[type="submit"]:focus {
        background-color: purple;
        border-color: #95598b;
    }

    .error-message {
        color: red;
        margin-top: 10px;
    }

    .bg-white {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
    }

    /* Add styles for the form input fields here */

    label {
        font-weight: bold;
        margin-bottom: 5px;
        display: flex;
    }

    input[type="text"],
    input[type="month"],
    textarea {
        padding: 8px;
        display:flex;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }
    #closeButton {
        position: fixed;
        top: 20px; /* Adjust the top position as needed */
        right: 20px; /* Adjust the right position as needed */
        z-index: 9999; /* Ensure it's above other elements */
    }

    .btn-info,
    .btn-primary {
        background-color:  #249bb3;
        border: 2px solid ;
        color: white;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
        margin-right: 10px;
    }

    .btn-primary {
        background-color:  #249bb3;
        border-color: #4a90e2;
        width: 10%;
        padding: 8px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-info:hover,
    .btn-info:focus,
    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #95598b;
        border-color: #95598b;
    }

    #success-msg {
        color: green;
        margin-top: 10px;
    }
    .error-input {
        border-color: red !important;
        margin-top:3px;
    }
   
</style>

</head>
<body>
    <section class="vertical-center">
        <div class="container ml-1">
            <div class="row rounded">
            <div class="col-md-3 purpleBox rounded-start-2 position-relative">
    <h4 class="text-white" style="margin-top: 200px;"><i class="fas fa-dollar-sign"></i> Employee Pay process</h4>                
</div>
               
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                <div class="row pb-4 mt-2">
                      <h4><center>Employee Pay process</center></h4>
                    </div>
                            <form method="POST" action="payslipconnection.php"  onsubmit="return validateForm();">
                            <?php if (!empty($employeeDetails)): ?>
                        <div class="row g-3 pb-3">
                            <div class="col-md-4">
                                <label for="empRec" class="form-label">Employee Code</label>
                                <input type="text" class="form-control" value="<?php echo isset($employeeDetails['empRec']) ? $employeeDetails['empRec'] : ''; ?>" id="empRec" name="empRec">
                            </div>
                            <div class="col-md-4">
                                <label for="empName" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" value="<?php echo isset($employeeDetails['empName']) ? $employeeDetails['empName'] : ''; ?>" id="empName" name="empName">
                            </div>
                            <div class="col-md-4">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" value="<?php echo isset($employeeDetails['department']) ? $employeeDetails['department'] : ''; ?>" id="department" name="department">
                            </div>
                        </div>
               
                        
                    <div class="row g-3 pb-3">
                            <div class="col-md-4">
                            <label for="bank_name" class="form-label">Bank Name</label>
                            <input type="text" class="form-control" value="<?php echo isset($employeeDetails['bank_name']) ? $employeeDetails['bank_name'] : ''; ?>" id="bank_name" name="bank_name">
                    </div>
                    <div class="col-md-4">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" class="form-control" value="<?php echo isset($employeeDetails['account_number']) ? $employeeDetails['account_number'] : ''; ?>" id="account_number" name="account_number">
                            </div>
                            <div class="col-md-4">
                            <label for="ifsc_code" class="form-label">Ifsc Code</label>
                            <input type="text" class="form-control" value="<?php echo isset($employeeDetails['ifsc_code']) ? $employeeDetails['ifsc_code'] : ''; ?>" id="ifsc_code" name="ifsc_code">
                            </div>
                    </div>


                    <?php endif; ?>

                    
                        
                   
                            <div class="row g-3 pb-3">
                              <div class="col-md-4">
                              <label for="base_salary" class="form-label">Base Salary</label>
                              <input type="text" class="form-control" name="base_salary" id="base_salary" value="20000">
                              <span id="error_base_salary" style="color:red"></span>
                              </div>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            <div class="col-md-4">
                              <label for="overtime" class="form-label">Overtime Pay</label>
                              <input type="text" class="form-control" name="overtime" id="overtime" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="overtimeValidation(event)">
                              <span id="error_overtime" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
            
                                <div class="col-md-4">
                                    <label for="bonus" class="form-label"> Bonus</label>
                                    <input type="text" class="form-control" name="bonus" id="bonus" maxlength="5" minlength="4" onkeypress="return isNumeric(event)" onkeyup="bonusValidation(event)">
                                    <span id="error_bonus" style="color:red"></span>
                                    <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                                  </div> 
                                  </div>                     
                    <div class="row g-3 pb-3">
                          <div class="col-md-4">
                             <label for=" commission" class="form-label">Commission</label>
                              <input type="text" class="form-control" name=" commission" id="commission" maxlength="5" onkeypress="return isNumeric(event)"  onkeyup="commissionValidation(event)">
                              <span id="error_commission" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                            <div class="col-md-4">
                            <label for=" houseRent" class="form-label">House Rent Allowance</label>
                            <input type="text" class="form-control" name=" houseRent" id="houseRent" maxlength="5" onkeypress="return isNumeric(event)" oninput="rentValidation(event)">
                            <span id="error_houseRent" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                        
                        
                          <div class="col-md-4">
                            <label for="medical_allowance" class="form-label">Medical  Allowance</label>
                            <input type="text" class="form-control" name="medical_allowance" id="medical_allowance"maxlength="5" onkeypress="return isNumeric(event)"  oninput="medicalValidation(event)">
                            <span id="error_medical_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                                </div>
                                         
                    <div class="row g-3 pb-3">
                          <div class="col-md-4">
                            <label for="transport_allowance" class="form-label">Transport Allowance</label>
                            <input type="text" class="form-control" name="transport_allowance" id="transport_allowance"maxlength="4" onkeypress="return isNumeric(event)"  oninput="transportValidation(event)">
                            <span id="error_transport_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                        
                          <div class="col-md-4">
                            <label for="food_allowance" class="form-label">Food Allowance</label>
                            <input type="text" class="form-control" name="food_allowance" id="food_allowance"maxlength="4" onkeypress="return isNumeric(event)"  oninput="foodValidation(event)">
                            <span id="error_food_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                          <div class="col-md-4">
                            <label for="phone_allowance" class="form-label"> Phone Allowance </label>
                            <input type="text" class="form-control" name="phone_allowance" id="phone_allowance" maxlength="4" onkeypress="return isNumeric(event)" oninput="phoneValidation(event)">
                            <span id="error_phone_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                                </div>
                        
                                <div class="row g-3 pb-3">
                            <div class="col-md-4">
                                <label for=" allowances" class="form-label">Allowance</label>
                                 <input type="text" class="form-control" name=" allowances" id="allowances" maxlength="5" readonly>
                                 <span id="error_allowances" style="color:red"></span>
                                </div>
                            
                            <div class="col-md-4">
                              <label for="tax_deductions" class="form-label">Tax Deductions</label>
                              <input type="text" class="form-control" name="tax_deductions" id="tax_deductions" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="taxValidation(event)">
                              <span id="error_tax_deductions" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                            
                            <div class="col-md-4">
                              <label for="insurence" class="form-label">Insurence Premium</label>
                              <input type="text" class="form-control" name="insurence" id="insurence" maxlength="4" onkeypress="return isNumeric(event)" onkeyup="phoneValidation(event)">
                              <span id="error_insurence" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                                </div>
                                <div class="row g-3 pb-3">
                                <div class="col-md-4">
                            <label for="pay_month" class="form-label">Pay Month</label>
                            <input type="month" id="pay_month" class="form-control" name="pay_month" maxlength="4" onkeypress="return isNumeric(event)" onkeyup="paymonthValidation(event)" >
                            <span id="error_pay_month" style="color:red"></span>
                        </div>
                        <div class="col-md-4">
    <label for="totalpresent" class="form-label">No of Days Presents</label>
    <input type="text" class="form-control" name="totalpresent" id="totalpresent" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="presentValidation(event)">
    <span id="error_totalpresent" style="color:red"></span>


</div>

<div class="col-md-4">
    <label for="totalupsent" class="form-label">Total number of Leaves</label>
    <input type="text" class="form-control" name="totalupsent" id="totalupsent" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="upsentValidation(event)">
    <span id="error_totalupsent" style="color:red"></span>
   
</div>

<div class="row g-3 pb-3">
<div class="col-md-4">
    <label for="totaldays" class="form-label">Total Days</label>
    <input type="text" class="form-control" name="totaldays" id="totaldays" onsubmit="calculateTotalDays()" maxlength="4">
</div>

                            <div class="col-md-4">
                              <label for="retirement" class="form-label">Retirement Contribute</label>
                              <input type="text" class="form-control" name="retirement" id="retirement" maxlength="4" onkeypress="return isNumeric(event)" onkeyup="retirementValidation(event)">
                              <span id="error_retirement" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>

                            <div class="col-md-4">
                                <label for="other_deductions" class="form-label">Other Deductions</label>
                                <input type="text" class="form-control" name=" other_deductions" id="other_deductions" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="deductionsValidation(event)">
                                <span id="error_other_deductions" style="color:red"></span>
                                <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            </div>
                              </div> 
        <div class="row g-3 pb-3">
                        <div class="col-md-4">
                            <label for="gross_earning" class="form-label">Gross Earning</label>
                            <input type="text" class="form-control" name="gross_earning" id="gross_earning" onkeypress="return isNumeric(event)" readonly>
                            <span id="error" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                        </div>
                        <div class="col-md-4">
                            <label for="total_deductions" class="form-label">Total deductions</label>
                            <input type="text" class="form-control" name="total_deductions" id="total_deductions" onkeypress="return isNumeric(event)" readonly>
                            <span id="error" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                        </div>
                       
    
                            <div class="col-md-4">
                              <label for="net_pay" class="form-label">Net Pay</label>
                              <input type="text" class="form-control" name="net_pay" id="net_pay"  readonly>
                              <span id="error" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                          </div>
                           </div>
                           <div class="row g-3 pb-3">
                      
        
                        <div class="col-md-4">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name"  value="Srays Info Tech">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="company_address" class="form-label">company Address</label>
                            <input class="form-control" name="company_address" id="company_address"  value="Chennai" readonly>
                        </div>
                        </div>
  
                    
                        <div class="row pt-2">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="user_id" value="<?php echo isset($employeeDetails['id']) ?$employeeDetails['id'] : "" ?>">
                                <input type="submit" class="btn btn-info" value="submit">
                                <button type="reset" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                        
                    </form>
                    <div id="success-msg" style="color:green">
                </div>
            </div>
        </div>
        
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <button id="closeButton" class="btn-close" aria-label="Close"></button>
   <script>
    // Get a reference to the close button
    var closeButton = document.getElementById('closeButton');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Redirect to the desired page (e.g., "emdash.html")
        window.location.href = "payprocess.php";
    });
</script>
    <script>
        function isNumeric(event) {
            return /^[0-9]*$/.test(event.key);
        }

        function presentValidation(event) {
            var totalpresent = document.getElementById('totalpresent').value;
            var totalupsent = document.getElementById('totalupsent').value;

            if (parseInt(totalpresent) + parseInt(totalupsent) > 31) {
                document.getElementById('error_totalpresent').innerText = "Total present and upsent days cannot exceed 30 and 31 days.";
            } else {
                document.getElementById('error_totalpresent').innerText = "";
            }

            // Auto-calculate total days
            calculateTotalDays();
        }

        function upsentValidation(event) {
            var totalpresent = document.getElementById('totalpresent').value;
            var totalupsent = document.getElementById('totalupsent').value;

            if (parseInt(totalpresent) + parseInt(totalupsent) > 31) {
                document.getElementById('error_totalupsent').innerText = "Total days cannot exceed 31.";
            } else {
                document.getElementById('error_totalupsent').innerText = "";
            }

            // Auto-calculate total days
            calculateTotalDays();
        }

        function calculateTotalDays() {
            var totalpresent = parseInt(document.getElementById('totalpresent').value) || 0;
            var totalupsent = parseInt(document.getElementById('totalupsent').value) || 0;
            var totaldays = totalpresent - totalupsent;
            document.getElementById('totaldays').value = totaldays > 0 ? totaldays : 0;
        }
    </script>
<script>
function calculateSalary() {
    // Get values from input fields
    var baseSalary = parseFloat(document.getElementById('base_salary').value) || 0;
    var overtime = parseFloat(document.getElementById('overtime').value) || 0;
    var bonus = parseFloat(document.getElementById('bonus').value) || 0;
    var allowance = parseFloat(document.getElementById('allowances').value) || 0;

    // Calculate Gross Earning
    var grossEarning = baseSalary + overtime + bonus + allowance;
    document.getElementById('gross_earning').value = grossEarning.toFixed(2);

    // Get values for Total Deductions
    var commission = parseFloat(document.getElementById('commission').value) || 0;
    var taxDeductions = parseFloat(document.getElementById('tax_deductions').value) || 0;
    var insurance = parseFloat(document.getElementById('insurence').value) || 0;
    var retirement = parseFloat(document.getElementById('retirement').value) || 0;
    var otherDeductions = parseFloat(document.getElementById('other_deductions').value) || 0;

    // Calculate Total Deductions
    var totalDeductions = commission + taxDeductions + insurance + retirement + otherDeductions;
    document.getElementById('total_deductions').value = totalDeductions.toFixed(2);

    // Calculate Net Pay
    var netPay = grossEarning - totalDeductions;
    document.getElementById('net_pay').value = netPay.toFixed(2);
}

// Attach the calculateSalary function to relevant input fields
var relevantFields = ['base_salary', 'overtime', 'bonus', 'allowances', 'commission', 'tax_deductions', 'insurence', 'retirement', 'other_deductions'];
relevantFields.forEach(function (field) {
    document.getElementById(field).addEventListener('input', calculateSalary);
});

    // Function to calculate Allowance based on individual allowance fields
    function calculateAllowance() {
        // Get values from input fields
        var phoneAllowance = parseFloat(document.getElementById('phone_allowance').value) || 0;
        var foodAllowance = parseFloat(document.getElementById('food_allowance').value) || 0;
        var transportAllowance = parseFloat(document.getElementById('transport_allowance').value) || 0;
        var medicalAllowance = parseFloat(document.getElementById('medical_allowance').value) || 0;
        var houseRentAllowance = parseFloat(document.getElementById('houseRent').value) || 0;

        // Calculate total Allowance
        var totalAllowance = phoneAllowance + foodAllowance + transportAllowance + medicalAllowance + houseRentAllowance;
        
        // Update the Allowance field
        document.getElementById('allowances').value = totalAllowance.toFixed(2);

        // Call the calculateSalary function to update other fields
        calculateSalary();
    }

    // Attach the calculateAllowance function to relevant input fields
    var allowanceFields = ['phone_allowance', 'food_allowance', 'transport_allowance', 'medical_allowance', 'houseRent'];
    allowanceFields.forEach(function (field) {
        document.getElementById(field).addEventListener('input', calculateAllowance);
    });
</script>


</body>
</html>