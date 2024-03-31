<?php
require_once "connect.php";
if (isset($_POST['submit'])) {
          $email = $_POST['email'];
          $pass = md5($_POST['pass']);
          $sql = "SELECT login_id, type_id, status FROM tbl_login WHERE email='$email' AND pass='$pass';";
          
          $result = $conn->query($sql); 
        
          if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $loginId = $row['login_id'];
            $typeId = $row['type_id'];
            $status = $row['status'];
          }
        }
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
  $email=$_POST['email'];
  $pass = md5($_POST['pass']);
  $sql1="SELECT email from tbl_login where email='$email' and pass='$pass';";
  $res=$conn->query($sql1);
  if($res->num_rows>0){
 
    if($status == "Active"){
  $hostName = gethostName();
    
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
        $mail->Subject = 'Login Alert ';
        $mail->Body = '
        <div style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    
            <h2 style="color: #007bff;">Login Successful!</h2>
    
            <p>Hello,<br>You have successfully logged in to the system hosted by:</p>
            
            <p style="font-weight: bold;">' . $hostName . '</p>
    
            <p>Thank you for using our system. If you have any questions or concerns, feel free to contact our support team.</p>
    
            <p style="margin-top: 20px; font-size: 0.8em; color: #777;">This is an automated message, please do not reply.</p>
    
        </div>
    ';
    
        $mail->send();
        if(isset($_POST['submit'])){
           
            session_start();
            $_SESSION['login_id'] = $loginId;
        
            if($status == "Active"){
              if($typeId == 1){
                header("Location: ./Admin/admin.php");
                exit();
              } elseif($typeId == 2) {
                header("Location: index.php");
                exit();
              }else{
                header("Location: driver_page.php");
                exit();
              }
            } else {
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
          title: "You can't Login",
          text: "Your account is blocked by admin",
          width : 350,
          height : 60,
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
          
        }
        exit();
    } catch (Exception $e) {
      if($result->num_rows > 0){
        ?>
            <script>
  alert("Oops... Please connect to the internet.");
  window.location.replace("login.php");
</script>

            <?php
      }
    }
   } else{
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
          title: "You can't Login",
          text: "Your account is blocked by admin",
          width : 350,
          height : 60,
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
  }else{
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
  text: "Incorrect email or password",
  footer: 'Don\'t have an account? <a href="signup.php">Register here</a>',
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
?>



<!DOCTYPE html>
<!-- Coding By CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Ace car rentals</title>
    <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
    <!-- Custom CSS File -->
   
    <link rel="stylesheet" href="css/flaticon.css">
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
  margin-top: 0px;
}
.form .input-box {
  width: 100%;
  margin-top: 20px;
}
.input-box label {
  color: #333;
}
.form :where(.input-box input, .select-box) {
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
.form .column {
  display: flex;
  column-gap: 15px;
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
.password-input {
    position: relative;
}

.fas.fa-eye.password-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: black;
    cursor: pointer;
    font-size: 20px;
}

/* Additional styling to match the Facebook password field appearance */
.password-input input {
    padding-right: 30px; /* Space for the eye icon */
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

        .forgot-password,
        .create-account {
            margin-top: 10px;
        }
        /* .navbar {
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
} */
        
    </style>
</head>



<body>

<?php


    $current_page = basename($_SERVER['PHP_SELF']);
    function isActive($page, $current_page) {
        return ($page == $current_page) ? 'active' : '';
    }
?>
 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="index.php">ACE <span>Car Rentals</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo isActive('index.php', $current_page); ?>"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item <?php echo isActive('car.php', $current_page); ?>"><a href="car.php" class="nav-link">Cars</a></li>
                <li class="nav-item <?php echo isActive('about.php', $current_page); ?>"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item <?php echo isActive('contact.php', $current_page); ?>"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item <?php echo isActive('login.php', $current_page); ?>"><a href="login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="container1">
    <header>Login</header>
    <form action="#" method="POST" class="form">
        <div class="input-box">
            <label>Email</label>
            <input type="text" placeholder="Enter email" id="email" name="email"/>
            <div class="error-message" id="username-error"></div>
        </div>
        <div class="input-box">
    <label>Password</label>
    <div class="password-input">
        <input type="password" placeholder="Enter password" id="password" name="pass"/>
        <i class="fas fa-eye password-icon position-absolute" onclick="togglePasswordVisibility('password')" style="right: 10px; top: 50%;color:black; transform: translateY(-50%); cursor: pointer;"></i>
    </div>
</div>

            <div class="error-message" id="password-error"></div>
            
            
        </div>
        <div class="forgot-password">
            <a href="forgot_password.php">Forgot Password?</a>
        </div>

        <button type="submit" name="submit" >Submit</button>

        <div class="create-account">
            <br>
            <p><b>Don't have an account? </b><a href="signup.php">Create Account</a></p>
        </div>
    </form>
</section>
</div>
</body>

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
            const emailValid = validateField(document.getElementById('email'), /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, 'Please enter email.', 'username-error');
            const passwordValid = validateField(document.getElementById('password'), /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/, 'Please enter password.', 'password-error');

            return emailValid && passwordValid;
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
                    validateField(inputElement, /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, 'Invalid email address.', 'username-error');
                    break;
                case 'pass':
                    validateField(inputElement, /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/, ' Please ensure it contains at least one special character, one uppercase letter, one number, and is at least 6 characters long.', 'password-error');
                    break;
                default:
                    break;
            }
        });
    });
    
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