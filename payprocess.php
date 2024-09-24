<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empRec = ''; // Initialize the variable
$errorMsg = ''; // Initialize the error message
$employeeDetails = []; // Initialize an array to store employee details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empRec = isset($_POST["empRec"]) ? $_POST["empRec"] : ''; // Update the value only if it's set

    // Check if the employee code is empty
    if (empty($empRec)) {
        $errorMsg = 'Please enter Employee Code.';
    } else {
        // If not empty, proceed with the database query
        $sql = "SELECT * FROM recordadd WHERE empRec= '$empRec'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $employeeDetails = $result->fetch_assoc();
        } else {
            $errorMsg = 'Employee not found.';
        }
    }
}
$conn->close();
?>


<!doctype html>
<html lang="en">
  <head>
  <title>pay process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    body {
    background-image: url(data:image/jpeg;base64,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);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}

.purpleBox {
    background-color: #249bb3;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    min-height: 200px;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.vertical-center {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    border:1px solid black;
    border-radius:5px;
    
}

.error-input {
    border-color: red !important;
}

.content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    max-width: 300px;
    gap: 40px;
}

.content label {
    margin-right: 10px; /* Add margin to the right of the label */
}

.content input[type="text"] {
    flex: 1;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.content input[type="submit"] {
    background-color: #249bb3;
    padding: 8px 16px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    border-radius: 5px;
    color: white;
}

.content input[type="submit"]:hover {
    background-color: #8F4B84;
}

.error-message {
    color: #ff0000;
    font-size: 15px;
    margin-top: 5px;
    margin-left: 125px;
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
        // Add additional form validation logic if needed
        // For now, let's just return the result of validateEmpCode
        return validateEmpCode();
    }

    // Add the input event listener to the input
    document.addEventListener('DOMContentLoaded', function () {
        const empCodeInput = document.getElementById('empRec');
        empCodeInput.addEventListener('input', validateEmpCode);

        // Handle form submission to prevent default behavior
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            validateForm().then((isValid) => {
                if (isValid) {
                    // If the form is valid, you can submit it or perform other actions
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
    <h4 class="text-white">
    <i class="fas fa-money-check-alt text-white"></i> 
    
        Employee Pay Slip
       <!-- Icon added here -->
    </h4>
</div>
<div class="col-md-9 bg-white p-3 rounded-end-2 d-flex justify-content-center align-items-center">
                <div class="container">
              
                    <form method="POST" action="payroll.php" onsubmit="return validateForm(event);">
                        <div class="content">
                            <label for="empRec">Employee Code :</label>
                            <input type="text" id="empRec" name="empRec" placeholder="Employee Code"
                                   value="<?php echo $empRec; ?>" maxlength="6" minlength="6">
                            <input type="submit" value="search">
                        </div>
                        <div id="error-message-container">
                            <?php
                            // Display the error message if it exists
                            if (!empty($errorMsg)) {
                                echo '<p class="error-message">' . $errorMsg . '</p>';
                            }
                            ?>
                        </div>
                    </form>


                <div id="success-msg" style="color:green"></div>
              </div>
          </div>
    </div>
</section>
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