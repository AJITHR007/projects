<?php

// include 'dbconnection.php';
include 'PHPMailer/PHPMailer.php';
include 'PHPMailer/Exception.php';
include 'PHPMailer/SMTP.php';

$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="srays";
$conn=new mysqli($servername,$dbusername,$dbpassword,$dbname);
if($conn->connect_error)
{
    die("connection failed:" .$conn->connect_error);
}

// echo "Test";
// exit;
$empRec = '';
$empName = '';
$dob = '';
$age = '';
$gender = '';
$bloodGroup = '';
$fatherName = '';
$marital = '';
$spousename = '';
$spousedob = '';
$spouseage = '';
$spousebloodgroup = '';
$children = '';
$motherName = '';
$phone = '';
$peraddress = '';
$resaddress = '';
$countryId = '';
$stateId = '';
$cityId = '';
$pincode = '';
$email = '';
$username = '';
$pass = '';
$aadharCard = '';
$pan = '';
$doj = '';
$designation = '';
$qualification = '';
$ugcourse = '';
$uginstitution = '';
$ugpassedout = '';
$pgcourse = '';
$pginstitution = '';
$pgpassedout = '';
$othercourse = '';
$otherinstitution = '';
$otherpassedout = '';
$department = "";
$contact ='';
$work_exp = "";
$acc_number = "";
$ifsc_code = "";
$branch_name = "";
$bank_name = "";
$passportStatus = "";
$passport = "";
$alert_message = "";

