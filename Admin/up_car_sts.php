<?php
include "../connect.php";



// Check if regi_id is provided in the URL
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
    $sql = "SELECT status FROM tbl_cars WHERE car_id='$car_id'";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        // Use curly braces to wrap the code inside the while loop
        if ($row['status'] == 'Available') {
            $updateQuery = "UPDATE tbl_cars SET status='Not Available' WHERE car_id='$car_id'";
        } else {
            $updateQuery = "UPDATE tbl_cars SET status='Available' WHERE car_id='$car_id'";
        }

        if ($conn->query($updateQuery) === TRUE) {
            header("Location: manage_car.php");
        } else {
            // Error message in JavaScript alert
            echo "<script>alert('Error updating user: " . $conn->error . "');</script>";
        }
    }
} else {
    // Invalid request message in JavaScript alert
    echo "<script>alert('Invalid request. No car_id provided.');</script>";
}

// Close the database connection
$conn->close();

// Redirect to admin dashboard after displaying alert
echo "<script>window.location.href = 'admin.php';</script>";
?>