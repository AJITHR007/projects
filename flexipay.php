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
    $employee_codetosearch = $_POST["employee_code"];

$sql = "SELECT *FROM pay_structure WHERE employee_code= '$employee_codetosearch'";
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
  <title>Employee Pay Process</title>
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
        background-image: url(background\ img.jpg);
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
        background-color: #dbd5d5;
        border-color: #dbd5d5;
        border:  1px solid #dbd5d5;
      }
    .btn-primary:hover, .btn-primary:focus {
        background-color: #dbd5d5;
        border-color: #dbd5d5;
        border:  1px solid #dbd5d5;
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
      margin-left:-10%
     
    }
     .col-md-6 select{
      border-color: #8F4B84;
    }
    label{
      width:200px;
      display:block;
      margin-top:5px;
      margin-left:150px;
    }
   .col-md-9 input{
      margin-left:150px;
      width:60%;
      text-align:center;
      border-radius:5px;
      padding:8px;
      border:  1px solid #dbd5d5;
      box-shadow: 2px 2px 2px 2px #dbd5d5;
      
    }
    h4{
        text-align:center; 
    }

</style>
</head>
<body>

    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">

                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                    <h4 class="text-white" style="margin-top: 200px;">Employee Flexi Pay </h4>
                    <img src="img url 1.png" class="img-fluid position-absolute" alt="" />
                </div>
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                <form method="POST" action="" onsubmit="return validateForm();">
                <div class="row">
                        <input type="text" class="form-control" id="employee_code" name="employee_code" placeholder="Enter employee code or name"
                         value = "<?php echo $employee_codetosearch; ?>" required >
                        <button type="submit"  value="search">
                            <i class="fas fa-search" value="search"></i>
                        </button>
                   </div>
                  </form>      
                  <?php
 
 if (!empty($row)) {
    echo "<h4>Employee Flexi Pay</h4>";
    echo "<form method='post' action='process_form.php'>";
    
       echo "<div>  
              <label for='employee_code'>Employee Code</label>
              <input type='text' name='employee_code' value='" . $row["employee_code"] . "'>
          </div>";

    echo "<div>
              <label for='employee_name'>Employee Name</label>
              <input type='text' name='employee_name' value='" . $row["employee_name"] . "'>
          </div>";


    echo "<div>
              <label for='base_salary'>Base Salary</label>
              <input type='text' name='base_salary' value='" . $row["base_salary"] . "'>
          </div>";

    echo "<div>
              <label for='houseRent'>House Rent</label>
              <input type='text' name='houseRent' value='" . $row["houseRent"] . "'>
          </div>";

    echo "<div>
              <label for='transport_allowance'>Transport Allowance</label>
              <input type='text' name='transport_allowance' value='" . $row["transport_allowance"] . "'>
          </div>";

echo "<div>
          <label for='phone_allowance'>Phone Allowance</label>
          <input type='text' name='phone_allowance' value='" . $row["phone_allowance"] . "'>
      </div>";

echo "<div>
          <label for='medical_allowance'>Medical Allowance</label>
          <input type='text' name='medical_allowance' value='" . $row["medical_allowance"] . "'>
      </div>";


    echo "</form>";
}elseif($_SERVER["REQUEST_METHOD"] == "POST") {
    ECHO "NO DATA FOUND";
 }
 ?>
    </div>
</div>
<script>
        function validateForm() {
        const employee_codeInput = document.getElementById("employee_code");
        const employee_codeValue = employee_codeInput.value.trim();

        // Check if the employee code is empty
        if (employee_codeValue === "") {
            showError(employee_codeInput, 'Employee Code is required');
            return false; // Return false to prevent form submission
        } else {
            hideError(employee_codeInput);
        }

        // Check if the employee code contains only numbers
        const isValidEmployeeCode = /^\d+$/.test(employee_codeValue);
        if (!isValidEmployeeCode) {
            showError(employee_codeInput, 'Employee Code should contain only numbers');
            return false; // Return false to prevent form submission
        } else {
            hideError(employee_codeInput);
        }

        return true; // Return true to allow form submission
    }

    function showError(inputElement, message) {
        // Add code to display the error message, e.g., show an error message below the input
        const errorDiv = inputElement.nextElementSibling;
        inputElement.classList.add("error-input");
        errorDiv.textContent = message;
        errorDiv.classList.add("show");
        errorDiv.classList.remove("hide");
    }

    function hideError(inputElement) {
        // Add code to hide the error message, e.g., hide the error message below the input
        const errorDiv = inputElement.nextElementSibling;
        inputElement.classList.remove("error-input");
        errorDiv.textContent = "";
        errorDiv.classList.remove("show");
        errorDiv.classList.add("hide");
    }
    </script>
</body>
</html>
