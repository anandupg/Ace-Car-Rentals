<?php
include "connect.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['login_id'])) {
    $login_id = $_SESSION['login_id'];

    $sql = "SELECT * FROM tbl_registration where login_id='$login_id';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['profile_update'])) {
    // Check if a file was uploaded
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $target_dir = "profile_images/";
        $target_file = $target_dir . basename($image_name);

        // Move the uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // File uploaded successfully, continue with the update
        } else {
            // Handle file upload error
            echo "Sorry, there was an error uploading your file.";
            exit(); // Terminate script
        }
    } else {
        // No new image uploaded, retain the existing image
        $image_name = $row['image'];
    }

    // Update profile information in the database
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];

    $sql_update = "UPDATE tbl_registration SET fname='$fname',lname='$lname',phone='$phone',image='$image_name' WHERE login_id='$login_id';";

    // Execute the update query
    if ($conn->query($sql_update) === TRUE) {
      
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}



// Assuming you have established a database connection

// Function to verify old password and update password by login_id  
if(isset($_POST['password_update'])) {
  $loginId = $_SESSION['login_id']; // Example login_id to update password
  $oldPassword = $_POST['old_password']; // Example old password
  $newPassword = $_POST['new_password']; // Example new password

  global $conn; // Assuming $conn is your database connection object

  // Hash the old and new passwords using MD5
  $oldPasswordHash = md5($oldPassword);
  $newPasswordHash = md5($newPassword);

  // Check if the old password is correct
  $query = "SELECT pass FROM tbl_login WHERE login_id = '$loginId'";
  $result = $conn->query($query);
  
  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $storedPassword = $row['pass'];

      // Verify old password
      if ($oldPasswordHash !== $storedPassword) {
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
      title: "Incorrect Old Password",
      text: "Enter your correct old password",
      width : 350,
      height : 60,
    }).then((result) => {
// Check if the user clicked "OK"
if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
window.location.replace("account.php");
}
});
    
        </script>
        </html>
        <?php
exit; 
      }

      // Prepare the update query with prepared statements to prevent SQL injection
      $stmt = $conn->prepare("UPDATE tbl_login SET pass = ? WHERE login_id = ?");
      $stmt->bind_param("ss", $newPasswordHash, $loginId);
      $stmt->execute();

      // Check if update was successful
      if ($stmt->affected_rows == 1) {
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
      icon: "success",
      title: "Password Updated",
      width : 350,
      height : 60,
    }).then((result) => {
// Check if the user clicked "OK"
if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
window.location.replace("account.php");
}
});
    
        </script>
        </html>
        <?php
      } else {
        
      }
  } else {
      return "User not found.";
  }
}


// Usage example

// Call the function to update password
?>








