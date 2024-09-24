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
            $row = $result->fetch_assoc();
        }
    }
}

// Check if the user has confirmed the deletion
if (isset($_GET['id']) && isset($_GET['confirm']) && $_GET['confirm'] == '1') {
    $id = $_GET['id'];

    // Use prepared statement to delete the record
    $stmt = $conn->prepare("DELETE FROM recordadd WHERE empRec = ?");
    $stmt->bind_param("s", $id); // Use "s" for string
    $stmt->execute();
    $stmt->close();

    // Redirect to the main page after deletion
    header("Location: viewemployee.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 150PX;
        padding: 0;
    }

    .container {
        width: 100%;
        margin: 10px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .content {
      
        align-items: center;
        margin-bottom: 20px;
          
    }
    label {
        font-weight: bold;
        margin-right: 10px;
    }

    input[type="text"] {
        padding: 8px;
        width: 200px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Change the hover color for the search button */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .record-heading {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .hr-line {
        border: none;
        border-top: 1px solid #ddd;
        margin: 10px 0;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
    }

    .edit-button,
    .delete-button,
    .toggle-status-button {
        text-decoration: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
        display: inline-block;
    }

    .edit-button {
        background-color: #007bff;
        color: #fff;
    }

    .toggle-status-button {
        background-color: #28a745; /* Green for enabled, red for disabled */
        color: #fff;
    }

    .toggle-slider {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle-slider input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #28a745;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #f2ff00;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: red;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .disabled-row input[type="text"] {
        background-color: white;
        color: #808080;
        cursor: not-allowed;
    }

    .edit-button {
        margin-right: 10px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 10px;
        display: inline-block;
    }

    .delete-button {
        background-color: #dc3545;
        color: #fff;
        text-decoration: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
        display: inline-block;
    }

    .delete-button:hover {
        background-color:skyblue; /* Darker red color on hover */
    }
    .error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
    margin-left: -110px;
}
    .error-input {
        border: 1px solid #ff0000 !important;
    }
    .btn-success {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
}

.btn-success:hover {
    background-color: green; /* Change the hover color for the "Add New Employee" button */
}
.btn-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.5rem;
    color: #000;
}

.btn-close:hover {
    color: #999;
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
    async function toggleActiveStatus(empRec, isActive) {
            console.log("isActive...",isActive);
            if (isActive) {
                sendDeactivationEmail(empRec);
            }
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response if needed
                    console.log(xhr.responseText);
                }
            };
            xhr.open('GET', `updateActiveStatus.php?empRec=${empRec}&isActive=${isActive ? '1' : '0'}`, true);
            xhr.send();
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
    <div class="container">
        <form method="POST" action="" onsubmit="return validateForm(event);">
       <center> <h3>Employee Details</h3> <center> 
            <div class="content">
                <label for="empRec">Employee Code :</label>
                <input type="text" id="empRec" name="empRec" placeholder="Employee Code" value="<?php echo $empRec; ?>" maxlength="6" minlength="6">
                <input type="submit" value="search">
                <a href="addentry.php" class="btn btn-success">Add New Employee</a><br>
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

        <div id="error-message-container">
            <?php
                // Assuming you have a database connection, replace the connection details accordingly
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "srays";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Validate empRec or perform other form processing as needed
                    $empRec = isset($_POST["empRec"]) ? $_POST["empRec"] : '';

                    // Check if the employee code is empty
                    if (empty($empRec)) {
                        $errorMsg = 'Please enter Employee Code.';
                    } else {
                        $sql = "SELECT * FROM recordadd WHERE empRec = '$empRec'";
                        $result = $conn->query($sql);

                        // Check if data is found
                        if ($result !== false && $result->num_rows > 0) {
                            echo "<table>
                                    <tr>
                                        <th>Employee Record</th>
                                        <th>Employee Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Active</th>
                                        <th scope='col' colspan='2'>Actions</th>
                                    </tr>";

                            // Output data for each row
                            while ($row = $result->fetch_assoc()) {
                                $isChecked = $row['active'] == "1" ? "checked": "";
                                echo "<tr>
                                        <td>{$row["empRec"]}</td>
                                        <td>{$row["empName"]}</td>
                                        <td>{$row["department"]}</td>
                                        <td>{$row["designation"]}</td>
                                        <td>{$row["email"]}</td>
                                        <td>{$row["phone"]}</td>
                                        <td>
                                        <label class='toggle-slider'>
                                        <input type='checkbox' {$isChecked} onchange='toggleActiveStatus(\"{$row["empRec"]}\", this.checked)' " . (isset($row["active"]) && $row["active"] == 'enabled' ? 'checked' : '') . " class='active-toggle'>
                                        <span class='slider'></span>
                                    </label>
                    </td>
                                        <td>
                                            <form method='post' action='employeemodify.php'>
                                                <input type='hidden' name='empRec' value='{$row["empRec"]}'>
                                                <input type='submit' value='Edit' class='edit-button'>
                                            </form>
                                        </td>
                                        <td>
                                            <a href='#' onclick=\"confirmDelete('{$row["empRec"]}')\" class='delete-button'>Delete</a>
                                        </td>
                                    </tr>";
                            }

                            echo "</table>";
                        } else {
                            echo "NO DATA FOUND";
                        }

                        // Close the result set
                        if ($result !== false) {
                            $result->close();
                        }
                    }
                }
            ?>
        </div>
    </div>
    <script>
    function handleToggleChange(empRec, isChecked) {
        // If the toggle is checked (1), trigger AJAX request
       
    }

    function sendDeactivationEmail(empRec) {
    // Trigger an AJAX request to the PHP script that sends the email
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response if needed
            console.log(xhr.responseText);
        }
    };

    xhr.open('GET', `sendDeactivationEmail.php?empRec=${empRec}`, true);
    xhr.send();
}
</script>

    <script>
        function confirmDelete(empRec) {
            var result = confirm("Are you sure you want to delete?");
            if (result) {
                // Redirect to this same page with the empRec parameter and confirm=1
                window.location.href = "viewemployee.php?id=" + encodeURIComponent(empRec) + "&confirm=1";
            } else {
                // Handle cancellation or do nothing
            }
        }
    </script>
   <button id="closeButton" class="btn-close" aria-label="Close">X</button>
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