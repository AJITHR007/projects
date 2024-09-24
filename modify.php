<?php
include 'dbconnection.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

// Fetch user details from the recordadd table
$select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

?>  


<!doctype html>
<html lang="en">
  <head>
  <title>Employee Record Modify</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="countrystatecity.js"></script>
  <style>
     body
      {
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
    .purpleBox{
        background-color: #8F4B84;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-between;
        text-align: center;
        min-height: 600px;
      }

    .btn-primary {
        background-color: #8F4B84;
        border-color: #8F4B84;
      }
    .btn-primary:hover, .btn-primary:focus {
        background-color: #95598b;
        border-color: #95598b;
      }
    .purpleBox img{
            bottom: 0;
        }

     .col-md-4 input{
      border-color: #8F4B84;
    }
    .col-md-5 textarea{
      border-color: #8F4B84;
    }
    

     .error-input {
        border-color: red !important;
    }
   
    .col-md-4 select{
      border-color: #8F4B84;
    }

</style>
</head>
<body>
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                    <h4 class="text-white" style="margin-top: 200px;">Employee Record-Modify</h4>
                    <img src="assets/img/emp-icon.png" class="img-fluid position-absolute" alt="" />
                </div>
                <div class="col-md-9 bg-white p-3 rounded-end-2">
                <form id="form" action="onboardingupdate.php" method="POST">
<div class="row g-3 pb-4">
                          <div class="col-md-4">
                            <label for="empRec" class="form-label" >Employee Code</label>
                            <input type="text" class="form-control" name="empRec" id="empRecInput" onkeydown="validateEmpCode(event)" maxlength="6" minlength="6" onblur="validateEmpCode(event)" value="<?php echo isset($fetch_profile["empRec"]) ? $fetch_profile["empRec"] : ''; ?>">

                           <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="empName" class="form-label">Employee Full Name</label>
                            <input type="text" class="form-control" name="empName" id="empName" minlength="3" maxlength="25" onkeyup="empNamevalidation(event)" onblur="empNamevalidation(event)" value="<?php echo isset($fetch_profile["empName"]) ? $fetch_profile["empName"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                            <div class="col-md-4">
                           <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" onkeydown="dobvalidation(event)" onchange="submitBday(event)" onblur="dobvalidation(event)" value="<?php echo isset($fetch_profile["dob"]) ? $fetch_profile["dob"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>

                        <div class="row g-3 pb-4">
                            <div class="col-md-4">
                            <label for="age" class="form-label" >Age</label>
                            <input type="text" class="form-control" name="age" id="age" readonly onblur="agevalidation(event)" value="<?php echo $fetch_profile['age']; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                           <label for="gender" class="form-label">Gender</label>
                             <select name="gender" id="gender" class="form-select" onkeydown="gendervalidation(event)" onblur="gendervalidation(event)" >
                                               
                              <option  value="<?= $fetch_profile['gender']; ?>"><?= $fetch_profile['gender']; ?></option>
                            </select>
                            <span id="error" style="color:red"></span>
                          </div>
                            <div class="col-md-4">
                           <label for="bloodGroup" class="form-label">Employee Blood Group</label>
                           <select name="bloodGroup" id="bloodGroup" class="form-select" onkeydown="bloodGroupvalidation(event)" onblur="bloodGroupvalidation(event)">
                           <option value="">Select Blood Group</option>
                           <option value="A+" <?php echo ($fetch_profile["bloodGroup"] == "A+") ? "selected" : ""; ?>>A+</option>
                           <option value="A-" <?php echo ($fetch_profile["bloodGroup"] == "A-") ? "selected" : ""; ?>>A-</option>
                           <option value="B+" <?php echo ($fetch_profile["bloodGroup"] == "B+") ? "selected" : ""; ?>>B+</option>
                           <option value="B-" <?php echo ($fetch_profile["bloodGroup"] == "B-") ? "selected" : ""; ?>>B-</option>
                           <option value="O+" <?php echo ($fetch_profile["bloodGroup"] == "O+") ? "selected" : ""; ?>>O+</option>
                           <option value="O-" <?php echo ($fetch_profile["bloodGroup"] == "O-") ? "selected" : ""; ?>>O-</option>
                           <option value="AB+" <?php echo ($fetch_profile["bloodGroup"] == "AB+") ? "selected" : ""; ?>>AB+</option>
                           <option value="AB-" <?php echo ($fetch_profile["bloodGroup"] == "AB-") ? "selected" : ""; ?>>AB-</option>
                           <option value="Others" <?php echo ($fetch_profile["bloodGroup"] == "Others") ? "selected" : ""; ?>>Others</option>
                           </select>
                           <span id="error" style="color:red"></span>
                           </div>
                           </div>
                           <div class="row g-3 pb-4">
                          <div class="col-md-4">
                           <label for="fatherName" class="form-label">Father Name</label>
                            <input type="text" class="form-control" name="fatherName" id="fatherName" onkeydown="fathernamevalidation(event)" onblur="fathernamevalidation(event)" value="<?php echo isset($fetch_profile["fatherName"]) ? $fetch_profile["fatherName"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="motherName" class="form-label">Mother Name</label>
                            <input type="text" class="form-control"name="motherName" id="motherName" onkeydown="motherNamevalidation(event)" onblur="motherNamevalidation(event)" value="<?php echo isset($fetch_profile["motherName"]) ? $fetch_profile["motherName"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                          <label for="marital" class="form-label">Marital Status</label>
                          <select name="marital" id="marital" class="form-select" onkeyup="maritalvalidation(event)" onblur="maritalvalidation(event)">
                          <option value="">Selected Marital-Status</option>
                          <option value="Single" <?php echo ($fetch_profile["marital"] == "Single") ? "selected" : ""; ?>>Single</option>
                          <option value="Married" <?php echo ($fetch_profile["marital"] == "Married") ? "selected" : ""; ?>>Married</option>
                          <option value="Divorced" <?php echo ($fetch_profile["marital"] == "Divorced") ? "selected" : ""; ?>>Divorced</option>
                          </select>
                          <span id="error" style="color:red"></span>
                          </div>

                        </div>

                        <div class="row g-3 pb-4">
                          <div class="col-md-4">
                            <label for="spousename" class="form-label">Spouse Name 
                            </label>
                            <input type="text" class="form-control" name="spousename" id="spousename" onkeydown="spousenamevalidation(event)" onblur="spousenamevalidation(event)" value="<?php echo isset($fetch_profile["spousename"]) ? $fetch_profile["spousename"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                           <label for="spousedob" class="form-label">Spouse Date of Birth</label>
                           <input type="date" class="form-control" name="spousedob" id="spousedob" onkeydown="spousedobvalidation(event)" onblur="spousedobvalidation(event)">
                           <span id="error" style="color:red"></span>
                          </div>

                            <div class="col-md-4">
                           <label for="spouseage" class="form-label">Spouse Age 
                            </label>
                            <input type="text" class="form-control" name="spouseage" id="spouseage" onkeydown="spouseagevalidation(event)" onblur="spouseagevalidation(event)" value="<?php echo isset($fetch_profile["spouseage"]) ? $fetch_profile["spouseage"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>

                        <div class="row g-3 pb-4">
                         <div class="col-md-4">
                           <label for="spousebloodgroup" class="form-label">Spouse Blood Group</label>
                            <select name="spousebloodgroup" id="spousebloodgroup" class="form-select" onkeydown="spousebloodgroupvalidation(event)" onblur="spousebloodgroupvalidation(event)" value="<?php echo isset($fetch_profile["spousebloodgroup"]) ? $fetch_profile["spousebloodgroup"] : ''; ?>">
                            <option value="">Select Blood Group</option>
                           <option value="A+" <?php echo ($fetch_profile["spousebloodgroup"] == "A+") ? "selected" : ""; ?>>A+</option>
                          <option value="A-" <?php echo ($fetch_profile["spousebloodgroup"] == "A-") ? "selected" : ""; ?>>A-</option>
                          <option value="B+" <?php echo ($fetch_profile["spousebloodgroup"] == "B+") ? "selected" : ""; ?>>B+</option>
                          <option value="B-" <?php echo ($fetch_profile["spousebloodgroup"] == "B-") ? "selected" : ""; ?>>B-</option>
                          <option value="O+" <?php echo ($fetch_profile["spousebloodgroup"] == "O+") ? "selected" : ""; ?>>O+</option>
                          <option value="O-" <?php echo ($fetch_profile["spousebloodgroup"] == "O-") ? "selected" : ""; ?>>O-</option>
                          <option value="AB+" <?php echo ($fetch_profile["spousebloodgroup"] == "AB+") ? "selected" : ""; ?>>AB+</option>
                          <option value="AB-" <?php echo ($fetch_profile["spousebloodgroup"] == "AB-") ? "selected" : ""; ?>>AB-</option>
                          <option value="Others" <?php echo ($fetch_profile["spousebloodgroup"] == "Others") ? "selected" : ""; ?>>Others</option>                            </select>
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                           <label for="children" class="form-label">Childrens</label>
                           <select name="children" id="children" class="form-select" onkeydown="childrenvalidation(event)" onblur="childrenvalidation(event)">
                           <option value="">Select Childrens</option>
                           <option value="0" <?php echo ($fetch_profile["children"] == "0") ? "selected" : ""; ?>>0</option>
                           <option value="1" <?php echo ($fetch_profile["children"] == "1") ? "selected" : ""; ?>>1</option>
                           <option value="2" <?php echo ($fetch_profile["children"] == "2") ? "selected" : ""; ?>>2</option>
                           <option value="3" <?php echo ($fetch_profile["children"] == "3") ? "selected" : ""; ?>>3</option>
                           <option value="4" <?php echo ($fetch_profile["children"] == "4") ? "selected" : ""; ?>>4</option>
                           <option value="5" <?php echo ($fetch_profile["children"] == "5") ? "selected" : ""; ?>>5</option>
                           </select>
                          <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                          <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone" id="phone"  maxlength="10" onkeydown="phonenumbervalidation(event)" onblur="phonenumbervalidation(event)" value="<?php echo isset($fetch_profile["phone"]) ? $fetch_profile["phone"] : ''; ?>">
                            
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>


                        <div class="row g-3 pb-4">
                          <div class="col-md-6">
                              <label for="peraddress" class="form-label">Permanent Address 
                            </label>
                          
                            <textarea class="form-control" name="peraddress" id="peraddress" rows="5" cols="40" onkeydown="peraddressvalidation(event)" minlength="10" maxlength="30" onblur="peraddressvalidation(event)"><?php echo isset($fetch_profile["peraddress"]) ? $fetch_profile["peraddress"] : ''; ?></textarea>
                            <span id="error" style="color:red"></span>
                          </div>
                        
                            
                          
                            <div class="col-md-6">
                               <label for="resaddress" class="form-label">Residential Address 
                            </label>
                            <input type="checkbox" name="homepostalcheck" id="homepostalcheck"/>Same As Permanent Address
                           </label>
                           
                            <textarea class="form-control" name="resaddress" id="resaddress" rows="5" cols="40" onkeydown="resaddressvalidation(event)" minlength="10" maxlength="30" onblur="resaddressvalidation(event)"><?php echo isset($fetch_profile["resaddress"]) ? $fetch_profile["resaddress"] : ''; ?></textarea>
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>


                       
                        <div class="row g-3 pb-4">
                          <div class="col-md-4">
                           
                           <label for="country" class="form-label">Country</label>
                                <select name="country" id="countryId" class="form-select countries" onkeydown="countryvalidation(event)" onblur="countryvalidation(event)" value="<?php echo isset($fetch_profile["countryId"]) ? $fetch_profile["countryId"] : ''; ?>">
                                    <option value="" selected disabled>Select Country</option>
                                </select>
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                          <select name="state" id="stateId" class="form-select states" onkeydown="statevalidation(event)" onblur="statevalidation(event)" value="<?php echo isset($fetch_profile["stateId"]) ? $fetch_profile["stateId"] : ''; ?>">
                                    <option value="" selected disabled>Select State</option>
                                   
                                </select>
                            <span id="error" style="color:red"></span>
                          </div>
                            <div class="col-md-4">
                            	  <label for="district" class="form-label">District</label>
                                <select name="district" id="cityId" class="form-select cities" onkeydown="districtvalidation(event)" onblur="districtvalidation(event)" value="<?php echo isset($fetch_profile["cityId"]) ? $fetch_profile["cityId"] : ''; ?>">
                                    <option value="" selected disabled>Select District</option>

                                </select>
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>

                        <div class="row g-3 pb-4">
                          <div class="col-md-4">
                          <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="pincode" maxlength="6" onkeydown="pincodeValidation(event)" onblur="pincodeValidation(event)" value="<?php echo isset($fetch_profile["pincode"]) ? $fetch_profile["pincode"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="email" class="form-label">Email-ID</label>
                            <input type="text" class="form-control" name="email" id="email"  onkeydown="emailvalidation(event)" onblur="emailvalidation(event)" value="<?php echo isset($fetch_profile["email"]) ? $fetch_profile["email"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                            <div class="col-md-4">
                            	<label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="username" id="username" maxlength="6" onkeydown="usernameValidation(event)" onblur="usernameValidation(event)"value="<?php echo isset($fetch_profile["username"]) ? $fetch_profile["username"] : ''; ?>"> 
                            <span id="error" style="color:red"></span>

                          </div>
                        </div>
                        <div class="row g-3 pb-4">
                          <div class="col-md-4">
                           <label for="pass" class="form-label">Password</label>
                            <input type="Password" class="form-control" name="pass" id="pass" maxlength="10" onkeydown="passvalidation(event)" onblur="passvalidation(event)" value="<?php echo isset($fetch_profile["pass"]) ? $fetch_profile["pass"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="aadharCard" class="form-label">Aadhar Number</label>
                            <input type="text" class="form-control" name="aadharCard" id="aadharCard" maxlength="12"  onkeydown="aadharCardValidation(event)" onblur="aadharCardValidation(event)" value="<?php echo isset($fetch_profile["aadharCard"]) ? $fetch_profile["aadharCard"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                            </div>
                            <div class="col-md-4">
                            	<label for="pan" class="form-label">PAN Number</label>
                            <input type="text" class="form-control" name="pan" id="pan" maxlength="10" onkeydown="panvalidation(event)" onblur="panvalidation(event)" value="<?php echo isset($fetch_profile["pan"]) ? $fetch_profile["pan"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>

                        <div class="row g-3 pb-4">
                        <div class="col-md-4">
                       <label for="doj" class="form-label">Date of Joining</label>
                       <input type="date" class="form-control" name="doj" id="doj" onkeydown="dojvalidation(event)" onblur="dojvalidation(event)" value="<?php echo isset($fetch_profile["doj"]) ? date('Y-m-d', strtotime($fetch_profile["doj"])) : ''; ?>">
                       <span id="error" style="color:red"></span>
                       </div>

                          
                          <div class="col-md-4">
                      <label for="designation" class="form-label">Designation</label>
                      <select class="form-select" name="designation" id="designation" onkeydown="designationvalidation(event)" onblur="designationvalidation(event)">
                      <option value="">Select Designation</option>
                      <option value="Manager" <?php echo ($fetch_profile["designation"] == "Manager") ? "selected" : ""; ?>>Manager</option>
                      <option value="Human Resource" <?php echo ($fetch_profile["designation"] == "Human Resource") ? "selected" : ""; ?>>Human Resource</option>
                      <option value="Developer" <?php echo ($fetch_profile["designation"] == "Developer") ? "selected" : ""; ?>>Developer</option>
                      <option value="Analyst" <?php echo ($fetch_profile["designation"] == "Analyst") ? "selected" : ""; ?>>Analyst</option>
                     <option value="Tester" <?php echo ($fetch_profile["designation"] == "Tester") ? "selected" : ""; ?>>Tester</option>
                     <option value="Networking" <?php echo ($fetch_profile["designation"] == "Networking") ? "selected" : ""; ?>>Networking</option>
                     </select>
                       <span id="error" style="color:red"></span>
                        </div>
                          <div class="col-md-4">
                           <label for="qualification" class="form-label">Qualification</label>
                         <select class="form-select" name="qualification" id="qualification" onkeydown="qualificationvalidation(event)" onblur="qualificationvalidation(event)">
                        <option value="">Select Qualification</option>
                        <option value="Others" <?php echo ($fetch_profile["qualification"] == "Others") ? "selected" : ""; ?>>Others</option>
                        <option value="PG" <?php echo ($fetch_profile["qualification"] == "PG") ? "selected" : ""; ?>>PG</option>
                        <option value="UG" <?php echo ($fetch_profile["qualification"] == "UG") ? "selected" : ""; ?>>UG</option>
                        </select>
                        <span id="error" style="color:red"></span>
                        </div>
                        </div>

                        <div class="row g-3 pb-4">

                        	 <div class="col-md-4">
                           <label for="ugcourse" class="form-label">UG Course</label>
                            <input type="text" class="form-control" name="ugcourse" id="ugcourse"  onkeyup="ugcoursevalidation(event)" onblur="ugcoursevalidation(event)" value="<?php echo isset($fetch_profile["ugcourse"]) ? $fetch_profile["ugcourse"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="uginstitution" class="form-label">UG Institution</label>
                            <input type="text" class="form-control" name="uginstitution" id="uginstitution"  onkeyup="uginstitutionvalidation(event)" onblur="uginstitutionvalidation(event)" value="<?php echo isset($fetch_profile["uginstitution"]) ? $fetch_profile["uginstitution"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                         
                            <div class="col-md-4">
                            	<label for="ugpassedout" class="form-label">UG Passed Out</label>
                            <input type="text" class="form-control" name="ugpassedout" id="ugpassedout" maxlength="4" onkeydown="ugpassedoutvalidation(event)" onblur="ugpassedoutvalidation(event)" value="<?php echo isset($fetch_profile["ugpassedout"]) ? $fetch_profile["ugpassedout"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>

                        <div class="row g-3 pb-4">
                          <div class="col-md-4">
                            <label for="pgcourse" class="form-label">PG Course</label>
                            <input type="text" class="form-control" name="pgcourse" id="pgcourse" maxlength="4" onkeydown="pgcoursevalidation(event)" onblur="pgcoursevalidation(event)" value="<?php echo isset($fetch_profile["pgcourse"]) ? $fetch_profile["pgcourse"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="pginstitution" class="form-label">PG Institution</label>
                            <input type="text" class="form-control" name="pginstitution" id="pginstitution" maxlength="4" onkeydown="pginstitutionvalidation(event)" onblur="pginstitutionvalidation(event)" value="<?php echo isset($fetch_profile["pginstitution"]) ? $fetch_profile["pginstitution"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                            <div class="col-md-4">
                            	<label for="pgpassedout" class="form-label">PG Passed Out</label>
                            <input type="text" class="form-control" name="pgpassedout" id="pgpassedout" maxlength="4" onkeydown="pgpassedoutvalidation(event)" onblur="pgpassedoutvalidation(event)" value="<?php echo isset($fetch_profile["pgpassedout"]) ? $fetch_profile["pgpassedout"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>

                        <div class="row g-3 pb-4">
                          <div class="col-md-4">
                            <label for="othercourse" class="form-label">Other Course</label>
                            <input type="text" class="form-control" name="othercourse" id="othercourse" maxlength="4" onkeydown="othercoursevalidation(event)" onblur="othercoursevalidation(event)" value="<?php echo isset($fetch_profile["othrecourse"]) ? $fetch_profile["othrecourse"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="otherinstitution" class="form-label">Other Institution</label>
                            <input type="text" class="form-control" name="otherinstitution" id="otherinstitution" maxlength="4" onkeydown="otherinstitutionvalidation(event)" onblur="otherinstitutionvalidation(event)" value="<?php echo isset($fetch_profile["otherinstitution"]) ? $fetch_profile["otherinstitution"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                            <div class="col-md-4">
                            	<label for="otherpassedout" class="form-label">Other Passed Out</label>
                            <input type="text" class="form-control" name="otherpassedout" id="otherpassedout" maxlength="4" onkeydown="otherpassedoutvalidation(event)" onblur="otherpassedoutvalidation(event)" value="<?php echo isset($fetch_profile["otherpassedout"]) ? $fetch_profile["otherpassedout"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                        </div>
                        <div class="row g-3 pb-4">
                   <div class="col-md-4">
                      <label for="department" class="form-label">Department</label>
                      <select name="department" id="department" class="form-select" onchange="departmentValidation(event)">
                          <option value="" <?php echo empty($fetch_profile["department"]) ? "selected" : ""; ?>>Select Department</option>
                          <option value="hr" <?php echo ($fetch_profile["department"] == "hr") ? "selected" : ""; ?>>Human Resources</option>
                          <option value="it" <?php echo ($fetch_profile["department"] == "it") ? "selected" : ""; ?>>Information Technology</option>
                          <option value="finance" <?php echo ($fetch_profile["department"] == "finance") ? "selected" : ""; ?>>Finance</option>
                          <!-- Add other options as needed -->
                      </select>
                      <span id="error" style="color:red"></span>
                  </div>

                          <div class="col-md-4">
                            <label for="contact" class="form-label">Emergency Contact Number</label>
                            <input type="text" class="form-control" name="contact" id="contact" minlength="10" maxlength="10" onkeyup="validateEmergencyContact(event)"  value="<?php echo isset($fetch_profile["contact"]) ? $fetch_profile["contact"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" class="form-control" name="account_number" id="account_number" minlength="10"maxlength="12" onkeyup="accountNumberValidation(event)" value="<?php echo isset($fetch_profile["account_number"]) ? $fetch_profile["account_number"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
  </div>
  <div class="row g-3 pb-4">
  <div class="col-md-4">
                          <label for="bank_name" class="form-label">Bank Name</label>
                          <select name="bank_name" id="bank_name" class="form-select" onkeyup="bankNameValidation(event)">
                              <option value="" <?php echo empty($fetch_profile["bank_name"]) ? "selected" : ""; ?>>Select bank name</option>
                              <option value="Bank of India" <?php echo ($fetch_profile["bank_name"] == "Bank of India") ? "selected" : ""; ?>>Bank of India</option>
                              <option value="Bank of Baroda" <?php echo ($fetch_profile["bank_name"] == "Bank of Baroda") ? "selected" : ""; ?>>Bank of Baroda</option>
                              <option value="Canara Bank" <?php echo ($fetch_profile["bank_name"] == "Canara Bank") ? "selected" : ""; ?>>Canara Bank</option>
                              <option value="Bank of Maharashtra" <?php echo ($fetch_profile["bank_name"] == "Bank of Maharashtra") ? "selected" : ""; ?>>Bank of Maharashtra</option>
                              <option value="Punjab National Bank" <?php echo ($fetch_profile["bank_name"] == "Punjab National Bank") ? "selected" : ""; ?>>Punjab National Bank</option>
                              <option value="State Bank of India" <?php echo ($fetch_profile["bank_name"] == "State Bank of India") ? "selected" : ""; ?>>State Bank of India</option>
                              <option value="Indian Bank" <?php echo ($fetch_profile["bank_name"] == "Indian Bank") ? "selected" : ""; ?>>Indian Bank</option>
                              <option value="Indian Overseas Bank" <?php echo ($fetch_profile["bank_name"] == "Indian Overseas Bank") ? "selected" : ""; ?>>Indian Overseas Bank</option>
                              <option value="Axis Bank" <?php echo ($fetch_profile["bank_name"] == "Axis Bank") ? "selected" : ""; ?>>Axis Bank</option>
                              <option value="HDFC Bank" <?php echo ($fetch_profile["bank_name"] == "HDFC Bank") ? "selected" : ""; ?>>HDFC Bank</option>
                              <option value="Punjab and Sind Bank" <?php echo ($fetch_profile["bank_name"] == "Punjab and Sind Bank") ? "selected" : ""; ?>>Punjab and Sind Bank</option>
                              <option value="UCO Bank" <?php echo ($fetch_profile["bank_name"] == "UCO Bank") ? "selected" : ""; ?>>UCO Bank</option>
                              <option value="ICICI Bank" <?php echo ($fetch_profile["bank_name"] == "ICICI Bank") ? "selected" : ""; ?>>ICICI Bank</option>
                              <option value="IndusInd Bank" <?php echo ($fetch_profile["bank_name"] == "IndusInd Bank") ? "selected" : ""; ?>>IndusInd Bank</option>
                              <option value="Allahabad Bank" <?php echo ($fetch_profile["bank_name"] == "Allahabad Bank") ? "selected" : ""; ?>>Allahabad Bank</option>
                              <option value="Dena Bank" <?php echo ($fetch_profile["bank_name"] == "Dena Bank") ? "selected":""; ?>>Dena Bank</option>
                              <option value="Federal Bank" <?php echo ($fetch_profile["bank_name"] == "Federal Bank") ? "selected" : ""; ?>>Federal Bank</option>
                              <option value="IDBI Bank" <?php echo ($fetch_profile["bank_name"] == "IDBI Bank") ? "selected" : ""; ?>>IDBI Bank</option>
                              <option value="Karnataka Bank" <?php echo ($fetch_profile["bank_name"] == "Karnataka Bank") ? "selected" : ""; ?>>Karnataka Bank</option>
                              <option value="Kotak Mahindra Bank" <?php echo ($fetch_profile["bank_name"] == "Kotak Mahindra Bank") ? "selected" : ""; ?>>Kotak Mahindra Bank</option>
                              <option value="Andhra Bank" <?php echo ($fetch_profile["bank_name"] == "Andhra Bank") ? "selected" : ""; ?>>Andhra Bank</option>
                              <option value="CSB Bank" <?php echo ($fetch_profile["bank_name"] == "CSB Bank") ? "selected" : ""; ?>>CSB Bank</option>
                              <option value="DCB Bank" <?php echo ($fetch_profile["bank_name"] == "DCB Bank") ? "selected" : ""; ?>>DCB Bank</option>
                              <option value="Oriental Bank of Commerce" <?php echo ($fetch_profile["bank_name"] == "Oriental Bank of Commerce") ? "selected" : ""; ?>>Oriental Bank of Commerce</option>
                          </select>
                          <span id="error" style="color:red"></span>
                      </div>
                      <div class="col-md-4">
                          <label for="branch_name" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" name="branch_name" id="branch_name" maxlength="30" onkeyup="motherNamevalidation(event)" value="<?php echo isset($fetch_profile["branch_name"]) ? $fetch_profile["branch_name"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                          <div class="col-md-4">
                          <label for="ifsc_code" class="form-label">IFSC Code</label>
                            <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"minlength="8"maxlength="15" onkeyup=" ifscCodevalidation(event)" value="<?php echo isset($fetch_profile["ifsc_code"]) ? $fetch_profile["ifsc_code"] : ''; ?>">
                            <span id="error" style="color:red"></span>
                          </div>
                            </div>
                            <div class="row g-3 pb-4">
                          <div class="col-md-4">
    <label for="work_experience" class="form-label">Work Experience</label>
    <select name="work_experience" id="work_experience" class="form-select" onchange="work_experienceValidation(event)">
        <option value="" <?php echo empty($fetch_profile["work_experience"]) ? "selected" : ""; ?>>Select work experience</option>
        <option value="0" <?php echo ($fetch_profile["work_experience"] == "0") ? "selected" : ""; ?>>0</option>
        <option value="1year" <?php echo ($fetch_profile["work_experience"] == "1year") ? "selected" : ""; ?>>1 year</option>
        <option value="2year" <?php echo ($fetch_profile["work_experience"] == "2year") ? "selected" : ""; ?>>2 years</option>
        <option value="3year" <?php echo ($fetch_profile["work_experience"] == "3year") ? "selected" : ""; ?>>3 year</option>
        <option value="4year" <?php echo ($fetch_profile["work_experience"] == "4year") ? "selected" : ""; ?>>4 years</option>
        <option value="5year" <?php echo ($fetch_profile["work_experience"] == "5year") ? "selected" : ""; ?>>5 year</option>
        <option value="6year" <?php echo ($fetch_profile["work_experience"] == "6year") ? "selected" : ""; ?>>6 years</option>
        <option value="7year" <?php echo ($fetch_profile["work_experience"] == "7year") ? "selected" : ""; ?>>7 year</option>
        <option value="8year" <?php echo ($fetch_profile["work_experience"] == "8year") ? "selected" : ""; ?>>8 years</option>
        <option value="9year" <?php echo ($fetch_profile["work_experience"] == "9year") ? "selected" : ""; ?>>9 year</option>
        <option value="10year" <?php echo ($fetch_profile["work_experience"] == "10year") ? "selected" : ""; ?>>10 years</option>
        <option value="11year" <?php echo ($fetch_profile["work_experience"] == "11year") ? "selected" : ""; ?>>11 year</option>
        <option value="12year" <?php echo ($fetch_profile["work_experience"] == "12year") ? "selected" : ""; ?>>12 years</option>
        <option value="13year" <?php echo ($fetch_profile["work_experience"] == "13year") ? "selected" : ""; ?>>13 year</option>
        <option value="14year" <?php echo ($fetch_profile["work_experience"] == "14year") ? "selected" : ""; ?>>14 years</option>
        <option value="15year" <?php echo ($fetch_profile["work_experience"] == "15year") ? "selected" : ""; ?>>15 year</option>
        <option value="16year" <?php echo ($fetch_profile["work_experience"] == "16year") ? "selected" : ""; ?>>16 years</option>
        <option value="17year" <?php echo ($fetch_profile["work_experience"] == "17year") ? "selected" : ""; ?>>17 year</option>
        <option value="18year" <?php echo ($fetch_profile["work_experience"] == "18year") ? "selected" : ""; ?>>18 years</option>
        <option value="19year" <?php echo ($fetch_profile["work_experience"] == "19year") ? "selected" : ""; ?>>19 year</option>
        <option value="20year" <?php echo ($fetch_profile["work_experience"] == "20year") ? "selected" : ""; ?>>20 years</option>
        <option value="21year" <?php echo ($fetch_profile["work_experience"] == "21year") ? "selected" : ""; ?>>21 year</option>
        <option value="22year" <?php echo ($fetch_profile["work_experience"] == "22year") ? "selected" : ""; ?>>22 years</option>
     
    </select>
    <span id="error" style="color:red"></span>
</div><div class="col-md-4">
    <label for="experienceCertificates" class="form-label">Experience Certificates</label>
    <input type="text" class="form-control" name="experienceCertificatesDisplay" id="experienceCertificatesDisplay" value="<?php echo !empty($fetch_profile["experienceCertificates"]) ? $fetch_profile["experienceCertificates"] : 'No file uploaded'; ?>" readonly>
    <input type="file" class="form-control" name="experienceCertificates" id="experienceCertificates">
    <span id="error" style="color:red"></span>
</div>

<div class="col-md-4">
    <label for="paySlip" class="form-label">Pay Slip</label>
    <input type="text" class="form-control" name="paySlipDisplay" id="paySlipDisplay" value="<?php echo !empty($fetch_profile["paySlip"]) ? $fetch_profile["paySlip"] : 'No file uploaded'; ?>" readonly>
    <input type="file" class="form-control" name="paySlip" id="paySlip">
    <span id="error" style="color:red"></span>
</div>


                      </div> <div class="row g-3 pb-4">
           
                        <div class="col-md-4">
                            <label for="passportStatus" class="form-label">Employee Passport</label>
                            <select name="passportStatus" class="form-select" id="passportStatus" onchange="handlePassportStatus()" onkeyup="passportStatusValidation(event)">
                                <option value="" <?php echo empty($fetch_profile["passportStatus"]) ? "selected" : ""; ?>>Select Employee Passport</option>
                                <option value="yes" <?php echo ($fetch_profile["passportStatus"] == "yes") ? "selected" : ""; ?>>Yes</option>
                                <option value="no" <?php echo ($fetch_profile["passportStatus"] == "no") ? "selected" : ""; ?>>No</option>
                                <!-- Add other options as needed -->
                            </select>
                            <span id="error" style="color:red"></span>
                        </div>

                       <div class="col-md-4" id="passportField">
                       <label for="passport" class="form-label">Passport Number</label>
                       <input type="text" class="form-control" name="passport" id="passport" minlength="8" maxlength="12" onkeyup="passportValidation(event)" onblur="passportValidation(event)" value="<?php echo isset($fetch_profile["passport"]) ? $fetch_profile["passport"] : ''; ?>">
                       <span id="error" style="color:red"></span>
                          </div>
                        <div class="fetch_profile pt-2">
                          <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Save Record</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        
        var loc = new locationInfo();
    var countryVal = "<?php echo $row['countryId']?>";
    var stateVal = "<?php echo $row['stateId']?>";
    var cityVal = "<?php echo $row['cityId']?>";
    var stateId;
    console.log(countryVal);
    console.log(stateVal);
    console.log(cityVal);

    $(document).ready(function() {

        setTimeout(() => {

            var test = 'option[value="' + countryVal + '"]'; // Corrected line
            var countryId = $("#countryId").find(test).attr("countryid");

            loc.getStates(countryId);
            var stateOptionVal = 'option[value="' + stateVal + '"]';

            setTimeout(() => {
                var stateId = $("#stateId").find(stateOptionVal).attr("stateid");
                console.log(stateId);
                loc.getCities(stateId);
            }, 2000);


        }, 2000);

    });
    // console.log(test);

    // setTimeout(() => {
    //     var countryId = $("#countryId").find(test).attr("countryid");

    // }, 1000);

    // setTimeout(() => {
    //     console.log('stateOptionVal...', stateOptionVal);
    //     console.log($("#stateId").find(stateOptionVal).attr("stateid"));
    // }, 3000);

    setTimeout(() => {
        $("#countryId").val(countryVal);
        $('#stateId').val(stateVal);
        $('#cityId').val(cityVal);
    }, 5500);
        </script>
  </body>
</html>
