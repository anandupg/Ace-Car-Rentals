<?php
session_start();

if (!isset($_SESSION['forgot_password_email'])) {
    header("Location: forgotpassword.php");
    exit();
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
    if (isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
        $newpassword = md5($_POST['newpassword']);
        $confirmpassword = md5($_POST['confirmpassword']);

        if ($newpassword == $confirmpassword) {
            $sql = "UPDATE tbl_login SET pass = '$newpassword' WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result == TRUE) {
                // Password changed successfully
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Password Changed</title>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Password changed successfully",
                            width: 350,
                            height: 60,
                        }).then(function () {
                            window.location.href = 'login.php'; // Redirect after showing the message
                        });
                    </script>
                </body>
                </html>
                <?php
                exit(); // Ensure nothing else is processed after showing the message
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: forgot_password.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Passwords do not match";
            header("Location: forgot_password.php");
            exit();
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

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .error-message {
            color: red
        }
    </style>
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

    .form .btn-primary {
        background-color: #6c757d;
        border-color: #6c757d;
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
        margin-top: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #6c757d;
    }

    .form button:hover {
        background: #495057;
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

        <header>Reset Password</header>
        <form action="#" method="post" onsubmit="return validateForm()" class="form">
        <label for="newPassword" style="color:black;">Enter new password</label>
            <!-- Added onsubmit attribute -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="newpassword" id="newPassword"
                    placeholder="newpassword" oninput="validatePassword()">
                
                <!-- Error message for new password -->
                <div id="password-error" class="error-message"></div>
            </div>
            <label for="confirmPassword" style="color:black;">Confirm new password</label>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="confirmpassword" id="confirmPassword"
                    placeholder="confirmpassword" oninput="validateConfirmPassword()">
               
                <!-- Error message for confirm password -->
                <div id="confirm-password-error" class="error-message"></div>
            </div>

            <!-- Countdown timer -->
            <div id="countdown" style="color: #007bff;"></div>

            <!-- Error message div -->
            <div id="errorMessage"></div>

            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Submit </button>
        </form>

        <!-- Back button -->
        <a href="./login.php" class="back-btn">&#8249; Back</a>
    </div>
</body>

</html>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    function showError(input, message, errorId) {
        document.getElementById(errorId).textContent = message;
    }

    function showSuccess(errorId) {
        document.getElementById(errorId).textContent = '';
    }

    function validateField(input, regex, message, errorId) {
        const value = input.value.trim();
        const isValid = regex.test(value);
        isValid ? showSuccess(errorId) : showError(input, message, errorId);
        return isValid;
    }

    function validatePassword() {
        const input = document.getElementById('newPassword');
        const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
        const message =
            'Password must be at least 6 characters long with an uppercase letter, a digit, and a special character.';
        return validateField(input, regex, message, 'password-error');
    }

    function validateConfirmPassword() {
        const passwordInput = document.getElementById('newPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const message = 'Passwords do not match.';
        return validateField(confirmPasswordInput, new RegExp(`^${passwordInput.value}$`), message,
            'confirm-password-error');
    }

    function validateForm() {
        return validatePassword() && validateConfirmPassword();
    }

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        } else {
            // Validation passed, form will submit as usual
        }
    });

    form.addEventListener('input', function(event) {
        const inputElement = event.target;
        switch (inputElement.id) {
            case 'newPassword':
                validatePassword();
                break;
            case 'confirmPassword':
                validateConfirmPassword();
                break;

            default:
                break;
        }
    });
});
</script>


        <!-- forgot password section ends here -->






        <!-- Sign In End -->
    </div>

    <!-- JavaScript code for real-time password validation -->
    <!-- Add this script inside your HTML file, preferably at the end of the body tag -->


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