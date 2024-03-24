<?php
session_start();
require("connect.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];

    $password = md5($_POST['password']); // Don't hash the password here

    // Hash the password

    $_SESSION['pass'] = $password; // Store the hashed password
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['mobile'] = $_POST['phone'];
    $_SESSION['dob'] = $_POST['dob'];
    $_SESSION['otp'] = mt_rand(100000, 999999);
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;               // Enable SMTP authentication
        $mail->Username   = 'acecarrentalss@gmail.com'; // SMTP username
        $mail->Password   = 'fjhe jbdi inzz nmhp';    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('acecarrentalss@gmail.com', 'Ace Car Rentals');
        $mail->addAddress($_POST['email']); // Add a recipient, using the email from the form

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'OTP for Verification : ';
        $mail->Body    = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
        <h2>Thank you for signing up!</h2>
        <p>Your One-Time Password (OTP) is: <strong>' . $_SESSION['otp'] . '</strong></p>
        <p>Please use this OTP to complete your registration. Ensure the confidentiality of your OTP and do not share it with anyone.</p>
        <p>If you did not request this OTP, please ignore this message.</p>
        <p>Best regards,<br>Your Website Team</p>
    </div>';

        $mail->send();
        echo 'Message has been sent';
        header("Location: checkotp.php");
        exit();
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

    // If email sending fails, you can display an error message here
    // Or you can redirect to a different page if desired
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<!-- Coding By CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ace car rentals</title>
    <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
    <!-- Custom CSS File -->

    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Import Google font - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

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
    background-attachment: fixed; /* Add this line */
}


        .container1 {
            position: relative;
            margin-top: 100px;
            max-width: 500px;
            width: 100%;
            background: rgb(234, 240, 247);
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: red;
            font-size: 10px;
        }

        .container1 header {
            font-size: 1.5rem;
            color: #050505;
            font-weight: 500;
            text-align: center;
        }

        .container1 .form {
            margin-top: 20px;
        }

        .form .input-box {
            width: 100%;
            margin-bottom: 10px;
            /* Adjusted margin */
        }

        .input-box label {
            color: #333;
            margin-bottom: px;
            /* Adjusted margin */
        }

        .form :where(.input-box input) {
            position: relative;
            height: 50px;
            width: 100%;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 4px;
            border: 1px solid #000000;
            border-radius: 6px;
            padding: 0 5px;
        }

        .input-box input:focus {
            box-shadow: 0 3px 0 rgba(0, 0, 0, 0.1);
        }

        .form .column {
            display: flex;
            column-gap: 15px;
        }

        .form button {
            height: 50px;
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

        .password-input {
            position: relative;
        }

        .fas.fa-eye.password-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: black;
            /* or your preferred color */
            font-size: 20px;
        }

        /* Additional styling to match the Facebook password field appearance */
        .password-input input {
            padding-right: 30px;
            /* Space for the eye icon */
        }

        .form button:hover {
            background: rgb(88, 56, 250);
        }

        /*Responsive*/
        @media screen and (max-width: 500px) {
            .form .column {
                flex-wrap: wrap;
            }

            .form :where(.gender-option, .gender) {
                row-gap: 15px;
            }
        }
        .eye-icon {
    font-size: 15px; /* Adjust the size as needed */
}

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    color: #fff;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

    </style>

