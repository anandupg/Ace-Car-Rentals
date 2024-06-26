<?php
include "../connect.php";
$login_id = $_GET['login_id'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if (isset($_GET['login_id'])) {
    $login_id = $_GET['login_id'];
    $sql1 = "SELECT email FROM tbl_login WHERE login_id='$login_id'";
    
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        while ($row1 = mysqli_fetch_array($result1)) {
            $email = $row1['email'];

            if (isset($_GET['doc_id'])) {
                $doc_id = $_GET['doc_id'];
                $sql = "SELECT status FROM tbl_documents WHERE doc_id='$doc_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
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
                            $mail->Subject = 'Documents Declined';
                            $mail->Body = '
                                <div style="max-width: 600px; margin: 0 auto; background-color: #f8f8f8; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
                                    <h2 style="text-align: left;">
                                        <span style="color: #00cc00;">Ace</span>
                                        <span style="color: #007bff;">Car Rentals</span>
                                    </h2>
                                    <h2 style="color: #ff0000; text-align: center;">Documents Declined</h2>
                                    <p style="font-size: 16px;">Hello,</p>
                                    <p style="font-size: 16px;">We regret to inform you that your submitted documents have been declined by our admin. It may be due to wrong details or wrong documents. Please review the requirements and resubmit the necessary documents. Thank you for your understanding.</p>
                                    <p style="margin-top: 20px; font-size: 14px; color: #777; text-align: center;">This is an automated message, please do not reply.</p>
                                </div>';

                            $mail->send();
                            $updateQuery = "UPDATE tbl_documents SET status='Declined' WHERE doc_id='$doc_id'";
                            if ($conn->query($updateQuery) === TRUE) {
                                header("Location: manage_documents.php");
                                exit; // Stop further execution
                            } else {
                                // Error message in JavaScript alert
                                echo "<script>alert('Error updating document status: " . $conn->error . "');</script>";
                            }
                        } catch (Exception $e) {
                            // Error handling for PHPMailer exception
                            echo "<script>alert('Error sending email: " . $e->getMessage() . "');</script>";
                        }
                    }
                } else {
                    // Invalid request message in JavaScript alert
                    echo "<script>alert('Invalid request. Document ID not found.');</script>";
                }
            } else {
                // Invalid request message in JavaScript alert
                echo "<script>alert('Invalid request. No document ID provided.');</script>";
            }
        }
    } else {
        // Invalid request message in JavaScript alert
        echo "<script>alert('Invalid request. Login ID not found.');</script>";
    }
} else {
    // Invalid request message in JavaScript alert
    echo "<script>alert('Invalid request. No login ID provided.');</script>";
}

// Close the database connection
$conn->close();
?>
