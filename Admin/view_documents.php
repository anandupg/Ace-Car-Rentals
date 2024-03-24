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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-W6Yw2p2U97wu8tMCa2Z5wifYSZTVUI0LgeGwShA/cnXcKDM0miHpzauwLclAx1BPTm6XPd5nG7m6gUeaBJYo8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            <a href="manage_locations.php" class="nav-item nav-link text-white"><i class="fa fa-map-marker"></i> Locations</a>
          
            <a href="manage_user.php" class="nav-item nav-link text-white"><i class="fas fa-user-alt"></i> Users</a>
            <a href="driver.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Drivers</a>
            <a href="manage_rentals.php" class="nav-item nav-link  text-white"><i class="fas fa-car-side"></i> Rentals</a>
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

            <?php 

include "../connect.php";
$doc_id=$_GET['doc_id'];
$reg_id=$_GET['regi_id'];
$login_id = isset($_GET['login_id']) ? $_GET['login_id'] : null;


$sql = "SELECT * FROM tbl_documents WHERE doc_id='$doc_id';";
$result = $conn->query($sql);
$sql1 = "SELECT * FROM tbl_registration WHERE reg_id='$reg_id';";
$result1 = $conn->query($sql1);





if ($result->num_rows > 0) {
    $sql_select = "SELECT * FROM tbl_documents WHERE doc_id='$doc_id';";
    $result = mysqli_query($conn, $sql_select);
    
    // Check if there are any rows
    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $lisc_img1_path = "../documents_img/" . $row['lisc_img1'];
        $lisc_img2_path = "../documents_img/" . $row['lisc_img2'];
        $aadhar_img1_path = "../documents_img/" . $row['aadhar_img1'];
        $aadhar_img2_path = "../documents_img/" . $row['aadhar_img2'];
?>

<?php

if ($result1 && $result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    ?>
    <div class="row">
        <div class="col">
            <div class="card" style="background-color: #191C24;">
                <div class="card-body">
                    <h5 class="card-title text-white">User Details</h5>
                    <p class="card-text text-white">
    <strong>Name:</strong> <?php echo $row1['fname'] . " " . $row1['lname']; ?><br>
    <strong>Email:</strong> <?php echo $row1['email']; ?><br>   
    <strong>Phone:</strong> <?php echo $row1['phone']; ?><br>
 
    
</p>


                
                
                    <?php
                        if ($row['status'] == "Pending") {
                            echo "<a class='btn btn-sm btn-success approve-button mr-2' href='up_doc_sts.php?doc_id={$row['doc_id']}&login_id={$row1['login_id']}'><i class='fas fa-check'></i> Approve</a>";
                            echo "<a class='btn btn-sm btn-danger decline-button' href='up_docdec_sts.php?doc_id={$row['doc_id']}&login_id={$row1['login_id']}' onclick='return confirmDecline()'><i class='fas fa-times'></i> Decline</a>";
                        } else if ($row['status'] == "Approved") {
                            // If status is not "Pending", display some other message or action
                            echo "<a class='btn btn-sm btn-danger decline-button' href='up_docdec_sts.php?doc_id={$row['doc_id']}&login_id={$row1['login_id']}' onclick='return confirmDecline()'><i class='fas fa-times'></i> Decline</a>";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    
    <?php
}
?>

       
<div class="container-fluid pt-4 px-4 border" style="background-color: #191C24;">

    <div class="row g-4">
        <div class="col-sm-12">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6 border-end">
                        <div class="row align-items-center justify-content-center">
                        <div class="text-center">
    <h2 class="text-muted mb-4">License</h2>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <strong class="mb-2">License Number:</strong>
        <span class="text-primary display-5" style="font-size: 1.25rem; margin-bottom: 9px"><?php echo $row['lisc_no']; ?></span>
    </div>
</div>

                            <!-- First big image on left -->
                            <div class="col-md-12 mb-3 text-center">
                            <img src="<?php echo $lisc_img1_path; ?>" class="img-fluid cropped-image" alt="First Image" style=" cursor: pointer;" onclick="showEnlargedImage('<?php echo $lisc_img1_path; ?>');">
                            </div>
                            <!-- Second big image on left -->
                            <div class="col-md-12 text-center">
                            <img src="<?php echo $lisc_img2_path; ?>" class="img-fluid cropped-image" alt="Second Image" style="margin-bottom: 40px;cursor: pointer;" onclick="showEnlargedImage('<?php echo $lisc_img2_path; ?>');">
                            </div>
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="row align-items-center justify-content-center">
                        <div class="text-center">
                        <h2 class="text-muted mb-4">Aadhar</h2>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <strong class="mb-2">Aadhar Number:</strong>
        <span class="text-primary display-5" style="font-size: 1.25rem; margin-bottom: 9px"><?php echo $row['aadhar_no']; ?></span>
    </div>
</div>
</div>
                            <div class="col-md-12 mb-3 text-center">
                            <img src="<?php echo $aadhar_img1_path; ?>" class="img-fluid cropped-image" alt="Third Image" style=" cursor: pointer;" onclick="showEnlargedImage('<?php echo $aadhar_img1_path; ?>');">
                            </div>
                            <!-- Fourth big image on right -->
                            <div class="col-md-12 text-center">
                            <img src="<?php echo $aadhar_img2_path; ?>" class="img-fluid cropped-image" alt="Fourth Image" style="margin-bottom: 40px; cursor: pointer;" onclick="showEnlargedImage('<?php echo $aadhar_img2_path; ?>');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<style>
    .cropped-image {
        max-width: 400px;
        max-height: 400px;
        width: auto;
        height: auto;
        object-fit: cover;
    }
</style>

<!-- Button Section -->


<style>
    .approve-button,
    .decline-button {
        width: 150px; /* Adjust button width as needed */
        margin-top: 20px; /* Adjust margin-top for spacing between buttons */
        margin-right: 20px; /* Adjust margin-right for spacing between buttons */
        border: 1px solid red;
    }
</style>



<?php
    } // Closing if for checking if there are rows
} // Closing if for checking if result has rows
?>



    <!-- Extra Space -->
    <div style="height: 50px;"></div>
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