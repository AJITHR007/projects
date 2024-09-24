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
	
$dod = $_POST["dod"];
$holiday = $_POST["holiday"];
$description = $_POST["description"];


$sql="INSERT INTO holidaytable (dod,holiday,description)  
       VALUES('$dod','$holiday','$description')";
       
if($conn->query($sql)===TRUE){
    echo "<script>alert('Leave Added successfully!'); window.location='calender.php';</script>";
  
}       
else{
    echo "error:  " .$sql. "<br>".$conn->error;
}
}


$conn->close();
?>