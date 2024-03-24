<?php
// Start or resume the session
session_start();

// Reset session variables as needed
$_SESSION = array(); // Reset all session variables

// Destroy the session
session_destroy();

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require 'connect.php';

if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $randomOTP = mt_rand(100000, 999999);
        $sql="SELECT email from tbl_login where email='$email'; ";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            $updateSql = "UPDATE tbl_login SET Gcode = $randomOTP WHERE email = '$email';";

            if ($conn->query($updateSql)) {
                $_SESSION['forgot_password_email'] = $email;
    
                // Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
    
                try {
                    // Server settings
                    $mail->SMTPDebug = 0;  // Enable verbose debug output
                    $mail->isSMTP();       // Send using SMTP
                    $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
                    $mail->SMTPAuth = true;  // Enable SMTP authentication
                    $mail->Username = 'acecarrentalss@gmail.com';  // SMTP username
                    $mail->Password = 'fjhe jbdi inzz nmhp';  // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable explicit TLS encryption
                    $mail->Port = 587;  // Use 587 for STARTTLS, or 465 for implicit TLS (SMTPS)
                    $mail->isHTML(true);
    
                    // Recipients
                    $mail->setFrom('acecarrentalss@gmail.com', 'Ace Car Rentals');
                    $mail->addAddress($email, 'Anandu');  // Add a recipient
    
                    // Set email format to HTML
                    $mail->Subject = 'Password Reset OTP for Your Account';
                    $mail->Body = '
                    <html>
                    <body>
                        <h1>Password Reset OTP</h1>
                
                        <p>Dear [User],</p>
                
                        <p>We have received a request to reset the password for your account associated with the email address <strong>[acecarrentalss@email.com]</strong>. To proceed with the password reset, please use the following One-Time Password (OTP):</p>
                
                        <h2>Your OTP: <span style="color: #007bff;">' . $randomOTP . '</span></h2>
                
                        <p>Please enter this OTP on the password reset page to complete the process. If you did not initiate this request, please ignore this email. Ensure the security of your account by not sharing this OTP with anyone.</p>
                
                        <p>If you have any questions or concerns, please contact our support team.</p>
                
                        <p>Thank you, <br>Ace Car Rentals</p>
                    </body>
                    </html>';
    
                    $mail->send();
                    
                } catch (Exception $e) {
                    ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Login error</title>
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
              
            </body>
            <script>
              Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Please connect to internet",
  width: 350,
  height: 60,
}).then((result) => {
  // Check if the user clicked "OK"
  if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
    // Redirect to login.php
    window.location.replace("login.php");
  }
});
        
            </script>
            </html>
            <?php
                }
    
                header("Location: otp.php");
                
            } else {
                echo "Error: " . $updateSql . "<br>" . $conn->error;
            }

        }else{
            ?>
            <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Forgot Password</title>
      
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
      
    </body>
    <script>
      Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Email is not registered!",
  width : 350,
  height : 60,
});

    </script>
    </html>
<?php
        }

       
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ace Car Rentals - Forgot Password</title>
    <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
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
            font-weight: 500;
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
            margin-top: 30px;
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

        /*Responsive*/
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
</head>

<body>
    <div class="container">
    <a class="navbar-brand" href=""><span style="color: green;">ACE</span> <span>Car Rentals</span></a>

        <header style="font-weight: bold;">Forgot Password</header>
        <form action="#" method="post" class="form" onsubmit="return check_error()">
            <div class="input-box">
                <label class="form-check-label" for="exampleCheck1" style="color: black;">
                    Enter your registered Email Address of your account!
                </label>
                <br>
                <input type="email" placeholder="Enter email" id="email" name="email" />
                <div class="error-message" id="email-error"></div>
                <div id="email-status" class="error-message"></div>
            </div>

            <!-- Error message div -->
            <div id="errorMessage"></div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                
            </div>
            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Send OTP</button>
        </form>

        <!-- Back button -->
        <a href="login.php" class="back-btn">&#8249; Back</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.form');

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

            function validateForm() {
                const emailValid = validateField(document.getElementById('email'), /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, 'Please enter a valid email address.', 'email-error');

                return emailValid;
            }

            form.addEventListener('submit', function (event) {
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                } else {
                    // Validation passed, submit the form
                    // Optional: You can add any additional logic here before submitting the form
                }
            });

            form.addEventListener('input', function (event) {
                const inputElement = event.target;
                switch (inputElement.name) {
                    case 'email':
                        validateField(inputElement, /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, 'Invalid email address.', 'email-error');
                        break;
                    default:
                        break;
                }
            });
        });

        function check_error() {

var errorElements = document.querySelectorAll('.error-message');
for (var i = 0; i < errorElements.length; i++) {
  if (errorElements[i].innerText !== '') {
    // If any error message exists, prevent form submission
    return false;
  }
}
    return true;
}
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#email').on('input', function(){
                var email = $(this).val();
                $.ajax({
                    url: 'check_email_fgpass.php',
                    type: 'POST',
                    data: {email: email},
                    success: function(response){
                        if(response == 'not_registered'){
                            $('#email-status').text('No account found with that email');
                        } else {
                            $('#email-status').text('');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
