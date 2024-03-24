<?php
include "connect.php";
session_start();

if(isset($_POST['insert'])){
    $login_id = $_SESSION['login_id'];
    $lisc_no = $_POST['licenseNumber'];
    $aadhar_no = $_POST['aadharNumber'];

    $lisc_img1 = $_FILES['frontLicensePhoto']['name'];
    $target_dir = "documents_img/";
    $lisc_target_file1 = $target_dir . basename($lisc_img1);

    $lisc_img2 = $_FILES['backLicensePhoto']['name'];
    $lisc_target_file2 = $target_dir . basename($lisc_img2);

    $aadhar_img1 = $_FILES['frontAadharPhoto']['name'];
    $aadhar_target_file1 = $target_dir . basename($aadhar_img1);

    $aadhar_img2 = $_FILES['backAadharPhoto']['name'];
    $aadhar_target_file2 = $target_dir . basename($aadhar_img2);

    move_uploaded_file($_FILES['frontLicensePhoto']['tmp_name'], $lisc_target_file1);
    move_uploaded_file($_FILES['backLicensePhoto']['tmp_name'], $lisc_target_file2);
    move_uploaded_file($_FILES['frontAadharPhoto']['tmp_name'], $aadhar_target_file1);
    move_uploaded_file($_FILES['backAadharPhoto']['tmp_name'], $aadhar_target_file2);

    $sql1 = "INSERT INTO tbl_documents (login_id, lisc_no, lisc_img1, lisc_img2, aadhar_no, aadhar_img1, aadhar_img2)
    VALUES ('$login_id', '$lisc_no', '$lisc_img1', '$lisc_img2', '$aadhar_no', '$aadhar_img1', '$aadhar_img2');";

    if($conn->query($sql1) === TRUE){
        ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login error</title>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
      
    </body>
    <script>
      Swal.fire({
  icon: "success",
  title: "Submitted Successfully",
  text: "Wait till the approval of the admin",
  width : 350,
  height : 60,
}).then((result) => {
// Check if the user clicked "OK"
if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
// Redirect to login.php
window.location.replace("documents.php");
}
});

    </script>
    </html>
    <?php

    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ace car rentals</title>
  <link rel="icon" type="snapedit_1709139230904.jpeg" href="snapedit_1709139230904.jpeg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
    rel="stylesheet">

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
    /* Add this to your existing CSS file or create a new one */

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
        margin-bottom: 10px ;
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
    background-color: #f8d7da; /* Reddish background color */
    border: 1px solid #f5c6cb; /* Border color */
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

  </style>
  
</head>

<body>

  <?php include "navbar.php" ;
  $login_id=$_SESSION['login_id'];
    ?>

<section class="" style="background-image: url('bg_img2.jpg'); height: 100px;">
    </section>
<?php
include "connect.php";
$sql = "SELECT * FROM tbl_documents WHERE login_id = '$login_id' and status='Approved';";
$result=$conn->query($sql);
$sqll="SELECT * FROM tbl_documents where status='Pending';";
$resultt=$conn->query($sqll);

if($result->num_rows > 0){
    $sql_select = "SELECT * FROM tbl_documents WHERE login_id = '$login_id' AND status='Approved';";
    $result = mysqli_query($conn, $sql_select);
    
    // Check if there are any rows
    if (mysqli_num_rows($result) > 0) {
       $row = $result->fetch_assoc();
            $lisc_img1_path = "documents_img/" . $row['lisc_img1'];
            $lisc_img2_path = "documents_img/" . $row['lisc_img2'];
            $aadhar_img1_path = "documents_img/" . $row['aadhar_img1'];
            $aadhar_img2_path = "documents_img/" . $row['aadhar_img2'];
         
$sql1 = "SELECT status FROM tbl_documents WHERE login_id = '$login_id'";
$result1 = $conn->query($sql1);

if ($result1) {
    $row1 = $result1->fetch_assoc();
    $status = $row1['status'];
    
    if ($status == 'Approved') {
      echo '<br><div id="notification" class="notification" style="width:650px;margin-left:20px; opacity: 1;"><span class="notification-icon">&#x2714;</span> Your documents submission is ' . $status . '. Thank you for your cooperation</div>';
echo '<script>
setTimeout(function(){
    var notification = document.getElementById("notification");
    notification.style.transition = "opacity 1s";
    notification.style.opacity = "0";
    setTimeout(function(){
        notification.style.display = "none";
    }, 1000); // Wait for the fade-out transition to complete (1 second)
}, 5000); // 5000 milliseconds = 5 seconds
</script>';
   }
}
echo '<div class="record-container">';
echo ' <div class="record">
           <div><h2>License</h2></div>
                <div><strong>License Number:</strong> ' . $row['lisc_no'] . '</div>
                <div class="image-container"><img src="' . $lisc_img1_path . '" alt="License Image 1" style="width: 400px; height: 300px;"></div>
                <div class="image-container"><img src="' . $lisc_img2_path . '" alt="License Image 2" style="width: 400px; height: 300px;"></div>
            </div>
            <div class="record">
            <div><h2>Aadhar</h2></div>
                <div><strong>Aadhar Number:</strong> ' . $row['aadhar_no'] . '</div>
                <div class="image-container"><img src="' . $aadhar_img1_path . '" alt="Aadhar Image 1" style="width: 400px; height: 300px;"></div>
                <div class="image-container"><img src="' . $aadhar_img2_path . '" alt="Aadhar Image 2" style="width: 400px; height: 300px;"></div>
            </div>
          </div>';

    
        
    } else {
        echo '<div class="no-records">No records found</div>';
    }
     
    // Close database connection
    mysqli_close($conn);
}elseif($resultt->num_rows > 0){
 
    echo '
    <div class="message-container" style="margin-top: 5px;">
        <h4>Your submission is pending!!</h4>
        <p>Wait for the approval of Admin.</p>
        
    </div>';
}
else{
    ?>
<hr>
<section class="ftco-section bg-light">
    <div class="container">
      <?php
      $sql1="SELECT status FROM tbl_documents WHERE login_id = '$login_id'; ";
      $status=null;
      $result1 = $conn->query($sql1);
if (!$result1) {
    // Handle query error
    echo "Error: " . $conn->error;
} else {
    // Fetch data from the result set
    $row1 = $result1->fetch_assoc();
    if ($row1 === null) {
  
    } else {
        // Continue processing the data
        $status = $row1['status'];
        // Your remaining code goes here
    }
}
      if($status == 'Declined'){
        echo '<div id="notification" class="notification" style="opacity: 1;"><span class="notification-icon">&#x26A0;</span> Your Previous submission is ' . $status . '. It may be of uploaded image quality or wrong details</div><br>';
        echo '<script>
        setTimeout(function(){
            var notification = document.getElementById("notification");
            notification.style.transition = "opacity 1s";
            notification.style.opacity = "0";
            setTimeout(function(){
                notification.style.display = "none";
            }, 1000); // Wait for the fade-out transition to complete (1 second)
        }, 5000); // 5000 milliseconds = 5 seconds
        </script>';
        
      }
      ?>

        <div class="row aadhar-form">
            <div class="col-md-12">
                <h2 class="h4">License and Aadhar Information</h2>
                <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <!-- License Information -->
                    <div class="form-group">
                        <label for="licenseNumber">License Number:</label>
                        <input type="text" class="form-control" id="licenseNumber" name="licenseNumber" required>
                    </div>

                    <!-- Front Photo Upload for License -->
                    <div class="form-group">
                        <label for="frontLicensePhoto">Front Photo of License:</label>
                        <input type="file" class="form-control-file" id="frontLicensePhoto" name="frontLicensePhoto"
                            accept="image/*" onchange="validateImageType(this)">
                            <span id="frontLicensePhotoError" class="error-message"></span>
                    </div>

                    <!-- Back Photo Upload for License -->
                    <div class="form-group">
                        <label for="backLicensePhoto">Back Photo of License:</label>
                        <input type="file" class="form-control-file" id="backLicensePhoto" name="backLicensePhoto"
                            accept="image/*" onchange="validateImageType(this)">
                            <span id="backLicensePhotoError" class="error-message"></span>
                    </div>

                    <!-- Aadhar Information -->
                    <div class="form-group">
                        <label for="aadharNumber">Aadhar Number:</label>
                        <input type="number" class="form-control" id="aadharNumber" name="aadharNumber" required >
                        <small id="message" class="form-text text-muted error-message"></small>
                    </div>

                    <!-- Front Photo Upload for Aadhar -->
                    <div class="form-group">
                        <label for="frontAadharPhoto">Front Photo of Aadhar:</label>
                        <input type="file" class="form-control-file" id="frontAadharPhoto" name="frontAadharPhoto"
                            accept="image/*" onchange="validateImageType(this)" required>
                            <span id="frontAadharPhotoError" class="error-message"></span>
                    </div>

                    <!-- Back Photo Upload for Aadhar -->
                    <div class="form-group">
                        <label for="backAadharPhoto">Back Photo of Aadhar:</label>
                        <input type="file" class="form-control-file" id="backAadharPhoto" name="backAadharPhoto"
                            accept="image/*" onchange="validateImageType(this)" required>
                            <span id="backAadharPhotoError" class="error-message"></span>
                    </div>

                    <button type="submit" onclick="verify()" name="insert" class="btn btn-primary">Submit Information</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
}

?>




  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>


  

  <script type="text/javascript">
    /* multiplication table */
    const d = [
      [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
      [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
      [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
      [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
      [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
      [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
      [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
      [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
      [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
      [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
    ]

    /* permutation table */
    const p = [
      [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
      [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
      [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
      [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
      [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
      [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
      [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
      [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
    ]

    /* validates Aadhar number received as string */
    function validate(aadharNumber) {
      let c = 0
      let invertedArray = aadharNumber.split('').map(Number).reverse()

      invertedArray.forEach((val, i) => {
        c = d[c][p[(i % 8)][val]]
      })

      return (c === 0)
    }

    function verify() {
      var message = document.getElementById("message");
      var aadharNo = document.getElementById("aadharNumber").value;
      if (validate(aadharNo)) {
        message.innerHTML = '<span style="color: green;">&#10004;</span>'; // Tick icon for valid
        return true;
      } else {
        message.innerHTML = '<span style="color: red;">&#10008;</span>'; // Cross icon for invalid
        return false;
      }
    }

    // Add event listener for live verification
    document.getElementById("aadharNumber").addEventListener("input", verify);

    // Add event listener to the form for submit
    document.getElementById("myForm").addEventListener("submit", function(event) {
      if (!verify()) {
        event.preventDefault(); // Prevent form submission if Aadhar number is invalid
        alert("Aadhar number is not valid");
      }
    });

   



      
     
      function validateForm() {
        var aadharNo = document.getElementById("aadharNumber").value;
        if (!validate(aadharNo)) {
            alert("Aadhar number is not valid");
            return false; // Prevent form submission
        }
    // Aadhar number validation

    // License front photo validation
    if (!validateImage('frontLicensePhoto', 'frontLicensePhotoError')) {
        return false;
    }

    // License back photo validation
    if (!validateImage('backLicensePhoto', 'backLicensePhotoError')) {
        return false;
    }

    // Aadhar front photo validation
    if (!validateImage('frontAadharPhoto', 'frontAadharPhotoError')) {
        return false;
    }

    // Aadhar back photo validation
    if (!validateImage('backAadharPhoto', 'backAadharPhotoError')) {
        return false;
    }

    // All validations passed
    return true;
}

function validateImage(inputId, errorMessageId) {
    const input = document.getElementById(inputId);
    const errorMessage = document.getElementById(errorMessageId);

    if (input.files.length > 0) {
        const file = input.files[0];
        if (!file || !validateImageType(file)) {
            errorMessage.textContent = 'Please upload a JPEG, JPG, or PNG image.';
            return false;
        }
    } else {
        errorMessage.textContent = 'Please select an image.';
        return false;
    }

    errorMessage.textContent = ''; // Clear any previous error message
    return true;
}

function validateImageType(file) {
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    return allowedTypes.includes(file.type);
}


  </script>

</body>

</html>