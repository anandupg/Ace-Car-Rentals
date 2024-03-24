<?php
include "connect.php";

if (isset($_POST['locationId'])) {
    $locationId = $_POST['locationId'];

    // Fetch pickup locations
    $sqlPickup = "SELECT * FROM tbl_subloc WHERE loc_id = '$locationId'and status='Active'";
    $resultPickup = $conn->query($sqlPickup);

    $pickupLocations = array();
    while ($row = $resultPickup->fetch_assoc()) {
        $pickupLocations[] = $row;
    }

    // Fetch drop-off locations
    $sqlDropoff = "SELECT * FROM tbl_subloc WHERE loc_id = '$locationId'and status='Active' ";
    $resultDropoff = $conn->query($sqlDropoff);

    $dropoffLocations = array();
    while ($row = $resultDropoff->fetch_assoc()) {
        $dropoffLocations[] = $row;
    }

    // Combine pickup and drop-off locations and send as a JSON response
    $response = array('pickup' => $pickupLocations, 'dropoff' => $dropoffLocations);
    echo json_encode($response);
} else {
    echo json_encode(array()); // Return an empty array if locationId is not set
}

$conn->close();
?>
