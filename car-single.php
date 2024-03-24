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
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['login_id'])) {
    $login_id = $_SESSION['login_id'];
    require_once "connect.php";

    // Use prepared statement to avoid SQL injection
    $sql = "SELECT reg_id FROM tbl_registration WHERE login_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $login_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $reg_id = $row['reg_id'];

        // Use prepared statement to avoid SQL injection
        $sql1 = "SELECT fname FROM tbl_registration WHERE reg_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $reg_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $name = $row1['fname'];

        } else {
            // Handle the case when no records are found for reg_id
            echo "Error: No records found for reg_id.";
        }

        $stmt1->close();
    } else {
    
    }

    $stmt->close();


$conn->close();
?>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">ACE <span>Car Rentals</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-link scrollto active"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-link scrollto active"><a href="car.php" class="nav-link">Cars</a></li>
                <li class="nav-link scrollto active"><a href="mybookings.php" class="nav-link">My Bookings</a></li>
                <li class="nav-link scrollto active"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-link scrollto active"><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
            <div class="dropdown">
                <button class="btn bg-transparent dropdown-toggle navbar-brand" style="text-transform: none; font-weight: normal" onclick="showDropdown()" type="button" id="dropdownMenuButton" data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false" class="nav-item">
                    <img src="whitebg_user.png" alt="Account Image" style="width: 20px; height: 20px;">
                    <?php echo isset($name) ? $name : ''; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0" id="myDropdown" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item " href="account.php">Account <img src="642902-200.png" alt="Account Image" style="width: 20px; height: 20px;"></a></li>
                    <li><a class="dropdown-item" href="documents.php">Documents <img src="Daco_755096.png" alt="Account Image" style="width: 20px; height: 20px;"></a></li>
                    <li><a class="dropdown-item " href="logout.php">Logout <img src="126467.png" alt="Logout Image" style="width: 20px; height: 20px;"></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php
}else {
    $current_page = basename($_SERVER['PHP_SELF']);
    function isActive($page, $current_page) {
        return ($page == $current_page) ? 'active' : '';
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">ACE <span>Car Rentals</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo isActive('index.php', $current_page); ?>"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item <?php echo isActive('car.php', $current_page); ?>"><a href="car.php" class="nav-link">Cars</a></li>
                <li class="nav-item <?php echo isActive('about.php', $current_page); ?>"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item <?php echo isActive('contact.php', $current_page); ?>"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item <?php echo isActive('login.php', $current_page); ?>"><a href="login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php

}
?>


	<?php
require "connect.php";
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
    $sql = "SELECT * FROM tbl_cars WHERE car_id='$car_id'";
    $result = $conn->query($sql);
	$row=$result->fetch_assoc();
}
	?>
<section class="ftco-car-details mt-0">
    <div class="container">
        <div class="row">
            <div class="col">
               <div class="car-details">
			   <div class="img rounded d-flex align-items-end mb-0" style="height: 550px;">
							<?php
$imageFolderPath = "./Admin/productimg/"; 
$imagePath = $imageFolderPath . $row['image'];
?>					<div class="container">
				<div class="row justify-content-center ">
	<div class="col-mt-0px px-0 ">
		<img src="<?php echo $imagePath; ?>" class="img-fluid " alt="Image" style="max-height: 600px; width: 800px; height: 1300;">
	</div>
