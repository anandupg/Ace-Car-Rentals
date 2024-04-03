<?php
include "connect.php";

if(isset($_GET['location'])) {
    $loc_id = $_GET['location'];
    $pickloc_id = $_GET['pickupLocation'];
    $dropoff_id = $_GET['dropoffLocation'];
    $pick_date = $_GET['book_pick_date'];
    $drop_date = $_GET['book_off_date'];
    $pick_time = $_GET['time_pick'];
    
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
	<style>
		/* Add this style to make the text in the navbar black */
		.navbar-dark .navbar-brand,
		.navbar-dark .navbar-nav .nav-link,
		.navbar-dark .navbar-toggler-icon {
			color: #000 !important;
		}

		/* Add this style to make the background of the dropdown menu black */
		.navbar-dark .dropdown-menu {
			background-color: #000;
		}

		/* Add this style to make the text in the dropdown menu white */
		.navbar-dark .dropdown-menu .dropdown-item {
			color: #000;
		}

		.navbar-dark .dropdown-menu {
			background-color: #fff;
		}

		/* Add this CSS to your stylesheet or in a style tag in your HTML document */
		.dropdown-menu :hover {
			background-color: #007bff !important;
			/* Change to the desired hover background color */
			color: #fff !important;
			/* Change to the desired hover text color */
		}

	
}
@media (max-width: 991.98px) {
        .navbar-collapse.collapse.show .nav-link {
            color: #fff !important;
        }
    }
	@media (max-width: 991.98px) {
        .dropdown-menu.show .dropdown-toggle {
            color: #fff !important;
        }
    }
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@flaticon/font/flaticon.css">

</head>

<body>
<?php
include "navbar.php";

?>
	
	
	<?php

include "connect.php";

// Check if the session variable is set (assuming 'login_id' is your session variable)
if(isset($_SESSION['login_id'])) {
    // Check if all relevant variables are set
    if(isset($_GET['car_id']) && isset($_GET['location']) && isset($_GET['pickupLocation']) && isset($_GET['dropoffLocation']) && isset($_GET['book_pick_date']) && isset($_GET['book_off_date']) && isset($_GET['time_pick'])) {
        // Assign values to variables
        $car_id = $_GET['car_id'];
        $loc_id = $_GET['location'];
        $pickloc_id = $_GET['pickupLocation'];
        $dropoff_id = $_GET['dropoffLocation'];
        $pick_date = $_GET['book_pick_date'];
        $drop_date = $_GET['book_off_date'];
        $pick_time = $_GET['time_pick'];

        // Output variables
        ?>
        
        <body>
            <br><br><br><br><br>
            <div class="container">
                <div class="details text-center"> <!-- Added text-center class here -->
                    <h2>Booking Details:</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Car ID:</strong> <?php echo $car_id; ?></p>
                            <p><strong>Location ID:</strong> <?php echo $loc_id; ?></p>
                            <p><strong>Pickup Location ID:</strong> <?php echo $pickloc_id; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Dropoff Location ID:</strong> <?php echo $dropoff_id; ?></p>
                            <p><strong>Pickup Date:</strong> <?php echo $pick_date; ?></p>
                            <p><strong>Dropoff Date:</strong> <?php echo $drop_date; ?></p>
                            <p><strong>Pickup Time:</strong> <?php echo $pick_time; ?></p>
                        </div>
                    </div>
                </div>
            </div>
              </body>
        <?php
        // Additional processing here if needed
    }
    // Add else statement for additional handling if necessary
} else {
    // If session is not active, show a SweetAlert and redirect to login page
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'You are not logged in!',
                text: 'Please login to continue!',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to login page
                    window.location.href = 'login.php';
                }
            });

            // Set timeout for automatic redirection after 5 seconds
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000); // 5000 milliseconds = 5 seconds
        });
    </script>
    <?php
    exit(); // Stop further execution
}
?>
    
	


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