<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ace car rentals</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* Add this to your existing CSS file or create a new one */ 

    /* Style for the user profile section */
    .ftco-section.bg-light {
      padding: 50px 0;
    }

    /* Style for the user profile image */
    .img-fluid.rounded-circle {
      width: 200px;
      height: 200px;
      object-fit: cover;
    }

    /* Style for the user profile information */
    .col-md-8 {
      text-align: left;
    }

    /* Style for the Edit Profile button */
    .btn-primary {
      margin-top: 10px;
    }

    /* Style for the dropdown container */
    .dropdown-container {
      display: none;
    }

    /* Style for the form input boxes */
    /* Style for the form input boxes */
    .form-control {
      border: 1px solid #ced4da;
      border-radius: 0;
      width: 250px;
      /* Adjust the width as needed */
    }

    /* Style for the form input boxes when focused */
    .form-control:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Style for the form button */
    .btn-primary {
      border-radius: 0;
    }

    /* CSS for animating the dropdown */
    @keyframes slideDown {
      0% {
        opacity: 0;
        transform: translateY(-20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .dropdown-container {
      display: none;
      animation: slideDown 1s ease forwards;
      /* Apply animation to the dropdown */
    }

    .animated {
      transition: opacity 0.3s ease;
    }



    .dropdown-container.animated {
      opacity: 0;
    }

    .dropdown-container {
      opacity: 0;
      transition: opacity 0.3s ease;
      /* Add a transition for opacity */
    }

    .error-message {
      color: red;
      font-size: 10px;
    }

    .form-group {
      display: flex;
      align-items: center;
      position: relative;
    }

    .eye-toggle {
      padding-left: 10px;
      right: 10px;
      cursor: pointer;
    }

    .form-control {
      padding-right: 1px; /* Adjust this value according to the eye icon size */
    }

    .animated {
      animation-duration: 0.3s;
    }
    .fadeIn {
      animation-name: fadeIn;
    }
    .fadeOut {
      animation-name: fadeOut;
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    @keyframes fadeOut {
      from {
        opacity: 1;
      }
      to {
        opacity: 0;
      }
    }
  </style>

</head>

<body>

  <?php include "navbar.php"; ?>

  <section class="" style="background-image: url('bg_img2.jpg'); height: 100px;">
  </section>

  <?php

include "connect.php";

// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php"); // Change 'login.php' to your actual login page
    exit(); // Terminate script
}

$login_id = $_SESSION['login_id'];

// Fetch user information from the database
$sql = "SELECT * FROM tbl_registration WHERE login_id='$login_id';";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
} else {
    // Handle database error
    echo "Error fetching user information: " . $conn->error;
    exit(); // Terminate script
}
?>

  <hr>

  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <!-- User Profile Image -->
          <?php if (!empty($row['image'])): ?>
           <?php $user_image = "profile_images/" . $row['image'];?>


          <img src="<?php  echo $user_image ?>" class="img-fluid rounded-circle"
            alt="User Profile Image" style="cursor: pointer;" onclick="showEnlargedImage('<?php echo $user_image; ?>');">
          <?php else: ?>
          <img src="whitebg_user.png" class="img-fluid rounded-circle" alt="Default User Profile Image" style="cursor: pointer;" onclick="showEnlargedImage('<?php echo $user_image; ?>');" >
          <?php endif; ?>
        </div>
        <div class="col-md-8">
          <!-- User Profile Information -->
          <h2>Name:
            <?php echo $row['fname'] . ' ' . $row['lname']; ?>
          </h2>
          <p>Email:
            <?php echo $row['email']; ?>
          </p>
          <p>DOB:
            <?php echo $row['dob']; ?>
          </p>
          <p>Phone:
            <?php echo $row['phone']; ?>
          </p>
          <button class="btn btn-primary" onclick="toggleDropdown('dropdown-container')">Edit Profile</button>
          <button class="btn btn-primary" onclick="toggleDropdown('dropdown-container1')">Edit Password</button>
          <!-- Edit Profile Button -->
          <!-- Dropdown Container -->
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="dropdown-container" id="dropdown-container">
            <form name="profileForm" action="#" method="post" enctype="multipart/form-data"
              onsubmit="return validateForm()">
              <div class="form-group row">
              <label for="image" class="col-sm-4 col-form-label">Profile Image:</label>
<div class="col-sm-8">
  <input type="file" class="form-control-file" name="image" id="image" onchange="validateImageType(this)">
  <span id="imageError" class="error-message"></span>
</div>
              </div>
              <!-- Optional: Image preview section -->
              <div class="form-group row">
                <div class="col-sm-4"></div> <!-- Empty column for alignment -->
                <div class="col-sm-8">
    <?php if(isset($row['image']) && !empty($row['image'])): ?>
        <img id="image_preview" src="profile_images/<?php echo $row['image']; ?>" alt="Preview" style="max-width: 100px; max-height: 100px; cursor: pointer;"  onclick="showEnlargedImage('<?php echo $user_image; ?>');">
    <?php endif; ?>
</div>
              </div>
              <div class="form-group row">
                <label for="fname" class="col-sm-4 col-form-label">First Name:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="fname" id="fname"
                    value="<?php echo htmlspecialchars($row['fname']); ?>" placeholder="First name"
                    style="font-size: 15px; color: #000;">
                  <span id="fnameError" class="error-message"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="lname" class="col-sm-4 col-form-label">Last Name:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="lname" id="lname"
                    value="<?php echo htmlspecialchars($row['lname']); ?>" placeholder="Last name"
                    style="font-size: 15px; color: #000;">
                  <span id="lnameError" class="error-message"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-sm-4 col-form-label">Phone:</label>
                <div class="col-sm-8">
                  <input type="tel" class="form-control" name="phone" id="phone"
                    value="<?php echo htmlspecialchars($row['phone']); ?>" placeholder="Phone"
                    style="font-size: 15px; color: #000;">
                  <span id="phoneError" class="error-message"></span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4"></div> <!-- Empty column for alignment -->
                <div class="col-sm-8">
                  <input type="submit" class="btn btn-primary" value="Update Profile" name="profile_update">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
    <div class="dropdown-container" id="dropdown-container1">
      <form action="#" method="post" id="password_change_form" onsubmit="return check_error()">
      <div class="form-group row">
    <label for="old_password" class="col-sm-4 col-form-label">Old Password:</label>
    <div class="col-sm-8">
        <div class="input-group">
            <input type="password" class="form-control" name="old_password" id="old_password"
                placeholder="Old Password" style="font-size: 15px; color: #000;">
            <div class="input-group-append">
                <span class="input-group-text eye-toggle" onclick="togglePasswordVisibility('old_password')">
                    <i id="eye-icon-old_password" class="far fa-eye-slash"></i>
                </span>
            </div>
        </div> 
        <span id="oldPasswordError" class="error-message "></span>
    </div>
</div>

<div class="form-group row">
    <label for="new_password" class="col-sm-4 col-form-label">New Password:</label>
    <div class="col-sm-8">
        <div class="input-group">
            <input type="password" class="form-control" name="new_password" id="new_password"
                placeholder="New Password" style="font-size: 15px; color: #000;">
            <div class="input-group-append">
                <span class="input-group-text eye-toggle" onclick="togglePasswordVisibility('new_password')">
                    <i id="eye-icon-new_password" class="far fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <span id="newPasswordError" class="error-message"></span>
    </div>
</div>

<div class="form-group row">
    <label for="confirm_password" class="col-sm-4 col-form-label">Confirm New Password:</label>
    <div class="col-sm-8">
        <div class="input-group">
            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                placeholder="Confirm New Password" style="font-size: 15px; color: #000;">
            <div class="input-group-append">
                <span class="input-group-text eye-toggle" onclick="togglePasswordVisibility('confirm_password')">
                    <i id="eye-icon-confirm_password" class="far fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <span id="confirmPasswordError" class="error-message"></span>
    </div>
</div>
<!-- <div class="form-group row">
<div class="col-sm-8 offset-sm-4"> 
<a href="forgot_password.php">Forgot Password?</a>
    </div>
    </div> -->
<div class="form-group row">
    <div class="col-sm-8 offset-sm-4"> <!-- Use offset-sm-4 to align the button with the text box -->
        <input type="submit" class="btn btn-primary" name="password_update" value="Password Update">
    </div>
</div>
      </form>
    </div>
  </div>
  
      </div>
    </div>
  </section>

  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body d-flex justify-content-center align-items-center">
        <img id="enlargedImage" src="" alt="Enlarged Image" class="img-fluid">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // AJAX request to check old password
    $("#old_password").on('input', function(){
        var oldPassword = $(this).val();
        $.ajax({
            url: 'check_old_password.php', // Replace 'check_old_password.php' with the actual path to your server-side script
            method: 'POST',
            data: {oldpassword: oldPassword},
            success: function(response){
                if(response.trim() === 'match'){
                    $("#oldPasswordError").text("Password is Correct");
                } else {
                    $("#oldPasswordError").text("Password does not match the one in the database.");
                    return false;
                }
            },
            error: function(){
                $("#oldPasswordError").text("An error occurred while processing your request.");
            }
        });
    });

    // Form submission validation
    $('form').submit(function(event){
        var newPassword = $('#new_password').val();
        var confirmPassword = $('#confirm_password').val();

        // Check if new password and confirm password match
        if (newPassword !== confirmPassword) {
            $('#confirmPasswordError').text("Passwords do not match.");
            event.preventDefault(); // Prevent form submission
        }
    });

    // Live validation for confirm password
    $('#confirm_password').on('input', function(){
    var newPassword = $('#new_password').val();
    var confirmPassword = $(this).val();

    if (newPassword === confirmPassword) {
        $('#confirmPasswordError').text(""); // Clear error message
        return false; // Return false when passwords match
    } else {
        $('#confirmPasswordError').text("Passwords do not match.");
        return true; // Return true when passwords don't match
    }
});


    // Live validation for new password not being the same as old password
    $('#new_password').on('input', function(){
    var oldPassword = $('#old_password').val();
    var newPassword = $(this).val();

    if (newPassword === oldPassword) {
        $('#newPasswordError').text("New password cannot be the same as the old password.");
        return false;
    } else {
        $('#newPasswordError').text(""); // Clear error message
    }
    return true; // Return true if the passwords don't match
});

});


