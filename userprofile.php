<?php

include 'dbconnection.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Profile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;   
       background: linear-gradient( #f6f6f6, #f9f9f9);
   
    }
    
    .container {
        max-width: 700px;
        max-height: 590px;
        margin: 20px auto;
        padding: 20px;
        border: 2px solid #ccc;
        background:linear-gradient( #8F4B84, #f6f6f6);
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .profile-picture {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 20px;
        overflow: hidden;
    }
    
    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-info {
        text-align: center;
        
    }
    
    .profile-info h2 {
        margin-bottom: 10px;
        text-align:center;
    }
    
    .profile-info p {
        margin: 20px 100px 20px;
        display:flex;
        text-align: left;
        font-size:16px;
        font-weight: bold;   

    }
    .profile-info p label{    
        width:200px;
    }
    
    .edit-input {
      display:flex;
        border: none;
        width: 65%;
        font-size:14px;
        text-align:left;
        background-color:hidden;
    }
    #closeButton {
            position: fixed;
            top: 10px;
            right: 20px;
            z-index: 9999;
            background-color: transparent; /* Set background color to transparent */
            border: none;
            font-size: 20px; /* Converted from rem to px */
            color: black;
            cursor: pointer;
        }

        #closeButton:hover {
            color: #2980b9;
        }
    @media (max-width: 600px) {
        .profile-picture {
            width: 100px;
            height: 100px;
        }
    }
</style>
</head>
<body>
<?php
      $select_profile = $conn->prepare("SELECT * FROM recordadd WHERE id = ?");
      $select_profile->execute([$user_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>          

<div class="container">
    <div class="profile-picture">
        <img class="img-profile" src="<?= $fetch_profile['image']; ?>" alt="Profile Image">

    </div>
    <div class="profile-info">
        <h2><?= $fetch_profile['empName']; ?></h2>
        <p><label>Job Title:</label> <?= $fetch_profile['designation']; ?></p>
        <p><label>Employee Id: </label><input type="text" class="edit-input" value="<?= $fetch_profile['empRec']; ?>" readonly></p>
        <p><label>Deprtment:</label> <input type="text" class="edit-input" value="<?= $fetch_profile['department']; ?>" readonly></p>
        <p><label>Email:</label> <input type="text" class="edit-input" value="<?= $fetch_profile['email']; ?>" readonly></p>
        <p><label>Phone Number: </label><input type="text" class="edit-input" value="<?= $fetch_profile['phone']; ?>" readonly></p>
        <p><label>Address:</label> <input type="text" class="edit-input" value="<?= $fetch_profile['peraddress']; ?>" readonly></p>
        <p><label>district:</label> <input type="text" class="edit-input" value="<?= $fetch_profile['cityId']; ?>" readonly></p>
        <p><label>State:</label> <input type="text" class="edit-input" value="<?= $fetch_profile['stateId']; ?>" readonly></p>
        <p><label>Country: </label><input type="text" class="edit-input" value="<?= $fetch_profile['countryId']; ?>" readonly></p>
        <p><label>Employment Status:</label> 
    <input type="text" class="edit-input" value="<?= $fetch_profile['status'] == 0 ? 'Active' : 'Inactive'; ?>" readonly>
</p>
        <p><label>Date of Joining:</label> <input type="text" class="edit-input" value="<?= $fetch_profile['doj']; ?>" readonly></p>
        <p style="font-style: italic;">If you want to change any details, please contact HR.</p>
 </div>
</div>
<button id="closeButton" class="btn-close" aria-label="Close">X</button>
    <script>
        // Get a reference to the close button
        var closeButton = document.getElementById('closeButton');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function() {
            // Redirect to the desired page (e.g., "emdash.html")
            window.location.href = "empdash.php";
        });
    </script>
</body>
</html>