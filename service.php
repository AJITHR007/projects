<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>services</title>
    <style>
        .main-content{
              display:flex;
              flex-direction:row;
        }
        .main-content img{
            width:300px;
            height:300px;

        }
        .card{
            border:1px;
            margin:10px 50px;
            box-shadow: 5px 5px 5px 5px #e1e3e6;
            width:400px;
            padding:10px;

        }
        h2{
            text-align:center;
        }
        h1{
            text-align:center;
            color:#6f42c1;
            text-decoration:underline;
        }
       .heading p{
            color:#634a91;
            text-align:center;
            width:650px;
            margin-left:300px;
            font-size:24px;
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
        <h1>Business Service</h1>
        <p>business services are activities that combine are 
            consolidate certain enterprise-wide needed support service</p>
    </div>
    <div class="main-content">
     <div class="card">   

    <img src="https://www.srayssolutions.in/assets/img/icons/service-recruitment.png" alt="alt-img">
    <h2>Recruitment</h2>
    <p>Hiring the right resource is always a challenge, but with the blend of dedicated recruiters,
        technology & best hiring practices we provide  the right set of resources for any challenging positions. 
        Our recruitment process is crafted specifically to match your business needs and to streamline & enhance the quality
        of your human capital. Get ready to leverage the cost and time efficient recruitment with us!.
    </p>
    </div>
    <div class="card">  
    <img src="https://www.srayssolutions.in/assets/img/icons/service-training-developement.png" alt="alt-img">
    <h2>Training & Development</h2>
    <p>We Train your employees to develop them as successful resources who can contribute to the revenue of the organization we as a consultant see through the client 
        training needs and would execute training programs and events. through vertain trainers associated with us.
    </p>
</div>
    <div class="card">  
    <img src="https://www.srayssolutions.in/assets/img/icons/service-organizational-development.png" alt="alt-img">
    <h2>Organizational  Development Support</h2>
    <p>Hiring the right resource is always a challenge, but with the blend of dedicated recruiters,
        technology & best hiring practices we provide  the right set of resources for any challenging positions. 
        Our recruitment process is crafted specifically to match your business needs and to streamline & enhance the quality
        of your human capital. Get ready to leverage the cost and time efficient recruitment with us!.
    </p>
    
</div>
    </div>
    <button id="closeButton" class="btn-close" aria-label="Close">X</button>
   <script>
    // Get a reference to the close button
    var closeButton = document.getElementById('closeButton');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Redirect to the desired page (e.g., "emdash.html")
        window.location.href = "welcome.php";
    });
</script>
</body>
</html>