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
   <style>
    .card-body table {
    width: 100%;
}

.card-body td {
    vertical-align: top;
}

.card-body .text-center {
    text-align: center;
}

.card-body img {
    display: block;
    margin: 0 auto;
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
            <a href="manage_car_category.php" class="nav-item nav-link text-white"><i class="fa fa-list-alt"></i> Car Categories</a>
            <a href="manage_locations.php" class="nav-item nav-link text-white"><i class="fa fa-map-marker"></i> Locations</a>
          
            <a href="manage_user.php" class="nav-item nav-link text-white"><i class="fas fa-user-alt"></i> Users</a>
            <a href="driver.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Drivers</a>
            <a href="manage_rentals.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Rentals</a>
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
            <div class="card bg-secondary card-body">
            <h4 class="card-title text-white">Driver Details</h4>
                <form method="POST" action="" id="carDetailsForm" onsubmit="return validateForm()" enctype="multipart/form-data">
                    <table class="table" style="color: white;">
                        <tbody>
                            <?php 
                            include "../connect.php";
                            $driver_id=$_GET['driver_id'];
                                // Assuming you have already established a database connection
                                $sql = "SELECT * FROM tbl_driver WHERE driver_id = $driver_id";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $lisc_img1_path = "../driver_docs/" . $row['liscence_front'];
                                        $lisc_img2_path = "../driver_docs/" . $row['liscence_back'];
                                        $image = "../driver_docs/" . $row['image'];
                                        // Print license front image
                                        echo '<tr>';
                                        
                                        echo '<td>';
                                        echo '<label for="driver_id">Driver Image:</label>';
                                        echo '<div class="d-flex justify-content-between align-items-center">'; // Use flexbox for alignment
                                        echo '<img src="'. $image .'" alt="License Front" class="img-fluid cropped-image rounded-circle" style="max-height: 100px; max-width: 100px; cursor: pointer;" onclick="showEnlargedImage(\'' . $image . '\');">';
                                        echo '<div>'; // Start a new div for buttons
                                        if ($row['status'] == "Pending") {
                                            echo "<a class='btn btn-sm btn-success approve-button mr-4' href='up_driver_sts.php?driver_id={$row['driver_id']}'><i class='fas fa-check'></i> Approve</a>";
                                            echo "  ";
                                            echo "<a class='btn btn-sm btn-danger decline-button ml-3' style='border-color: green;' href='up_driver_decsts.php?driver_id={$row['driver_id']}' onclick='return confirmDecline()'><i class='fas fa-times'></i> Decline</a>";
                                        } else if ($row['status'] == "Approved") {
                                            // If status is not "Pending", display some other message or action
                                            echo "<a class='btn btn-sm btn-danger decline-button ml-4' style='border-color: green;' href='up_driver_sts.php?driver_id={$row['driver_id']}' onclick='return confirmDecline()'><i class='fas fa-times'></i> Decline</a>";
                                        }else{
                                            
                                            // Check if there is a login_id associated with the driver
                                            $selectLogin = "SELECT login_id FROM tbl_driver WHERE driver_id='{$row['driver_id']}'";
                                            $login_result = $conn->query($selectLogin);
                                            $login_row = $login_result->fetch_assoc();
                                            $driver_login_id = $login_row['login_id'];
                                            
                                            if ($driver_login_id == 0 || $driver_login_id == null) {
                                                // If login_id is 0 or null, make the button inactive
                                            } else {
                                                // If there is a login_id, generate the approve button
                                                echo "<a class='btn btn-sm btn-success approve-button mr-4' href='up_driver_sts.php?driver_id={$row['driver_id']}'><i class='fas fa-check'></i> Approve</a>";
                                            }
                                           
                                                                                        //  echo "  ";
                                            //  echo "<a class='btn btn-sm btn-danger decline-button ml-3' style='border-color: green;' href='up_driver_sts.php?driver_id={$row['driver_id']}' onclick='return confirmDecline()'><i class='fas fa-times'></i> Decline</a>";
                                        }
                                        echo '</div>'; // End of buttons div
                                        echo '</div>'; // End of flexbox div
                                        echo '</td>';
                                        echo '<td>';
                                        

                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label for="driver_id">Driver Id:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<span class="">' . $row['driver_id'] . '</span>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label for="fname">First Name:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<span class="">' . $row['fname'] . '</span>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label for="lname">Last Name:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<span class="">' .  $row['lname'] . '</span>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label for="email">Email:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<span class="">' . $row['email'] . '</span>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label for="fname">Phone:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<span class="">' . $row['phone'] . '</span>';
                                        echo '</td>';
                                        echo '</tr>';
                                        
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label for="fname">Location:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        $sql5 = "SELECT * FROM tbl_location WHERE loc_id = (SELECT loc_id FROM tbl_driver WHERE driver_id = '" . $row['driver_id'] . "');";
                                        $result5 = $conn->query($sql5);
                                        if ($result5->num_rows > 0) {
                                            while ($row5 = $result5->fetch_assoc()) {
                                                echo $row5['loc_name'];
                                            }
                                        }
                                        echo "</td>";
                                        echo "</tr>";

                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label for="fname">Address:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<span class="">' . $row['address'] . '</span>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<td>';
                                        echo '<label for="status">Status:</label>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<span class="">' . $row['status'] . '</span>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td class="text-center">';
                                        echo '<label for="license_front">License Front</label><br>';
                                        echo '<img src="'. $lisc_img1_path .'" alt="License Front" class="img-fluid cropped-image" style="max-height: 300px; max-width: 500px;cursor: pointer;" onclick="showEnlargedImage(\'' . $lisc_img1_path . '\');"><br>';

                                        echo '</td>';
                                       
                                        echo '<td class="text-center">';
                                        echo '<label for="license_back">License Back</label><br>';
                                        echo '<img src="'. $lisc_img2_path .'" alt="License Front" class="img-fluid cropped-image" style="max-height: 300px; max-width: 500px;cursor: pointer;" onclick="showEnlargedImage(\'' . $lisc_img2_path . '\');"><br>';
                                        echo '</td>';
                                        echo '</tr>';

                                        // Print other details one by one
                                        
                                    }
                                } else {
                                    echo '<tr><td colspan="7">No driver  found</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
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
<script>
    function confirmDecline() {
        return confirm("Are you sure you want to decline?");
    }
</script>
</body>

</html>