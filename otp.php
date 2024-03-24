<?php
session_start();

if (!isset($_SESSION['forgot_password_email'])) {
    header("Location: forgotpassword.php");
}

$email = $_SESSION['forgot_password_email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

require "connect.php";



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {

    if (isset($_POST['otp'])) {
        $otp = $_POST['otp'];
        $checkSql = "SELECT * FROM tbl_login WHERE email = '$email'";
        $result = $conn->query($checkSql);

        // Check if the query was successful
        if ($result) {
            // Fetch the data from the result set
            while ($row = $result->fetch_assoc()) {
                // Output the email to the console
                // Note: The correct syntax is console.log, not console . log
                $otpCheck = $row['Gcode'];

                echo "<script>console.log('" . $row['Gcode'] . "');</script>";
            }
        } else {
            // Handle the case where the query was not successful
            echo "<script>alert('Query failed: " . $conn->error . "');</script>";
        }
        if ($otpCheck == $otp) {

             header("Location: resetpassword.php");
            exit();
        }else{
            echo"<script>alert('Incorrect OTP');</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ace Car Rentals</title>
    <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap JS and Bootbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<style>
   
    body {
        background-image: url('bg.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        margin: 0;
        font-family: "Poppins", sans-serif;
    }

    .container {
        max-width: 500px;
        width: 100%;
        background: rgb(234, 240, 247);
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .container header {
        font-size: 1.5rem;
        color: #050505;
        font-weight: bold;
        text-align: center;
    }

    .form {
        margin-top: 20px;
    }

    .input-box {
        margin-top: 20px;
    }

    .input-box label {
        color: #333;
    }

    .input-box input {
        position: relative;
        height: 50px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        color: #707070;
        margin-top: 8px;
        border: 1px solid #000000;
        border-radius: 6px;
        padding: 0 15px;
    }

    .input-box input:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    }

    .error-message {
        color: red;
        font-size: 10px;
        margin-top: 5px;
    }

    .form button {
        height: 55px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        font-weight: 400;
        border-radius: 25px;
        margin-top: 10px; /* Adjusted margin-top here */
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: rgb(130, 106, 251);
    }

    .form button:hover {
        background: rgb(88, 56, 250);
    }

    .back-btn {
        display: block;
        text-align: center;
        margin-top: 20px;
    }

    .back-btn:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media screen and (max-width: 500px) {
        .input-box,
        .form .column {
            flex-wrap: wrap;
        }

        .input-box,
        .gender-option,
        .gender {
            row-gap: 15px;
        }
    }
</style>



<body>
    <div class="container">
        <a class="navbar-brand" href=""><span style="color: green;">ACE</span> <span>Car Rentals</span></a>

        <header>OTP</header>
        <form action="#" method="post" onsubmit="return validateForm()" class="form">
            <div class="input-box">
                <label class="form-check-label" for="exampleCheck1" style="color: black;">
                    Enter the OTP received in your registered Email Address!
                </label>
                <br>
                <input type="number" placeholder="Enter OTP" id="otp" name="otp" oninput="validateOtp()" />
                <div class="error-message" id="otp-error"></div>
            </div>

            <!-- Countdown timer -->
            <div id="countdown" style="color: #007bff;"></div>

            <!-- Error message div -->
            <div id="errorMessage"></div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="form-check">

                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Submit OTP</button>
        </form>

        <!-- Back button -->
        <a href="./login.php" class="back-btn">&#8249; Back</a>
    </div>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener for live validation on input
        document.getElementById('otp').addEventListener('input', function() {
            validateOtp();
        });
    });

    function validateOtp() {
        // Get OTP input value and error message element
        var otpInput = document.getElementById('otp').value.trim();
        var errorMessageDiv = document.getElementById('otp-error');

        // Use a regex to match exactly 6 digits
        var otpRegex = /^\d{6}$/;

        if (!otpRegex.test(otpInput)) {
            // Display error message for invalid OTP
            errorMessageDiv.textContent = 'Enter a valid 6-digit OTP';
        } else {
            // Clear error message for valid OTP
            errorMessageDiv.textContent = '';
        }
    }

    function validateForm() {
        // Get OTP input value and error message element
        var otpInput = document.getElementById('otp').value.trim();
        var errorMessageDiv = document.getElementById('otp-error');

        // Use a regex to match exactly 6 digits
        var otpRegex = /^\d{6}$/;

        if (!otpRegex.test(otpInput)) {
            // Display error message for invalid OTP
            errorMessageDiv.textContent = 'Enter a valid 6-digit OTP';
            // Prevent form submission
            return false;
        }

        // Form is valid, allow submission
        return true;
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



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>