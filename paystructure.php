<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empRectosearch = "";
$row = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empRec"])) {
    $empRectosearch = $_POST["empRec"];

    $sql = "SELECT * FROM recordadd WHERE empRec = '$empRectosearch'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
  <title>Pay Process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
    input#empRec {
    width: 70%; /* Adjust the width as needed */
    padding: 8px;
    border: 2px solid #8F4B84;
    border-radius: 5px;
    display:flex;
    margin-right: 10px;
}

button[type="submit"] {
    background-color: #8F4B84;
    border: 2px solid #8F4B84;
    color: white;
    display:flex;
    width:20%;
    padding:6px;
    cursor: pointer;
    border-radius: 5px;
}

button[type="submit"]:hover,
button[type="submit"]:focus {
    background-color: #95598b;
    border-color: #95598b;
}

/* Style for the input boxes */
.form-control {
    border-color: #8F4B84;
    width: 100%;
    margin-bottom: 10px;
}

/* Adjust the style for the container */
.vertical-center {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: url("your-background-image-url.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
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

.purpleBox img {
    bottom: 0;
}

/* Adjust the style for the form container */
.col-md-9 {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
}

</style>

</head>
<body>
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                    <h4 class="text-white" style="margin-top: 200px;">Employee Pay Process</h4>
                    </div>
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                    
                       <div class="row pb-4 mt-2">
                      <h4><center>Employee Pay Process</center></h4>
                    </div>         
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="row">
                    <input type="text" class="form-control" id="empRec" name="empRec"
                           placeholder="Enter employee code or name" value="<?php echo $empRectosearch; ?>" required>
                           <button type="submit" value="search">
    <i class="fas fa-search"></i>
</button>

                </div>     
                 </form>
            <?php
            if (!empty($row)) {
                echo "<form method='post' action=''>";
                echo "<div class='row g-3 pb-3'>            
                      <div class='col-md-4'>
                            <label for='empRec'>Employee Code:</label>
                            <input type='text' name='empRec' id='empRec' value='" . $row["empRec"] . "'>
                        </div>
                        </div>";

                        echo "<div class='col-md-4'>
                            <label for='empName'>Employee name:</label>
                            <input type='text' name='empName' id='empName' value='" . $row["empName"] . "'><br>
                        
                            </div>";
                        echo "<div class='col-md-4'>
                        <label for='department'>Employee Department:</label>
                        <input type='text' name='department' value='" . $row["department"] . "'><br>
                        
                        </div>";
                    echo "<div class='row g-3 pb-3'>
                    <div class='col-md-4'>
                    <label for='bank_name'>Bank Name:</label>
                    <input type='text' name='bank_name' value='" . $row["bank_name"] . "'><br>
                </div>
                </div>";
                echo "<div class='col-md-4'>
                <label for='account_number'>Account Number:</label>
                <input type='text' name='account_number' value='" . $row["account_number"] . "'><br>
            </div>";
            echo "<div class='col-md-4'>
            <label for='ifsc_code'>Ifsc Code:</label>
            <input type='text' name='ifsc_code' value='" . $row["ifsc_code"] . "'>
        </div>";
        echo "<div class='col-md-4'>
        <label for='gender'>Gender:</label>
        <input type='text' name='gender' value='" . $row["gender"] . "'>
    </div>";


                // Repeat similar blocks for other input fields

                echo "</form>";
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "NO DATA FOUND";
            }
            ?> 
  <form method="POST" action="payslipconnection.php" onsubmit="return validateForm();">

            <div class="row g-3 pb-3">
                              <div class="col-md-4">
                              <label for="base_salary" class="form-label">Base Salary</label>
                              <input type="text" class="form-control" name="base_salary" id="base_salary" maxlength="5" onkeypress="return isNumeric(event)" onkeydown="baseValidation(event)">
                              <span id="error_base_salary" style="color:red"></span>
                              </div>
                              <script>
                                    function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function baseValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            <div class="col-md-4">
                              <label for="overtime" class="form-label">Overtime Pay</label>
                              <input type="text" class="form-control" name="overtime" id="overtime" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="overtimeValidation(event)">
                              <span id="error_overtime" style="color:red"></span>
                              <script>
                                    function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function overtimeValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            </div>
            
                                <div class="col-md-4">
                                    <label for="bonus" class="form-label"> Bonus</label>
                                    <input type="text" class="form-control" name="bonus" id="bonus" maxlength="5" minlength="4" onkeypress="return isNumeric(event)" onkeyup="bonusValidation(event)">
                                    <span id="error_bonus" style="color:red"></span>
                                    <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function bonusValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
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
                                    function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function commissionValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            </div>
                            <div class="col-md-4">
                            <label for=" houseRent" class="form-label">House Rent Allowance</label>
                            <input type="text" class="form-control" name=" houseRent" id="houseRent" maxlength="5" onkeypress="return isNumeric(event)" oninput="rentValidation(event)">
                            <span id="error_houseRent" style="color:red"></span>
                            <script>
                                    function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function rentValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                          </div>
                        
                        
                          <div class="col-md-4">
                            <label for="medical_allowance" class="form-label">Medical  Allowance</label>
                            <input type="text" class="form-control" name="medical_allowance" id="medical_allowance"maxlength="5" onkeypress="return isNumeric(event)"  oninput="medicalValidation(event)">
                            <span id="error_medical_allowance" style="color:red"></span>
                            <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function medicalValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                          </div>
                                </div>
                                         
                    <div class="row g-3 pb-3">
                          <div class="col-md-4">
                            <label for="transport_allowance" class="form-label">Transport Allowance</label>
                            <input type="text" class="form-control" name="transport_allowance" id="transport_allowance"maxlength="4" onkeypress="return isNumeric(event)"  oninput="transportValidation(event)">
                            <span id="error_transport_allowance" style="color:red"></span>
                            <script>function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function transportValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                          </div>
                        
                          <div class="col-md-4">
                            <label for="food_allowance" class="form-label">Food Allowance</label>
                            <input type="text" class="form-control" name="food_allowance" id="food_allowance"maxlength="4" onkeypress="return isNumeric(event)"  oninput="foodValidation(event)">
                            <span id="error_food_allowance" style="color:red"></span>
                            <script>
                                    function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function foodValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                          </div>
                          <div class="col-md-4">
                            <label for="phone_allowance" class="form-label"> Phone Allowance </label>
                            <input type="text" class="form-control" name="phone_allowance" id="phone_allowance" maxlength="4" onkeypress="return isNumeric(event)" oninput="phoneValidation(event)">
                            <span id="error_phone_allowance" style="color:red"></span>
                            <script>
                                    function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function phoneValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                          </div>
                                </div>
                        
                                <div class="row g-3 pb-3">
                            <div class="col-md-4">
                                <label for=" allowances" class="form-label">Allowance</label>
                                 <input type="text" class="form-control" name=" allowances" id="allowances" maxlength="5" onkeypress="return isNumeric(event)"  onkeyup="allowancesValidation(event)">
                                 <span id="error_allowances" style="color:red"></span>
                                 <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function allowancesValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                               </div>
                            
                            <div class="col-md-4">
                              <label for="tax_deductions" class="form-label">Tax Deductions</label>
                              <input type="text" class="form-control" name="tax_deductions" id="tax_deductions" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="taxValidation(event)">
                              <span id="error_tax_deductions" style="color:red"></span>
                              <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function taxValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            </div>
                            
                            <div class="col-md-4">
                              <label for="insurence" class="form-label">Insurence Premium</label>
                              <input type="text" class="form-control" name="insurence" id="insurence" maxlength="4" onkeypress="return isNumeric(event)" onkeyup="phoneValidation(event)">
                              <span id="error_insurence" style="color:red"></span>
                              <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function phoneValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            </div>
                                </div>
                                <div class="row g-3 pb-3">
                            <div class="col-md-4">
                                <label for="totalpresent" class="form-label">No of Days Presents</label>
                                 <input type="text" class="form-control" name=" totalpresent" id="totalpresent" maxlength="5" onkeypress="return isNumeric(event)"  onkeyup="presentValidation(event)">
                                 <span id="error_totalpresent" style="color:red"></span>
                                 <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function presentValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                               </div>
                            
                            <div class="col-md-4">
                              <label for="totalupsent" class="form-label">Total number of Leaves</label>
                              <input type="text" class="form-control" name="totalupsent" id="totalupsent" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="upsentValidation(event)">
                              <span id="error_totalupsent" style="color:red"></span>
                              <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function upsentValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            </div>
                            
                            <div class="col-md-4">
                              <label for="totaldays" class="form-label">Total Days</label>
                              <input type="text" class="form-control" name="totaldays" id="totaldays" maxlength="4" onkeypress="return isNumeric(event)" onkeyup="totalValidation(event)">
                              <span id="error_totaldays" style="color:red"></span>
                              <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function totalValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            </div>
                                </div>
                              
                          <div class="row g-3 pb-3">
                    
                            <div class="col-md-4">
                              <label for="retirement" class="form-label">Retirement Contribute</label>
                              <input type="text" class="form-control" name="retirement" id="retirement" maxlength="4" onkeypress="return isNumeric(event)" onkeyup="retirementValidation(event)">
                              <span id="error_retirement" style="color:red"></span>
                              <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function retirementValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                            </div>

                            <div class="col-md-4">
                                <label for="other_deductions" class="form-label">Other Deductions</label>
                                <input type=" text" class="form-control" name=" other_deductions" id="other_deductions" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="deductionsValidation(event)">
                                <span id="error_other_deductions" style="color:red"></span>
                                <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        function deductionsValidation(event) {
                                            var value = event.target.value;
                                            if (isNotEmpty(value)) {
                                                return isNumeric(event);
                                            }
                                            return true;
                                        }
                              </script>
                            
                              </div> 
                              <div class="col-md-4">
                            <label for="pay_month" class="form-label">Pay Month</label>
                            <input type="month" id="pay_month" class="form-control" name="pay_month" maxlength="4" onkeypress="return isNumeric(event)" onkeyup="paymonthValidation(event)" >
                            <span id="error_pay_month" style="color:red"></span>
                        </div>
                        <div class="row g-3 pb-3">
                        <div class="col-md-4">
                            <label for="gross_earning" class="form-label">Gross Earning</label>
                            <input type="text" class="form-control" name="gross_earning" id="gross_earning" onkeypress="return isNumeric(event)" readonly>
                            <span id="error" style="color:red"></span>
                            <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                       
                              </script>
                            
                        </div>
                        <div class="col-md-4">
                            <label for="total_deductions" class="form-label">Total deductions</label>
                            <input type="text" class="form-control" name="total_deductions" id="total_deductions" onkeypress="return isNumeric(event)" readonly>
                            <span id="error" style="color:red"></span>
                            <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                       
                              </script>
                            
                        </div>
                       
    
                            <div class="col-md-4">
                              <label for="net_pay" class="form-label">Net Pay</label>
                              <input type=" text" class="form-control" name="net_pay" id="net_pay"  readonly>
                              <span id="error" style="color:red"></span>
                              <script>
                                     function isNotEmpty(value) {
                                            return value.trim() !== '';
                                        }
                                        function isNumeric(event) {
                                            return /^[0-9]*$/.test(event.key);
                                        }

                                        
                              </script>
                            
                          </div>
                           </div>
                           <div class="row g-3 pb-3">
                      
        
                        <div class="col-md-4">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" minlength="3" maxlength="50" onkeyup="cnameValidation(event)" value="Srays Info Solutions">
                            <span id="error_company_name" style="color:red"></span>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="company_address" class="form-label">company Address</label>
                            <textarea class="form-control" name="company_address" id="company_address" rows="3" onkeyup="caddressValidation(event)"></textarea>
                            <span id="error_company_address" style="color:red"></span>
                        </div>
                        </div>
  
                    
                        <div class="row pt-2">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-info">
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
    <script src="finalprocess.js" defer></script>
<script>
    function calculateTotalDays() {
      // Get the leave start and end date values
      var startDate = document.getElementById('startDate').value;
      var enddate = document.getElementById('enddate').value;

      // Convert the date strings to Date objects
      var startDate = new Date(startDate);
      var enddate = new Date(enddate);

      // Calculate the time difference in milliseconds
      var timeDiff = enddate -startDate;

      // Calculate the text of days
      var daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24))+1;

      // Update the total_days field
      document.getElementById('total_days').value = daysDiff;
  }

// Function to calculate Gross Earning, Total Deductions, and Net Pay
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
    document.getElementById(field).addEventListener('input', function (event) {
        if (isNotEmpty(event.target.value)) {
            calculateSalary();
        }
    });
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
    document.getElementById(field).addEventListener('input', function (event) {
        if (isNotEmpty(event.target.value)) {
            calculateAllowance();
        }
    });
});
</script>

</script>
</body>
</html>