$(document).ready(function(){
    // Function to check if a string contains at least one uppercase letter
    function containsUpperCase(str) {
        return /[A-Z]/.test(str);
    }

    // Function to check if a string contains at least one number
    function containsNumber(str) {
        return /\d/.test(str);
    }

    // Function to check if a string contains at least one special character
    function containsSpecialChar(str) {
        return /[!@#$%^&*(),.?":{}|<>]/.test(str);
    }

    // AJAX request to check old password (Add your AJAX request code here)

    // Form submission validation
    $('#password_change_form').submit(function(event){
        var oldPassword = $('#old_password').val();
        var newPassword = $('#new_password').val();
        var confirmPassword = $('#confirm_password').val();
        var submitForm = true; // Flag to track form submission

        // Check if old password is empty
        if (!oldPassword.trim()) {
            $('#oldPasswordError').text("Please enter your old password.");
            submitForm = false;
        } else {
            $('#oldPasswordError').text("");
        }

        // Check if new password is empty
        if (!newPassword.trim()) {
            $('#newPasswordError').text("Please enter your new password.");
            submitForm = false;
        } else {
            $('#newPasswordError').text("");
        }

        // Check if confirm password is empty
        if (!confirmPassword.trim()) {
            $('#confirmPasswordError').text("Please confirm your new password.");
            submitForm = false;
        } else {
            $('#confirmPasswordError').text("");
        }

        // Check if new password and confirm password match
        if (newPassword !== confirmPassword) {
            $('#confirmPasswordError').text("Passwords do not match.");
            submitForm = false;
        }

        if (oldPassword === newPassword) {
            $('#newPasswordError').text("New password cannot be the same as the old password.");
            submitForm = false;
        }

        // Live validation for new password
        if (newPassword.length < 6 || !containsUpperCase(newPassword) || !containsNumber(newPassword) || !containsSpecialChar(newPassword)) {
            $('#newPasswordError').text("New password must be at least 6 characters long and contain at least one uppercase letter, one number, and one special character.");
            submitForm = false;
        }
        if (oldPassword.length < 6 || !containsUpperCase(oldPassword) || !containsNumber(oldPassword) || !containsSpecialChar(oldPassword)) {
            $('#oldPasswordError').text("Old password must be at least 6 characters long and contain at least one uppercase letter, one number, and one special character.");
            submitForm = false;
        }

        // Prevent form submission if any error occurs
        if (!submitForm) {
            event.preventDefault(); // Prevent form submission
        }
    });

   
});

</script>

<!-- <script>
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
</script> -->

<script>
  function showEnlargedImage(imageUrl) {
    var modal = document.getElementById('imageModal');
    var enlargedImage = document.getElementById('enlargedImage');
    enlargedImage.src = imageUrl;
    $('#imageModal').modal('show');
  }
</script>


  <script>
    function toggleDropdown(containerId) {
    var dropdownContainer = document.getElementById(containerId);

    if (dropdownContainer.style.display === "none" || dropdownContainer.style.display === "") {
        dropdownContainer.style.display = "block";
        dropdownContainer.classList.add("animated", "fadeIn"); // Add animation class for appearing
    } else {
        // Add animation class for disappearing
        dropdownContainer.classList.add("animated", "fadeOut");

        // Delay before hiding the dropdown to allow animation
        setTimeout(function () {
            dropdownContainer.style.display = "none";
            dropdownContainer.classList.remove("animated", "fadeOut"); // Remove disappearing animation class
        }, 300); // Adjust the delay time (in milliseconds) to match the duration of the animation
    }
}



    function validateForm() {
      var fname = document.forms["profileForm"]["fname"].value;
      var lname = document.forms["profileForm"]["lname"].value;
      var phone = document.forms["profileForm"]["phone"].value;
      var fnameError = document.getElementById("fnameError");
      var lnameError = document.getElementById("lnameError");
      var phoneError = document.getElementById("phoneError");

      fnameError.innerHTML = lnameError.innerHTML = phoneError.innerHTML = "";

      // Validate First Name
      if (fname == "") {
        fnameError.innerHTML = "First name is required";
        return false;
      } else if (!/^[a-zA-Z]+$/.test(fname)) {
        fnameError.innerHTML = "First name should contain only alphabets";
        return false;
      }

      // Validate Last Name
      if (lname == "") {
        lnameError.innerHTML = "Last name is required";
        return false;
      } else if (!/^[a-zA-Z\s]+$/.test(lname)) {
        lnameError.innerHTML = "Last name should contain only alphabets and spaces";
        return false;
      }

      // Validate Phone Number
      if (phone == "") {
        phoneError.innerHTML = "Phone is required";
        return false;
      } else if (!/^[6-9]\d{9}$/.test(phone)) {
        phoneError.innerHTML = "Phone number should start with 6, 7, 8, or 9 and be 10 digits long";
        return false;
      } else if (/(\d)\1{4}/.test(phone)) {
        phoneError.innerHTML = "Phone number should not repeat the same digit 5 times consecutively";
        return false;
      }

      return true;
    }

    function validateImageType(input) {
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    const errorMessageElement = document.getElementById('imageError');
    if (input.files.length > 0) {
        const file = input.files[0];
        if (!allowedTypes.includes(file.type)) {
            errorMessageElement.textContent = 'Please upload a JPEG, JPG, or PNG image.';
            input.value = ''; // Clear the file input
        } else {
            errorMessageElement.textContent = ''; // Clear the error message if image is valid
        }
    } else {
        errorMessageElement.textContent = ''; // Clear the error message if no file selected
    }
}

function togglePasswordVisibility(inputId) {
      var input = document.getElementById(inputId);
      var eyeIcon = document.getElementById('eye-icon-' + inputId); // Corrected selection of the eye icon
      
      if (input.type === "password") {
        input.type = "text";
        eyeIcon.className = "far fa-eye"; // Change eye icon to open
      } else {
        input.type = "password";
        eyeIcon.className = "far fa-eye-slash"; // Change eye icon to closed
      }
    }

   

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
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

</body>

</html>