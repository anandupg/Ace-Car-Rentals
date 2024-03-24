<?php
require_once "connect.php";

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $sql = "SELECT email FROM tbl_driver WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<span style='color: red; font-size: 10px;'>A driver with same email exists.Please try using another email.</span>";
    }
    else{
        echo "";
    }
}
?> 