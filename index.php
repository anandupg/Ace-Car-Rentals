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

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
// Perform logout actions here, such as destroying session, etc.

// Check if the page was accessed through browser's history
echo '<script>
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
            // Redirect the user to the login page if accessed through history
            window.location.href = "logout.php";
        }
      </script>';
?>

<style>
  .error-message {
    font-size: 9px;
    color: red;
    display: none; /* Initially hide the error messages */
    margin-top: 5px; /* Adjust as needed for spacing */
  }
</style>

</head>

<body>

	<?php include "navbar.php" ;
    ?>

	<div class="hero-wrap ftco-degree-bg" style="background-image: url('bg.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
				<div class="col-lg-8 ftco-animate">
					<div class="text w-100 text-center mb-md-5 pb-md-5">
						<h1 class="mb-4">Fast &amp; Easy Way To Rent A Car</h1>
						<p style="font-size: 18px;">Ace Car Rentals Better way to rent a car using online platforms</p>



					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-12 featured-top">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex align-items-center">
                        <form action="rent_select.php" class="request-form ftco-animate bg-primary">
                            <h2>Make your trip</h2>
                            <div class="form-group">
                                <label for="category" class="label">Your Location</label>
                                <?php
                                include "connect.php";
                                // Assuming $conn is your database connection
                                $sql2 = "SELECT * FROM tbl_location where status='Active'";
                                $result2 = $conn->query($sql2);

                                if ($result2->num_rows > 0) {
                                    echo '<select class="form-control" name="location" id="location" style="background-color: black; color: black;">';
                                    echo '<option value="" style="color: black;">Your Location</option>';

                                    while ($row = $result2->fetch_assoc()) {
                                        echo '<option value="' . $row['loc_id'] . '" style="color: black;">' . $row['loc_name'] . '</option>';
                                    }

                                    echo '</select>';
                                } else {
                                    echo '<p>No locations found.</p>';
                                }
                                ?>
								<div id="location-error" class="error-message"></div>
                            </div>

                            <div class="form-group">
    <label for="pickupLocation" class="label">Pick-up location</label>
    <select class="form-control" id="pickupLocation" name="pickupLocation">
        <!-- Options will be dynamically populated using Ajax -->
    </select>
	<div id="pickupLocation-error" class="error-message"></div>
</div>

<div class="form-group">
    <label for="dropoffLocation" class="label">Drop-off location</label>
    <select class="form-control" id="dropoffLocation" name="dropoffLocation">
        <!-- Options will be dynamically populated using Ajax -->
    </select>
	<div id="dropoffLocation-error" class="error-message"></div>
</div>

<div class="d-flex">
    <div class="form-group mr-2">
        <label for="" class="label">Pick-up date</label>
        <input type="text" class="form-control" id="book_pick_date" name="book_pick_date" placeholder="Date">
		<div id="book_pick_date-error" class="error-message"></div>
    </div>
	
    <div class="form-group ml-2">
        <label for="" class="label">Drop-off date</label>
        <input type="text" class="form-control" id="book_off_date" name="book_off_date"placeholder="Date">
		<div id="book_off_date-error" class="error-message"></div>
    </div>

</div>
								<div class="form-group">
									<label for="" class="label">Pick-up time</label>
									<input type="text" class="form-control" id="time_pick" name="time_pick" placeholder="Time">
								</div>
								<div id="time_pick-error" class="error-message"></div>
								<div class="form-group">
									<input type="submit" value="Rent A Car Now" name='rent' id='rent' class="btn btn-secondary py-3 px-4">
								</div>
							</form>
						</div>
						<div class="col-md-8 d-flex align-items-center">
							<div class="services-wrap rounded-right w-100">
								<h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
								<div class="row d-flex mb-4">
									<div class="col-md-4 d-flex align-self-stretch ftco-animate">
										<div class="services w-100 text-center">
											<div class="icon d-flex align-items-center justify-content-center"><span
													class="flaticon-route"></span></div>
											<div class="text w-100">
												<h3 class="heading mb-2">Choose Your Pickup Location</h3>
											</div>
										</div>
									</div>
									<div class="col-md-4 d-flex align-self-stretch ftco-animate">
										<div class="services w-100 text-center">
											<div class="icon d-flex align-items-center justify-content-center"><span
													class="flaticon-handshake"></span></div>
											<div class="text w-100">
												<h3 class="heading mb-2">Select the Best Deal</h3>
											</div>
										</div>
									</div>
									<div class="col-md-4 d-flex align-self-stretch ftco-animate">
										<div class="services w-100 text-center">
											<div class="icon d-flex align-items-center justify-content-center"><span
													class="flaticon-rent"></span></div>
											<div class="text w-100">
												<h3 class="heading mb-2">Reserve Your Rental Car</h3>
											</div>
										</div>
									</div>
								</div>
								<p><a href="car.php" class="btn btn-primary py-3 px-4">Choose a Car</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>

