<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->

<?php

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'config.php';
$msg = "";




?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Forgot Password</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

<section class="form-container">

   <form id='forgotPassword' >
        <div class="img">
        <img src="images/Matos-logo.png" alt="">
        </div>
      <h3>Forgot Password<h3>
      <p>Please fill up the box.</p>
        <div id='showMsg' class='alert alert-info'></div>
      <input type="email" class="box" name="email" placeholder="Enter Your Email" required>
        <button name="submit" class="btn" type="submit">Send Reset Link</button>
    </form>

    <p>Back to! <a href="index.php">Login</a>.</p>

</section>

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
            
            
           $('#forgotPassword').submit(function(e){
                e.preventDefault();
                
                
                const forInfo = document.getElementById('forgotPassword');
                const formData = new FormData(forInfo);
            
                $.ajax({
                    url:'get-user.php',
                    type:'POST',
                    data:formData,
                    dataType:'json',
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    success:function(res){
                        if(res.success){
                            
                                const resData = {
                                    email:res.email,
                                    code:res.email,
                                    reset:true
                                }
                                $.ajax({
                                    url:'mail-setup.php',
                                    type:'POST',
                                    data:JSON.stringify(resData),
                                    processData: false,
                                    contentType: false,
                                    async: false,
                                    cache: false,
                                    success:function(res){
                                       
                                       if(res){
                                           $('#showMsg').text(res);
                                            Swal.fire({
                                              icon: "success",
                                              title: "Accepted request",
                                              text:  res
                                            });
                                       }
                                    }
                                });
                        }else{
                               Swal.fire({
                              icon: "error",
                              title: "Oops...",
                              text:  res.message
                            });
                        }
                    },
                    error:function(err){
                        Swal.fire({
                      icon: "error",
                      title: "Oops...",
                      text: "Something went wrong!" + JSON.stringify(err),
                      footer: '<a href="#">Why do I have this issue?</a>'
                    });
                                        }
                });
                    
                
            });
        });
</script>


