<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Assuming you have an ID for the record you want to update

    $empRec = $_POST["empRec"];
    $overtime = $_POST["overtime"];
    $base_salary = $_POST["base_salary"];
    $bonus = $_POST["bonus"];
    $commission = $_POST["commission"];
    $allowances = $_POST["allowances"];
    $tax_deductions = $_POST["tax_deductions"];
    $insurence = $_POST["insurence"];
    $retirement = $_POST["retirement"];
    $other_deductions = $_POST["other_deductions"];
    $startDate = $_POST["startDate"];
    $enddate = $_POST["enddate"];
    $total_days = $_POST["total_days"];
    $gross_earning = $_POST["gross_earning"];
    $total_deductions = $_POST["total_deductions"];
    $payment_method = $_POST["payment_method"];
    $company_name = $_POST["company_name"];
    $company_address = $_POST["company_address"];
    $net_pay = $_POST["net_pay"];
   
    $sql = "UPDATE recordadd SET 
            overtime='$overtime', 
            base_salary='$base_salary', 
            bonus='$bonus', 
            commission='$commission', 
            allowances='$allowances', 
            tax_deductions='$tax_deductions', 
            insurence='$insurence', 
            retirement='$retirement', 
            other_deductions='$other_deductions', 
            startDate='$startDate', 
            enddate='$enddate', 
            total_days='$total_days', 
            gross_earning='$gross_earning', 
            total_deductions='$total_deductions', 
            payment_method='$payment_method', 
            company_name='$company_name', 
            company_address='$company_address', 
            net_pay='$net_pay' 
            WHERE empRec='$empRec'";

    if ($conn->query($sql) === TRUE) {
        echo "Update successful";
        // header("Location: example.php/?SUCCESS=1");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>