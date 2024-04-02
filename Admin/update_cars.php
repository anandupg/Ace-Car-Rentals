<?php
include "../connect.php";

$sql="SELECT * FROM tbl_cars;";

if (isset($_POST['update'])) {
    // Retrieve form data
    $car_id=$_GET['car_id'];
    $category_id=$_POST['category'];
    $company = $_POST["company"];
    $model = $_POST["model"];
    $variant = $_POST["variant"];
    $reg_no = $_POST["regno"];
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

    if (!empty($_FILES['image']['name'])) {
        // New image is uploaded
        $image_name = $_FILES['image']['name'];
        $target_dir = "productimg/";
        $target_file = $target_dir . basename($image_name);

        // Move the uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // File moved successfully
        } else {
            // Handle file upload error if needed
            echo "File upload failed.";
            exit(); // Terminate script if file upload fails
        }
    } else {
        // No new image uploaded, retain the existing image
        $sql_get_image = "SELECT image FROM tbl_cars WHERE car_id = $car_id";
        $result_get_image = $conn->query($sql_get_image);
        if ($result_get_image->num_rows > 0) {
            $row_image = $result_get_image->fetch_assoc();
            $image_name = $row_image['image'];
        } else {
            // Handle error if the image is not found
            echo "Error fetching existing image.";
            exit(); // Terminate script if image retrieval fails
        }
    }

    $sql_update = "UPDATE tbl_cars SET 
        category_id = '$category_id',
        company = '$company',
        model = '$model',
        variant = '$variant',
        reg_no='$reg_no',
        colour = '$colour',
        mileage = '$mileage',
        year = '$year',
        fuel_type = '$fuelType',
        transmission_type = '$transmissionType',
        seat = '$seat',
        rate = '$rate',
        status = '$status',
        loc_id = '$location',
        image='$image_name'
        WHERE car_id=$car_id";
     
     
     
   

    // Move the uploaded file
    

    $r=$conn->query($sql_update);
    if($r == TRUE){
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update the image column in the query
            $sql_update .= ", image = '$image_name' ";
        } else {
            // Handle file upload error if needed
            echo "File upload failed.";
        }
        ob_start(); // Start output buffering
        header("Location: manage_car.php");
        ob_end_flush(); // Flush the output
    }else{
        echo"Error";
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
        .form-control::placeholder {
            color: #6c7293;
        }

        .error-message {
            font-size: 10px;
            padding-top: 10px;
            color: red;
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
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- Add your CSS links or stylesheets here if needed -->
                <link rel="stylesheet" href="your-stylesheet.css">
                <title></title>
            </head>

            <body>

                <?php
    // Include your database connection or any necessary PHP code here
    // ...

    // Assuming you have a connection named $conn
    ?>

                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12">


                            <div class="card bg-secondary card-body">
                                <p>
                                <h3 style="color:white;">Update Car details</h3>
                                </p>
                                <form method="POST" action="" id="carDetailsForm" onsubmit="return validateForm()"
                                    enctype="multipart/form-data">
                                    <table class="table" style="color: white;">
                                        <tbody>
                                            <?php 
                                    $sql = "SELECT * FROM tbl_cars WHERE car_id = '" . $_GET['car_id'] . "'";
                                    $result=$conn->query($sql);
                                    $row=$result->fetch_assoc();

                                    ?>
                                            <tr>
                                                <td>
                                                    <label for="company">Car Id</label>
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $row['car_id']; ?>" disabled readonly
                                                        style="background-color: black;">

                                                    <div id="companyError" class="text-danger error-message"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="company">Company</label>
                                                    <input type="text" class="form-control" name="company" id="company"
                                                        placeholder="Enter Company"
                                                        value="<?php echo $row['company']; ?>">

                                                    <div id="companyError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="model">Model</label>
                                                    <input type="text" class="form-control" name="model" id="model"
                                                        placeholder="Enter model" value="<?php echo $row['model']; ?>">
                                                    <div id="modelError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="variant">Variant</label>
                                                    <input type="text" class="form-control" name="variant" id="variant"
                                                        placeholder="Enter variant"
                                                        value="<?php echo $row['variant']; ?>">
                                                    <div id="variantError" class="text-danger error-message"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="colour">Colour</label>
                                                    <input type="text" class="form-control" name="colour" id="colour"
                                                        placeholder="Enter colour"
                                                        value="<?php echo $row['colour']; ?>">
                                                    <div id="colourError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="status">Category</label>
                                                    <?php
$sqlCategories = "SELECT * FROM tbl_car_category;";
$resultCategories = $conn->query($sqlCategories);

$sqlCategoryName = "SELECT category_name FROM tbl_car_category WHERE category_id = '" . $row['category_id'] . "'";
$resultCategoryName = $conn->query($sqlCategoryName);

if ($resultCategoryName) {
    $rowCategoryName = $resultCategoryName->fetch_assoc();
    $category_name = $rowCategoryName['category_name'];
} else {
    $category_name = '';
}

if ($resultCategories->num_rows > 0) {
    echo '<select class="form-control" name="category" id="category" style="background-color: black;">';
    echo '<option value="' . $row['category_id'] . '">' . $category_name . '</option>';

    while ($rowCategories = $resultCategories->fetch_assoc()) {
        echo '<option value="' . $rowCategories['category_id'] . '" style="color: white;">' . $rowCategories['category_name'] . '</option>';
    }

    echo '</select>';
} else {
    echo '<p>No Categories.</p>';
}
?>

                                                    <div id="categoryError" class="text-danger error-message"></div>
                                                </td>

                                                <td>
                                                    <label for="mileage">Mileage</label>
                                                    <input type="number" class="form-control" name="mileage"
                                                        id="mileage" placeholder="Enter mileage"
                                                        value="<?php echo $row['mileage']; ?>">
                                                    <div id="mileageError" class="text-danger error-message"></div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="year">Year</label>
                                                    <input type="number" class="form-control" name="year" id="year"
                                                        placeholder="Enter year" value="<?php echo $row['year']; ?>">
                                                    <div id="yearError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="fuelType">Fuel Type</label>
                                                    <select class="form-control" name="fuelType" id="fuelType"
                                                        style="background-color: black;">
                                                        <option value="<?php echo $row['fuel_type']; ?>">
                                                            <?php echo $row['fuel_type']; ?>
                                                        </option>
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
                                                        <option value="<?php echo $row['transmission_type']; ?>">
                                                            <?php echo $row['transmission_type']; ?>
                                                        </option>
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
                                                        placeholder="Enter seat" value="<?php echo $row['seat']; ?>">
                                                    <div id="seatError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="rate">Rate</label>
                                                    <input type="number" class="form-control" name="rate" id="rate"
                                                        placeholder="Enter rate" value="<?php echo $row['rate']; ?>">
                                                    <div id="rateError" class="text-danger error-message"></div>
                                                </td>
                                                <td>
                                                    <label for="colour">Reg No</label>
                                                    <input type="text" class="form-control" name="regno" id="regno"
                                                        placeholder="Enter Regno" value="<?php echo $row['reg_no']; ?>">
                                                    <div id="regnoError" class="text-danger error-message"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <label for="status">Location</label>
                                                    <?php
                                                    $sql5 = "SELECT * FROM tbl_location;";
                                                    $result5 = $conn->query($sql5);

                                                     $sql7 = "SELECT loc_name FROM tbl_location WHERE loc_id = '" . $row['loc_id'] . "'";
                                                     $result7 = $conn->query($sql7);

                                                    if ($result7) {
                                                       $row7 = $result7->fetch_assoc();
                                                      $loc_name = $row7['loc_name'];
                                                     } else {
                                                          $loc_name = '';
                                                     }

                                                      if ($result5->num_rows > 0) {
                                                         echo '<select class="form-control" name="location" id="location" style="background-color: black; ">';
                                                         echo '<option value="' . $row['loc_id'] . '">' . $loc_name . '</option>';

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
                                                        <option value="<?php echo $row['status']; ?>"
                                                            style="color: white;">
                                                            <?php echo $row['status']; ?>
                                                        </option>
                                                        <option value="Available" style="color: white;">Available
                                                        </option>
                                                        <option value="Not Available" style="color: white;">Not
                                                            Available</option>
                                                        <option value="Rented" style="color: white;">Rented</option>
                                                        <option value="Maintanance" style="color: white;">Maintanance
                                                        </option>

                                                    </select>
                                                    <div id="statusError" class="text-danger error-message"></div>
                                                </td>


                                                <td class="col-sm-4">
    <label for="image">Image</label>
    <input type="file" class="form-control bg-dark" name="image" id="image" placeholder="Enter image URL" onchange="validateImageType(this)">
    <div id="imageError" class="text-danger error-message"></div>
</td>

<tr>
    <td>
        <div class="mt-2">
        <?php  $car_img = "./productimg/" . $row['image']; ?>
            <img src="<?php echo $car_img; ?>" alt="Car Front" class="img-fluid cropped-image" style=" cursor: pointer;" onclick="showEnlargedImage('<?php echo $car_img; ?>');"
                width="100px" height="120px">
        </div>
    </td>
</tr>


                                                <!-- Add more rows for form fields -->

                                                <!-- End of additional rows -->

                                        </tbody>
                                    </table>
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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

                <!-- Add your JavaScript scripts or links here if needed -->
                <script src="your-script.js"></script>
            </body>



            <!-- Content End -->

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
                if (!validateField('regno', 'regnoError', 'Please enter the Regno')) return false;
                if (!validateField('rate', 'rateError', 'Please enter the rate')) return false;
                if (!validateField('status', 'statusError', 'Please select the status')) return false;
                if (!validateField('location', 'locationError', 'Please enter the Location')) return false;
                

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







</html>