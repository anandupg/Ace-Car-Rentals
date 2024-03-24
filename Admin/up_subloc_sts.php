<?php
include "../connect.php";



// Check if regi_id is provided in the URL
if (isset($_GET['subloc_id'])) {
    $subloc_id = $_GET['subloc_id'];
    $sql = "SELECT status FROM tbl_subloc WHERE subloc_id='$subloc_id'";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        // Use curly braces to wrap the code inside the while loop
        if ($row['status'] == 'Active') {
            $updateQuery = "UPDATE tbl_subloc SET status='Inactive' WHERE subloc_id='$subloc_id'";
        } else {
            $updateQuery = "UPDATE tbl_subloc SET status='Active' WHERE subloc_id='$subloc_id'";
        }

        if ($conn->query($updateQuery) === TRUE) {
            header("Location: manage_locations.php");
        } else {
            // Error message in JavaScript alert
            echo "<script>alert('Error updating user: " . $conn->error . "');</script>";
        }
    }
} else {
    // Invalid request message in JavaScript alert
    echo "<script>alert('Invalid request. No subloc_id provided.');</script>";
}

// Close the database connection
$conn->close();

// Redirect to admin dashboard after displaying alert
echo "<script>window.location.href = 'admin.php';</script>";
?>