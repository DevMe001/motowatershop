<?php

include 'config.php';

// Get code from POST data
$getcode = $_POST['code'][0] . $_POST['code'][1] . $_POST['code'][2] . $_POST['code'][3] . $_POST['code'][4] . $_POST['code'][5];

// Escape the code to prevent SQL injection
$code = mysqli_real_escape_string($conn, $getcode);

// Prepare SELECT query
$selectQuery = "SELECT * FROM users WHERE code = '$code'";
$result = mysqli_query($conn, $selectQuery);

// Check if any row is returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the first row
    $row = mysqli_fetch_assoc($result);
    
    // Update email_verified field
    $updateQuery = "UPDATE users SET email_verified = 1 WHERE email = '{$row['email']}'";

    // Execute UPDATE query
    if (mysqli_query($conn, $updateQuery)) {
        echo json_encode(array('success' => true, 'data' => $row, 'message' => 'Account verification has been successfully completed'));
    } else {
        echo json_encode(array('success' => false, 'data' => [], 'message' => 'Failed to update email verification status'));
    }
} else {
    echo json_encode(array('success' => false, 'data' => [], 'message' => 'Invalid otp code'));
}

?>
