<?php
include "../connect.php";
if(!isset($_SESSION['login_id'])){
    header("Location:../logout.php");
   exit();
}
if($_SESSION['type_id']!=1){
    header("Location:../logout.php");
   exit();
}
$_SESSION['type_id'];
$sql = "SELECT * FROM tbl_car_category";
$result = $conn->query($sql);

if(isset($_POST['addcategory'])){

    $category=$_POST['category'];
    $sql1="INSERT INTO tbl_car_category(category_name) values('$category');";
    $result=$conn->query($sql1);
    if($result == TRUE){
        ob_start(); // Start output buffering
        header("Location: manage_car_category.php");
        ob_end_flush(); // Flush the output
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
     
}

if (isset($_POST['update'])) {
    $category_id = $_POST['category_id'];

    // Assuming you have a function to sanitize and validate input, use it to prevent SQL injection
    $category_id = filter_var($category_id, FILTER_SANITIZE_NUMBER_INT);

    // Assuming you have a variable to represent the current status
    $currentStatus = 'Active'; // You may need to fetch this from the database

    // Update the status based on the current status
    if ($currentStatus == 'Active') {
        $newStatus = 'Inactive';
    } else {
        $newStatus = 'Active';
    }

    // Assuming your table name is 'your_table_name'
    $sql = "UPDATE tbl_car_category SET status = ? WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newStatus, $category_id);
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
    <style>
       
        .btn-outline-danger:hover {
            background-color: red;
            border-color: red;
            color: white; /* Set text color to white or any color that suits your design */
        }
    
    </style>
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
            <a href="manage_car_category.php" class="nav-item nav-link active text-white"><i class="fa fa-list-alt"></i> Car Categories</a>
            <a href="manage_locations.php" class="nav-item nav-link text-white"><i class="fa fa-map-marker"></i> Locations</a>
          
            <a href="manage_user.php" class="nav-item nav-link text-white"><i class="fas fa-user-alt"></i> Users</a>
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
    <div class="row g-4">
        <div class="col-sm-12">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Add New Category
                </button>
            </p>
            <div class="collapse" id="collapseExample">
    <div class="card bg-secondary card-body">
        <form method="POST" action="" onsubmit="return validateForm()">
            <table class="table" style="color: white;">
                <tbody>
                    <tr>
                        <td>
                            <label for="category">Add Car Category</label>
                            <input type="text" class="form-control" name="category" id="category" placeholder="Enter category" oninput="liveValidateCategory()">
                            <span id="categoryError" style="color: red; font-size: 10px;"></span> <!-- Display error message here -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" name="addcategory" class="btn btn-primary float-right">Submit</button>
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
                <h6 class="mb-4">Car Category Table</h6>
                <table class="table" style="color: white;">
                    <thead>
                        <tr>
                            <th scope="col">SI No</th>
                            <th scope="col">Category name</th>
                            <th scope="col">Status</th>
                            <th scope="col" >Actions</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                     $sno=1;
                        // Loop through the result set
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                           
                                echo "<td>" . $sno++ . "</td>";
                            echo "<td > " . $row['category_name'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";
                           
                        if ($row['status'] == 'Active') {
                            echo "<td><a class='btn btn-sm btn-outline-danger m-2' style='border-color: red;' href='up_cat_sts.php?category_id={$row['category_id']}'>Deactivate</a></td>";
                        } else {
                            echo "<td><a class='btn btn-sm btn-outline-danger m-2' style='border-color: red;' href='up_cat_sts.php?category_id={$row['category_id']}'>Activate</a></td>";
                        }
                        echo "</td>";


                       echo" </tr>";
                                                       
                            echo "</div>";
                       
                           
                        }
                        ?>
                        
                          </form>
                      
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

<?php
            // Handle form submissions
            
            ?>







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
        var categoryValue = document.getElementById("category").value.trim();

        // Validate if the category is empty
        if (categoryValue === "") {
            document.getElementById("categoryError").innerHTML = "Category cannot be empty";
            return;
        }

        // Validate if the category contains numbers
        if (/^\d+$/.test(categoryValue)) {
            document.getElementById("categoryError").innerHTML = "Category cannot contain numbers";
            return;
        }

        // If everything is valid, clear the error message
        document.getElementById("categoryError").innerHTML = "";
    }

    function validateForm() {
        // Run live validation before submitting the form
        liveValidateCategory();

        // Check if there are any error messages
        var errorMessage = document.getElementById("categoryError").innerHTML;
        if (errorMessage !== "") {
            return false; // Prevent form submission if there are errors
        }

        return true; // Allow form submission if everything is valid
    }
</script>
</html>
