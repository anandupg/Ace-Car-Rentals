<?php
include "../connect.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
if (isset($_GET['driver_id'])) {
    $driver_id = $_GET['driver_id'];
    $sql1 = "SELECT fname,email FROM tbl_driver WHERE driver_id='$driver_id'";
    
    $result1 = $conn->query($sql1);

    while ($row1 = mysqli_fetch_array($result1)) {
        $email=$row1['email'] ;
        $name=$row1['fname'];
        $randomNumber = rand(0, 9); // Generate a random number between 0 and 9
$pass = ucfirst($name) . '@' . $randomNumber; // Concatenate the random number with the rest of the password string
$password = md5($pass); // Hash the password using MD5

if (isset($_GET['driver_id'])) {
    $driver_id = $_GET['driver_id'];
    $sql = "SELECT status FROM tbl_driver WHERE driver_id='$driver_id'";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        // Use curly braces to wrap the code inside the while loop
        if ($row['status'] == 'Pending') {
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth   = true;               // Enable SMTP authentication
                $mail->Username   = 'acecarrentalss@gmail.com'; // SMTP username
                $mail->Password   = 'fjhe jbdi inzz nmhp';    // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
        
                // Recipients
                $mail->setFrom('acecarrentalss@gmail.com', 'Ace Car Rentals');
                $mail->addAddress($email); // Add a recipient, using the email from the form
        
                // Content
                $mail->isHTML(true);
                $declineReason = "Wrong information provided or incorrect documents uploaded";

                $mail->Subject = 'Driver Request Declined';
                $mail->Body = '
                <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
                    <h2 style="color: #007bff; text-align: center; margin-bottom: 20px;">Driver Request Declined</h2>
                
                    <p style="font-size: 16px;">Hello,</p>
                
                    <p style="font-size: 16px;">We regret to inform you that your driver request has been declined by our administration team.</p>
                
                    <p style="font-size: 16px;">Reason for decline: '.$declineReason.'</p>
                
                    <p style="font-size: 16px;">If you have any questions or concerns regarding this decision, please feel free to contact us.</p>
                
                    <p style="font-size: 16px;">Thank you for considering Ace Car Rentals.</p>
                
                    <p style="margin-top: 20px; font-size: 14px; color: #777; text-align: center;">This is an automated message, please do not reply.</p>
                </div>';
                
            
                $mail->send();
                $updateQuery = "UPDATE tbl_driver SET status='Declined' WHERE driver_id='$driver_id'";
            } catch (Exception $e) {
                if($result1->num_rows > 0){
                    ?>
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title></title>
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    </head>
                    <body>
                      
                    </body>
                    <script>
                      Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Please connect to internet",
          width: 350,
          height: 60,
        }).then((result) => {
          // Check if the user clicked "OK"
          if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
            // Redirect to login.php
            window.location.replace("admin.php");
          }
        });
                
                    </script>
                    </html>
                    <?php
                }
              }
           
               
        
           
        }
        else {
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth   = true;               // Enable SMTP authentication
                $mail->Username   = 'acecarrentalss@gmail.com'; // SMTP username
                $mail->Password   = 'fjhe jbdi inzz nmhp';    // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
        
                // Recipients
                $mail->setFrom('acecarrentalss@gmail.com', 'Ace Car Rentals');
                $mail->addAddress($email); // Add a recipient, using the email from the form
        
                // Content
                $mail->isHTML(true);
                $declineReason = "Wrong information provided or incorrect documents uploaded";

                $mail->Subject = 'Driver Request Declined';
                $mail->Body = '
                <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
                    <h2 style="color: #007bff; text-align: center; margin-bottom: 20px;">Driver Request Declined</h2>
                
                    <p style="font-size: 16px;">Hello,</p>
                
                    <p style="font-size: 16px;">We regret to inform you that your driver request has been declined by our administration team.</p>
                
                    <p style="font-size: 16px;">Reason for decline: '.$declineReason.'</p>
                
                    <p style="font-size: 16px;">If you have any questions or concerns regarding this decision, please feel free to contact us.</p>
                
                    <p style="font-size: 16px;">Thank you for considering Ace Car Rentals.</p>
                
                    <p style="margin-top: 20px; font-size: 14px; color: #777; text-align: center;">This is an automated message, please do not reply.</p>
                </div>';
                
            
                $mail->send();
                $updateQuery = "UPDATE tbl_driver SET status='Declined' WHERE driver_id='$driver_id'";
            } catch (Exception $e) {
                if($result1->num_rows > 0){
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
          icon: "error",
          title: "Oops...",
          text: "Please connect to internet",
          width: 350,
          height: 60,
        }).then((result) => {
          // Check if the user clicked "OK"
          if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
            // Redirect to login.php
            window.location.replace("admin.php");
          }
        });
                
                    </script>
                    </html>
                    <?php
                }
              }
           
        }

        if ($conn->query($updateQuery) === TRUE ) {
            header("Location: driver.php");
        } else {
            // Error message in JavaScript alert
            echo "<script>alert('Error updating driver: " . $conn->error . "');</script>";
        }
    }
} else {
    // Invalid request message in JavaScript alert
    echo "<script>alert('Invalid request. No driver_id provided.');</script>";
}
    }
} else {
    // Invalid request message in JavaScript alert
    echo "<script>alert('Invalid request. No driver_id provided.');</script>";
}
// Close the database connection
$conn->close();

// Redirect to admin dashboard after displaying alert
echo "<script>window.location.href = 'admin.php';</script>";
?>
