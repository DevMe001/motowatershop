<?php

include 'config.php';

// Get code from POST data
$email = $_POST['email'];
$currentPassword = $_POST['current'];
$newPassword = $_POST['new'];



// Escape the code to prevent SQL injection
$sanitinizeEmail = mysqli_real_escape_string($conn, $email);
$sanitizeCurrent = mysqli_real_escape_string($conn, $currentPassword);
$sanitizeNew = mysqli_real_escape_string($conn, $newPassword);

// Prepare SELECT query
$selectQuery = "SELECT * FROM users WHERE email = '$sanitinizeEmail'";
$result = mysqli_query($conn, $selectQuery);

// Check if any row is returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the first row
    $row = mysqli_fetch_assoc($result);
    

    
    
     // verify current password
     
        if(password_verify($sanitizeCurrent,$row['password'])){
        // update the password to new password 
    
            // Update email_verified field
            $newPasswordCode = password_hash($sanitizeNew,PASSWORD_BCRYPT);
            $email = $row['email'];
            $updateQuery = "UPDATE users SET password='$newPasswordCode'  WHERE email = '$email'";
            
             // Execute UPDATE query
            if (mysqli_query($conn, $updateQuery)) {
                
                echo json_encode(array('success' => true,  'message' => 'Account has been reset successfully'));
            } else {
                echo json_encode(array('success' => false,  'message' => 'Failed to reset'));
            }
                    
        }else{
             echo json_encode(array('success' => false,  'message' => 'Failed to reset,Invalid credential'));
        }
        
} else {
    echo json_encode(array('success' => false,  'message' => 'Invalid account'));
}

?>
