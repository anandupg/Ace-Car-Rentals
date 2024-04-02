<?php
include "../connect.php";
$sql = "SELECT * FROM tbl_cars";
$result = $conn->query($sql);


// Check if the form is submitted
if (isset($_POST['addcars'])) {
    // Retrieve form data
    $category_id=$_POST['category'];
    $company = $_POST["company"];
    $model = $_POST["model"];
    $variant = $_POST["variant"];
    $reg_no=$_POST["regno"];
    $colour = $_POST["colour"];
    $mileage = $_POST["mileage"];
    $year = $_POST["year"];
    $fuelType = $_POST["fuelType"];
    $transmissionType = $_POST["transmissionType"];
    $seat = $_POST["seat"];
    $rate = $_POST["rate"];
    $status = $_POST["status"];
    $location = $_POST["location"];
    $image_name = $_FILES['image']['name'];
    $target_dir = "productimg/";
    $target_file = $target_dir . basename($image_name);

   

    // SQL query to insert data into tbl_cars
    $sql = "INSERT INTO tbl_cars (category_id,company, model, variant,reg_no, colour, mileage, year, fuel_type, transmission_type, seat, rate, status, loc_id, image) 
            VALUES ('$category_id','$company', '$model', '$variant','$reg_no', '$colour', '$mileage', '$year', '$fuelType', '$transmissionType', '$seat', '$rate', '$status', '$location', '$image_name')";
 
 
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo "The file ". htmlspecialchars(basename($image_name)). " has been uploaded.";
            echo"<script>alert('Upload successfull');</script>";
        } else {
            echo "Sorry, there was an error uploading your file.";
            echo"<script>alert('Upload not successfull');</script>";
        }
        echo"<script>alert('Upload not successfull');</script>";
        ob_start(); // Start output buffering
        header("Location: manage_car.php");
        ob_end_flush(); // Flush the output
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    



}

 
if (isset($_POST['delete']) && $_POST['delete'] == 1) {
    // Check if a delete button was clicked
    foreach ($_POST as $key => $value) {
        // Check if the key starts with 'delete_'
        if (strpos($key, 'delete_') === 0) {
            // Extract car_id from the key
            $car_id_to_delete = substr($key, strlen('delete_'));

            // Sanitize the car_id to prevent SQL injection
            $car_id_to_delete = $conn->real_escape_string($car_id_to_delete);

            // Your SQL query to delete the record
            $delete_query = "DELETE FROM tbl_cars WHERE car_id = $car_id_to_delete;";

            // Execute the query
            if ($conn->query($delete_query) === TRUE) {
               
                header("Location: manage_car.php");
                exit();
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }
}
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
            font-size: 14px;
            /* Adjust the font size as needed */
        }

        .custom-btn {
            font-size: 12px;
            /* Adjust the font size as needed */
            padding: 6px 12px;
            /* Adjust the padding as needed */
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
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Admin</h6>
                        <span class="text-white">Admin</span>
                    </div>
                </div> -->
                <div class="navbar-nav w-100">
                    <a href="admin.php" class="nav-item nav-link  text-white"><i class="fa fa-home"></i> Home</a>
                    <a href="manage_car.php" class="nav-item nav-link active text-white"><i class="fas fa-car"></i>
                        Manage Cars</a>
                    <a href="manage_car_category.php" class="nav-item nav-link text-white"><i
                            class="fa fa-list-alt"></i> Car Categories</a>
                    <a href="manage_locations.php" class="nav-item nav-link text-white"><i class="fa fa-map-marker"></i>
                        Locations</a>

                    <a href="manage_user.php" class="nav-item nav-link text-white"><i class="fas fa-user-alt"></i>
                        Users</a>
                    <a href="driver.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i>
                        Drivers</a>
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
                <div class="row g-4">
                    <div class="col-sm-12">
                        <p>
                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Add New Car
                            </button>
                        <div class="collapse" id="collapseExample">
                            <div class="card bg-secondary card-body">
                                <form method="POST" action="" id="carDetailsForm" onsubmit="return validateForm()"
                                    enctype="multipart/form-data">
                                    <table class="table" style="color: white;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="company">Company</label>
                                                    <input type="text" class="form-control" name="company" id="company"
                                                        placeholder="Enter Company">
                                                    <div id="companyError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="model">Model</label>
                                                    <input type="text" class="form-control" name="model" id="model"
                                                        placeholder="Enter Model">

                                                    <div id="modelError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="variant">Variant</label>
                                                    <input type="text" class="form-control" name="variant" id="variant"
                                                        placeholder="Enter variant">
                                                    <div id="variantError" class="text-danger error-message"></div>
                                                </td>

                                            </tr>
                                            <tr>

                                                <td>
                                                    <label for="colour">Colour</label>
                                                    <input type="text" class="form-control" name="colour" id="colour"
                                                        placeholder="Enter colour">
                                                    <div id="colourError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="status">Category</label>
                                                    <?php
                                                 $sql2 = "SELECT * FROM tbl_car_category;";
                                                 $result2 = $conn->query($sql2);


                                                 if ($result2->num_rows > 0) {
                                                    
                                                    echo '<select class="form-control" name="category" id="category" style="background-color: black;  background-image: url(\'white_arrow.png\'); background-position: right center; background-repeat: no-repeat; -webkit-appearance: none; -moz-appearance: none; appearance: none;">';
                                                 echo '<option value="">Enter category</option>';
                                                  while ($row = $result2->fetch_assoc()) {
                                                    
                                                    echo '<option value="' . $row['category_id'] . '" style="color: white;">' . $row['category_name'] . '</option>';
                                                  
                                                }
                                                        echo '</select>';
                                                  } else {
                                                  echo '<p>No categories found.</p>';
                                                   }
                                                           ?>


                                                    <div id="categoryError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="mileage">Mileage</label>
                                                    <input type="number" class="form-control" name="mileage"
                                                        id="mileage" placeholder="Enter mileage">
                                                    <div id="mileageError" class="text-danger error-message"></div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="year">Year</label>
                                                    <input type="number" class="form-control" name="year" id="year"
                                                        placeholder="Enter year">
                                                    <div id="yearError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="fuelType">Fuel Type</label>
                                                    <select class="form-control" name="fuelType" id="fuelType"
                                                        style="background-color: black;">
                                                        <option value="">Enter Fuel Type</option>
                                                        <option value="Petrol" style="color: white;">Petrol</option>
                                                        <option value="Diesel" style="color: white;">Diesel</option>
                                                        <option value="Electric" style="color: white;">Electric</option>
                                                        <option value="Gasoline" style="color: white;">Gasoline</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                    <div id="fuelTypeError" class="text-danger error-message"></div>


                                                </td>
                                                <td>
                                                    <label for="transmissionType">Transmission Type</label>
                                                    <select class="form-control" name="transmissionType"
                                                        id="transmissionType" style="background-color: black;">
                                                        <option value="">Enter Transmission Type</option>
                                                        <option value="Manual" style="color: white;">Manual</option>
                                                        <option value="Automatic" style="color: white;">Automatic
                                                        </option>
                                                        <option value="Semi-Automatic" style="color: white;">
                                                            Semi-Automatic</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                    <div id="transmissionTypeError" class="text-danger error-message">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="seat">Seat</label>
                                                    <input type="number" class="form-control" name="seat" id="seat"
                                                        placeholder="Enter seat">
                                                    <div id="seatError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="rate">Rate</label>
                                                    <input type="number" class="form-control" name="rate" id="rate"
                                                        placeholder="Enter rate">
                                                    <div id="rateError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="colour">Reg No</label>
                                                    <input type="text" class="form-control" name="regno" id="regno"
                                                        placeholder="Enter Regno">
                                                    <div id="regnoError" class="text-danger error-message"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <label for="status">Location</label>
                                                    <?php
                                                 $sql5 = "SELECT * FROM tbl_location;";
                                                 $result5 = $conn->query($sql5);
 

                                                 if ($result5->num_rows > 0) {
                                                    
                                                    echo '<select class="form-control" name="location" id="location" style="background-color: black;  background-image: url(\'white_arrow.png\'); background-position: right center; background-repeat: no-repeat; -webkit-appearance: none; -moz-appearance: none; appearance: none;">';
                                                 echo '<option value="">Enter Location</option>';
                                                  while ($row5 = $result5->fetch_assoc()) {
                                                   
                                                    echo '<option value="' . $row5['loc_id'] . '" style="color: white;">' . $row5['loc_name'] . '</option>';
                                                  
                                                }
                                                        echo '</select>';
                                                  } else {
                                                  echo '<p>No Locations.</p>';
                                                   }
                                                           ?>


                                                    <div id="locationError" class="text-danger error-message"></div>

                                                </td>
                                                <td>
                                                    <label for="status">Status</label>
                                                    <select class="form-control" name="status" id="status"
                                                        style="background-color: black;">
                                                        <option value="" style="color: white;">Enter status</option>
                                                        <option value="Available" style="color: white;">Available
                                                        </option>
                                                        <option value="Not Available" style="color: white;">Not
                                                            Available</option>

                                                        <option value="Maintanance" style="color: white;">Maintanance
                                                        </option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                    <div id="statusError" class="text-danger error-message"></div>
                                                </td>

                                                <td class="col-sm-4">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control bg-dark" name="image"
                                                        id="image" placeholder="Enter image URL"
                                                        onchange="validateImageType(this)">
                                                    <div id="imageError" class="text-danger error-message"></div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" name="addcars" class="btn btn-primary">Add New car</button>
                                </form>
                            </div>
                        </div>






                        <div class="container-fluid pt-4 px-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-secondary rounded p-4">
                                        <form method="POST" action="" id="carDetailsForm">
                                            <h6 class="mb-4">Car Table</h6>
                                            <div class="table-responsive">
                                                <table class="table table custom-table" style="color: white;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Car Id</th>
                                                            <th scope="col">Car Image</th>
                                                            <th scope="col">Company</th>
                                                            <th scope="col">Model</th>
                                                            <th scope="col">Location</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Rate</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" class="text-center">Actions</th>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                    // Loop through the result set
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        $image = "./productimg/" . $row['image'];
                                        // Output table data for each column
                                        echo "<th scope='row'>" . $row['car_id'] . "</th>";
                                        echo "<td><img src='" . $image . "' alt='Car Image' width='95px' height='65px' style='cursor:pointer;' onclick=\"showEnlargedImage('" . $image . "');\"></td>";

                                        echo "<td>" . $row['company'] . "</td>";
                                        echo "<td>" . $row['model'] . "</td>";
                                         $sql5 = "SELECT * FROM tbl_location WHERE loc_id = (SELECT loc_id FROM tbl_cars WHERE car_id = '{$row['car_id']}')";

                                        $result5 = $conn->query($sql5);
                                        if ($result5->num_rows > 0) {
                                            while ($row5 = $result5->fetch_assoc()) {
                                                echo "<td>" . $row5['loc_name'] . "</td>";
                                            }
                                        }
                                        $sql6 = "SELECT * FROM tbl_car_category WHERE category_id = (SELECT category_id FROM tbl_cars WHERE car_id = '{$row['car_id']}')";

                                        $result6 = $conn->query($sql6);
                                        if ($result6->num_rows > 0) {
                                            while ($row6 = $result6->fetch_assoc()) {
                                                echo "<td>" . $row6['category_name'] . "</td>";
                                            }
                                        }
                                        echo "<td>" . $row['rate'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";

                                        // echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='update_cars.php?car_id={$row['car_id']}'>Update</a></td>";
                                        if ($row['status'] == 'Available') {
                                            echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_car_sts.php?car_id={$row['car_id']}'>Unavailable</a></td>";
                                        } elseif($row['status'] == 'Not Available') {
                                            echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='up_car_sts.php?car_id={$row['car_id']}'>Available</a></td>";
                                        }else{

                                        }      
                                        echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='view_cars.php?car_id={$row['car_id']}'>View More</a></td>";  
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
                            if (!validateFile('regno', 'regnoError', 'Please enter a Regno')) return false;
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
                    </script>







</body>

</html>