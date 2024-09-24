<html>
<head>
    <title>Editing File</title>
    <script src="holiday.js" defer></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border: 2px solid #8F4B84; /* Highlighting the border */
            position: relative; /* Added position relative */
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }

        input[type="date"],
        input[type="text"],
        select {
            width: calc(100% - 24px);
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s; /* Smooth transition for border color */
        }

        input[type="date"]:focus,
        input[type="text"]:focus,
        select:focus {
            border-color: #8F4B84; /* Highlight border color on focus */
        }

        input[type="submit"] {
            background-color: #8F4B84; /* Highlight button background color */
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 30%;
            margin-left:150px;
        }

        input[type="submit"]:hover {
            background-color: blue; /* Darken button color on hover */
        }

        .btn-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #999;
            z-index: 9999;
            outline: none;
        }

        .btn-close:hover {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Holiday Form </h1>
        <form id="holidayForm" action="holidayupdate.php" method="POST">

            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            if (isset($_GET["id"])) {
                $user_id = $_GET["id"];

                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "srays";

                $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Use parameterized query to prevent SQL injection
                $sql = "SELECT * FROM holidaytable WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();

                    echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
                    echo '<label for="dod">Date</label><br>';
                    echo '<input type="date" name="dod" id="dod" placeholder="Enter your dod" value="' . $row["dod"] . '" ><br>';
                    echo '<div class="row g-2 m-4">';
                    echo '<label for="holiday" class="form-label">Holiday Type</label>';
                    echo '<select class="form-select" name="holiday" id="holiday" >';
                    echo '<option value="">Select Holiday Type</option>';
                    echo '<option value="National Holiday">National Holiday</option>';
                    echo '<option value="Public Holiday">State Holiday</option>';
                    echo '<option value="Company Holiday">Company Holiday</option>';
                    echo '</select>';
                    echo '<span class="error" style="color:red"></span>';
                    echo '</div>';
                    echo '<label for="description">Description</label><br>';
                    echo '<input type="text" name="description" id="description" placeholder="Enter your description" value="' . $row["description"] . '" ><br>';
                    echo '<input type="submit" value="Update">';
                } else {
                    echo "User not found.";
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "Invalid user ID.";
            }
            ?>
        </form>
    </div>
    <button id="closeButton" class="btn-close" aria-label="Close">X</button>

    <script>
        // Function to validate the form before submission
        function validateForm() {
            var dod = document.getElementById('dod').value;
            var holiday = document.getElementById('holiday').value;
            var description = document.getElementById('description').value;

            // Check if any of the fields is empty
            if (dod === '' || holiday === '' || description === '') {
                alert('Please fill in all fields');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }

        // Get a reference to the form
        var form = document.getElementById('holidayForm');

        // Add form submission event listener
        form.addEventListener('submit', function(event) {
            // Validate the form before submission
            if (!validateForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Get a reference to the close button
        var closeButton = document.getElementById('closeButton');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function() {
            // Redirect to the desired page (e.g., "emdash.html")
            window.location.href = "calender.php";
        });
    </script>
</body>
</html>