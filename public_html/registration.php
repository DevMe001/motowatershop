<?php

    include 'config.php';
        
        
 

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, password_hash($_POST['password'],PASSWORD_BCRYPT));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        
        
    
        $code = mysqli_real_escape_string($conn, md5(rand()));
        $code = rand(999999, 111111);

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
             $getMsg = "$email - This email address has been already exists";
             echo json_encode(array('success' => false,'message' => $getMsg));
           
        } else {
            if ($_POST['password'] == $_POST['confirm-password']) {
                $sql = "INSERT INTO users (name, email, password, code) VALUES ('{$name}', '{$email}', '{$password}', '{$code}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                   echo json_encode(array('success' => true,'message' => 'Registration valid','email' => $email,'code' => $code));
                } else {
                    echo json_encode(array('success' => false,'message' => 'Something wrong went'));
                }
            } else {
                 echo json_encode(array('success' => false,'message' => 'Password and Confirm Password do not match'));
            }
        }
?>
