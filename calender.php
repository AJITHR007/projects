<!DOCTYPE html>
<html lang="en">

<head>
    <title>Holiday Calender</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="holiday.js" defer></script>
    
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
        }
        
        .purpleBox {
            background-color: #249bb3;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            min-height: 600px;
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

/* Responsive Table */
.container{
    background-color:white;
}
#closeButton {
        position: fixed;
        top: 20px; /* Adjust the top position as needed */
        right: 20px; /* Adjust the right position as needed */
        z-index: 9999; /* Ensure it's above other elements */
    }
@media (max-width: 768px) {
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }

    .table-responsive > .table {
        margin-bottom: 0;
    }
}
       .profile-container{
                max-width:1300px;
                margin:10px  auto;
                background-color:white;
                border-radius: 5px;
                box-shadow: 00 10px rgba(0,0,0.1);
                padding:10px;
                overflow-x: auto;

            }
            h2{
                color: red;
            }

            table{
                width: 100%;
                border-collapse: collapse;
            }
            th,td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: center;
            }
            th{
                background-color: #249bb3;
            }
            tr:nth-child(even){
                background-color: navy blue;
            }
            tr:hover{
                background-color: #249bb3;
            }
            h2{
                color: #333;

            }
            
    </style>
</head>

<body>
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
            <div class="col-md-3 purpleBox rounded-start-2 position-relative">
    <h4 class="text-white" style="margin-top: 200px;">
        Holiday Calendar <!-- Text here -->
        <i class="fa-solid fa-gifts fa-1x text-white"></i> <!-- Icon here -->
    </h4>
</div>

                <div class="col-md-9 bg-white p-3 rounded-end-2">
                    <form id="form" action="connection.php" method="POST">
                        <div class="row pb-2 mt-4">
                            <h4>
                                <center>Holiday Record Entry</center>
                            </h4>
                        </div>
                        <div class="row g-2 m-4">
                            <label for="dod" class="form-label">Date</label>
                            <input type="date" class="form-control" name="dod" id="dod"  onkeydown="dodvalidation(event)" onblur="dodvalidation(event)">
                            <span id="error" style="color:red"></span>
                        </div>
                     
                        <div class="row g-2 m-4">
                            <label for="holiday" class="form-label">Holiday Type</label>
                            <select class="form-select" name="holiday" id="holiday" onkeyup="holidayvalidation(event)" onblur="holidayvalidation(event)">
                            <option value=" ">Select Holiday Type</option>
                            <option value="National Holiday">National Holiday</option>
                            <option value="Public Holiday">State Holiday</option>
                          	<option value="Company Holiday">Company Holiday</option>
                            </select>
                            <span class="error " style="color:red "></span>
                        </div>
                        <div class="row g-2 m-4">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description" maxlength="50"  onkeyup="descriptionvalidation(event)" onblur="descriptionvalidation(event)">
                            <span id="error" style="color:red"></span>
                        </div>
                        
                        <div class="row pt-4">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class="btn btn-primary">Add Holiday</button>
                                
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
   

    <!-- Add this section after the form -->
<div class="container mt-5">
    <h4>Holiday Records:</h4>
    <div class = "profile-conainer">    
    <?php
$servername = "localhost";
$dbusername= "root";
$dbpassword ="";
$dbname = "srays";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute a query to fetch the results
$sql = "SELECT id, dod, holiday, description FROM holidaytable";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
    <th>SL.NO</th>
           <th>Date</th>
           <th>Holiday</th>
           <th>Description</th>
           <th>Edit</th>
           <th>Delete</th>
           </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["dod"] . "</td>";
        echo "<td>" . $row["holiday"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";

        echo '<td><a href= "holidayedit.php?id=' . $row['id'] . '" class="btn">Edit</a></td>';
        echo '<td><a href="javascript:void(0);" onclick="confirmDelete(' . $row['id'] . ');" class="btn">Delete</a></td>';
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No registered Leaves.";
}

$conn->close();
?>

</div>
</div>
<script>
        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete this holiday?");
            if (result) {
                window.location.href = 'holidaydelete.php?id=' + id;
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
        window.location.href = "ray.php";
    });
</script> 
<script>
document.getElementById("dod").addEventListener('keypress', (e) => {
         e.preventDefault();
        });
        </script>
</body>

</html>