</div>
</div>


						</div>
						<div class="text text-center">
							<span class="subheading">
								<?php echo $row['company'] ?>
							</span>
							<h2>
								<?php echo $row['model'] ?>
							</h2>
							<span class="subheading">
								<?php echo $row['variant'] ?>
							</span>
						</div>
					</div>
				</div>
			</div><br>
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
	
    // Output the button HTML
    echo '<div class="text-center">
            <p class="d-flex mb-0 d-block text-center">'
			?>
               <a href="rent.php?car_id=<?php echo $car_id; ?>&location=<?php echo $loc_id; ?>&pickupLocation=<?php echo $pickloc_id; ?>&dropoffLocation=<?php echo $dropoff_id; ?>&book_pick_date=<?php echo $pick_date; ?>&book_off_date=<?php echo $drop_date; ?>&time_pick=<?php echo $pick_time; ?>" class="btn btn-primary btn-block py-3" style="color: white; border-radius: 30px;">Book Now</a>

            <?php echo'</p>
        </div>';
}
?>
			
			<div class="row">
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-dashboard"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Mileage
										<span>
											<?php echo $row['mileage'] ?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-pistons"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Transmission
										<span>
											<?php echo $row['transmission_type'] ?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-car-seat"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Seats
										<span>
											<?php echo $row['seat'] ?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-car"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Rate
										<span>
											<?php echo $row['rate'] ?>/day
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-diesel"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Fuel
										<span>
											<?php echo $row['fuel_type'] ?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="padding-left:80px;">
				
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								

								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Reg No
										<span>
											<?php echo $row['reg_no'] ?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Colour
										<span>
											<?php echo $row['colour'] ?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Year
										<span>
											<?php echo $row['year'] ?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				 </div>
				 <div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Category
										<span>
										<?php
											$cat_id=$row['category_id'];
											$sql2="SELECT * FROM tbl_car_category WHERE category_id='$cat_id'";
											$result2 = $conn->query($sql2);
											$row2=$result2->fetch_assoc();
											echo $row2['category_name'];
											?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Location
										<span>
											<?php
											$loc_id=$row['loc_id'];
											$sql1="SELECT * FROM tbl_location WHERE loc_id='$loc_id'";
											$result1 = $conn->query($sql1);
											$row1=$result1->fetch_assoc();
											echo $row1['loc_name'];
											?>
										</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>


			<div class="row">
				<div class="col-md-12 pills">
					<div class="bd-example bd-example-tabs">
						<div class="d-flex justify-content-center">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

								<!-- <li class="nav-item">
									<a class="nav-link active" id="pills-description-tab" data-toggle="pill"
										href="#pills-description" role="tab" aria-controls="pills-description"
										aria-expanded="true">Features</a>
								</li> -->

								<li class="nav-item">
									<a class="nav-link active" id="pills-review-tab" data-toggle="pill" href="#pills-review"
										role="tab" aria-controls="pills-review" aria-expanded="true">Review</a>
								</li>
							</ul>
						</div>

						<div class="tab-content" id="pills-tabContent">
							<!-- <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
								aria-labelledby="pills-description-tab">
								<div class="row">
									<div class="col-md-4">
										<ul class="features">
											<li class="check"><span class="ion-ios-checkmark"></span>Airconditions</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Child Seat</li>
											<li class="check"><span class="ion-ios-checkmark"></span>GPS</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Luggage</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Music</li>
										</ul>
									</div>
									<div class="col-md-4">
										<ul class="features">
											<li class="check"><span class="ion-ios-checkmark"></span>Seat Belt</li>
											<li class="remove"><span class="ion-ios-close"></span>Sleeping Bed</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Water</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Bluetooth</li>
											<li class="remove"><span class="ion-ios-close"></span>Onboard computer</li>
										</ul>
									</div>
									<div class="col-md-4">
										<ul class="features">
											<li class="check"><span class="ion-ios-checkmark"></span>Audio input</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Long Term Trips
											</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Car Kit</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Remote central
												locking</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Climate control
											</li>
										</ul>
									</div>
								</div>
							</div> -->



							<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
        <div class="row">
            <div class="col-md-7">
                <h3 class="head">23 Reviews</h3>
                <div class="review d-flex">
                    <div class="user-img" style="background-image: url(images/person_1.jpg)">
                    </div>
                    <div class="desc">
                        <h4>
													<span class="text-left">Jacob Webb</span>
													<span class="text-right">14 March 2018</span>
												</h4>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
													</span>
													<span class="text-right"><a href="#" class="reply"><i
																class="icon-reply"></i></a></span>
												</p>
												<p>When she reached the first hills of the Italic Mountains, she had a
													last view back on the skyline of her hometown Bookmarksgrov</p>
											</div>
										</div>
										<div class="review d-flex">
											<div class="user-img" style="background-image: url(images/person_2.jpg)">
											</div>
											<div class="desc">
												<h4>
													<span class="text-left">Jacob Webb</span>
													<span class="text-right">14 March 2018</span>
												</h4>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
													</span>
													<span class="text-right"><a href="#" class="reply"><i
																class="icon-reply"></i></a></span>
												</p>
												<p>When she reached the first hills of the Italic Mountains, she had a
													last view back on the skyline of her hometown Bookmarksgrov</p>
											</div>
										</div>
										<div class="review d-flex">
											<div class="user-img" style="background-image: url(images/person_3.jpg)">
											</div>
											<div class="desc">
												<h4>
													<span class="text-left">Jacob Webb</span>
													<span class="text-right">14 March 2018</span>
												</h4>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
													</span>
													<span class="text-right"><a href="#" class="reply"><i
																class="icon-reply"></i></a></span>
												</p>
												<p>When she reached the first hills of the Italic Mountains, she had a
													last view back on the skyline of her hometown Bookmarksgrov</p>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="rating-wrap">
											<h3 class="head">Give a Review</h3>
											<div class="wrap">
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(98%)
													</span>
													<span>20 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(85%)
													</span>
													<span>10 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(70%)
													</span>
													<span>5 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(10%)
													</span>
													<span>0 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(0%)
													</span>
													<span>0 Reviews</span>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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
					$sql3 = "SELECT cars.*
					FROM tbl_cars cars
					JOIN tbl_car_category category ON cars.category_id = category.category_id
					JOIN tbl_location loc ON loc.loc_id = cars.loc_id
					WHERE category.status = 'Active' AND loc.status = 'Active' AND cars.status = 'Available' AND loc.loc_id = $loc_id AND cars.car_id <> " . $row['car_id'] . "
					ORDER BY RAND() LIMIT 4";
		   

		   

                    $result3 = $conn->query($sql3);
                    if ($result3->num_rows > 0) {
                        while ($rows3 = $result3->fetch_assoc()) {
                            ?>
                            <div class="item">
                                <div class="car-wrap rounded ftco-animate">
                                    <div class="img rounded d-flex align-items-end">
                                        <?php
                                        $imageFolderPath = "./Admin/productimg/";
                                        $imagePath = $imageFolderPath . $rows3['image'];
                                        ?>
                                       <a href="car-single.php?car_id=<?php echo $rows3['car_id']; ?>"><img src="<?php echo $imagePath; ?>" height="230px" width="350px"></a>
                                    </div>
                                    <div class="text">
                                        <h2 class="mb-0"><a href="car-single.php?car_id=<?php echo $rows3['car_id']; ?>"><?php echo $rows3['model']; ?></a></h2>
                                        <div class="d-flex mb-3">
                                            <span class="cat"><?php echo $rows3['company']; ?></span>
                                            <p class="price ml-auto">₹<?php echo $rows3['rate']; ?><span>/day</span></p>
                                        </div>
                                        <p class="d-flex mb-0 d-block">  <a href="car-single.php?car_id=<?php echo $rows3['car_id']; ?>" class="btn btn-secondary py-2 ml-1 w-100"><i class="fas fa-info-circle"></i> Details</a></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <h6>No Cars Available at this location</h6>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
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