<section class="ftco-section ftco-intro" style="background-image: url('why-kei-8e2gal_GIE8-unsplash.jpg'); background-size: cover; background-position: center;">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Do You Want To Earn With Us? So Don't Be Late.</h2>
            <a href="driver_registration.php" class="btn btn-primary btn-lg">Become A Driver</a>
          </div>
				</div>
			</div>
		</section>


	<section class="ftco-section ftco-no-pt bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 heading-section text-center ftco-animate mb-5">
				<br>
					<span class="subheading">What we offer</span>
					<h2 class="mb-2">Featured Vehicles</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="carousel-car owl-carousel">
						<?php
						 require "connect.php";
						 $sql="   SELECT cars.*
        FROM tbl_cars cars
        JOIN tbl_car_category category ON cars.category_id = category.category_id
		JOIN tbl_location loc ON loc.loc_id = cars.loc_id
        WHERE category.status = 'Active' and cars.status='Available' and loc.status='Active' ORDER BY RAND() LIMIT 4";

						 $result=$conn->query($sql);
						 if($result->num_rows>0){
						   while($rows=$result->fetch_assoc()){
							?>
							<div class="item">
							<div class="car-wrap rounded ftco-animate">
								<div class="img rounded d-flex align-items-end">
								<?php
$imageFolderPath = "./Admin/productimg/"; 
$imagePath = $imageFolderPath . $rows['image'];
?>
           <a href="car-single.php?car_id=<?php echo $rows['car_id']; ?>"><img src="<?php echo $imagePath; ?>" height="230px" width="350px"></a>
								</div>
								<div class="text">
									<h2 class="mb-0"><a href="#"><?php echo $rows['model']; ?></a></h2>
									<div class="d-flex mb-3">
										<span class="cat"><?php echo $rows['company']; ?></span>
										<p class="price ml-auto">₹<?php echo $rows['rate']; ?><span>/day</span></p>
									</div>
										<p class="d-flex mb-0 d-block"> <a href="car-single.php?car_id=<?php echo $rows['car_id']; ?>" class="btn btn-secondary py-2 ml-1 w-100"><i class="fas fa-info-circle"></i> Details</a></p>
								</div>
							</div>
						</div>
							<?php
						   }
						   
						}else{
							?>
							<h6>No Cars Available Now</h6>
							<?php
						}
						 ?>
						
					</div>
				</div>
			</div>
		</div>
	</section>

	



<?php
$sql="SELECT COUNT(*) as cq FROM tbl_cars";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$count_cars=$row['cq'];

$sql2="SELECT COUNT(*) as cq FROM tbl_login WHERE type_id = 2";
$result2=$conn->query($sql2);
$row2=$result2->fetch_assoc();

$count_users=$row2['cq'];

$sql="SELECT COUNT(*) as cq FROM tbl_location";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$count_loc=$row['cq'];

$sql3="SELECT COUNT(*) as cq FROM tbl_login WHERE type_id = 3";
$result3=$conn->query($sql3);
$row3=$result3->fetch_assoc();

