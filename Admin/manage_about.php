<?php
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted
    
    // Validate and sanitize the input
    $about_id = 1; // Assuming the about_id is 1
    $about_desc = $_POST['about_desc']; // Assuming you're using POST method
    
    // Perform any additional validation if needed
    
    // Check if the about_desc contains more than 1500 words
    $wordCount = str_word_count($about_desc);
    if ($wordCount > 1500) {
        // Display error message
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            console.log("Error message should be displayed.");
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "About description should not exceed 1500 words.",
                width: 350,
                height: 60,
            });
        </script>
        <?php
    } else {
        // Update query
        $sql = "UPDATE tbl_about SET about_desc = '$about_desc' WHERE about_id = $about_id";
        
        if (mysqli_query($conn, $sql)) {
            // Query executed successfully
            ?>
            <!DOCTYPE html>
                    <html lang="en">
                    <head>
                      
                      
                      <title>About updated</title>
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    </head>
                    <body>
                      
                    </body>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                console.log("Success message should be displayed.");
                Swal.fire({
                    icon: "success",
                    title: "Updated",
                    text: "About section updated successfully",
                    width: 350,
                    height: 60,
                });
            </script>
            </html>
            <?php
        } else {
            // Query execution failed
            echo "Error updating About Description: " . mysqli_error($conn);
        }
    }
    
}
// Close the database connection
mysqli_close($conn);
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
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
   
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
        </a>
       
        <div class="navbar-nav w-100">
            <a href="admin.php" class="nav-item nav-link  text-white"><i class="fa fa-home"></i> Home</a>
            <a href="manage_car.php" class="nav-item nav-link text-white"><i class="fas fa-car"></i> Manage Cars</a>
            <a href="manage_car_category.php" class="nav-item nav-link text-white"><i class="fa fa-list-alt"></i> Car Categories</a>
            <a href="manage_locations.php" class="nav-item nav-link text-white"><i class="fa fa-map-marker"></i> Locations</a>
           
            <a href="manage_user.php" class="nav-item nav-link text-white"><i class="fas fa-user-alt"></i> Users</a>
            <a href="driver.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Drivers</a>
            <a href="manage_rentals.php" class="nav-item nav-link text-white"><i class="fas fa-car-side"></i> Rentals</a>
            <a href="manage_documents.php" class="nav-item nav-link text-white"><i class="fas fa-file-alt"></i> Documents</a>
            <a href="manage_payments.php" class="nav-item nav-link  text-white"><i class="fas fa-credit-card"></i> Payments</a>
            <a href="manage_review.php" class="nav-item nav-link text-white"><i class="fa fa-tachometer-alt me-2"></i> Reviews</a>
            <a href="manage_about.php" class="nav-item nav-link active text-white"><i class="fa fa-tachometer-alt me-2"></i> About</a>

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
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
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
                <h6 class="mb-4">Update About Description</h6>
                <form id="updateAboutForm" method="post" onsubmit="return validateForm()">
                    
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <textarea class="form-control" id="about_desc" name="about_desc" rows="4" cols="7" oninput="checkLength()"></textarea>
                        </div>
                        <div id="about_descError" class="text-danger error-message" style="font-size: 10px; color: red;"></div>
                    </div>
                    
                    <button type="submit" name="password_sbout" value="Update About" class="btn btn-primary m-2">Update About</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function validateForm() {
    var aboutDesc = document.getElementById("about_desc").value.trim();
    var aboutDescError = document.getElementById("about_descError");
    var maxLength = 1500;

    // Check if about_desc is empty
    if (aboutDesc === "") {
        aboutDescError.textContent = "About Description cannot be empty";
        return false; // Prevent form submission
    } else if (aboutDesc.length > maxLength) {
        aboutDescError.textContent = "Maximum " + maxLength + " characters allowed.";
        return false; // Prevent form submission
    } else {
        aboutDescError.textContent = ""; // Clear error message
        return true; // Allow form submission
    }
}
</script>




        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

<!-- <div class="row mb-3">
                        <label for="oldpassword" class="col-sm-2 col-form-label white-label">Image</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="file" class="form-control" name="oldpassword" id="oldpassword">
                               
                            </div>
                            <div id="oldpasswordError" class="text-danger error-message" style="font-size: 10px; color: red;"></div>
                        </div>
                    </div>   -->

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