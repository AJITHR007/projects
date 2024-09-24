<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Make the container full height of the viewport */
        }
        .container {
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .highlight {
            font-weight: bold;
            color: purple;
        }
        #closeButton {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>About Us</h1>
        <p><span class="highlight">SRays</span> is an HR outsourcing firm incorporated by skilled and proficient wizards in the field of Human Resources aiming to Virtualize the HR Process. We have professionals who are actively exercising Human Resources practices in the Industry, by providing up-to-date sophisticated HR solutions and HRMS (Human Resource Management System) software, IT services to startups, SMEs, Family-Based businesses, and Corporates.</p>
        <p>As a contribution towards the Students community, we are conducting some HR Skill Development Programs for helping them to Up-Skill their knowledge towards the Industrial requirements. Also, we conduct Technical Skill Development Programs for HR Professionals and Entrepreneurs.</p>
    </div>
    <button id="closeButton" class="btn-close" aria-label="Close">X</button>
    <script>
        // Get a reference to the close button
        var closeButton = document.getElementById('closeButton');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function() {
            // Redirect to the desired page (e.g., "welcome.php")
            window.location.href = "welcome.php";
        });
    </script>
</body>
</html>
