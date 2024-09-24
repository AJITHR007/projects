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
    // Assuming all fields are required and you have validated the input data before reaching here
    $empRec = $_POST["empRec"];
    $empName = $_POST["empName"];
    $department = $_POST["department"];
    $bank_name = $_POST["bank_name"];
    $account_number = $_POST["account_number"];
    $ifsc_code = $_POST["ifsc_code"];
    $houseRent = $_POST["houseRent"];
    $medical_allowance = $_POST["medical_allowance"];
    $overtime = $_POST["overtime"];
    $base_salary = $_POST["base_salary"];
    $bonus = $_POST["bonus"];
    $commission = $_POST["commission"];
    $allowances = $_POST["allowances"];
    $tax_deductions = $_POST["tax_deductions"];
    $insurence = $_POST["insurence"];
    $retirement = $_POST["retirement"];
    $other_deductions = $_POST["other_deductions"];
    $totalpresent = $_POST["totalpresent"];
    $totalupsent = $_POST["totalupsent"];
    $totaldays = $_POST["totaldays"];
    $gross_earning = $_POST["gross_earning"];
    $total_deductions = $_POST["total_deductions"];
    $pay_month = $_POST["pay_month"];
    $company_name = $_POST["company_name"];
    $company_address = $_POST["company_address"];
    $net_pay = $_POST["net_pay"];
    $transport_allowance = $_POST["transport_allowance"];
    $food_allowance = $_POST["food_allowance"];
    $phone_allowance = $_POST["phone_allowance"];

    // Using prepared statement to prevent SQL injection
    $sql = "INSERT INTO payslip (empRec, empName, department, bank_name, account_number, ifsc_code, houseRent, medical_allowance, overtime, base_salary, bonus, commission, allowances, tax_deductions, insurence, retirement, other_deductions, net_pay, totalpresent, totalupsent, totaldays, gross_earning, total_deductions, pay_month, company_name, company_address, transport_allowance, food_allowance, phone_allowance)  
            VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssssssssssssssssssssssss", 
        $empRec, $empName, $department, $bank_name, $account_number, $ifsc_code, 
        $houseRent, $medical_allowance, $overtime, $base_salary, $bonus, $commission, 
        $allowances, $tax_deductions, $insurence, $retirement, $other_deductions, 
        $net_pay, $totalpresent, $totalupsent, $totaldays, $gross_earning, 
        $total_deductions, $pay_month, $company_name, $company_address, 
        $transport_allowance, $food_allowance, $phone_allowance);

    if ($stmt->execute()) {
                // Display success message as a JavaScript alert and redirect to empdash.php
        echo "<script>alert('New Payslip submitted successfully!'); window.location='ray.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>