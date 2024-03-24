




<?php

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass  = md5($_POST['password']);
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];

    require("connect.php");

    // Check if email already exists
    $sql_check_email = "SELECT login_id FROM tbl_login WHERE email='$email'";
    $result_check_email = $conn->query($sql_check_email);
   

    if($result_check_email->num_rows > 0 ){
        ?>
<script>document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('email-error').innerHTML = "Email Already exists";
    });</script>
<?php
       
    } else {
        // Insert login primaryrmation
        $sql_insert_login = "INSERT INTO tbl_login(email, pass, type_id) VALUES('$email', '$pass', (SELECT type_id FROM tbl_user_types WHERE type_name = 'user'))";
        $conn->query($sql_insert_login);

        // Get the login_id
        $login_id = $conn->insert_id;

        // Insert registration primaryrmation
        $sql_insert_registration = "INSERT INTO tbl_registration(login_id,fname,lname,dob, email, phone) VALUES('$login_id', '$fname', '$lname', '$dob', '$email', '$phone');";
        if($conn->query($sql_insert_registration) === TRUE){
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

</body>
<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations!",
        text: "You have successfully Registered..",
        footer: '<a href="login.php">Login here</a>',
        width: 350,
        height: 60,
    });

</script>

</html>
<?php
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}
?>