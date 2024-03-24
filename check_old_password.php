<?php
session_start(); // Start the session if not started already
include "connect.php";

// Retrieve the inputted email and password
if(isset($_SESSION['login_id']) && isset($_POST['oldpassword'])) {
    $login_id = $_SESSION['login_id'];
    $oldPassword = md5($_POST['oldpassword']);

    // Prepare and execute a SQL statement to fetch the hashed password from the database
    $sql = "SELECT pass FROM tbl_login WHERE login_id = ? AND type_id = ?";
    $stmt = $conn->prepare($sql);
    if($stmt) {
        $type_id = 2; // Assuming type_id = 1 is correct, change if necessary
        $stmt->bind_param("si", $login_id, $type_id); 
        $stmt->execute();
        
        // Check for errors
        if($stmt->error) {
            echo "Error: " . $stmt->error;
        } else {
            $result = $stmt->get_result();

            // Check if a row was returned
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $dbPassword = $row['pass'];

                // Compare the inputted password with the one from the database
                if ($oldPassword == $dbPassword) {
                    echo "match";
                } else {
                    echo "nomatch";
                }
            } else {
                // No user found with the provided login ID
                echo "nomatch";
            }
        }
        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Missing login ID or password.";
}
?>
