<?php
include "connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
// Check if the form is submitted
if (isset($_POST["submit_reg"])) {

    // Include your database connection file
    include "connect.php";

    // Function to sanitize and validate input data
    function sanitize_input($data)
    {
        // Remove whitespace and strip tags
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Get form data and sanitize
    $fname = sanitize_input($_POST["fname"]);
    $lname = sanitize_input($_POST["lname"]);
    $email = sanitize_input($_POST["email"]);
    $phone = sanitize_input($_POST["phone"]);
    $address = sanitize_input($_POST["address"]);
    $location = sanitize_input($_POST["location"]);

    // Check if all required fields are filled
    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($phone) && !empty($address) && !empty($location)) {

        // Check if image files are uploaded
        if (isset($_FILES["profile_image"]["tmp_name"]) && isset($_FILES["license_front"]["tmp_name"]) && isset($_FILES["license_back"]["tmp_name"])) {

            // Define the directory where images will be saved
            $upload_dir = "driver_docs/";

            // Generate unique filenames for uploaded images
            $profile_image_name = uniqid("profile_") . "_" . $_FILES["profile_image"]["name"];
            $license_front_name = uniqid("license_front_") . "_" . $_FILES["license_front"]["name"];
            $license_back_name = uniqid("license_back_") . "_" . $_FILES["license_back"]["name"];

            // Move uploaded images to the specified directory
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $upload_dir . $profile_image_name) &&
                move_uploaded_file($_FILES["license_front"]["tmp_name"], $upload_dir . $license_front_name) &&
                move_uploaded_file($_FILES["license_back"]["tmp_name"], $upload_dir . $license_back_name)) {

                // Insert data into the database with the filenames
                $sql = "INSERT INTO tbl_driver ( image, fname, lname, email, phone, address, loc_id, liscence_front, liscence_back, status) 
                        VALUES ( '$profile_image_name', '$fname', '$lname', '$email', $phone, '$address', $location, '$license_front_name', '$license_back_name', 'Pending')";

                if ($conn->query($sql) === TRUE) {
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
                        $mail->addAddress($email); // Add a recipient, using the email from the form
                
                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Driver Application Pending Approval';
                        $mail->Body = '
                        <div style="max-width: 600px; margin: 0 auto; background-color: #f8f8f8; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
                            <h2 style="text-align: left;">
                                <span style="color: #00cc00;">Ace</span>
                                <span style="color: #007bff;">Car Rentals</span>
                            </h2>
                            <h2 style="color: #007bff; text-align: center;">Driver Application Pending Approval</h2>
                        
                            <p style="font-size: 16px;">Hello,</p>
                        
                            <p style="font-size: 16px;">We appreciate your interest in joining Ace Car Rentals as a driver. Your application is currently in the process of being reviewed by our admin team. This process typically takes a short amount of time, and we assure you that we are working diligently to evaluate your application.</p>
                        
                            <p style="font-size: 16px;">Rest assured, we will notify you promptly once a decision has been made regarding your application status. If you have any urgent inquiries or need assistance, feel free to reach out to our support team.</p>
                        
                            <p style="margin-top: 20px; font-size: 14px; color: #777; text-align: center;">This is an automated message, please do not reply.</p>
                        </div>';
                        
                    
                
                    
                        $mail->send();
                       
                    } catch (Exception $e) {
                        if($result1->num_rows > 0){
                         
                        }
                      }
                    // SweetAlert to show success message
                    ?>
                    <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Login success</title>
              <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
              
            </body>
            <script>

                        Swal.fire({
                            icon: "success",
                            title: "Application Submitted successfully",
                            text: "Wait for the approval of admin",
                            width: 350,
                            height: 60,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "index.php"; // Redirect to dashboard after success
                            }
                        });
                    </script>
            </html>
                    <?php
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                // Handle file upload errors
                echo "Error uploading files.";
            }
        } else {
            // Handle missing file upload
            echo "Please upload all required files.";
        }
    } else {
        // Handle missing form fields
        echo "Please fill all required fields.";
    }
}
?>
 


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Driver Registration</title>
    <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

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
<style>
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
        background-attachment: fixed;
        /* Add this line */
    }

    .container-registration-form {
        margin-top: 100px;
        /* Adjust the value as needed */
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

    .container-registration-form .form-control {
        width: calc(100% - 25px);
        /* Adjust as needed */
    }



    #profile_image_input {
        display: none;
    }

    container {
        text-align: center;
        /* Center align the container */
    }

    .custom-file-label {
        cursor: pointer;
    }

    .form-group label {
        color: black;
        /* Set label color to black */
    }

    .error-message {
        color: red;
        font-size: 11px;
    }
