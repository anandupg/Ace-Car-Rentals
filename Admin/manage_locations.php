<?php
include "../connect.php";
$sql = "SELECT * FROM tbl_location";
$result = $conn->query($sql);

if(isset($_POST['addlocation'])){

    $location=$_POST['location'];
    $sql1="INSERT INTO tbl_location(loc_name) values('$location');";
    $result=$conn->query($sql1);
    if($result == TRUE){
        ob_start(); // Start output buffering
        header("Location: manage_locations.php");
        ob_end_flush(); // Flush the output
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
     
}

if(isset($_POST['addsublocation'])){
    $loc_id=$_POST['loc'];
    $subloc=$_POST['subloc'];
    $sql1="INSERT INTO tbl_subloc(loc_id,subloc_name) values('$loc_id','$subloc');";
    $result=$conn->query($sql1);
    if($result == TRUE){
        ob_start(); // Start output buffering
        header("Location: manage_locations.php");
        ob_end_flush(); // Flush the output
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
     
}

if (isset($_POST['update'])) {
    $loc_id = $_POST['loc_id'];

    // Assuming you have a function to sanitize and validate input, use it to prevent SQL injection
    $category_id = filter_var($loc_id, FILTER_SANITIZE_NUMBER_INT);

    // Assuming you have a variable to represent the current status
    $currentStatus = 'Active'; // You may need to fetch this from the database

    // Update the status based on the current status
    if ($currentStatus == 'Active') {
        $newStatus = 'Inactive';
    } else {
        $newStatus = 'Active';
    }

    // Assuming your table name is 'your_table_name'
    $sql = "UPDATE tbl_location SET status = ? WHERE loc_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newStatus, $loc_id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status.";
    }

    $stmt->close();
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
            <h4 class="text-white"><i></i>Ace Car Rentals</h4>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">Admin</h6>
                <span class="text-white">Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="admin.php" class="nav-item nav-link  text-white"><i class="fa fa-home"></i> Home</a>
            <a href="manage_car.php" class="nav-item nav-link text-white"><i class="fas fa-car"></i> Manage Cars</a>
            <a href="manage_car_category.php" class="nav-item nav-link text-white"><i class="fa fa-list-alt"></i> Car Categories</a>
            <a href="manage_locations.php" class="nav-item nav-link active text-white"><i class="fa fa-map-marker"></i> Locations</a>
          
            <a href="manage_user.php" class="nav-item nav-link text-white"><i class="fas fa-user-alt"></i> Users</a>
            <a href="driver.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Drivers</a>
            <a href="manage_rentals.php" class="nav-item nav-link text-white"><i class="fas fa-car-side"></i> Rentals</a>
            <a href="manage_documents.php" class="nav-item nav-link text-white"><i class="fas fa-file-alt"></i> Documents</a>
            <a href="manage_payments.php" class="nav-item nav-link text-white"><i class="fas fa-credit-card"></i> Payments</a>
            <a href="manage_review.php" class="nav-item nav-link text-white"><i class="fa fa-tachometer-alt me-2"></i> Reviews</a>
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
                                Add New Location
                            </button>

                            <!-- <button class="btn btn-outline-secondary m-2 text-white" type="button"
                                data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false"
                                aria-controls="collapseExample">
                                See All Locations
                            </button> -->

                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card bg-secondary card-body">
                                <form method="POST" action="" onsubmit="return validateForm()">

                                    <table class="table" style="color: white;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="location">Add New Location</label>
                                                    <input type="text" class="form-control" name="location"
                                                        id="location" placeholder="Enter Location"
                                                        oninput="liveValidateCategory()">
                                                    <span id="LocationError"
                                                        style="color: red; font-size: 10px;"></span>
                                                    <!-- Display error message here -->
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>
                                    <button type="submit" name="addlocation"
                                        class="btn btn-primary float-right">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12">

                       
                            <div class="bg-secondary rounded h-100 p-4">
                                <form action="#" method="POST">
                                    <h6 class="mb-4">Location Table</h6>
                                    <table class="table" style="color: white;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Location id</th>
                                                <th scope="col">Location name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" class="text-right" >Actions</th>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                        // Loop through the result set
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['loc_id'] . "</th>";
                            echo "<td>" . $row['loc_name'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            
                            echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";
                                                   
                           if ($row['status'] == 'Active') {
                            echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_loc_sts.php?loc_id={$row['loc_id']}'>Deactivate</a></td>";
                        } else {
                            echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_loc_sts.php?loc_id={$row['loc_id']}'>Activate</a></td>";
                        }        
                            echo "</div>";
                       
                            echo "</tr>";
                        }
                        ?>

                                </form>

                                </tbody>
                                </table>
                            </div>

                      
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                    Add New Sub Locations
                </button>
                <!-- <button class="btn btn-outline-secondary m-2 text-white" type="button"
                                data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false"
                                aria-controls="collapseExample">
                                See All Sub Locations
                            </button>  -->
            </p>
            <div class="collapse" id="collapseExample1">
                <div class="card bg-secondary card-body">
                    <form method="POST" action="" onsubmit="return validateForm1()">
                        <table class="table" style="color: white;">
                            <tbody>
                            <tr>
                                <td>
                                    <label for="loc">Select Location</label>
                                    <?php
                                    // Assuming you have the database connection ($conn) established
                                    $sqll = "SELECT * FROM tbl_location";
                                    $result1 = $conn->query($sqll);
                                    if ($result1->num_rows > 0) {
                                        echo '<select class="form-control" name="loc" id="loc" style="background-color: black; color: white;" oninput="liveValidateloc()"> ';
                                        echo '<option value="">Select Location</option>';
                                        while ($row1 = $result1->fetch_assoc()) {
                                           
                                                echo '<option value="' . $row1['loc_id'] . '">' . $row1['loc_name'] . '</option>';
                                            
                                           
                                        }
                                        echo '</select>';
                                    } else {
                                        echo '<p>No Locations found.</p>';
                                    }
                                    ?>
                                    <span id="locError" style="color: red; font-size: 10px;"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="subloc">Sub Location</label>
                                    <input type="text" class="form-control" name="subloc" id="subloc"
                                           placeholder="Enter Sub Location" oninput="liveValidatesubLocation()">
                                    <span id="sublocError" style="color: red; font-size: 10px;"></span>
                                    <!-- Display error message here -->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="submit" name="addsublocation" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12">

                         <!-- <div class="collapse" id="collapseExample3">  -->
                            <div class="bg-secondary rounded h-100 p-4">
                                <form action="#" method="POST">
                                    <h6 class="mb-4">Sub Location Table</h6>
                                    <table class="table" style="color: white;" >
                                        <thead>
                                            <tr>
                                                <th scope="col">SUb Location id</th>
                                                <th scope="col">Location name</th>
                                                <th scope="col">Sub Location name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" >Actions</th>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    $s="SELECT * FROM tbl_subloc";
                                    $r=$conn->query($s);
                                    

                        // Loop through the result set
                        while ($row3 = $r->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row3['subloc_id'] . "</th>";
                            $p = "SELECT * FROM tbl_location WHERE loc_id = (SELECT loc_id FROM tbl_subloc WHERE subloc_id = '" . $row3['subloc_id'] . "')";

                            $re=$conn->query($p);
                            while ($row4 = $re->fetch_assoc()) {
                            echo "<td>" . $row4['loc_name'] . "</td>";
                            }
                            echo "<td>" . $row3['subloc_name'] . "</td>";
                            echo "<td>" . $row3['status'] . "</td>";
                            
                            
                            echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";
                                                   
                           if ($row3['status'] == 'Active') {
                            echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_subloc_sts.php?subloc_id={$row3['subloc_id']}'>Deactivate</a></td>";
                        } else {
                            echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_subloc_sts.php?subloc_id={$row3['subloc_id']}'>Activate</a></td>";
                        }        
                            echo "</div>";
                       
                            echo "</tr>";
                        }
                        ?>

                                </form>

                                </tbody>
                                </table>
                            </div>

                        <!-- </div> -->
                    </div>
                </div>
            </div>

<script>
    function validateForm1() {
        var subloc = document.getElementById('subloc').value;
        var loc = document.getElementById('loc').value;

        // Reset previous error messages
        document.getElementById('locError').innerHTML = '';
        document.getElementById('sublocError').innerHTML = '';

        // Check if values are not empty
        if (loc === '') {
            document.getElementById('locError').innerHTML = 'Please select a location.';
            return false;
        }
        if (subloc === '') {
            document.getElementById('sublocError').innerHTML = 'Please enter a sub location.';
            return false;
        }
        if (/^\d+$/.test(subloc)) {
            document.getElementById('sublocError').innerHTML = 'Sub location cannot contain numeric values.';
            return false;
        }

        return true;
    }

    function liveValidatesubLocation() {
        var subloc = document.getElementById('subloc').value;
        document.getElementById('sublocError').innerHTML = (subloc === '') ? 'Please enter a sub location.' : '';
        if (/^\d+$/.test(subloc)) {
            document.getElementById('sublocError').innerHTML = 'Sub location cannot contain numeric values.';
        }

    }
    function liveValidateloc() {
        var subloc = document.getElementById('loc').value;
        document.getElementById('locError').innerHTML = (subloc === '') ? 'Please select a location.' : '';
    }
</script>

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
</body>
<script>
    function liveValidateCategory() {
        // Get the value of the category input
        var categoryValue = document.getElementById("location").value.trim();

        // Validate if the category is empty
        if (categoryValue === "") {
            document.getElementById("LocationError").innerHTML = "Location cannot be empty";
            return;
        }

        // Validate if the category contains numbers
        if (/^\d+$/.test(categoryValue)) {
            document.getElementById("LocationError").innerHTML = "Location cannot contain numbers";
            return;
        }

        // If everything is valid, clear the error message
        document.getElementById("LocationError").innerHTML = "";
    }

    function validateForm() {
        // Run live validation before submitting the form
        liveValidateCategory();

        // Check if there are any error messages
        var errorMessage = document.getElementById("LocationError").innerHTML;
        if (errorMessage !== "") {
            return false; // Prevent form submission if there are errors
        }

        return true; // Allow form submission if everything is valid
    }
</script>

</html>