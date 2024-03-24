<?php

include "connect.php";

$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';

// Your table and email column might be different
$sql = "SELECT email FROM tbl_login WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "exists";
} else {
  echo "not_registered";
}

$conn->close();
?>
