<?php
require_once "connect.php";

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $sql = "SELECT email FROM tbl_login WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<span style='color: red; font-size: 10px;'>Email Already exists.Please try using another email.</span>";
    }
    else{
        echo "";
    }
}
?> 