</style>

<body>

    <?php include "navbar.php"; ?>
    <!-- END nav -->


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="container-registration-form"
                    style="background-color: rgb(234, 240, 247); padding: 30px; border-radius: 10px;">
                    <h3 class="text-center mb-4"><b>Driver Registration Form</b></h3>
                    <br>
                    <form action="#" method="post" enctype="multipart/form-data" onsubmit="return check_error()">
                        <div class="form-group">
                            <label for="profile_image" style="font-size: 14px;">Profile Image:<span
                                    style="color:red;">*</span></label>

                            <input type="file" id="profile_image" name="profile_image" class="form-control-file mb-3"
                                accept="image/jpeg, image/png" style="font-size: 14px;">


                            <span id="profile_image_error" class="error-message"></span>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label for="fname" style="font-size: 14px;">First Name:<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    style="font-size: 14px;">
                                <span id="fname_error" class="error-message"></span>
                            </div>
                            <div class="col">
                                <label for="lname" style="font-size: 14px;">Last Name:<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    style="font-size: 14px;">
                                <span id="lname_error" class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
    <label for="email" style="font-size: 14px;">Email:<span style="color:red;">*</span></label>
    <input type="email" id="email" name="email" class="form-control mb-3" style="font-size: 14px;"
        oninput="validateEmail1()" onblur="validateEmail1()">
    <span id="email_error" class="error-message"></span>
    <div id="email-error1" class="error-message"></div>
    <div id="email-error2" class="error-message"></div>