if($_SERVER["REQUEST_METHOD"]=="POST" ){
	

// exit;
if(isset($_POST["empRec"])) {
	$empRec = $_POST["empRec"];
}
if(isset($_POST["empName"])) {
	$empName = $_POST["empName"];
}
if(isset($_POST["dob"])) {
	$dob = $_POST["dob"];
}
if(isset($_POST["age"])) {
	$age = $_POST["age"];
}
if(isset($_POST["gender"])) {
	$gender = $_POST["gender"];
}
if(isset($_POST["bloodGroup"])) {
	$bloodGroup = $_POST["bloodGroup"];
}
if(isset($_POST["fatherName"])) {
	$fatherName = $_POST["fatherName"];
}
if(isset($_POST["motherName"])) {
	$motherName = $_POST["motherName"];
}
if(isset($_POST["marital"])){
	$marital = $_POST["marital"];
}
if(isset($_POST["spousename"])){
	$spousename = $_POST["spousename"];
}
if(isset($_POST["spousedob"])){
	$spousedob = $_POST["spousedob"];
}
if(isset($_POST["spouseage"])){
	$spouseage = $_POST["spouseage"];
}
if(isset($_POST["spousebloodgroup"])){
	$spousebloodgroup = $_POST["spousebloodgroup"];
}
if(isset($_POST["children"])){
	$children = $_POST["children"];
}
if(isset($_POST["phone"])){
	$phone = $_POST["phone"];
}
if(isset($_POST["peraddress"])){
	$peraddress = $_POST["peraddress"];
}
if(isset($_POST["resaddress"])){
	$resaddress = $_POST["resaddress"];
}
if(isset($_POST["countryId"])) {
	$countryId = $_POST["countryId"];
}
if(isset($_POST["stateId"])) {
	$stateId = $_POST["stateId"];
}
if(isset($_POST["cityId"])) {
	$cityId = $_POST["cityId"];
}
if(isset($_POST["pincode"])){
	$pincode = str_replace(' ', '', $_POST["pincode"]);
}
if(isset($_POST["email"])){
	$email = $_POST["email"];
}
if(isset($_POST["username"])){
	$username = $_POST["username"];
}
if(isset($_POST["pass"])){
	$pass = $_POST["pass"];
}
if(isset($_POST["aadharCard"])){
	$aadharCard = $_POST["aadharCard"];
}
if(isset($_POST["pan"])){
	$pan = $_POST["pan"];
}
if(isset($_POST["doj"])){
	$doj = $_POST["doj"];
}
if(isset($_POST["designation"])){
	$designation = $_POST["designation"];
}
if(isset($_POST["qualification"])){
	$qualification = $_POST["qualification"];
}
if(isset($_POST["ugcourse"])){
	$ugcourse = $_POST["ugcourse"];
}
if(isset($_POST["uginstitution"])){
	$uginstitution = $_POST["uginstitution"];
}
if(isset($_POST["ugpassedout"])){
	$ugpassedout = $_POST["ugpassedout"];
}
if(isset($_POST["pgcourse"])){
	$pgcourse = $_POST["pgcourse"];
}
if(isset($_POST["pginstitution"])){
	$pginstitution = $_POST["pginstitution"];
}
if(isset($_POST["pgpassedout"])){
	$pgpassedout = $_POST["pgpassedout"];
}
if(isset($_POST["othercourse"])){
	$othercourse = $_POST["othercourse"];
}
if(isset($_POST["otherinstitution"])){
	$otherinstitution = $_POST["otherinstitution"];
}
if(isset($_POST["otherpassedout"])){
	$otherpassedout = $_POST["otherpassedout"];
}
if(isset($_POST["department"])){
	$department = $_POST["department"];
}
if(isset($_POST["contact"])){
	$contact = $_POST["contact"];
}
if(isset($_POST["work_experience"])) {
	$work_exp = $_POST["work_experience"];
}
if(isset($_POST["account_number"])) {
	$acc_number = $_POST["account_number"];
}
if(isset($_POST["ifsc_code"])) {
	$ifsc_code = $_POST["ifsc_code"];
}
if(isset($_POST["branch_name"])) {
	$branch_name = $_POST["branch_name"];
}
if(isset($_POST["bank_name"])) {
	$bank_name = $_POST["bank_name"];
}
if(isset($_POST["passportStatus"])) {
	$passportStatus = $_POST["passportStatus"];
}
if(isset($_POST["passport"])) {
	$passport = $_POST["passport"];
}
$sql="INSERT INTO recordadd(
				empRec,
				empName,
				dob,
				age,
				gender,
				bloodGroup,
				fatherName,
				motherName,
				marital,
				spousename,
				spousedob,
				spouseage,
				spousebloodgroup,
				children,
				phone,
				peraddress,
				resaddress,
				countryId,
				stateId,
				cityId,
				pincode,
				email,
				username,
				pass,
				aadharCard,
				pan,
				doj,
				designation,
				qualification,
				ugcourse,
				uginstitution,
				ugpassedout,
				pgcourse,
				pginstitution,
				pgpassedout,
				othercourse,
				otherinstitution,
				otherpassedout,
				department,
                contact,
                passportStatus,
				passport,
				work_experience,
				account_number,
				ifsc_code,
				branch_name,
				bank_name
			)
			VALUES(
				'$empRec',
				'$empName',
				'$dob',
				'$age',
				'$gender',
				'$bloodGroup',
				'$fatherName',
				'$motherName',
				'$marital',
				'$spousename',
				'$spousedob',
				'$spouseage',
				'$spousebloodgroup',
				'$children',
				'$phone',
				'$peraddress',
				'$resaddress',
				'$countryId',
				'$stateId',
				'$cityId',
				'$pincode',
				'$email',
				'$username',
				'$pass',
				'$aadharCard',
				'$pan',
				'$doj',
				'$designation',
				'$qualification',
				'$ugcourse',
				'$uginstitution',
				'$ugpassedout',
				'$pgcourse',
				'$pginstitution',
				'$pgpassedout',
				'$othercourse',
				'$otherinstitution',
				'$otherpassedout',
				'$department',
                '$contact',
                '$passportStatus',
				'$passport',
				'$work_exp',
				'$acc_number',
				'$ifsc_code',
				'$branch_name',
				'$bank_name'
				)";


    //    echo $sql;
