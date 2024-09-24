<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "srays";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure empRec is set
    if (isset($_POST["empRec"])) {
        $empRec = $_POST["empRec"];
        $empName = $_POST["empName"];
        $dob = $_POST["dob"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];
        $bloodGroup = $_POST["bloodGroup"];
        $fatherName = $_POST["fatherName"];
        $motherName = $_POST["motherName"];
        $marital = $_POST["marital"];
        $spousename = $_POST["spousename"];
        $spousedob = $_POST["spousedob"];
        $spouseage = $_POST["spouseage"];
        $spousebloodgroup = $_POST["spousebloodgroup"];
        $children = $_POST["children"];
        $phone = $_POST["phone"];
        $peraddress = $_POST["peraddress"];
        $resaddress = $_POST["resaddress"];
        $countryId = $_POST["countryId"];
        $stateId = $_POST["stateId"];
        $cityId = $_POST["cityId"];
        $pincode = $_POST["pincode"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $pass = $_POST["pass"];
        $aadharCard = $_POST["aadharCard"];
        $pan = $_POST["pan"];
        $doj = $_POST["doj"];
        $designation = $_POST["designation"];
        $qualification = $_POST["qualification"];
        $ugcourse = $_POST["ugcourse"];
        $uginstitution = $_POST["uginstitution"];
        $ugpassedout = $_POST["ugpassedout"];
        $pgcourse = $_POST["pgcourse"];
        $pginstitution = $_POST["pginstitution"];
        $pgpassedout = $_POST["pgpassedout"];
        $othercourse = $_POST["othercourse"];
        $otherinstitution = $_POST["otherinstitution"];
        $otherpassedout = $_POST["otherpassedout"];
        $department = $_POST["department"];
        $contact = $_POST["contact"];
        $work_exp = $_POST["work_experience"];
        $acc_number = $_POST["account_number"];
        $ifsc_code = $_POST["ifsc_code"];
        $branch_name = $_POST["branch_name"];
        $bank_name = $_POST["bank_name"];
        $passportStatus = $_POST["passportStatus"];
        $passport = $_POST["passport"];
        
        // Your SQL query for update
        $sql = "UPDATE recordadd SET 
                    empName = '$empName',
                    dob = '$dob',
                    age = '$age',
                    gender = '$gender',
                    bloodGroup = '$bloodGroup',
                    fatherName = '$fatherName',
                    motherName = '$motherName',
                    marital = '$marital',
                    spousename = '$spousename',
                    spousedob = '$spousedob',
                    spouseage = '$spouseage',
                    spousebloodgroup = '$spousebloodgroup',
                    children = '$children',
                    phone = '$phone',
                    peraddress = '$peraddress',
                    resaddress = '$resaddress',
                    countryId = '$countryId',
                    stateId = '$stateId',
                    cityId = '$cityId',
                    pincode = '$pincode',
                    email = '$email',
                    username = '$username',
                    pass = '$pass',
                    aadharCard = '$aadharCard',
                    pan = '$pan',
                    doj = '$doj',
                    designation = '$designation',
                    qualification = '$qualification',
                    ugcourse = '$ugcourse',
                    uginstitution = '$uginstitution',
                    ugpassedout = '$ugpassedout',
                    pgcourse = '$pgcourse',
                    pginstitution = '$pginstitution',
                    pgpassedout = '$pgpassedout',
                    othercourse = '$othercourse',
                    otherinstitution = '$otherinstitution',
                    otherpassedout = '$otherpassedout',
                    department = '$department',
                    contact = '$contact',
                    passportStatus = '$passportStatus',
                    passport = '$passport',
                    work_experience = '$work_exp',
                    account_number = '$acc_number',
                    ifsc_code = '$ifsc_code',
                    branch_name = '$branch_name',
                    bank_name = '$bank_name'
                WHERE empRec = '$empRec'";
        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Handle success
            echo "<script>alert('update successfully!'); window.location='viewemployee.php';</script>";
        } else {
            // Handle errors
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Handle empRec not set
        echo "Employee code is not set";
    }
}

$conn->close();
?>