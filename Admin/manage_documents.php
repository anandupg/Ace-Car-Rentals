<?php
include "../connect.php";
$sql = "SELECT * FROM tbl_registration";
$result = $conn->query($sql);



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
            <a href="manage_rentals.php" class="nav-item nav-link text-white"><i class="fas fa-car-side"></i> Rentals</a>
            <a href="manage_documents.php" class="nav-item nav-link active text-white"><i class="fas fa-file-alt"></i> Documents</a>
            <a href="manage_payments.php" class="nav-item nav-link text-white"><i class="fas fa-credit-card"></i> Payments</a>
            <a href="manage_review.php" class="nav-item nav-link text-white"><i class="fa fa-tachometer-alt me-2"></i> Reviews</a>
        </div>
    </nav>
</div>


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
$sql_pending = "SELECT * FROM tbl_documents WHERE status='Pending';";
$result_pending = $conn->query($sql_pending);
?>

<?php if ($result_pending && $result_pending->num_rows > 0): ?>
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-secondary rounded p-4">
                <form method="POST" action="" id="carDetailsForm">
                    <h6 class="mb-4">Documents Pending Table</h6>
                    <div class="table-responsive">
                        <table class="table table custom-table" style="color: white;">
                            <thead>
                                <tr>
                                    <th scope="col">Doc Id</th>
                                    <th scope="col">Login Id</th>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Actions</th> 
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row2 = $result_pending->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row2['doc_id'] . "</td>";
                                echo "<td>" . $row2['login_id'] . "</td>";

                                $login_id = $row2['login_id'];
                                $sql_registration = "SELECT * FROM tbl_registration WHERE login_id=$login_id";
                                $registration_result = $conn->query($sql_registration);

                                if ($registration_result && $registration_result->num_rows > 0) {
                                    $row = $registration_result->fetch_assoc();
                                    echo "<td>" . $row['fname'] . "</td>";
                                    echo "<td>" . $row['lname'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                }
                                echo "<td>" . $row2['status'] . "</td>";
                                if ($row2['status'] == 'Approved') {
                                    echo "<td><a class='btn btn-sm btn-outline-danger' style='border-color: red;' href='up_doc_sts.php?doc_id={$row2['doc_id']}' onclick='return confirmDecline()'>Decline</a></td>";
                                } elseif($row2['status'] == 'Pending' || $row2['status'] == 'Not Approved') {
                                    echo "<td><a class='btn btn-sm btn-success' href='up_doc_sts.php?doc_id={$row2['doc_id']}&login_id={$row['login_id']}'><i class='fas fa-check'></i> Approve</a></td>";
                                    echo "<td><a class='btn btn-sm btn-outline-danger' href='up_docdec_sts.php?doc_id={$row2['doc_id']}&login_id={$row['login_id']}' onclick='return confirmDecline()' style='border-color: red; '><i class='fas fa-times'></i> Decline</a></td>";
                                } else {
                                    echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='up_doc_sts.php?doc_id={$row2['doc_id']}'>Approve</a></td>";
                                }
                                echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='view_documents.php?doc_id={$row2['doc_id']}&regi_id={$row['reg_id']}'>View Documents</a></td>";
 
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
$sql_pending = "SELECT * FROM tbl_documents WHERE status='Approved';";
$result_pending = $conn->query($sql_pending);
?>
<?php if ($result_pending && $result_pending->num_rows > 0): ?>
                        <div class="container-fluid pt-4 px-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-secondary rounded p-4">
                                        <form method="POST" action="" id="carDetailsForm">
                                            <h6 class="mb-4">Documents Approved Table</h6>
                                            <div class="table-responsive">
                                                <table class="table table custom-table" style="color: white;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Doc Id</th>
                                                            <th scope="col">Login Id</th>
                                                            <th scope="col">First name</th>
                                                            <th scope="col">Last name</th>
                                                           <th scope="col">Email</th>
                                                              <th scope="col">Status</th>
                                                           
                                                            <!-- <th scope="col" class="text-center">Actions</th>  -->
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php


$sql3 = "SELECT * FROM tbl_documents WHERE status='Approved';";
$result3 = $conn->query($sql3);

// Check if both queries executed successfully
if ($result && $result3) {
   
    // Loop through the result set of tbl_documents
    while ($row3 = $result3->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row3['doc_id'] . "</td>";
        echo "<td>" . $row3['login_id'] . "</td>";

        // Retrieve data from tbl_registration based on login_id
        $login_id = $row3['login_id'];
        $sql_registration = "SELECT * FROM tbl_registration WHERE login_id=$login_id";
        $registration_result = $conn->query($sql_registration);

        if ($registration_result && $registration_result->num_rows > 0) {
            $row = $registration_result->fetch_assoc();
            echo "<td>" . $row['fname'] . "</td>";
            echo "<td>" . $row['lname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
           
        }
         echo "<td>" . $row3['status'] . "</td>";
        // if ($row3['status'] == 'Approved') {
        //     echo "<td><a class='btn btn-sm btn-outline-danger' href='up_docdec_sts.php?doc_id={$row3['doc_id']}&login_id={$row3['login_id']}' onclick='return confirmDecline()' style='border-color: red; '><i class='fas fa-times'></i> Decline</a></td>";
        // } else{
        //     echo "fefs";
        // }     
        echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='view_documents.php?doc_id={$row3['doc_id']}&regi_id={$row['reg_id']}&login_id={$row['login_id']}'>View Documents</a></td>"; 
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . $conn->error;
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
$sql_pending = "SELECT * FROM tbl_documents WHERE status='Declined';";
$result_pending = $conn->query($sql_pending);
?>
<?php if ($result_pending && $result_pending->num_rows > 0): ?>
                        <div class="container-fluid pt-4 px-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-secondary rounded p-4">
                                        <form method="POST" action="" id="carDetailsForm">
                                            <h6 class="mb-4">Documents Declined Table</h6>
                                            <div class="table-responsive">
                                                <table class="table table custom-table" style="color: white;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Doc Id</th>
                                                            <th scope="col">Login Id</th>
                                                            <th scope="col">First name</th>
                                                            <th scope="col">Last name</th>
                                                           <th scope="col">Email</th>
                                                              <th scope="col">Status</th>
                                                         
                                                              
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
;

$sql2 = "SELECT * FROM tbl_documents WHERE status='Declined';";
$result2 = $conn->query($sql2);

// Check if both queries executed successfully
if ($result && $result2) {
   
    // Loop through the result set of tbl_documents
    while ($row2 = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row2['doc_id'] . "</td>";
        echo "<td>" . $row2['login_id'] . "</td>";

        // Retrieve data from tbl_registration based on login_id
        $login_id = $row2['login_id'];
        $sql_registration = "SELECT * FROM tbl_registration WHERE login_id=$login_id";
        $registration_result = $conn->query($sql_registration);

        if ($registration_result && $registration_result->num_rows > 0) {
            $row = $registration_result->fetch_assoc();
            echo "<td>" . $row['fname'] . "</td>";
            echo "<td>" . $row['lname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
           
        }
        echo "<td>" . $row2['status'] . "</td>";
            
        echo "<td><a class='btn btn-sm btn-outline-success' style='border-color: red;' href='view_documents.php?doc_id={$row2['doc_id']}&regi_id={$row['reg_id']}'>View Documents</a></td>";  
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . $conn->error;
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
    function confirmDecline() {
        return confirm("Are you sure you want to decline?");
    }
</script>

  
</body>

</html>