</div>


                        <div class="form-group">
                            <label for="phone" style="font-size: 14px;">Phone:<span style="color:red;">*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control mb-3"
                                style="font-size: 14px;">
                            <span id="phone_error" class="error-message"></span>
                        </div>

                        
                            <div class="form-group">
                                <label for="district" style="font-size: 14px;">Location:<span style="color:red;">*</span>Make sure that you are from this location</label>
                                <?php
                                include "connect.php";
                                                 $sql5 = "SELECT * FROM tbl_location;";
                                                 $result5 = $conn->query($sql5);
                                                 if ($result5->num_rows > 0) {
                                                    ?>
                                <select id="district" name="location" class="form-control mb-3" style="font-size: 14px;">
                                    <option value="" >Select Location</option>
                                    <?php
                                     while ($row5 = $result5->fetch_assoc()) {
                                                   
                                        echo '<option value="' . $row5['loc_id'] . '" style="color: black;font-size: 14px;">' . $row5['loc_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <?php
                                } else {
                                    echo '<p>No Locations.</p>';
                                     }
                                ?>
                                <span id="district_error" class="error-message"></span>
                            </div>
                   


                        <div class="form-group">
                            <label for="address" style="font-size: 14px;">Address:<span
                                    style="color:red;">*</span></label>
                            <textarea id="address" name="address" class="form-control mb-3" rows="4"
                                style="font-size: 14px;"></textarea>
                            <span id="address_error" class="error-message"></span>
                        </div>



                        <div class="form-group row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="license_front" style="font-size: 14px;">Upload Front Photo of Your
                                        License:<span style="color:red;">*</span></label>
                                    <input type="file" id="license_front" name="license_front"
                                        class="form-control-file mb-3" accept="image/jpeg, image/png"
                                        style="font-size: 14px;">
                                    <small class="form-text text-muted" style="font-size: 10px;">Please upload a clear
                                        photo of the front side of
                                        your
                                        license.</small>
                                    <span id="license_front_error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="license_back" style="font-size: 14px;">Upload Back Photo of Your
                                        License:<span style="color:red;">*</span></label>
                                    <input type="file" id="license_back" name="license_back"
                                        class="form-control-file mb-3" accept="image/jpeg, image/png"
                                        style="font-size: 14px;">
                                    <small class="form-text text-muted" style="font-size: 10px;">Please upload a clear
                                        photo of the back side of
                                        your
                                        license.</small>
                                    <span id="license_back_error" class="error-message"></span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" name="submit_reg">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>

    </div>






    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector('form');

            function validateForm() {
                const fnameValid = validateField(document.getElementById('fname'), /^[a-zA-Z]+$/, 'Firstname cant be empty & cannot contain spaces.', 'fname_error');

                const lnameValid = validateField(document.getElementById('lname'), /^[a-zA-Z]+(?:\s[a-zA-Z]+)?$/, 'Last name cannot be empty.', 'lname_error');
                const emailValid = validateField(document.getElementById('email'), /^\w{3,}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, 'Invalid email address.', 'email_error');
                const phoneValid = validatePhoneNumber(document.getElementById('phone'));
                const addressValid = validateField(document.getElementById('address'), /\S+/, 'Address cannot be empty.', 'address_error');

                const districtValid = validateField(document.getElementById('district'), /\S+/, 'Please select a district.', 'district_error');
                const profileImageValid = validateFile(document.getElementById('profile_image'), ['jpg', 'jpeg', 'png'], 'Profile image is required and must be in JPG or PNG format.', 'profile_image_error');
                const licenseFrontValid = validateFile(document.getElementById('license_front'), ['jpg', 'jpeg', 'png'], 'Front photo of the license is required and must be in JPG or PNG format.', 'license_front_error');
                const licenseBackValid = validateFile(document.getElementById('license_back'), ['jpg', 'jpeg', 'png'], 'Back photo of the license is required and must be in JPG or PNG format.', 'license_back_error');
                
                return fnameValid && lnameValid && emailValid && phoneValid && addressValid &&  districtValid && profileImageValid && licenseFrontValid && licenseBackValid;
            
                

   
            }

            function validateField(inputElement, regex, errorMessage, errorId) {
                const value = inputElement.value.trim();
                const errorElement = document.getElementById(errorId);
                if (!regex.test(value)) {
                    errorElement.innerText = errorMessage;
                    return false;
                } else {
                    errorElement.innerText = "";
                    return true;
                }
            }

            function validateFile(fileElement, allowedExtensions, errorMessage, errorId) {
                const file = fileElement.files[0];
                const errorElement = document.getElementById(errorId);
                if (!file) {
                    errorElement.innerText = errorMessage;
                    return false;
                } else {
                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    if (!allowedExtensions.includes(fileExtension)) {
                        errorElement.innerText = errorMessage;
                        return false;
                    } else {
                        errorElement.innerText = "";
                        return true;
                    }
                }
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
                        validateField(inputElement, /^[a-zA-Z]+$/, `${inputElement.name.charAt(0).toUpperCase() + inputElement.name.slice(1)} must contain only letters.`, `${inputElement.name}_error`);
                        break;
                    case 'lname':
                        validateField(inputElement, /^[a-zA-Z\s]+$/, `${inputElement.name.charAt(0).toUpperCase() + inputElement.name.slice(1)} must contain only letters.`, `${inputElement.name}_error`);


                        break;
                    case 'address':
                        validateField(inputElement, /\S+/, `${inputElement.name.charAt(0).toUpperCase() + inputElement.name.slice(1)} cannot be empty.`, `${inputElement.name}_error`);
                        break;
                    case 'email':
                        var email = document.getElementById("email").value;
                        var errorElement = document.getElementById("email_error");

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
                        break;
                    case 'phone':
                        validatePhoneNumber(inputElement);
                        break;

                    case 'district':
                        validateField(inputElement, /\S+/, 'Please select a district.', 'district_error');
                        break;
                    // Add cases for other input fields if needed
                }
            });
        });
    </script>

    <script>
        function validatePhoneNumber(inputElement) {
            const phoneNumber = inputElement.value;
            const erPhoneNumber = document.getElementById('phone_error');

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

        function validateEmail1() {
    var email = document.getElementById('email').value;
    var errorMessage = document.getElementById('email-error1');
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            errorMessage.innerHTML = response;
            
            // Check if there's an error message
            if (response.trim() === '') {
                // No error message, allow form submission
                document.getElementById('submit_button').disabled = false;
            } else {
                // Error message exists, prevent form submission
                document.getElementById('submit_button').disabled = true;
            }
        }
    };

    xhr.open('GET', 'check_driver_email.php?email=' + email, true);
    xhr.send();

    
        var errorMessage2 = document.getElementById('email-error2');
        var xhrr = new XMLHttpRequest();

        xhrr.onreadystatechange = function () {
            if (xhrr.readyState == 4 && xhrr.status == 200) {
                var responsee = xhrr.responseText;
                errorMessage2.innerHTML = responsee;
            }
        };

        xhrr.open('GET', 'check_driver_login_email.php?email=' + email, true);
        xhrr.send();
}


 function check_error() {

 var errorElements = document.querySelectorAll('.error-message');
 for (var i = 0; i < errorElements.length; i++) {
  if (errorElements[i].innerText !== '') {
    // If any error message exists, prevent form submission
    return false;
  }
 }
      return true;
 }


    </script>


</body>

</html>