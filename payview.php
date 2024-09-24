<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);

if($conn->connect_error) {
    die("connection failed:" .$conn->connect_error);
}

$employee_codetosearch = "";
$row = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){   
    $employee_codetosearch = $_POST["empRec"];

$sql = "SELECT *FROM payslip WHERE empRec= '$employee_codetosearch'";
$result=$conn->query($sql);

if($result->num_rows >0){
    $row=$result->fetch_assoc();
}
}
$conn->close();
?>


<!doctype html>
<html lang="en">
  <head>
  <title> Pay Slip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="assets/js/modify.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <style>
     body
      {
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
        width:1500px;
      }
      .conainer{
        width:2000px;
      }
    .purpleBox{
        background-color: #8F4B84;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-between;
        text-align: center;
        min-height: 600px;
      }
     .btn-primary {
        background-color: #95598b;
        border-color: #8F4B84;
      }
    .btn-primary:hover, .btn-primary:focus {
        background-color: #95598b;
        border-color: #95598b;
      }
    .purpleBox img{
            bottom: 0;
        }
    .row input{
      margin-left:10px;
      width:60%;
    }
    .row button{
      width:10%;
      border-radius:10px;
      margin-left:-10%
    }
     .col-md-6 select{
      border-color: #8F4B84;
    }
    label{
      width:200px;
      display:block;
      margin-top:5px;
      margin-left:100px;
    }
   .col-md-9 input{
      margin-left:150px;
      width:50%;
      text-align:center;
      border-radius:10px;
      padding:10px;
    }
   .table{
    margin-top:50px;
    width:80%;
    margin-left:100px;
   }
   h6{
    margin-top:20px;
    margin-left:100px;
   }
   .error-message {
    color: #ff0000;
    font-size: 15px;
    margin-top: 5px;
    margin-left: 150px;
}
    .error-input {
        border: 1px solid #ff0000 !important;
    }
