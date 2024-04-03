<?php
include "../connect.php";
$sql = "SELECT * FROM tbl_registration ; ";
$result = $conn->query($sql);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
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
    <style>
        .btn-outline-danger:hover {
            background-color: red;
            border-color: red;
            color: white;
            /* Set text color to white or any color that suits your design */
        }

        .custom-table {
            font-size: 14px; /* Adjust the font size as needed */
        }
        .custom-btn {
            font-size: 12px; /* Adjust the font size as needed */
            padding: 6px 12px; /* Adjust the padding as needed */
        }

        .error-message {
            font-size: 10px;
            padding-top: 10px;
            color: red;
        }
        .form-control {
       
        background-color: black;
    }
    input.form-control:focus,
    input.form-control:active {
        background-color: black !important;
    }

    .form-control::placeholder {
        color: #6c7293;
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
        </a>
        <!-- <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">Admin</h6>
                <span class="text-white">Admin</span>
            </div>
        </div> -->
        <div class="navbar-nav w-100">
            <a href="admin.php" class="nav-item nav-link  text-white"><i class="fa fa-home"></i> Home</a>
            <a href="manage_car.php" class="nav-item nav-link text-white"><i class="fas fa-car"></i> Manage Cars</a>
            <a href="manage_car_category.php" class="nav-item nav-link text-white"><i class="fa fa-list-alt"></i> Car Categories</a>
            <a href="manage_locations.php" class="nav-item nav-link text-white"><i class="fa fa-map-marker"></i> Locations</a>
            
            <a href="manage_user.php" class="nav-item nav-link active text-white"><i class="fas fa-user-alt"></i> Users</a>
            <a href="driver.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Drivers</a>
            <a href="manage_rentals.php" class="nav-item nav-link text-white"><i class="fas fa-car-side"></i> Rentals</a>
            <a href="manage_documents.php" class="nav-item nav-link text-white"><i class="fas fa-file-alt"></i> Documents</a>
            <a href="manage_payments.php" class="nav-item nav-link text-white"><i class="fas fa-credit-card"></i> Payments</a>
            <a href="manage_review.php" class="nav-item nav-link text-white"><i class="fa fa-tachometer-alt me-2"></i> Reviews</a>
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
            <?php
$sql_pending = "SELECT r.*, l.status 
FROM tbl_registration r
INNER JOIN tbl_login l ON r.login_id = l.login_id
WHERE l.status = 'Active';";

$result_pending = $conn->query($sql_pending);
?>
<?php if ($result_pending && $result_pending->num_rows > 0): ?>
                        <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-secondary rounded p-4">
                    <form method="POST" action="" id="carDetailsForm">
                        <h6 class="mb-4">Active Users Table</h6>
                        <div class="table-responsive">
                            <table class="table table custom-table" style="color: white;">
                                <thead>
                                    <tr>
                                    <th scope="col">Profile</th>
                                        
                                       
                                        <th scope="col">SI No</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"> Actions</th>
                                        <td></td>
                                       

                                    </tr>
                                </thead>
                                <tbody>
                               
      
   
                                    <?php
                                   $sql = "SELECT r.*
                                   FROM tbl_registration r
                                   JOIN tbl_login l ON r.login_id = l.login_id
                                   WHERE l.status = 'Active';";
                           
                                    $result = $conn->query($sql);
                                    // Loop through the result set
                                    $sno=1;
                                    while ($row = $result->fetch_assoc()) {
                                        $image = "../profile_images/" . $row['image'];
                                        echo "<tr>";
                                        if (!empty($image) && file_exists($image)) {
                                            echo "<td><img src='" . $image . "' alt='No Profile' width='65px' height='65px' style='cursor:pointer;' class='rounded-circle' onclick=\"showEnlargedImage('" . $image . "');\"></td>";
                                        } else {
                                            // If there is no user photo or the image file doesn't exist, display the default image
                                            echo "<td><img src='642902-200.png' alt='Default Img' width='65px' height='65px'></td>";
                                        }
                                        // Output table data for each column
                                        
                                echo "<td>" . $sno++ . "</td>";
                                        echo "<td>" . $row['fname'] . "</td>";
                                        echo "<td>" . $row['lname'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['dob'] . "</td>";
                                        $sql1 = "SELECT status FROM tbl_login WHERE login_id='" . $row['login_id'] . "' AND type_id=2; ";
                                        $result1 = $conn->query($sql1);
                            
                                        while ($row1 = $result1->fetch_assoc()) {
                                        echo "<td>" . $row1['status'] . "</td>";
                                        
                                        echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";

                                        
                                        if ($row1['status'] == 'Active') {
                                            echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_user_sts.php?login_id={$row['login_id']}' onclick='return confirmDecline()'>Inactive</a></td>";
                                        } else{
                                            echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='up_user_sts.php?login_id={$row['login_id']}'>Active</a></td>";
                                        }
                                    }
                                        echo "</div>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php
$sql_pending = "SELECT r.*, l.status 
FROM tbl_registration r
INNER JOIN tbl_login l ON r.login_id = l.login_id
WHERE l.status = 'Inactive';";

$result_pending = $conn->query($sql_pending);
?>
<?php if ($result_pending && $result_pending->num_rows > 0): ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-secondary rounded p-4">
                    <form method="POST" action="" id="carDetailsForm">
                        <h6 class="mb-4"> Inactive Users Table</h6>
                        <div class="table-responsive">
                            <table class="table table custom-table" style="color: white;">
                                <thead>
                                    <tr>
                                    <th scope="col">Profile</th>
                                        <th scope="col">SI No</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"> Actions</th>
                                        <td></td>
                                       

                                    </tr>
                                </thead>
                                <tbody>
                               
      
   
                                    <?php
                                    $sno=1;
                                    // Loop through the result set
                                    $sql = "SELECT r.*
                                    FROM tbl_registration r
                                    JOIN tbl_login l ON r.login_id = l.login_id
                                    WHERE l.status = 'Inactive';";
                            
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $image = "../profile_images/" . $row['image'];
                                        echo "<tr>";
                                        if (!empty($image) && file_exists($image)) {
                                            echo "<td><img src='" . $image . "' alt='No Profile' width='65px' height='65px' style='cursor:pointer;' class='rounded-circle' onclick=\"showEnlargedImage('" . $image . "');\"></td>";
                                        } else {
                                            // If there is no user photo or the image file doesn't exist, display the default image
                                            echo "<td><img src='642902-200.png' alt='Default Img' width='65px' height='65px'></td>";
                                        }
                                        // Output table data for each column
                                        echo "<td>" . $sno++ . "</td>";

                                        echo "<td>" . $row['fname'] . "</td>";
                                        echo "<td>" . $row['lname'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['dob'] . "</td>";
                                        $sql1 = "SELECT status FROM tbl_login WHERE login_id='" . $row['login_id'] . "' AND type_id=2; ";
                                        $result1 = $conn->query($sql1);
                            
                                        while ($row1 = $result1->fetch_assoc()) {
                                        echo "<td>" . $row1['status'] . "</td>";
                                        
                                        echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";

                                        
                                        if ($row1['status'] == 'Active') {
                                            echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_user_sts.php?login_id={$row['login_id']}' onclick='return confirmDecline()'>Inactive</a></td>";
                                        } else{
                                            echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='up_user_sts.php?login_id={$row['login_id']}'>Active</a></td>";
                                        }
                                    }
                                        echo "</div>";
                                        echo "</tr>";
                                        
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php endif; ?>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <img id="enlargedImage" src="" alt="Enlarged Image" class="img-fluid" >
      </div>
    </div>
  </div>
</div>

                        <!-- Content End -->

                        <!-- Back to Top -->
                        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                                class="bi bi-arrow-up"></i></a>
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


                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


                    <!-- Template Javascript -->
                    <script src="js/main.js"></script>

                    <script>
  function showEnlargedImage(imageUrl) {
    var modal = document.getElementById('imageModal');
    var enlargedImage = document.getElementById('enlargedImage');
    enlargedImage.src = imageUrl;
    $('#imageModal').modal('show');
  }
</script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Attach oninput event to each input field for live validation
                            var inputFields = document.querySelectorAll('.form-control');
                            inputFields.forEach(function (field) {
                                field.addEventListener('input', function () {
                                    validateLive(field.id);
                                });
                            });
                        });

                        function validateLive(fieldName) {
                            // Reset live error messages
                            var errorId = fieldName + 'Error';
                            displayErrorMessage(errorId, '');

                            // Validate the specific input field
                            if (fieldName !== 'image') {  // Skip live validation for file input
                                var fieldValue = document.getElementById(fieldName).value.trim();

                                if (fieldName === 'colour' && /\d/.test(fieldValue)) {
                                    displayErrorMessage(errorId, 'Colour cannot contain numbers');
                                } else if (fieldValue === "") {
                                    displayErrorMessage(errorId, 'This field cannot be empty');
                                }



                            }
                        }

                        function validateForm() {
                            // Reset error messages
                            resetErrorMessages();

                            // Validate each input field
                            if (!validateField('company', 'companyError', 'Please enter the company')) return false;
                            if (!validateField('model', 'modelError', 'Please enter the model')) return false;
                            if (!validateField('variant', 'variantError', 'Please enter the variant')) return false;
                            if (!validateField('colour', 'colourError', 'Please enter a valid colour')) return false;
                            if (!validateField('category', 'categoryError', 'Please select a category')) return false;
                            if (!validateField('status', 'statusError', 'Please select the status')) return false;
                            if (!validateField('mileage', 'mileageError', 'Please enter the mileage')) return false;
                            if (!validateField('year', 'yearError', 'Please enter the year')) return false;
                            if (!validateField('fuelType', 'fuelTypeError', 'Please enter the fuel type')) return false; // Corrected ID
                            if (!validateField('transmissionType', 'transmissionTypeError', 'Please enter the transmission type')) return false; // Corrected ID
                            if (!validateField('seat', 'seatError', 'Please enter the seat')) return false;
                            if (!validateField('rate', 'rateError', 'Please enter the rate')) return false;
                            if (!validateField('status', 'statusError', 'Please select the status')) return false;
                            if (!validateField('location', 'locationError', 'Please enter the Location')) return false;
                            if (!validateFile('image', 'imageError', 'Please select an image')) return false;

                            // All validations passed, form can be submitted
                            return true;
                        }

                        function validateField(fieldName, errorId, errorMessage) {
                            var fieldValue = document.getElementById(fieldName).value.trim();

                            if (fieldName === 'colour' && /\d/.test(fieldValue)) {
                                displayErrorMessage(errorId, 'Colour cannot contain numbers');
                                return false;
                            } else if (fieldValue === "") {
                                displayErrorMessage(errorId, errorMessage);
                                return false;
                            }

                            return true;
                        }

                        function validateFile(fieldName, errorId, errorMessage) {
                            var fileInput = document.getElementById(fieldName);
                            var fieldValue = fileInput.value.trim();

                            if (fieldValue === "") {
                                displayErrorMessage(errorId, errorMessage);
                                return false;
                            }

                            // Add additional file type or size validation if needed

                            return true;
                        }

                        function displayErrorMessage(errorId, errorMessage) {
                            document.getElementById(errorId).innerText = errorMessage;
                        }

                        function resetErrorMessages() {
                            var errorMessages = document.querySelectorAll('.error-message');
                            errorMessages.forEach(function (element) {
                                element.innerText = '';
                            });
                        }


                        
                    </script>

<script>
    function confirmDecline() {
        return confirm("Are you sure you want to inactive this user?");
    }
</script>





</body>

</html>