if($conn->query($sql)===TRUE){

	try {
		// $getRequestDetails = $conn->prepare("SELECT * FROM compensation WHERE id = ?");
		// $getRequestDetails->execute([$requestId]);
		// $requestDetails = $getRequestDetails->fetch(PDO::FETCH_ASSOC);

		// Send an email to the user using PHPMailer
		$mail = new PHPMailer\PHPMailer\PHPMailer(true);

		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'umaatc@gmail.com';
		$mail->Password = 'kwhf znks pfrv dnzw';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->setFrom('umaatc@gmail.com', 'Srays');
		$mail->addAddress($email, $empName);
		$mail->Subject = 'Registration Successfull';
		$mail->isHTML(true);
		$mail->Body = '<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login Information</title>
		</head>
		<body>
		<p>Dear '.$empName.',</p>
        <p>Welcome TO Srays!</p>
        <p>You Are Succssfully Onboarded!</p>
		<p>Below are your login credentials:</p>
		<ul>
		  <li><strong>Username:</strong>'.$email.' </li>
		  <li><strong>Password:</strong> '.$pass.'</li>
		</ul>
		<p>Thank you </p>
		</body>
		</html>';

		if ($mail->send()) {
			// Email sent successfully
			// echo 'Request with ID ' . $requestId . ' approved and email sent to the user.';
			
			// // Insert the notification into the database
			// $action_user_id = $_SESSION['user_id']; // Get the user ID from the session
			// $notification_message = "Your Compensation request has been approved";
			// $insert_notification = $conn->prepare("INSERT INTO notifications (user_id, message, status) VALUES (?, ?, 'unread')");
			// $insert_notification->execute([$action_user_id, $notification_message]);
            $alert_message = "Form submitted successfully!";
            // header("Location: ".$_SERVER['PHP_SELF']);
            // exit();

		} else {
			// Email failed to send
			// echo 'Request with ID ' . $requestId . ' approved, but email failed to send.';
			echo ' Mailer Error: ' . $mail->ErrorInfo;
		}
	} catch (PDOException | Exception $e) {
		// Handle database or PHPMailer error
		echo 'An error occurred: ' . $e->getMessage();
	}
    
    // header("Location: example.php/?SUCCESS=1");
}       
else{
    echo "error:  " .sql."<br>".$conn->error;
}
}


$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Employee Record Add</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="addlink.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="countrystatecity.js"></script>
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
        
        .col-md-4 input {
            border-color: #8F4B84;
        }
        .col-md-6 input {
            border-color: #8F4B84;
        }
        
        .col-md-6 textarea {
            border-color: #8F4B84;
        }
        
        .error-input {
            border-color: red !important;
        }
        
        .col-md-4 select {
            border-color: #8F4B84;
        }
        .col-md-6 select {
            border-color: #8F4B84;
        }
        #closeButton {
        position: fixed;
        top: 20px; /* Adjust the top position as needed */
        right: 20px; /* Adjust the right position as needed */
        z-index: 9999; /* Ensure it's above other elements */
    }
    </style>
   
    <script>
        // Set the alert message using PHP
        var alertMessage = "<?php echo $alert_message ? $alert_message : "" ?>";

        // Check if the alert message is not empty, then display the alert
        if (alertMessage) {
            alert(alertMessage);
        }
    </script>
</head>

