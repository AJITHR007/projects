<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srays</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg,  #4F3EC8, #D38636);
            margin-top: 0px;
            padding: 0px;
            
        }
        .sidebar{
            background-color: #f1f1e8;
            text-align: center;
            min-height: 600px;
            width:400px;
            margin:20px 0px 10px 0px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            box-shadow: 10px 10px 10px 0 #363534;


        }
        .black-text {
        color: black;
        font-size:20px;
    }
        .main-content{
            
            background-color:#6e65eb;
            text-align: center;
            min-height: 600px;
            width:800px;
            margin:20px 0px 10px 0px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            box-shadow: 10px 10px 10px 0 #363534;
        
        }
        .header{
            display:flex;
            font-size:24px;
            font-weight:500;
            text-decoration:none;
            display:flex; padding:10px; margin:10px; 
        }
       
        .header ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

.header li {
    float: left;
}

.header li a {
    display: block;
    color: #f6f6f6;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.header li a:hover {
    background-color:orange;
}

.header li a.active {
    background-color: #ccc;
}
.heading{
 color:white;
 width:200px;
 margin:20px 50px;
 font-style:red-rose;
}
.heading img{
 width:300px;
 height:300px;
 border-radius:150px;
 margin:20px 100px;
 animation: moveLogo 2s infinite linear; /* Adjusted animation properties */
}   
span{
    color:orange;
}    
p{
    color:white;
    padding:20px;
    margin:20px;
}
.sidebar li{
    list-style:none;
    text-align:left;
    margin-left:50px;
    margin-top:20px;
    padding:10px;
    width:200px;
}
.sidebar li a{
    text-decoration:none;
    font-size:24px;
    font-weight:bold;
   
}
.sidebar li:hover{
    background-color:orange;
}
.srays-image{
    margin:30px;
}
.dropdown-content a{
    font-size:18px;
}
 @keyframes moveLogo {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(20px);
            }
        }

        h4 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color:none;
            border:30px solid #666666;
            margin-left:300px;
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-row ">
       
    <div class="sidebar">
    <img src="assets\pic4.webp" alt="demo" class="srays-image"/>
    <div class="sidebar-content">
        <h3>Welcome to our website!</h3>
        <p class="black-text">Explore our services and discover how we can help you achieve your goals.</p>
    </div>
</div>
    <div class="main-content">
    
    <div class="header">
    <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="tech.php">Technology</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="service.php">Service</a></li>
                    <li id="loginDropdown" class="dropdown">
                        <a href="#">Login</a>
                        <div class="dropdown-content">
                           <a href="adminlogin.php">ADMIN</a>
                           <a href="login.php">USER</a>
                        </div>
                    </li>
                </ul>
   
</div>
<div class="heading d-flex flex-row">
    <div class="text-container">
    <h1>THE NEXT GENERATION</h1>
    <h2>
            Design an Optimal Business Model to reach Your <span id="dynamicText"></span>
        </h2>
    </div>
    <img src="https://www.srayssolutions.in/assets/img/icons/hero-img.png" class="logo"/>
</div>
<p>
            The Process of Business Model Construction and Modifications is also called business model innovation
        </p>
    </div>
</div>
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        var loginDropdown = document.getElementById('loginDropdown');
        var dropdownContent = loginDropdown.querySelector('.dropdown-content');

        // Initially hide the dropdown content
        dropdownContent.style.display = 'none';

        // Add click event listener to the login link
        loginDropdown.addEventListener('click', function(event) {
            event.preventDefault();
            // Toggle the visibility of the dropdown content
            if (dropdownContent.style.display === 'none') {
                dropdownContent.style.display = 'block';
            } else {
                dropdownContent.style.display = 'none';
            }
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                dropdownContent.style.display = 'none';
            }
        });

        // Redirect to appropriate login page when user clicks on "Admin" or "User"
        var adminLoginLink = dropdownContent.querySelector('a[href="adminlogin.php"]');
        var userLoginLink = dropdownContent.querySelector('a[href="login.php"]');

        adminLoginLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = adminLoginLink.getAttribute('href');
        });

        userLoginLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = userLoginLink.getAttribute('href');
        });
    });
</script>
<script>
    const dynamicText = document.getElementById('dynamicText');
    let phrases = ['Designing', 'IT Services', 'HR Solutions'];
    let index = 0;

    function changeText() {
        dynamicText.textContent = phrases[index];
        index = (index + 1) % phrases.length;
    }

    setInterval(changeText, 2000); // Change text every 2 seconds
</script>
</body>
</html>