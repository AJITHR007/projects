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
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : '';
    $age = isset($_POST["age"]) ? $_POST["age"] : '';
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
    $bloodGroup = isset($_POST["bloodGroup"]) ? $_POST["bloodGroup"] : '';
    $fatherName = isset($_POST["fatherName"]) ? $_POST["fatherName"] : '';
    $motherName = isset($_POST["motherName"]) ? $_POST["motherName"] : '';
    $marital = isset($_POST["marital"]) ? $_POST["marital"] : '';
    $spousename = isset($_POST["spousename"]) ? $_POST["spousename"] : '';
    $spousedob = isset($_POST["spousedob"]) ? $_POST["spousedob"] : '';
    $spouseage = isset($_POST["spouseage"]) ? $_POST["spouseage"] : '';
    $spousebloodgroup = isset($_POST["spousebloodgroup"]) ? $_POST["spousebloodgroup"] : '';
    $children = isset($_POST["children"]) ? $_POST["children"] : '';
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
    $peraddress = isset($_POST["peraddress"]) ? $_POST["peraddress"] : '';
    $resaddress = isset($_POST["resaddress"]) ? $_POST["resaddress"] : '';
    $countryId = isset($_POST["countryId"]) ? $_POST["countryId"] : '';
    $stateId = isset($_POST["stateId"]) ? $_POST["stateId"] : '';
    $cityId = isset($_POST["cityId"]) ? $_POST["cityId"] : '';
    $pincode = isset($_POST["pincode"]) ? $_POST["pincode"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $pass = isset($_POST["pass"]) ? $_POST["pass"] : '';
    $aadharCard = isset($_POST["aadharCard"]) ? $_POST["aadharCard"] : '';
    $pan = isset($_POST["pan"]) ? $_POST["pan"] : '';
    $doj = isset($_POST["doj"]) ? $_POST["doj"] : '';
    $designation = isset($_POST["designation"]) ? $_POST["designation"] : '';
    $qualification = isset($_POST["qualification"]) ? $_POST["qualification"] : '';
    $ugcourse = isset($_POST["ugcourse"]) ? $_POST["ugcourse"] : '';
    $uginstitution = isset($_POST["uginstitution"]) ? $_POST["uginstitution"] : '';
    $ugpassedout = isset($_POST["ugpassedout"]) ? $_POST["ugpassedout"] : '';
    $pgcourse = isset($_POST["pgcourse"]) ? $_POST["pgcourse"] : '';
    $pginstitution = isset($_POST["pginstitution"]) ? $_POST["pginstitution"] : '';
    $pgpassedout = isset($_POST["pgpassedout"]) ? $_POST["pgpassedout"] : '';
    $othercourse = isset($_POST["othercourse"]) ? $_POST["othercourse"] : '';
    $otherinstitution = isset($_POST["otherinstitution"]) ? $_POST["otherinstitution"] : '';
    $otherpassedout = isset($_POST["otherpassedout"]) ? $_POST["otherpassedout"] : '';
    $department = isset($_POST["department"]) ? $_POST["department"] : '';
    $passport = isset($_POST["passport"]) ? $_POST["passport"] : '';
    $work_experience = isset($_POST["work_experience"]) ? $_POST["work_experience"] : '';
    $baseSalary = isset($_POST["baseSalary"]) ? $_POST["baseSalary"] : '';
    $account_number = isset($_POST["account_number"]) ? $_POST["account_number"] : '';
    $ifsc_code = isset($_POST["ifsc_code"]) ? $_POST["ifsc_code"] : '';
    $branch_name = isset($_POST["branch_name"]) ? $_POST["branch_name"] : '';
    $bank_name = isset($_POST["bank_name"]) ? $_POST["bank_name"] : '';
    $experienceCertificates = isset($_POST["experienceCertificates"]) ? $_POST["experienceCertificates"] : '';
    $paySlip = isset($_POST["paySlip"]) ? $_POST["paySlip"] : '';
    $passportStatus = isset($_POST["passportStatus"]) ? $_POST["passportStatus"] : '';
    $contact = isset($_POST["contact"]) ? $_POST["contact"] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

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
            passport = '$passport',
            work_experience = '$work_experience',
            baseSalary = '$baseSalary',
            account_number = '$account_number',
            ifsc_code = '$ifsc_code',
            branch_name = '$branch_name',
            bank_name = '$bank_name',
            experienceCertificates = '$experienceCertificates',
            paySlip = '$paySlip',
            passportStatus = '$passportStatus',
            contact = '$contact'
  
            WHERE empRec = $empRec";

    if ($conn->query($sql) === TRUE) {
        echo "update successful";
        // header("Location: example.php/?SUCCESS=1");
    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