</style>
<script>
        function displayErrorMessage(message) {
            const errorMessageContainer = document.getElementById('error-message-container');
            errorMessageContainer.innerHTML = `<p class="error-message">${message}</p>`;
        }

        function hideErrorMessage() {
            const errorMessageContainer = document.getElementById('error-message-container');
            errorMessageContainer.innerHTML = '';
        }

        async function validateemployee_code() {
            const employee_codeInput = document.getElementById('empRec');
            const employee_codeValue = employee_codeInput.value.trim();

            // Check if the input is empty
            if (employee_codeValue === '') {
                employee_codeInput.classList.add('error-input');
                displayErrorMessage('Please enter Employee Code.');
                return false;
            }

            // Define a regular expression pattern for uppercase letters and numbers
            const pattern = /^[A-Z0-9]{6}$/;

            // Check if the code matches the pattern
            if (!pattern.test(employee_codeValue)) {
                employee_codeInput.classList.add('error-input');
                displayErrorMessage('Employee Code must be alphanumeric, and no spaces are allowed.');
                return false;
            } else {
                employee_codeInput.classList.remove('error-input');
                hideErrorMessage();

                // Check if the employee code exists in the database
                const isUserValid = await checkEmployeeCodeInDatabase(employee_codeValue);

                if (!isUserValid) {
                    employee_codeInput.classList.add('error-input');
                    displayErrorMessage('Invalid Employee Code. User not found.');
                    return false;
                }

                return true;
            }
        }

        async function checkEmployeeCodeInDatabase(employee_code) {
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
                xhr.open('GET', 'checkEmployeeCode.php?employee_code=' + employee_code, true);
                xhr.send();
            });
        }

        function validateForm(event) {
            return validateemployee_code();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const employee_codeInput = document.getElementById('empRec');
            employee_codeInput.addEventListener('input', validateemployee_code);

            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                validateForm().then((isValid) => {
                    if (isValid) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</head>
<body>

    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                    <h4 class="text-white" style="margin-top: 200px;">Employee Pay view</h4>
                    <img src="img url 1.png" class="img-fluid position-absolute" alt="" />
                </div>
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                <form method= "POST" action="">
                <div class="row">
                        <input type="text" class="form-control" id="empRec" name="empRec" placeholder="Enter employee code "
                         value = "<?php echo $employee_codetosearch; ?>" onkeyup="numberValidation()" >
                        <button type="submit"  value="search">
                            <i class="fas fa-search" value="search"></i>
                        </button>
                   </div>
                  </form>      
                  <?php
 // Check if the data is not empty
if (!empty($row)) {

    echo "<table class='table'>";
    
    echo "<tr>
            <th>Company Name </th>
            <td>" . $row["company_name"] . "</td>
          </tr>";
    
    echo "<tr>
            <th>Company Address</th>
            <td>" . $row["company_address"] . "</td>
          </tr>";

    echo "<tr>
            <th>Employee code</th>
            <td>" . $row["empRec"] . "</td>
          </tr>";
    
    echo "<tr>
            <th>Name</th>
            <td>" . $row["empName"] . "</td>
          </tr>";

    echo "<tr>
            <th>Department</th>
            <td>" . $row["department"] . "</td>
          </tr>";

   
    echo "</table>";
    echo "<h6> Salary start and End   Details</h6>";
    echo "<table class='table table-bordered'>";
    echo "<tr>
            <th>Start Date</th><th>End Date</th><th>Total Days</th>
                     </tr>";
    
    echo "<tr>
    <td>" . $row["totalpresent"] . "</td>
            <td>" . $row["totalupsent"] . "</td>
            <td>" . $row["totaldays"] . "</td>
          </tr>";


    echo "</table>";
    echo "<h6> Account  Details</h6>";
    echo "<table class='table table-bordered'>";
    echo "<tr>
            <th>Bank Name</th><th>Account Number</th><th>Account Type</th>
                     </tr>";
    
    echo "<tr>
    <td>" . $row["bank_name"] . "</td>
            <td>" . $row["account_number"] . "</td>
            <td>" . $row["account_type"] . "</td>
          </tr>";


    echo "</table>";
    echo "<h6>Salary details</h6>";
    echo "<table class='table table-bordered'>";
    echo "<tr>
            <th>Earnings</th>  <th>Amount</th> <th>Deductions</th><th>Amount</th>
          </tr>";
    
    echo "<tr>
    <th>Base Salary</th>
    <td>" . $row["base_salary"] . "</td>
        <th>Insurence</th>
        <td>" . $row["insurence"] . "</td>    
    </tr>";

    echo "<tr>
            <th>Bonus</th>
            <td>" . $row["bonus"] . "</td>
            <th>Tax Deductions</th>
            <td>" . $row["other_deductions"] . "</td>
          </tr>";

    echo "<tr>
            <th>Allowance</th>
            <td>" . $row["allowances"] . "</td>
            <th>Retirement Saving</th>
            <td>" . $row["retirement"] . "</td>
          </tr>";

    echo "<tr>
           <th>Overtime</th>
           <td>" . $row["overtime"] . "</td>
            <th> Commission</th>
            <td>" . $row["commission"] . "</td>
          </tr>";

    echo "<tr>
              <th></th>
              <td></td>
            <th>Tax Deductions</th>
            <td>" . $row["tax_deductions"] . "</td>
          </tr>";
    
          echo "<tr>
          <th>Gross Earning</th>
          <td>" .$row["gross_earning"] . "</td>
        <th>Total Deductions</th>
        <td>" . $row["total_deductions"] . "</td>
      </tr>";   
      echo "<tr>
      <td></td>
      <td></td>
    <th>Net Pay </th>
    <td>" .$row["net_pay"] . "</td>

</tr>";

    echo "</table>";
   
    // Additional Details


} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    
}
 ?>
<div id="error-message-container"></div>
                    
                </div>
            </div>


        </div>
    </section>
   
</body>
</html>