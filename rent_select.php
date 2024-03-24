<?php
include "connect.php";
if(isset($_GET['location'])) {
$loc_id=$_GET['location'];
$pickloc_id=$_GET['pickupLocation'];
$dropoff_id=$_GET['dropoffLocation'];
$pick_date=$_GET['book_pick_date'];
$drop_date=$_GET['book_off_date'];
$pick_time=$_GET['time_pick'];
$next_page_url = "car-single.php?location=$loc_id&pickupLocation=$pickloc_id&dropoffLocation=$dropoff_id&book_pick_date=$pick_date&book_off_date=$drop_date&time_pick=$pick_time";

    

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ace car rentals</title>
    <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include "navbar.php" ;
    ?>

    <section class="" style="background-image: url('bg_img2.jpg'); height: 100px;">
    </section>


    <p style="text-align: center;margin-top:30px;margin-bottom:30px;">Available cars according to your selection</p>


    <section class="ftco-section bg-light">
        <div class="container">

            <div class="row">
                <?php
        require "connect.php";
        $sql = "SELECT cars.*
        FROM tbl_cars cars
        JOIN tbl_car_category category ON cars.category_id = category.category_id
        WHERE category.status = 'Active' AND cars.loc_id = '$loc_id' AND cars.status='Available';";

        $result=$conn->query($sql);
        if($result->num_rows>0){
          while($rows=$result->fetch_assoc()){
            ?>
                <div class="col-md-4">
                    <div class="car-wrap rounded ftco-animate">
                        <div class="img rounded d-flex align-items-end">
                            <?php
$imageFolderPath = "./Admin/productimg/"; 
$imagePath = $imageFolderPath . $rows['image'];
?>
                            <a href="car-single.php?car_id=<?php echo $rows['car_id']; ?>&location=<?php echo $loc_id; ?>&pickupLocation=<?php echo $pickloc_id; ?>&dropoffLocation=<?php echo $dropoff_id; ?>&book_pick_date=<?php echo $pick_date; ?>&book_off_date=<?php echo $drop_date; ?>&time_pick=<?php echo $pick_time; ?>"><img
                                    src="<?php echo $imagePath; ?>" height="230px" width="350px"></a>
                        </div>
                        <div class="text">
                            <h2 class="mb-0"><a href="car-single.php?car_id=<?php echo $rows['car_id']; ?>&location=<?php echo $loc_id; ?>&pickupLocation=<?php echo $pickloc_id; ?>&dropoffLocation=<?php echo $dropoff_id; ?>&book_pick_date=<?php echo $pick_date; ?>&book_off_date=<?php echo $drop_date; ?>&time_pick=<?php echo $pick_time; ?>">
                                    <?php echo $rows['model']; ?>
                                </a></h2>
                            <div class="d-flex mb-3">
                                <span class="cat">
                                    <?php echo $rows['company']; ?>
                                </span>
                                <p class="price ml-auto">₹
                                    <?php echo $rows['rate']; ?> <span>/day</span>
                                </p>

                            </div>
                            <p class="d-flex mb-0 d-block align-items-center">
    <a href="car-single.php?car_id=<?php echo $rows['car_id']; ?>&location=<?php echo $loc_id; ?>&pickupLocation=<?php echo $pickloc_id; ?>&dropoffLocation=<?php echo $dropoff_id; ?>&book_pick_date=<?php echo $pick_date; ?>&book_off_date=<?php echo $drop_date; ?>&time_pick=<?php echo $pick_time; ?>" class="btn btn-secondary py-2 mr-1"><i class="fas fa-info-circle"></i> Details</a>

    <?php
    include "connect.php";

    // Check if $loc_id exists
    if(isset($loc_id) && isset($_GET['pickupLocation']) && isset($_GET['dropoffLocation']) && isset($_GET['book_pick_date']) && isset($_GET['book_off_date']) && isset($_GET['time_pick'])) {
        $loc_id =  $_GET['location'];
        $pickloc_id = $_GET['pickupLocation'];
        $dropoff_id = $_GET['dropoffLocation'];
        $pick_date = $_GET['book_pick_date'];
        $drop_date = $_GET['book_off_date'];
        $pick_time = $_GET['time_pick'];
        $next_page_url = "rent.php?location=$loc_id&pickupLocation=$pickloc_id&dropoffLocation=$dropoff_id&book_pick_date=$pick_date&book_off_date=$drop_date&time_pick=$pick_time";
?>
       <a href="rent.php?car_id=<?php echo $rows['car_id']; ?>&location=<?php echo $loc_id; ?>&pickupLocation=<?php echo $pickloc_id; ?>&dropoffLocation=<?php echo $dropoff_id; ?>&book_pick_date=<?php echo $pick_date; ?>&book_off_date=<?php echo $drop_date; ?>&time_pick=<?php echo $pick_time; ?>" class="btn btn-primary py-2 ml-1" style="color: white; ">Book Now</a>
       <?php

    }
    ?>
</p>


                        </div>
                    </div>
                </div>
                <?php
          }
        }else{
          echo "No Cars Available at this location now!! ";
        }
        ?>
            </div>


            <!-- <div class="row mt-5">
        <div class="col text-center">
          <div class="block-27">
            <ul>
              <li><a href="#">&lt;</a></li>
              <li class="active"><span>1</span></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&gt;</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div> -->

    </section>






    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

</body>

</html>