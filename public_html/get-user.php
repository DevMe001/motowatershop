<?php

include 'config.php';

// Get code from POST data
$postmail = $_POST['email'];
// Escape the code to prevent SQL injection
$email = mysqli_real_escape_string($conn, $postmail);

// Prepare SELECT query
$selectQuery = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $selectQuery);

// Check if any row is returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the first row
    $row = mysqli_fetch_assoc($result);

    echo json_encode(array('success' => true, 'email' => $email, 'message' => 'Account verification has been successfully completed'));
} else {
    echo json_encode(array('success' => false, 'data' => [], 'message' => 'Invalid email'));
}

?>
