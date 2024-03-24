<?php
include "connect.php";
session_start();

// Check if $_SESSION['name'], $_SESSION['pass'], $_SESSION['email'], $_SESSION['mobile'], and $_SESSION['otp'] are set
if (isset($_SESSION['fname'],$_SESSION['lname'], $_SESSION['pass'], $_SESSION['email'], $_SESSION['mobile'], $_SESSION['otp'],$_SESSION['dob'])) {
    // Proceed with your code
} else {
    // Handle the case when session variables are not set
    echo "Session variables are not set.";
}


// Check connection
if(isset($_POST['checkotp'])) {

    // Retrieve form data and sanitize it to prevent SQL injection
    $fname=$_SESSION['fname'];
    $lname=$_SESSION['lname'];
    $pass=$_SESSION['pass'] ;
    $email= $_SESSION['email'] ;
    $phone=$_SESSION['mobile'] ;
    $dob=$_SESSION['dob'] ;
    $otp = $_POST['otp'];
    if ($_SESSION['otp']==$otp) {

    // If the first insert is successful, proceed with the second insert
    $sql2="INSERT INTO tbl_login(email, pass, type_id) VALUES('$email', '$pass', (SELECT type_id FROM tbl_user_types WHERE type_name = 'user'));";    
    if ($conn->query($sql2) === TRUE) {
        $login_id = $conn->insert_id;
        $sql_insert_registration = "INSERT INTO tbl_registration(login_id,fname,lname,dob, email, phone) VALUES('$login_id', '$fname', '$lname', '$dob', '$email', '$phone');";
        if($conn->query($sql_insert_registration) === TRUE){
        
        header("Location: login.php");
        session_destroy();
        $_SESSION['registration_success'] = true;

    } else {

        // Handle error for the second insert
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        header("Location: signup.php");
    }

 
}
    }else{
        echo"<script>alert('Wrong OTP please register once more');</script>";
       
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

</body>
<script>
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Invalid OTP.",
    });
</script>

</html>
<?php

    }
        ?>

<?php
  
    
    // Close connection
    $conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
   
</head>
<body>
    

<section class="ftco-section">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-xl-8 ftco-animate">
                <div class="otp-box">
                <a class="navbar-brand ml-auto" href=""><span style="color: green;">ACE</span> <span>Car Rentals</span></a>

                    <form action="#" class="billing-form" method="post">
                        <h3 class="mb-4 billing-heading">Enter OTP</h3>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter OTP" name="otp" id="mail" required>
                        </div>
                        <div id="countdown" style="color: #007bff;"></div>
                        <div class="form-group">
                            <input type="submit" value="Verify-OTP" name="checkotp" id="login">
                        </div>
                    </form>
                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>
</body>
    <style>
        body{
            background-image: url('bg.jpg');
            background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        
        }
        .form-group input {
        border: 1px solid #000; /* Add this line for the 1px border */
        
    }
       
  /* OTP Box Styles */
.otp-box {
    width: 100%;
    max-width: 400px;
    padding: 30px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    text-align: center;
    border: 1px solid #000;
    margin: 0 auto;
}

.billing-heading {
    font-size: 24px;
    color: black;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
    display: flex;
        justify-content: center;
        align-items: center;
    
}

.form-control {
    width: calc(100% - 30px); /* Adjust width to fit padding */
    padding: 15px;
    border: none;
    border-radius: 5px;
    background-color: white;
    color: #000000; /* Set font color to black */
    font-size: 16px;
    
}

.form-control:focus {
    outline: none;
    background-color: #ffffff;
    border-color: black;
}

#login {
    width: calc(100% - 30px); /* Adjust width to fit padding */
    padding: 15px;
    border: none;
    border-radius: 5px;
    background-color: #6b38e8;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#login:hover {
    background-color: #5632a9;
}

</style>





    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
    <script>
        function validateEmail() {
            const email = document.getElementById("mail").value;
            const emailLabel = document.getElementById("email");
            emailLabel.textContent = /^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/.test(email) ? "" : "*Invalid email address.";

        }
        function validatePassword() {
            const password = document.getElementById("password").value;
            const passLabel = document.getElementById("pass");
            passLabel.textContent = password.length >= 6 ? "" : "*Password should be at least 6 characters.";
        }
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye/eye-slash icon
            const icon = passwordField.nextElementSibling;
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }


        document.addEventListener('DOMContentLoaded', function () {
        // Set the time for the countdown (in seconds)
        let timeInSeconds = 300; // 5 minutes

        // Get the countdown element
        const countdownElement = document.getElementById('countdown');

        // Function to update the countdown
        function updateCountdown() {
            const minutes = Math.floor(timeInSeconds / 60);
            const seconds = timeInSeconds % 60;

            // Display the countdown in the format MM:SS
            countdownElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            // Decrement the time
            timeInSeconds--;

            // Check if time has run out
            if (timeInSeconds < 0) {
                clearInterval(countdownInterval);
                // Redirect to forgot_password.php
                window.location.href = 'forgot_password.php';
            }
        }

        // Initial update
        updateCountdown();

        // Set up an interval to update the countdown every second
        const countdownInterval = setInterval(updateCountdown, 1000);
    });

    </script>
</body>

</html>