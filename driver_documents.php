<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ace car rentals</title>
  <link rel="icon" type="image/jpeg" href="snapedit_1709139230904.jpeg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Include your CSS links here -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
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
    /* Add your custom styles here */
    /* Style for the user profile section */
    .ftco-section.bg-light {
      padding: 50px 0;
    }

    /* Style for the user profile image */
    .img-fluid.rounded-circle {
      width: 200px;
      height: 200px;
      object-fit: cover;
    }

    /* Style for the user profile information */
    .col-md-8 {
      text-align: left;
    }

    /* Style for the Edit Profile button */
    .btn-primary {
      margin-top: 10px;
    }

    .record-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 15px;
      border-radius: 5px;
      background-color: #fff;
    }

    .record {
      flex: 1 1 calc(50% - 10px);
      text-align: center;
    }

    .image-container {
      width: 100%;
      height: auto;
      max-width: 500px;
      max-height: 400px;
      overflow: hidden;
      border-radius: 5px;
      margin: 0 auto;
    }

    img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .no-records {
      text-align: center;
      margin-top: 20px;
      font-size: 18px;
      color: #808080;
    }

    .message-container {
      text-align: center;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #f8f8f8;
    }

    .error-message {
      color: red;
      font-size: 12px;
      margin-left: 10px;
    }

    .notification {
      background-color: #f8d7da;
      /* Reddish background color */
      border: 1px solid #f5c6cb;
      /* Border color */
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
      display: flex;
    }

    .notification-icon {
      font-size: 20px;
      margin-right: 10px;
    }

    .notification-content {
      flex-grow: 1;
    }
    .image-container.left {
    float: left;
    width: 50%;
}

.image-container.right {
    float: right;
    width: 50%;
}
.record {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center horizontally */
}

.image-container-wrapper {
    display: flex;
}

.image-container {
    width: 50%;
    margin: 0 10px; /* Add margin between images */
}

.image-container img {
    width: 100%; /* Ensure images take full width of their container */
}


  </style>

</head>

<body>

  <?php include "driver_navbar.php";
  $login_id=$_SESSION['login_id'];
  ?>

  <section class="" style="background-image: url('bg_img2.jpg'); height: 100px;"></section>

<?php
include "connect.php";


if ($result->num_rows > 0) {
  // User has approved documents
  $sql_select = "SELECT * FROM tbl_driver WHERE login_id = '$login_id' ;";
  $result = mysqli_query($conn, $sql_select);
  if (mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
    $lisc_img1_path = "driver_docs/" . $row['liscence_front'];
    $lisc_img2_path = "driver_docs/" . $row['liscence_back'];
    

    echo '<div class="record-container">';
    echo '<div class="record">
          
             
    <div class="record">
    <div><h2>License</h2></div>
    <div class="image-container-wrapper">
        <div class="image-container left">
            <img src="' . $lisc_img1_path . '" alt="License Image 1">
        </div>
        <div class="image-container right">
            <img src="' . $lisc_img2_path . '" alt="License Image 2">
        </div>
    </div>
</div>

          
            </div>';
    echo '</div>';
  }
} 
?>

<!-- Include your JavaScript code here -->
<!-- Your existing JavaScript code -->

</body>
</html>
