<?php
include "../connect.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
if (isset($_GET['login_id'])) {
    $login_id = $_GET['login_id'];
    $sql1 = "SELECT email FROM tbl_login WHERE login_id='$login_id'";
    
    $result1 = $conn->query($sql1);

    while ($row1 = mysqli_fetch_array($result1)) {
        $email=$row1['email'] ;

if (isset($_GET['doc_id'])) {
    $doc_id = $_GET['doc_id'];
    $sql = "SELECT status FROM tbl_documents WHERE doc_id='$doc_id'";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        // Use curly braces to wrap the code inside the while loop
        if ($row['status'] == 'Approved') {
            $updateQuery = "UPDATE tbl_documents SET status='Declined' WHERE doc_id='$doc_id'";
               
        } elseif($row['status'] == 'Pending'){
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
                $mail->Subject = 'Documents Approved';
$mail->Body = '
<div style="max-width: 600px; margin: 0 auto; background-color: #f8f8f8; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
    <h2 style="text-align: left;">
        <span style="color: #00cc00;">Ace</span>
        <span style="color: #007bff;">Car Rentals</span>
    </h2>
    <h2 style="color: #007bff; text-align: center;">Documents Approved!</h2>

    <p style="font-size: 16px;">Hello,</p>

    <p style="font-size: 16px;">We are pleased to inform you that your submitted documents have been approved by our admin. You can now rent cars. Thank you for your cooperation.</p>

    <p style="margin-top: 20px; font-size: 14px; color: #777; text-align: center;">This is an automated message, please do not reply.</p>
</div>';

            
        
            
                $mail->send();
                $updateQuery = "UPDATE tbl_documents SET status='Approved' WHERE doc_id='$doc_id'";
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
        else {
            $updateQuery = "UPDATE tbl_documents SET status='Approved' WHERE doc_id='$doc_id'";
        }

        if ($conn->query($updateQuery) === TRUE) {
            header("Location: manage_documents.php");
        } else {
            // Error message in JavaScript alert
            echo "<script>alert('Error updating user: " . $conn->error . "');</script>";
        }
    }
} else {
    // Invalid request message in JavaScript alert
    echo "<script>alert('Invalid request. No doc_id provided.');</script>";
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
