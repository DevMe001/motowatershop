<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function encrypt($value, $key) {
    return base64_encode(openssl_encrypt($value, 'aes-256-cbc', $key, 0, substr($key, 0, 16)));
}

$email_setup = json_decode(trim(file_get_contents("php://input")));

try {
    $mail->isSMTP();
    $mail->Host = 'sg2plzcpnl503747.prod.sin2.secureserver.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'ajbcrisologo5@matoswater.shop';
    $mail->Password = 'rpcshwtfjjpwstyd';
    $mail->SMTPSecure = 'ssl'; // Enable SSL encryption
    $mail->Port = 465; // Set the SMTP port for the GoDaddy server

    $mail->setFrom('ajbcrisologo5@matoswater.shop', 'MotWaterShop'); // Use the same email address as Username
    $mail->addAddress($email_setup->email, 'New User');
    $mail->addReplyTo($email_setup->email, 'MotoWaterShop');

    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'No reply';
    
    $value = $email_setup->code; // Original value to encrypt
    $key = 'EMAILVERIFICATION2024';   
    $reset = $email_setup->reset;
    $encryptedValue = encrypt($value, $key);
    
    $body = '';
    $msg = '';
    
    if($reset){
         $msg = 'We\'ve sent a reset link to your email address';
        $body = 'Here is the reset link <b><a href="http://matoswater.shop/forgot.php?code='.urlencode($encryptedValue).'">Reset now</a></b>';
    }else{
         $msg = 'We\'ve sent a verification link to your email address';
        $body = 'Here is the verification link <b><a href="http://matoswater.shop/code-verification.php?code='.urlencode($encryptedValue).'">Click here to verify</a></b>';
    }

    // Construct the verification link with the hashed code parameter
    $mail->Body = $body;
    $mail->send();
    echo  $msg;

    // echo json_encode(['message' => 'We\'ve sent a verification link to your email address']); // Output success message

} catch (Exception $e) {
    echo json_encode(['message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]); // Output error message
}
?>
