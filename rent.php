<?php
session_start(); // Start the session

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
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Rent Details</title>
            <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    background-image: url('bg.jpg'); /* Specify the path to your background image */
                    background-size: cover;
                    background-position: center;
                }
                .details {
                    background-color: #f9f9f9;
                    padding: 20px;
                    border-radius: 5px;
                    margin-bottom: 20px;
                }
                .details h2 {
                    margin-top: 0;
                }
                .details p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <div class="details">
                <h2>Booking Details:</h2>
                <p><strong>Car ID:</strong> <?php echo $car_id; ?></p>
                <p><strong>Location ID:</strong> <?php echo $loc_id; ?></p>
                <p><strong>Pickup Location ID:</strong> <?php echo $pickloc_id; ?></p>
                <p><strong>Dropoff Location ID:</strong> <?php echo $dropoff_id; ?></p>
                <p><strong>Pickup Date:</strong> <?php echo $pick_date; ?></p>
                <p><strong>Dropoff Date:</strong> <?php echo $drop_date; ?></p>
                <p><strong>Pickup Time:</strong> <?php echo $pick_time; ?></p>
            </div>
        </body>
        </html>
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
