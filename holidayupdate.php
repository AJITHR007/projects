<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "srays";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("connection failed:" . $conn->connect_error);
    }

    $user_id = $_POST["user_id"];
    $dod = $_POST["dod"];
    $holiday = $_POST["holiday"];
    $description = $_POST["description"];

    $sql = "UPDATE holidaytable SET
        dod ='$dod',
        holiday = '$holiday',
        description = '$description'
        WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Display success message as a JavaScript alert
        echo "<script>
                alert('Calendar updated successfully.');
                window.location.href = 'calender.php';
              </script>";
    } else {
        echo "Invalid: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Invalid error.";
}
?>