</head>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">ACE <span>Car Rentals</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> 
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About</a></li> 
                    <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                    <li class="nav-item "><a href="login.php" class="nav-link">Login</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
 
    <div>
        <section class="container1">
            <header>User Registration</header>
            <form action="#" method="POST" class="form" onsubmit="return check_error()">
                <div class="column">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter first name" name="fname" id="fname" />
                        <div class="error-message" id="fname-error"></div>
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter last name" name="lname" id="lname" />
                        <div class="error-message" id="lname-error"></div>
                    </div>
                </div>
                <div class="input-box">
                    <label>Email </label>
                    <input type="text" placeholder="Enter email" id="email" name="email" oninput="validateEmail1()"
                        onblur="validateEmail1()" />
                    <div class="error-message" id="email-error"></div>
                    <div class="error-message" id="email-error1"></div>
                    <div class="error-message" id="email-error2"></div>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Password</label>
                        <div class="password-input">
                            <input type="password" placeholder="Password" id="password" name="password" />
                            <i class="fas fa-eye password-icon position-absolute" onclick="togglePasswordVisibility('password')" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <div class="error-message" id="password-error"></div>
                    </div>
                    <div class="input-box">
                        <label>Confirm Password</label>
                        <input type="password" placeholder="Confirm password" id="confirmpassword" name="confirmpassword" />
                        <div class="error-message" id="confirm-password-error"></div>
                    
                    </div>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Phone Number</label>
                        <input type="number" placeholder="Enter phone number" id="phone" name="phone" />
                        <div class="error-message" id="phone-error"></div>
                    </div>
                    <div class="input-box">
                        <label>Date of Birth</label>
                        <input type="date" placeholder="Enter date of birth" id="dob" name="dob" max="2006-01-01" />
                        <div class="error-message" id="dob-error"></div>
                    </div>
                </div>
                <button type="submit" name="submit">Submit</button>
                <div class="already-user">
                    <br>
                    <p><b>Already a user?</b> <a href="login.php">Login</a></p>
                </div>
            </form>
        </section>

    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        function calculateAge(birthDate) {
            const today = new Date();
            const birthYear = new Date(birthDate).getFullYear();
            const age = today.getFullYear() - birthYear;

            // Check if birthday has occurred this year
            if (new Date(today.getFullYear(), new Date(birthDate).getMonth(), new Date(birthDate).getDate()) > today) {
                return age - 1;
            } else {
                return age;
            }
        }

        function validatePhoneNumber(inputElement) {
            const phoneNumber = inputElement.value;
            const erPhoneNumber = document.getElementById('phone-error');

            // Regular expression to match a 10-digit phone number starting with 6, 7, 8, or 9
            const regex = /^[6-9]\d{9}$/;

            // Regular expression to check if the input contains any letters, special characters, or negative sign
            const invalidCharsRegex = /[^\d]/;

            // Check if the phone number matches the pattern and doesn't contain invalid characters
            if (regex.test(phoneNumber) && !invalidCharsRegex.test(phoneNumber)) {
                // Check if the number doesn't contain repeating 5s
                if (!/(.)\1{4}/.test(phoneNumber)) {
                    erPhoneNumber.innerText = ''; // Clear error message
                    return true; // Valid phone number
                } else {
                    erPhoneNumber.innerText = 'Phone number cannot contain 5 repeated digits consecutively.';
                }
            } else {
                erPhoneNumber.innerText = 'Please enter a valid 10-digit phone number without letters or special characters.';
            }
            return false; // Invalid phone number
        }



        function validateForm() {
            const fnameValid = validateField(document.getElementById('fname'),/^[a-zA-Z]+$/, 'First name cannot be empty and not contains any space.', 'fname-error');
            const lnameValid = validateField(document.getElementById('lname'), /^[a-zA-Z]+(?:\s[a-zA-Z]+)?$/, 'Last name cannot be empty.', 'lname-error');
            const emailValid = validateField(document.getElementById('email'), /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/, 'Invalid email address.', 'email-error');
            const passwordValid = validateField(document.getElementById('password'), /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/, 'Password must be at least 6 characters long with an uppercase letter, a digit, and a special character.', 'password-error');
            const confirmPasswordValid = validateField(document.getElementById('confirmpassword'), new RegExp(`^${document.getElementById('password').value}$`), 'Passwords do not match.', 'confirm-password-error');
            const phoneValid = validatePhoneNumber(document.getElementById('phone'));

            const dobElement = document.getElementById('dob');
            const dobValid = validateField(dobElement, /^\d{4}-\d{2}-\d{2}$/, 'Invalid date of birth format.', 'dob-error');
            if (dobValid) {
                const age = calculateAge(dobElement.value);
                if (age < 18 || age >= 70) {
                    showError(dobElement, 'You have to be more than 18 years old', 'dob-error');
                    return false;
                }
            }

            return fnameValid && lnameValid && emailValid && passwordValid && confirmPasswordValid && phoneValid && dobValid;
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
                case 'fname':
                
                    validateField(
    inputElement,
    /^[a-zA-Z]+$/,
    `${inputElement.name.charAt(0).toUpperCase() + inputElement.name.slice(1)} must contain only letters.`,
    `${inputElement.name}-error`
);
                    break;
                    case 'lname':
                        validateField(
    inputElement,
    /^[a-zA-Z\s]+$/,
    `${inputElement.name.charAt(0).toUpperCase() + inputElement.name.slice(1)} must contain only letters.`,
    `${inputElement.name}-error`
);

                        break;
                case 'email':
    var email = document.getElementById("email").value;
    var errorElement = document.getElementById("email-error");

    if (email === "") {
        errorElement.innerText = "Email Address is required";
        return false;
    } else if (!/^\w{3,}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        errorElement.innerText = "Invalid Email Address";
        return false;
    } else if (email.length > 255) {
        errorElement.innerText = "Email Address is too long";
        return false;
    } else if (email.indexOf("..") !== -1 || email.indexOf(".@") !== -1 || email.indexOf("@.") !== -1) {
        errorElement.innerText = "Invalid Email Address";
        return false;
    } else if (email.indexOf("@") === 0 || email.lastIndexOf(".") === email.length - 1) {
        errorElement.innerText = "Invalid Email Address";
        return false;
    } else if (/(\.\.)|(@\.)|(\.@)|(^\.)/.test(email)) {
        errorElement.innerText = "Invalid Email Address";
        return false;
    } else if (!/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
        errorElement.innerText = "Invalid Email Address";
        return false;
    } else {
        errorElement.innerText = "";
        return true;
    }
 
                    break;
                case 'password':
                    validateField(inputElement, /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/, 'Password must be at least 6 characters long with an uppercase letter, a digit, and a special character.', 'password-error');
                    break;
                case 'confirmpassword':
                    validateField(inputElement, new RegExp(`^${document.getElementById('password').value}$`), 'Passwords do not match.', 'confirm-password-error');
                    break;
                case 'phone':
                    validatePhoneNumber(inputElement);
                    
                    break;
                case 'dob':
                    validateField(inputElement, /^\d{4}-\d{2}-\d{2}$/, 'Invalid date of birth format.', 'dob-error');
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
 


    function validateEmail1() {
    var email = document.getElementById('email').value;

    // Object to track the state of each validation
    var validationState = {
        'checkEmail': false,
        'checkDriverEmail': false,
    };

    // Function to check if form should be enabled or disabled
    function updateFormState() {
        // Enable submit button if both validations passed (no error message)
        document.getElementById('submit_button').disabled = !(validationState['checkEmail'] && validationState['checkDriverEmail']);
    }

    // Shared onreadystatechange function
    function handleResponse(errorMessageElement, validationKey) {
        return function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                errorMessageElement.innerHTML = response;

                // Update the validation state based on whether the error message is empty
                validationState[validationKey] = (response.trim() === '');

                // Decide whether to enable or disable the submit button
                updateFormState();
            }
        };
    }

    // Validate with check_email.php
    var errorMessage1 = document.getElementById('email-error1');
    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = handleResponse(errorMessage1, 'checkEmail');
    xhr1.open('GET', 'check_email.php?email=' + encodeURIComponent(email), true);
    xhr1.send();

    // Validate with check_driver_email.php
    var errorMessage2 = document.getElementById('email-error2');
    var xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = handleResponse(errorMessage2, 'checkDriverEmail');
    xhr2.open('GET', 'check_driver_email.php?email=' + encodeURIComponent(email), true);
    xhr2.send();
}


    document.addEventListener('DOMContentLoaded', function () {
        const passwordField = document.getElementById('password');
        const icon = passwordField.nextElementSibling;

        // Set the initial state to 'password' and 'eye-slash' icon
        passwordField.setAttribute('type', 'password');
        icon.classList.add('fa-eye-slash');

        function togglePasswordVisibility() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Update only the eye icon class
            if (type === 'password') {
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.add('fa-eye');
                icon.classList.remove('fa-eye-slash');
            }
        }

        icon.addEventListener('click', togglePasswordVisibility);
    });
</script>

</html>