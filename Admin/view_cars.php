<?php
if(!isset($_SESSION['login_id'])){
    header("Location:../logout.php");
   exit();
}
if($_SESSION['type_id']!=1){
    header("Location:../logout.php");
   exit();
}
$_SESSION['type_id'];
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
                            <a href="admin_profile.php" class="dropdown-item">My Profile</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            
<?php
include "../connect.php";
$sql = "SELECT * FROM tbl_cars";
$result = $conn->query($sql);
?>
           

           <div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-secondary rounded p-4" style="background-color: white;">
                <form method="POST" action="" id="carDetailsForm">
                    <h6 class="mb-4">Car Details</h6>
                    <div class="table-responsive">
                        <table class="table table custom-table">
                            <tbody>
                                <?php
                                // Check if the car_id is set in the GET parameters
                                if(isset($_GET['car_id'])) {
                                    $car_id = $_GET['car_id'];

                                    // Fetch details for the specific car
                                    $sql = "SELECT * FROM tbl_cars WHERE car_id = '$car_id'";
                                    $result = $conn->query($sql);

                                    // Check if there is a result
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        // Display details for the specific car
                                        $image = "./productimg/" . $row['image'];
                                         
                                        echo "<tr>";
                                        echo "<td class='text-center' colspan='2'><img src='" .  $image . "' alt='Car Image' width='400px' height='300px' style='cursor:pointer;' onclick=\"showEnlargedImage('" .  $image . "');\"></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td colspan='2' class='text-center'>";
                                        
                                        echo "<a class='btn btn-outline-success' style='border-color: red; width: 180px;' href='update_cars.php?car_id={$row['car_id']}'>Update Car Details</a>";
                                        
                                        echo "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Car Id:</td><td style='color: white;'>" . $row['car_id'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Company:</td><td style='color: white;'>" . $row['company'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Model:</td><td style='color: white;'>" . $row['model'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Variant:</td><td style='color: white;'>" . $row['variant'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Color:</td><td style='color: white;'>" . $row['colour'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Location:</td><td style='color: white;'>";
                                        $sql5 = "SELECT * FROM tbl_location WHERE loc_id = (SELECT loc_id FROM tbl_cars WHERE car_id = '$car_id');";
                                        $result5 = $conn->query($sql5);
                                        if ($result5->num_rows > 0) {
                                            while ($row5 = $result5->fetch_assoc()) {
                                                echo $row5['loc_name'];
                                            }
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Category:</td><td style='color: white;'>";
                                        $sql6 = "SELECT * FROM tbl_car_category WHERE category_id = (SELECT category_id FROM tbl_cars WHERE car_id = '$car_id');";
                                        $result6 = $conn->query($sql6);
                                        if ($result6->num_rows > 0) {
                                            while ($row6 = $result6->fetch_assoc()) {
                                                echo $row6['category_name'];
                                            }
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Mileage:</td><td style='color: white;'>" . $row['mileage'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Reg No:</td><td style='color: white;'>" . $row['reg_no'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Year:</td><td style='color: white;'>" . $row['year'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Fuel Type:</td><td style='color: white;'>" . $row['fuel_type'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Transmission Type:</td><td style='color: white;'>" . $row['transmission_type'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Seat:</td><td style='color: white;'>" . $row['seat'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Rate:</td><td style='color: white;'>" . $row['rate'] . "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td style='color: white;'>Status:</td><td style='color: red;'>" . $row['status'] . "</td>";
                                        echo "</tr>";
                                        // Action buttons
                                        echo "<tr>";
                                       
                                        
                                       // echo "<a class='btn btn-outline-success' style='border-color: red;' href='update_cars.php?car_id={$row['car_id']}'>Update</a>";
                                        
                                        
                                        echo "</tr>";
                                    } else {
                                        echo "<tr><td colspan='2'>Car not found</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>Car ID not provided</td></tr>";
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
        <script>
  function showEnlargedImage(imageUrl) {
    var modal = document.getElementById('imageModal');
    var enlargedImage = document.getElementById('enlargedImage');
    enlargedImage.src = imageUrl;
    $('#imageModal').modal('show');
  }
</script>

</body>

</html>