$count_drivers=$row3['cq'];
?>




	<section class="ftco-counter ftco-section img bg-light" id="section-counter">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
					<div class="block-18">
						<div class="text text-border d-flex align-items-center">
						<span style="margin-right:20px;">Total <br>Users</span>
							<strong class="number" data-number="<?php echo $count_users ?> ">0</strong>
							
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
					<div class="block-18">
						<div class="text text-border d-flex align-items-center">
						<span style="margin-right:20px;">Total <br>Cars</span>
							<strong class="number" data-number="<?php echo $count_cars ?> ">0</strong>
							
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
					<div class="block-18">
						<div class="text text-border d-flex align-items-center">
						<span style="margin-right:20px;">Total <br>Drivers</span>
							<strong class="number" data-number="<?php echo $count_drivers ?> ">0</strong>
							
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
					<div class="block-18">
						<div class="text d-flex align-items-center">
						<span style="margin-right:20px;">Total <br>locations</span>
							<strong class="number" data-number="<?php echo $count_loc ?>">0</strong>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include "footer.php"; ?>


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
	<script>
		$(document).ready(function () {
    // Get today's date
    var today = new Date();

    // Initialize datepicker for pick-up date
    $("#book_pick_date").datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        todayHighlight: true
    }).on('show', function (e) {
        // Set the minimum date for pick-up date to today
        $("#book_pick_date").datepicker("setStartDate", today);
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        // Set the minimum date for drop-off date to the selected pick-up date + 1 day
        minDate.setDate(minDate.getDate() + 1);
        $("#book_off_date").datepicker("setStartDate", minDate);

        // Set the maximum date for drop-off date to 2 months from the pick-up date
        var maxDate = new Date(selected.date.valueOf());
        maxDate.setMonth(maxDate.getMonth() + 2);
        $("#book_off_date").datepicker("setEndDate", maxDate);
    });

    // Initialize datepicker for drop-off date
    $("#book_off_date").datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        todayHighlight: true
    });
});

	</script>
	<script>
    $(document).ready(function () {
        // Attach an event listener to the "Your Location" dropdown for both pickup and drop-off locations
        $('#location').on('change', function () {
            var locationId = $(this).val(); // Get the selected location ID

            // Make an Ajax request to fetch both pickup and drop-off locations based on the selected location
            $.ajax({
                url: 'fetch_subloc.php', // Replace with the actual server-side script
                method: 'POST',
                data: { locationId: locationId },
                dataType: 'json',
                success: function (data) {
                    // Clear existing options and append new ones for pickup location
                    $('#pickupLocation').empty().append('<option value="" style="color: black;">Select Pick-up location</option>');
                    // Clear existing options and append new ones for drop-off location
                    $('#dropoffLocation').empty().append('<option value="" style="color: black;">Select Drop-off location</option>');

                    $.each(data.pickup, function (key, value) {
                        $('#pickupLocation').append('<option value="' + value.subloc_id + '" style="color: black;">' + value.subloc_name + '</option>');
                    });

                    $.each(data.dropoff, function (key, value) {
                        $('#dropoffLocation').append('<option value="' + value.subloc_id + '" style="color: black;">' + value.subloc_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

	document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector(".request-form");
    addInputEventListeners();
    form.addEventListener("submit", function (event) {
        var location = document.getElementById("location").value;
        var pickupLocation = document.getElementById("pickupLocation").value;
        var dropoffLocation = document.getElementById("dropoffLocation").value;
        var pickDate = document.getElementById("book_pick_date").value;
        var dropDate = document.getElementById("book_off_date").value;
        var pickTime = document.getElementById("time_pick").value;

        // Reset previous error messages
        resetErrorMessages();

        // Validate Your Location
        if (location === "") {
            showError("location", "Please select your location.");
            event.preventDefault();
            return;
        }

        // Validate Pick-up Location
        if (pickupLocation === "") {
            showError("pickupLocation", "Please select pick-up location.");
            event.preventDefault();
            return;
        }

        // Validate Drop-off Location
        if (dropoffLocation === "") {
            showError("dropoffLocation", "Please select drop-off location.");
            event.preventDefault();
            return;
        }

        // Validate Pick-up Date
        if (pickDate === "") {
            showError("book_pick_date", "Please enter pick-up date.");
            event.preventDefault();
            return;
        }

        // Validate Drop-off Date
        if (dropDate === "") {
            showError("book_off_date", "Please enter drop-off date.");
            event.preventDefault();
            return;
        }

        // Validate Pick-up Time
        if (pickTime === "") {
            showError("time_pick", "Please enter pick-up time.");
            event.preventDefault();
            return;
        }
    });

    function showError(fieldId, message) {
        var errorDiv = document.getElementById(`${fieldId}-error`);
        errorDiv.innerHTML = message;
        errorDiv.style.display = "block";
    }

    function resetErrorMessages() {
        var errorDivs = document.querySelectorAll(".error-message");
        errorDivs.forEach(function (errorDiv) {
            errorDiv.innerHTML = "";
            errorDiv.style.display = "none";
        });
    }

    function addInputEventListeners() {
        var inputFields = form.querySelectorAll("input, select");
        inputFields.forEach(function (field) {
            field.addEventListener("input", function () {
                var fieldId = field.id;
                var errorDiv = document.getElementById(`${fieldId}-error`);
                errorDiv.innerHTML = ""; // Clear the error message on input
                errorDiv.style.display = "none";
            });
        });
    }
});

	
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Include Bootstrap JS (optional, if not already included) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>