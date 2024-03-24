<?php
// Start or resume the session


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require 'connect.php';

if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $senderEmail = $_POST['email']; // Inputted email address
        $subject = $_POST['subject'];
        $messageBody = $_POST['message'];

        // Your existing code for generating OTP and checking if the email is registered

        // Rest of your existing code...

        try {
            // Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

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
            $mail->setFrom($senderEmail, $name); // Set sender email and name
            $mail->addAddress('acecarrentalss@gmail.com', 'Ace Car Rentals');  // Add Ace Car Rentals as the recipient

            // Set email format to HTML
            $mail->Subject = $subject;
// Combine all information into a single mail body
$mailBody = '<html><body>';
$mailBody .= '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; background-color: #f4f4f4; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">';
$mailBody .= '<h2 style="color: #333;">New Message from Website</h2>';
$mailBody .= '<p style="margin-bottom: 20px;">Dear Ace Car Rentals,</p>';
$mailBody .= '<p style="margin-bottom: 10px;"><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>';
$mailBody .= '<p style="margin-bottom: 10px;"><strong>Email:</strong> <a href="mailto:' . $senderEmail . '" style="color: #007bff; text-decoration: none;">' . htmlspecialchars($senderEmail) . '</a></p>';
$mailBody .= '<p style="margin-bottom: 10px;"><strong>Subject:</strong> ' . htmlspecialchars($subject) . '</p>';
$mailBody .= '<p style="margin-bottom: 20px;"><strong>Message:</strong><br>' . nl2br(htmlspecialchars($messageBody)) . '</p>';

$mailBody .= '</div>';
$mailBody .= '</body></html>';

// Set the mail body
$mail->Body = $mailBody;


            $mail->send();

            // Redirect to a success page or display a success message
            header("Location: contact.php");

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>

<!-- The HTML form remains the same -->


<!-- The HTML form remains the same -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ace car rentals</title>
    <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

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
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places" defer></script>
    <style>
    .error-message {
        font-size: 12px;
        color: red;
    }
</style>

  </head>
  <body>
    
  <?php include "navbar.php" ;
    ?>
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('bg_img5.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Contact Us</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-5 contact-primary">
        	<div class="col-md-4">
        		<div class="row mb-5">
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-map-o"></span>
			          	</div>
			            <p><span>Address:</span> Near Kanjirappally Bus Stand </p>
			          </div>
		          </div>
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-mobile-phone"></span>
			          	</div>
                          <p><span>Phone:</span> <a href="https://wa.me/917306080450">+91 7306080450</a></p>

			          </div>
		          </div>
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-envelope-o"></span>
			          	</div>
                          <p><span>Email:</span> <a href="mailto:acecarrentalss@gmail.com">acecarrentalss@gmail.com</a></p>


			          </div>
		          </div>
		        </div>
          </div>

        
          <div class="col-md-8 block-9 mb-md-5">
        <form action="#" class="bg-light p-5 contact-form" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" value="" placeholder="Your Name" id="name" name="name">
                <span class="error-message" id="name-error"></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email" id="email" name="email">
                <span class="error-message" id="email-error"></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject">
                <span class="error-message" id="subject-error"></span>
            </div>
            <div class="form-group">
                <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                <span class="error-message" id="message-error"></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Send Message" name="submit" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
        </div>
        <div class="row justify-content-center">
    <div class="col-md-12">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31475.60973503095!2d76.76660421090881!3d9.55631559375236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b063678244b010b%3A0x3963a18cef4d0da!2sKanjirappally%2C%20Kerala!5e0!3m2!1sen!2sin!4v1709141694300!5m2!1sen!2sin"
            style="border: 0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

    </section>
	

    <?php include "footer.php"; ?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
        var form = document.querySelector('.contact-form');
        var emailField = document.getElementById('email');

        // Add event listener for live validation on email input change
        emailField.addEventListener('input', function (event) {
            validateEmailField(emailField);
        });

        form.addEventListener('submit', function (event) {
            // Prevent form submission if validation fails
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        function validateForm() {
            var name = document.getElementById('name');
            var email = emailField; // Use the global emailField variable
            var subject = document.getElementById('subject');
            var message = document.getElementById('message'); 

            // Reset any previous error messages
            resetErrors();

            var isValid = true;

            // Validate Name
            isValid = validateField(name) && isValid;

            // Validate Email
            isValid = validateField(email) && isValidEmail(email.value) && isValid;

            // Validate Subject
            isValid = validateField(subject) && isValid;

            // Validate Message
            isValid = validateField(message) && isValid;

            return isValid;
        }

        function validateField(field) {
            var fieldName = field.id;
            var value = field.value.trim();
            var errorElement = document.getElementById(fieldName + '-error');

            // Reset error message
            errorElement.innerText = '';

            // Validate and display error if necessary
            if (value === "") {
                displayError(fieldName + '-error', fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + ' is required.');
                return false;
            }

            return true;
        }

        function validateEmailField(emailField) {
            var emailValue = emailField.value.trim();
            var emailErrorElement = document.getElementById('email-error');

            // Reset error message
            emailErrorElement.innerText = '';

            // Validate and display error if necessary
            if (emailValue === "") {
                displayError('email-error', 'Email is required.');
                return false;
            }

            if (!isValidEmail(emailValue)) {
                displayError('email-error', 'Please enter a valid email address.');
                return false;
            }

            return true;
        }

        function isValidEmail(email) {
            // Basic email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function displayError(id, message) {
            var errorElement = document.getElementById(id);
            errorElement.innerText = message;
            errorElement.classList.add('error-message'); // Add the error-message class
        }

        function resetErrors() {
            var errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(function (element) {
                element.innerText = '';
                element.classList.remove('error-message'); // Remove the error-message class
            });
        }
    });
</script>





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
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>