<body>
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                <h4 class="text-white" style="margin-top: 200px;">On-Boarding <i class="fas fa-handshake fa-1x" style="margin-left: 5px;"></i></h4>

                    <img src="assets/img/emp-icon.png" class="img-fluid position-absolute" alt="" />
                </div>
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                    <form id="form" action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="POST">
                        <div class="row pb-4 mt-2">
                            <h4>
                                <center>Employee Record Entry</center>
                            </h4>
                        </div>

                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="empRec" class="form-label">Employee Code</label>
                                <input type="text" class="form-control" name="empRec" id="empRec" oninput="validateEmpCode(event)" maxlength="6" minlength="6" onblur="validateEmpCode(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="empName" class="form-label">Employee Full Name</label>
                                <input type="text" class="form-control" name="empName" id="empName" minlength="3" maxlength="30" oninput="empNamevalidation(event)" onblur="empNamevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <!-- <input type="date" class="form-control"  name="dob" readonly  id="dob" onkeydown="dobvalidation(event)" onblur="dobvalidation(event)" > -->
                                <input type="date" class="form-control" name="dob" id="dob"  onkeydown="dobvalidation(event)" onblur="dobvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>

                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" class="form-control" name="age" id="age" readonly onblur="agevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-select" onkeydown="gendervalidation(event)" onblur="gendervalidation(event)">
                                      <option selected value="">Select Gender</option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                      <option value="Not">Prefer Not to Say</option>
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="bloodGroup" class="form-label">Employee Blood Group</label>
                                <select name="bloodGroup" id="bloodGroup" class="form-select" onkeydown="bloodGroupvalidation(event)" onblur="bloodGroupvalidation(event)">
                              <option selected value="">Select Blood Group</option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                              <option value="AB+">AB+</option>
                              <option value="AB-">AB-</option>
                              <option value="Others">Others</option>
                            </select>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="fatherName" class="form-label">Father Name</label>
                                <input type="text" class="form-control" name="fatherName" id="fatherName" oninput="fathernamevalidation(event)" minlength="3" maxlength="30" onblur="fathernamevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="motherName" class="form-label">Mother Name</label>
                                <input type="text" class="form-control" id="motherName" name="motherName" oninput="motherNamevalidation(event)" minlength="3" maxlength="30" onblur="motherNamevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="marital" class="form-label">Marital Status</label>
                                <select name="marital" id="marital" class="form-select" onchange="maritalvalidation(event)" onkeydown="maritalvalidation(event)" onblur="maritalvalidation(event)">
                              <option selected value="">Select Marital Status</option>
                              <option value="Single">Single</option>
                              <option value="Married">Married</option>
                              <!-- <option value="Divorced">Divorced</option> -->
                            </select>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="spousename" class="form-label">Spouse Name </label>
                                <input type="text" class="form-control" name="spousename" id="spousename" minlength="3" maxlength="30"  onkeydown="spousenamevalidation(event)" onblur="spousenamevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="spousedob" class="form-label">Spouse Date of Birth 
                            </label>
                                <input type="date" class="form-control" name="spousedob" id="spousedob" onchange="submitBirthday(event)" onblur="spousedobvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="spouseage" class="form-label">Spouse Age 
                            </label>
                                <input type="text" class="form-control" name="spouseage" id="spouseage" readonly onblur="spouseagevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="spousebloodgroup" class="form-label">Spouse Blood Group</label>
                                <select name="spousebloodgroup" id="spousebloodgroup" class="form-select" onkeydown="spousebloodgroupvalidation(event)" onblur="spousebloodgroupvalidation(event)">
                              <option selected value="">Select Blood Group</option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                              <option value="AB+">AB+</option>
                              <option value="AB-">AB-</option>
                              <option value="Others">Others</option>
                            </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="children" class="form-label">Children 
                            </label>
                                <select name="children" id="children" class="form-select" onkeydown="childrenvalidation(event)" onblur="childrenvalidation(event)">
                              <option selected value="">Select Children</option>
                              <option value="0">0</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                            </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="+91" maxlength="10" oninput="phonenumbervalidation(event)" onblur="phonenumbervalidation(event)">

                                <span id="error" style="color:red"></span>
                            </div>
                        </div>



                        <div class="row g-3 pb-4">
                            <div class="col-md-6">
                                <label for="peraddress" class="form-label">Permanent Address 
                              </label>
                                <textarea class="form-control" name="peraddress" id="peraddress" rows="5" cols="40" onkeydown="peraddressvalidation(event)" minlength="10" maxlength="300" onblur="peraddressvalidation(event)"></textarea>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between">
                                    <label for="resaddress" class="form-label">Residential Address</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="homepostalcheck" id="homepostalcheck">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        Same As Permanent Address
                                      </label>
                                    </div>
                                </div>
                                <textarea class="form-control" name="resaddress" id="resaddress" rows="5" cols="40" onkeydown="resaddressvalidation(event)" minlength="10" maxlength="300" onblur="resaddressvalidation(event)"></textarea>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="country" class="form-label">Country</label>
                                <select id="countryId" class="form-select countries" name="countryId" onkeydown="countryvalidation(event)" onblur="countryvalidation(event)">
                                <option value="" selected disabled>Select Country</option>
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select id="stateId" class="form-select states" name="stateId" onkeydown="statevalidation(event)" onblur="statevalidation(event)">
                                    <option value="" selected disabled>Select State</option> 
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="district" class="form-label">District</label>
                                <select id="cityId" class="form-select cities" name="cityId" onkeydown="districtvalidation(event)" onblur="districtvalidation(event)">
                                    <option value="" selected disabled>Select District</option>
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input type="text" class="form-control" name="pincode" id="pincode" maxlength="6" minlength="6" onchange="checkPincode(event)" oninput="pincodeValidation(event)" onblur="pincodeValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email" oninput="emailvalidation(event)" onkeydown="emailvalidation(event)" onblur="emailvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" name="username" id="username" minlength="5" maxlength="30" onkeydown="usernameValidation(event)" onblur="usernameValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>

                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="pass" class="form-label">Password</label>
                                <input type="Password" class="form-control" name="pass" id="pass" maxlength="20" onkeydown="passvalidation(event)" onblur="passvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="aadharCard" class="form-label">Aadhar Number</label>
                                <input type="text" class="form-control" name="aadharCard" id="aadharCard" maxlength="12" onkeydown="aadharCardValidation(event)" onblur="aadharCardValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="pan" class="form-label">PAN Number</label>
                                <input type="text" class="form-control" name="pan" id="pan" maxlength="10" oninput="panvalidation(event)" onblur="panvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="doj" class="form-label">Date of Joining</label>
                                <input type="Date" class="form-control" name="doj" id="doj" onkeydown="dojvalidation(event)" onblur="dojvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="designation" class="form-label">Designation</label>
                                <select class="form-select" name="designation" id="designation" onkeydown="designationvalidation(event)" onblur="designationvalidation(event)">
                                    <option value="">Select Designation</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Engineer">Human Resource</option>
                                    <option value="Developer">Developer</option>
                                    <option value="Analyst">Analyst</option>
                                    <option value="Analyst">Tester</option>
                                    <option value="Analyst">Networking</option>
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="qualification" class="form-label">Qualification</label>
                                <select class="form-select" name="qualification" id="qualification" onkeydown="qualificationvalidation(event)" onblur="qualificationvalidation(event)">
                                    <option value="">Select Qualification</option>
                                    <option value="Others">Others</option>
                                    <option value="PG">PG</option>
                                    <option value="UG">UG</option>
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="ugcourse" class="form-label">UG Course</label>
                                <input type="text" class="form-control" name="ugcourse" id="ugcourse" minlength="2" maxlength="50" onkeydown="ugcoursevalidation(event)" onblur="ugcoursevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="uginstitution" class="form-label">Institution</label>
                                <input type="text" class="form-control" name="uginstitution" id="uginstitution" onkeydown="uginstitutionvalidation(event)" maxlength="50" onblur="uginstitutionvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="ugpassedout" class="form-label">Passed Out</label>
                                <select class="form-select" id="ugpassedout" name="ugpassedout" onkeydown="ugpassedoutvalidation(event)" onblur="ugpassedoutvalidation(event)">
                                     <option value="0">Select Year</option> 
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="pgcourse" class="form-label">PG Course</label>
                                <input type="text" class="form-control" name="pgcourse" id="pgcourse" minlength="2" maxlength="50" onkeydown="pgcoursevalidation(event)" onblur="pgcoursevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="pginstitution" class="form-label">Institution</label>
                                <input type="text" class="form-control" name="pginstitution" id="pginstitution" maxlength="50" onkeydown="pginstitutionvalidation(event)" onblur="pginstitutionvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="pgpassedout" class="form-label">Passed Out</label>
                                <select class="form-select" id="pgpassedout" name="pgpassedout" onkeydown="pgpassedoutvalidation(event)" onblur="pgpassedoutvalidation(event)">
                                        <option value="0">Select Year</option> 
                                 </select>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="othercourse" class="form-label">Other Course</label>
                                <input type="text" class="form-control" name="othercourse" minlength="2" maxlength="50" id="othercourse" maxlength="4" onkeydown="othercoursevalidation(event)" onblur="othercoursevalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="otherinstitution" class="form-label">Institution</label>
                                <input type="text" class="form-control" name="otherinstitution" id="otherinstitution" maxlength="50" onkeydown="otherinstitutionvalidation(event)" onblur="otherinstitutionvalidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="otherpassedout" class="form-label">Passed Out</label>
                                <select class="form-select" id="otherpassedout" name="otherpassedout" onkeydown="otherpassedoutvalidation(event)" onblur="otherpassedoutvalidation(event)">
                                        <option value="0">Select Year</option> 
                                 </select>
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="department" class="form-label">Department</label>
                                <select name="department" id="department" class="form-select" onkeydown="bank_namevalidation(event)" onblur="departmentvalidation(event)">
                                      <option selected value="">Select Department</option> 
                                     <option value="hr">Human Resources</option>
                                     <option value="it">Information Technology</option>
                                     <option value="finance">Finance</option>
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="contact" class="form-label">Emergency Contact Number</label>
                                <input type="text" class="form-control" name="contact" id="contact"  minlength="10" placeholder="+91" maxlength="10" onkeydown="validateEmergencyContact(event)" oninput="validateEmergencyContact(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" class="form-control" name="account_number" id="account_number" minlength="8" maxlength="18" onkeydown="accountNumberValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4">
                          

                             <div class="col-md-4">
                                <label for="ifsc_code" class="form-label">IFSC Code</label>
                                <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" minlength="8" maxlength="15" oninput="getBankDetails(event)" onkeydown="ifsc_codeValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                              <div class="col-md-4">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                 <input type="text" class="form-control" name="bank_name" id="bank_name" readonly onkeydown="bank_namevalidation(event)" oninput="bank_namevalidation(event)" onblur="bank_namevalidation(event)">
                                
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" id="branch_name" readonly maxlength="30" onkeydown="branch_nameValidation(event)" oninput="branch_nameValidation(event)" onblur="branch_nameValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>

                           
                        </div>


                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                                <label for="work_experience" class="form-label">Work Experience</label>
                                <select name="work_experience" id="work_experience" class="form-select"  onkeydown="work_experiencevalidation(event)" onblur="work_experiencevalidation(event)">
                                    <option selected value=" ">Select Work Experience</option> 
                                               <option value="0">0</option>
                                               <option value="1">1year</option>
                                               <option value="2">2year</option>
                                               <option value="3">3year</option>
                                               <option value="4">4year</option>
                                               <option value="5">5year</option>
                                               <option value="6">6year</option> 
                                               <option value="7">7year</option>
                                               <option value="8">8year</option>
                                               <option value="9">9year</option>
                                               <option value="10">10year</option>
                                               <option value="11">11year</option>
                                               <option value="12">12year</option>
                                               <option value="13">13year</option>
                                               <option value="14">14year</option>
                                               <option value="15">15year</option>
                                               <option value="16">16year</option>
                                               <option value="17">17year</option>
                                               <option value="18">18year</option>
                                               <option value="19">19year</option>
                                               <option value="20">20year</option>
                                               <option value="21">21year</option>
                                               <option value="22">22year</option>
                                        </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-4 ">
                                <label for="experienceCertificates" class="form-label ">Experience Certificates</label>
                                <input type="file" class="form-control" name="experienceCertificates" id="experienceCertificates" onkeydown="uploadValidation(event)" oninput="uploadValidation(event)" onblur="uploadValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>


                            <div class="col-md-4 ">
                                <label for="paySlip" class="form-label">Pay Slip</label>
                               <input type="file" class="form-control" name="paySlip" id="paySlip" onkeydown="uploadValidation(event)" oninput="uploadValidation(event)" onblur="uploadValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row g-3 pb-4 ">
                            <div class="col-md-6 ">
                                <label for="passportStatus" class="form-label">Employee Passport</label>
                                <select name="passportStatus" class="form-select" id="passportStatus" onchange="work_experiencevalidation(event)" onkeydown="work_experiencevalidation(event)">
                                   <option selected value=" ">Select Employee Passport</option>
                                   <option value="yes">Yes</option>
                                   <option value="no">No</option>
                                </select>
                                <span id="error" style="color:red"></span>
                            </div>

                            <div class="col-md-6" id="passportField">
                                <label for="passport" class="form-label">Passport Number</label>
                                <input type="text" class="form-control" name="passport" id="passport" maxlength="8" onkeydown="passportValidation(event)">
                                <span id="error" style="color:red"></span>
                            </div>
                        </div>


                        <div class="row pt-2 ">
                            <div class="col-md-12 text-center">
                                <button type="submit " class="btn btn-primary ">Save Record</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js "></script>
    <script>

        document.getElementById("dob").addEventListener('keypress', (e) => {
         e.preventDefault();
        });
        document.getElementById("spousedob").addEventListener('keypress', (e) => {
         e.preventDefault();
        });
        $(function() {
            //disable all input at start
            $('.theInput').attr('disabled', 'disabled')

            $("#phone").keyup(function(event) {
                var emergency_contact = $("#contact").val();
                if (emergency_contact === $(this).val()) {
                    showError(event.target, "Phone Number should not be same as Emergency Number ");
                }
            });

            $("#contact").change(function(event) {
                var phone = $("#phone").val();
                if (phone === $(this).val()) {
                    showError(event.target, "Emergency Number should not be same of Phone Number ");
                }
            });
            //monitor type changes
            $('#marital').change(function(e) {
                var selected_type = $(this).val(); //get the form value

                if (selected_type == 'Single') { //if A is selected
                    hideError(document.getElementById("spousename"));
                    hideError(document.getElementById("spousedob"));
                    hideError(document.getElementById("spouseage"));
                    hideError(document.getElementById("spousebloodgroup"));
                    hideError(document.getElementById("children"));
                    $('#spousename').attr('disabled', 'disabled'); //enable Input A
                    $('#spousedob').attr('disabled', 'diasbled'); //disable Input B
                    $('#spouseage').attr('disabled', 'diasbled'); //disable Input B
                    $('#spousebloodgroup').attr('disabled', 'diasbled'); //disable Input B
                    $('#children').attr('disabled', 'diasbled'); //disable Input B
                } else if (selected_type == 'Married' || selected_type == 'Divorced') { //if B is selected
                    $('#spousename').removeAttr('disabled'); //enable Input B
                    $('#spousedob').removeAttr('disabled'); //enable Input B
                    $('#spouseage').removeAttr('disabled'); //enable Input B
                    $('#spousebloodgroup').removeAttr('disabled'); //enable Input B
                    $('#children').removeAttr('disabled'); //enable Input B

                }
            })
        })
    </script>
    <script>
        $(function() {
            //disable all input at start
            $('.theInput').attr('disabled', 'disabled')

            //monitor type changes
            $('#qualification').change(function(e) {
                var selected_type = $(this).val(); //get the form value

                if (selected_type == 'UG') { //if A is selected
                    $('#ugcourse').removeAttr('disabled');
                    $('#uginstitution').removeAttr('disabled');
                    $('#ugpassedout').removeAttr('disabled');
                    $('#pgcourse').attr('disabled', 'disabled');
                    $('#pginstitution').attr('disabled', 'diasbled');
                    $('#pgpassedout').attr('disabled', 'diasbled');
                    $('#othercourse').attr('disabled', 'disabled');
                    $('#otherinstitution').attr('disabled', 'diasbled');
                    $('#otherpassedout').attr('disabled', 'diasbled');

                } else if (selected_type == 'PG') { //if B is selected
                    $('#ugcourse').removeAttr('disabled');
                    $('#uginstitution').removeAttr('disabled');
                    $('#ugpassedout').removeAttr('disabled');
                    $('#pgcourse').removeAttr('disabled');
                    $('#pginstitution').removeAttr('disabled');
                    $('#pgpassedout').removeAttr('disabled');
                    $('#othercourse').attr('disabled', 'disabled');
                    $('#otherinstitution').attr('disabled', 'diasbled');
                    $('#otherpassedout').attr('disabled', 'diasbled');

                } else if (selected_type == 'Others') { //if B is selected
                    $('#ugcourse').attr('disabled', 'diasbled');
                    $('#uginstitution').attr('disabled', 'diasbled');
                    $('#ugpassedout').attr('disabled', 'diasbled');
                    $('#pgcourse').attr('disabled', 'diasbled');
                    $('#pginstitution').attr('disabled', 'diasbled');
                    $('#pgpassedout').attr('disabled', 'diasbled');
                    $('#othercourse').removeAttr('disabled');
                    $('#otherinstitution').removeAttr('disabled');
                    $('#otherpassedout').removeAttr('disabled');


                }
            })
        })
    </script>
    <script>
        $(function() {
            //disable all input at start
            $('.theinput').attr('disabled', 'disabled')

            //monitor type changes
            $('#work_experience').change(function(e) {
                var selected_type = $(this).val(); //get the form value

                if (selected_type == '0') { //if A is selected
                    $('#experienceCertificates').attr('disabled', 'disabled'); //enable Input A
                    $('#paySlip').attr('disabled', 'diasbled'); //disable Input B

                    const experienceCertificatesInput = document.getElementById("experienceCertificates");
                    const paySlipInput = document.getElementById("paySlip");

                    hideError(experienceCertificatesInput);
                    hideError(paySlipInput);
                } else if (selected_type > 0 || selected_type == 'Divorced') { //if B is selected
                    $('#experienceCertificates').removeAttr('disabled'); //enable Input B
                    $('#paySlip').removeAttr('disabled'); //enable Input B

                }
            })
        })
    </script>
    <script>
         function getBankDetails(event){
                let ifsc_code = event.target;
                //Fire the IFSC API only when the code has 11 AlphaNumeric Characterss
                if(ifsc_code.value.length === 11 ){
                    $.getJSON('https://ifsc.razorpay.com/'+ifsc_code.value, function(data){

                    console.log(data);
                       $("#bank_name").val(data.BANK);
                       $("#branch_name").val(data.BRANCH);
                    
                   }).fail(function(){
                     // var msg = '<div id="errMsg">Invalid IFSC code</div>';
                     // $('#container').append(msg);
                     alert("Failed");
                   });
                }else{
                    $("#bank_name").val(" ");
                    $("#branch_name").val(" ");           
                }
            }

        $(function() {
            //disable all input at start
            $('.theInput').attr('disabled', 'disabled')

            //monitor type changes
            $('#passportStatus').change(function(e) {
                var selected_type = $(this).val(); //get the form value

                if (selected_type == 'no') { //if A is selected
                    $('#passport').attr('disabled', 'disabled'); //enable Input A
                    const passportInput = document.getElementById("passport ");
                    hideError(passport);
                } else if (selected_type == 'yes' || selected_type == 'yes') { //if B is selected
                    $('#passport').removeAttr('disabled'); //enable Input B

                }
            })

        })
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
</body>

</html>