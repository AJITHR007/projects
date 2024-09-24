<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technology</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }
        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .main-content img {
            width: 500px; /* Increase the width */
            height: 500px; /* Increase the height */
        }
        .card {
            border: 1px solid;
            margin: 10px 0;
            box-shadow: 5px 5px 5px 5px #e1e3e6;
            width: 500px;
            padding: 10px;
        }
        h2 {
            text-align: center;
        }
        h1 {
            text-align: center;
            color: #6f42c1;
            text-decoration: underline;
        }
        .heading p {
            color: #634a91;
            text-align: center;
            width: 650px;
            font-size: 24px;
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
    <div class="heading">
        <h1>Technology Services</h1>
        <p>Below are the technology services we offer, including Laravel:</p>
    </div>
    <div class="main-content">
        <div class="card">   
            <img src="assets\download.jpg" alt="Laravel Image 1">
        </div>
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
