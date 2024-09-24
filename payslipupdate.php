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
    $empRec = isset($_POST["empRec"]) ? $_POST["empRec"] : '';
    $empName = isset($_POST["empName"]) ? $_POST["empName"] : '';
    $department = isset($_POST["department"]) ? $_POST["department"] : '';
    $bank_name = isset($_POST["bank_name"]) ? $_POST["bank_name"] : '';
    $account_number = isset($_POST["account_number"]) ? $_POST["account_number"] : '';
    $ifsc_code = isset($_POST["ifsc_code"]) ? $_POST["ifsc_code"] : '';
    $houseRent = isset($_POST["houseRent"]) ? $_POST["houseRent"] : '';
    $medical_allowance = isset($_POST["medical_allowance"]) ? $_POST["medical_allowance"] : '';
    $overtime = isset($_POST["overtime"]) ? $_POST["overtime"] : '';
    $base_salary = isset($_POST["base_salary"]) ? $_POST["base_salary"] : '';
    $bonus = isset($_POST["bonus"]) ? $_POST["bonus"] : '';
    $commission = isset($_POST["commission"]) ? $_POST["commission"] : '';
    $allowances = isset($_POST["allowances"]) ? $_POST["allowances"] : '';
    $tax_deductions = isset($_POST["tax_deductions"]) ? $_POST["tax_deductions"] : '';
    $insurence = isset($_POST["insurence"]) ? $_POST["insurence"] : '';
    $retirement = isset($_POST["retirement"]) ? $_POST["retirement"] : '';
    $other_deductions = isset($_POST["other_deductions"]) ? $_POST["other_deductions"] : '';
    $totalpresent = isset($_POST["totalpresent"]) ? $_POST["totalpresent"] : '';
    $totalupsent = isset($_POST["totalupsent"]) ? $_POST["totalupsent"] : '';
    $totaldays = isset($_POST["totaldays"]) ? $_POST["totaldays"] : '';
    $gross_earning = isset($_POST["gross_earning"]) ? $_POST["gross_earning"] : '';
    $total_deductions = isset($_POST["total_deductions"]) ? $_POST["total_deductions"] : '';
    $pay_month = isset($_POST["pay_month"]) ? $_POST["pay_month"] : '';
    $company_name = isset($_POST["company_name"]) ? $_POST["company_name"] : '';
    $company_address = isset($_POST["company_address"]) ? $_POST["company_address"] : '';
    $net_pay = isset($_POST["net_pay"]) ? $_POST["net_pay"] : '';
    $transport_allowance = isset($_POST["transport_allowance"]) ? $_POST["transport_allowance"] : '';
    $food_allowance = isset($_POST["food_allowance"]) ? $_POST["food_allowance"] : '';
    $phone_allowance = isset($_POST["phone_allowance"]) ? $_POST["phone_allowance"] : '';

    // Check if the record with empRec and pay_month already exists in the payslip table
    $checkSql = "SELECT * FROM payslip WHERE empRec = ? AND pay_month = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $empRec, $pay_month);
    $checkStmt->execute();
    $checkStmt->store_result();


    if ($checkStmt->num_rows > 0) {
        // Update the record if it already exists
        $updateSql = "UPDATE payslip SET empName=?, department=?, bank_name=?, account_number=?, ifsc_code=?, houseRent=?, medical_allowance=?, overtime=?, base_salary=?, bonus=?, commission=?, allowances=?, tax_deductions=?, insurence=?, retirement=?, other_deductions=?, net_pay=?, totalpresent=?, totalupsent=?, totaldays=?, gross_earning=?, total_deductions=?, company_name=?, company_address=?, transport_allowance=?, food_allowance=?, phone_allowance=? WHERE empRec=? AND pay_month=?";
        
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssssssssssssssssssssssssssss", 
            $empName, $department, $bank_name, $account_number, $ifsc_code, 
            $houseRent, $medical_allowance, $overtime, $base_salary, $bonus, $commission, 
            $allowances, $tax_deductions, $insurence, $retirement, $other_deductions, 
            $net_pay, $totalpresent, $totalupsent, $totaldays, $gross_earning, 
            $total_deductions, $company_name, $company_address, 
            $transport_allowance, $food_allowance, $phone_allowance, $empRec, $pay_month);
        
        if ($updateStmt->execute()) {
            echo "<script>alert('Payslip updated successfully!'); window.location='paymodify.php';</script>";
            
        } else {
            echo "Error updating payslip: " . $updateStmt->error;
        }
        
        $updateStmt->close();
    } else {
        echo "Payslip not found for updating.";
    }

    $checkStmt->close();
}

$conn->close();
?>