<?php
$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="srays";
$conn=new mysqli($servername,$dbusername,$dbpassword,$dbname);
if($conn->connect_error)
{
    die("connection failed:" .$conn->connect_error);
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
	
// echo "<pre>";
// print_r($_POST);
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
$emergency_contact = "";
$work_exp = "";
$acc_number = "";
$ifsc_code = "";
$branch_name = "";
$bank_name = "";
$passportStatus = "";
$passport = "";


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
if(isset($_POST["contact_"])){
	$emergency_contact = $_POST["contact_"];
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
				'$passport',
				'$work_exp',
				
				'$acc_number',
				'$ifsc_code',
				'$branch_name',
				'$bank_name'
				)";


    
if($conn->query($sql)===TRUE){
    echo "registration successful";
   // header("Location: C:\xampp\htdocs\final\ray.php/?SUCCESS=1");
}       
else{
    echo "error:  " .sql."<br>".$conn->error;
}
}


$conn->close();
?>