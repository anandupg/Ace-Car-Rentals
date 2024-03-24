<?php
$conn = new mysqli('localhost', 'root', '', 'db_car_rental');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

?>