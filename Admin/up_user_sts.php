<?php
include "../connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';


// Check if regi_id is provided in the URL
if (isset($_GET['login_id'])) {
    $login_id = $_GET['login_id'];
    $sql = "SELECT status,email FROM tbl_login WHERE login_id='$login_id'";
    
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        $email=$row['email'] ;
        // Use curly braces to wrap the code inside the while loop
        if ($row['status'] == 'Active') {

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
        $mail->Subject = 'Blocked by admin ';
        $mail->Body = '
        <div style="max-width: 600px; margin: 0 auto; background-color: #f8f8f8; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
        <h2 style="text-align: left;">
        <span style="color: #00cc00;">Ace</span>
        <span style="color: #007bff;">Car Rentals</span>
    </h2>
            <h2 style="color: #ff0000; text-align: center;">Account Blocked!</h2>
            
    
            <p style="font-size: 16px;">Hello,</p>
            
            <p style="font-size: 16px;">We regret to inform you that your account has been blocked due to some malpractices. If you believe this is a mistake or if you have any questions, please contact our support team for further assistance.</p>
            

            
            <p style="margin-top: 20px; font-size: 14px; color: #777; text-align: center;">This is an automated message, please do not reply.</p>
    
        </div>';
    

    
        $mail->send();
        $updateQuery = "UPDATE tbl_login SET status='Inactive' WHERE login_id='$login_id'";
    } catch (Exception $e) {
        if($result->num_rows > 0){
          echo '<script>alert("Incorrect username or password"); window.location.href = "manage_user.php";</script>';
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
        $mail->Subject = 'Unblocked';
        $mail->Body = '
    <div style="max-width: 600px; margin: 0 auto; background-color: #f8f8f8; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
    <h2 style="text-align: left;">
    <span style="color: #00cc00;">Ace</span>
    <span style="color: #007bff;">Car Rentals</span>
</h2>
        <h2 style="color: #00cc00; text-align: center;">Account Unblocked!</h2>
        

        <p style="font-size: 16px;">Hello,</p>
        
        <p style="font-size: 16px;">Great news! Your account has been successfully unblocked by the system administrator. You can now log in and access your account.</p>
        
       
        
        <p style="margin-top: 20px; font-size: 14px; color: #777; text-align: center;">This is an automated message, please do not reply.</p>

    </div>';



    
        $mail->send();
        $updateQuery = "UPDATE tbl_login SET status='Inactive' WHERE login_id='$login_id'";
    } catch (Exception $e) {
        if($result->num_rows > 0){
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
            $updateQuery = "UPDATE tbl_login SET status='Active' WHERE login_id='$login_id'";
        }

        if ($conn->query($updateQuery) === TRUE) {
            header("Location: manage_user.php");
        } else {
            // Error message in JavaScript alert
            echo "<script>alert('Error updating user: " . $conn->error . "');</script>";
        }
    }
} else {
    // Invalid request message in JavaScript alert
    echo "<script>alert('Invalid request. No login_id provided.');</script>";
}

// Close the database connection
$conn->close();

// Redirect to admin dashboard after displaying alert
echo "<script>window.location.href = 'admin.php';</script>";
?>