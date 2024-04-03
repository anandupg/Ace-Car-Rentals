<?php

include "../connect.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['login_id'])){
    header("Location:../logout.php");
   exit();
}
if($_SESSION['type_id']!=1){
    header("Location:../logout.php");
   exit();
}
$_SESSION['type_id'];
if(isset($_POST['password_update'])) {
  $loginId = $_SESSION['login_id']; // Example login_id to update password
  $oldPassword = $_POST['oldpassword']; // Example old password
  $newPassword = $_POST['newpassword']; // Example new password

 // Assuming $conn is your database connection object

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
window.location.replace("admin_profile.php");
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
window.location.replace("admin_profile.php");
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
    <meta charset="utf-8">
    <title>Ace Car Rentals</title>
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   
    <style>
        /* Add this CSS to make the input fields half the size */
.half-size-input {
    width: 50%;
}
/* Add this CSS to make the labels white */
.white-label {
    color: white;
}

.eye-icon {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
        }
        .eye-toggle {
      padding-left: 10px;
      right: 10px;
      cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="" class="navbar-brand mx-4 mb-3">
                <h4 class="text-white"><i></i><br>Ace Car Rentals</h4>              
                
                <div class="navbar-nav w-100">
                    <a href="admin.php" class="nav-item nav-link  text-white"><i class="fa fa-home"></i> Home</a>
                    <a href="manage_car.php" class="nav-item nav-link text-white"><i class="fas fa-car"></i> Manage
                        Cars</a>
                    <a href="manage_car_category.php" class="nav-item nav-link text-white"><i
                            class="fa fa-list-alt"></i> Car Categories</a>
                    <a href="manage_locations.php" class="nav-item nav-link text-white"><i class="fa fa-map-marker"></i>
                        Locations</a>
                       
                    <a href="manage_user.php" class="nav-item nav-link text-white"><i class="fas fa-user-alt"></i>
                        Users</a>
                        <a href="driver.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Drivers</a>
                    <a href="manage_rentals.php" class="nav-item nav-link text-white"><i class="fas fa-car-side"></i>
                        Rentals</a>
                    <a href="manage_documents.php" class="nav-item nav-link text-white"><i class="fas fa-file-alt"></i>
                        Documents</a>
                    <a href="manage_payments.php" class="nav-item nav-link text-white"><i
                            class="fas fa-credit-card"></i> Payments</a>
                    <a href="manage_review.php" class="nav-item nav-link text-white"><i
                            class="fa fa-tachometer-alt me-2"></i> Reviews</a>
                            <a href="manage_about.php" class="nav-item nav-link text-white"><i class="fa fa-tachometer-alt me-2"></i> About</a>
                </div>
            </nav>
        </div>

        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0 text-white">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="admin_profile.php" class="dropdown-item">My Profile</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            

           
            <div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">Update Password</h6>
                <form id="updatePasswordForm" method="post">
                    <div class="row mb-3">
                        <label for="oldpassword" class="col-sm-2 col-form-label white-label">Old Password</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="password" class="form-control" name="oldpassword" id="oldpassword">
                                <div class="input-group-append">
                                    <span class="input-group-text eye-toggle" onclick="togglePasswordVisibility('oldpassword')">
                                        <i id="eye-icon-oldpassword" class="far fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="oldpasswordError" class="text-danger error-message" style="font-size: 10px; color: red;"></div>
                        </div>
                    </div>  
                    <div class="row mb-3">
                        <label for="newpassword" class="col-sm-2 col-form-label white-label">New Password</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="password" class="form-control" id="newpassword" name="newpassword">
                                <div class="input-group-append">
                                    <span class="input-group-text eye-toggle" onclick="togglePasswordVisibility('newpassword')">
                                        <i id="eye-icon-newpassword" class="far fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="newpasswordError" class="text-danger error-message" style="font-size: 10px; color: red;"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="confirmpassword" class="col-sm-2 col-form-label white-label">Confirm Password</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                                <div class="input-group-append">
                                    <span class="input-group-text eye-toggle" onclick="togglePasswordVisibility('confirmpassword')">
                                        <i id="eye-icon-confirmpassword" class="far fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="confirmpasswordError" class="text-danger error-message" style="font-size: 10px; color: red;"></div>
                        </div>
                    </div>
                    
                    <button type="submit" name="password_update" value="Update Password" class="btn btn-primary m-2">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>




    document.addEventListener('DOMContentLoaded', function () {
        const oldPasswordInput = document.getElementById('oldpassword');
        const newPasswordInput = document.getElementById('newpassword');
        const confirmPasswordInput = document.getElementById('confirmpassword');
        const oldPasswordError = document.getElementById('oldpasswordError');
        const newPasswordError = document.getElementById('newpasswordError');
        const confirmPasswordError = document.getElementById('confirmpasswordError');
        const updatePasswordForm = document.getElementById('updatePasswordForm'); // Updated form id


        // Function to validate the old password
        function validateOldPassword() {
            // Add your validation logic here
            // For example, check if the old password meets certain criteria
            const oldPassword = oldPasswordInput.value.trim();
            if (oldPassword.length < 8) {
                oldPasswordError.textContent = 'Old Password must be at least 8 characters';
                return false;
            } else {
                oldPasswordError.textContent = '';
                return true;
            }
        }

        // Function to validate the new password
        function validateNewPassword() {
            // Add your validation logic here
            // For example, check if the new password meets certain criteria
            const newPassword = newPasswordInput.value.trim();
            if (newPassword.length < 8) {
                newPasswordError.textContent = 'New Password must be at least 8 characters';
                return false;
            } else {
                newPasswordError.textContent = '';
                return true;
            }
        }

        // Function to validate the confirmation password
        function validateConfirmPassword() {
            // Add your validation logic here
            // For example, check if the confirmation password matches the new password
            const confirmPassword = confirmPasswordInput.value.trim();
            const newPassword = newPasswordInput.value.trim();
            if (confirmPassword !== newPassword) {
                confirmPasswordError.textContent = 'Passwords do not match';
                return false;
            } else {
                confirmPasswordError.textContent = '';
                return true;
            }
        }

        // Function to handle form submission
        function handleSubmit(event) {
            // Perform additional validation if needed
            if (!validateOldPassword() || !validateNewPassword() || !validateConfirmPassword()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
            // You can add additional logic for form submission here
        }

        // Attach live validation to input events
        oldPasswordInput.addEventListener('input', validateOldPassword);
        newPasswordInput.addEventListener('input', validateNewPassword);
        confirmPasswordInput.addEventListener('input', validateConfirmPassword);

        // Attach submit validation to form submission
        updatePasswordForm.addEventListener('submit', handleSubmit);
    });

   
   

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




            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

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