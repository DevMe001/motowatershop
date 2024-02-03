<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }
    
    function decrypt($encryptedValue, $key) {
    return openssl_decrypt(base64_decode($encryptedValue), 'aes-256-cbc', $key, 0, substr($key, 0, 16));
}

$encryptedCode = $_GET['code'];
$key = 'EMAILVERIFICATION2024';    

$decryptedCode = decrypt(urldecode($encryptedCode), $key);


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
  
<section class="form-container">
    
   <form id='resetAccount'>
       
        <div style='display:flex; flex-direction:row;gap:20px;justify-content:center;align-items:baseline;'>
              <h3>Account</h3>
              <span>(<?php echo $decryptedCode; ?>)</span>
        </div>
       <div id='showMsg' class='alert alert-info'></div>"
       <input type="hidden" name="email" value='<?php echo $decryptedCode;  ?>'>
      <input type="password" name="current" class="box" placeholder="enter curent password" required>
      <input type="password" name="new" class="box" placeholder="enter new password" required>
      <input type="submit" class="btn"  value="Submit">
   </form>

</section>
    <!-- //form section start -->



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
            
            
           $('#resetAccount').submit(function(e){
                e.preventDefault();
                
                
                const forInfo = document.getElementById('resetAccount');
                const formData = new FormData(forInfo);
            
                $.ajax({
                    url:'resets-password.php',
                    type:'POST',
                    data:formData,
                    dataType:'json',
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    success:function(res){
                        if(res.success){
                            
                      
                        Swal.fire({
                          icon: "success",
                          title: "Accepted request",
                          text:  res.message
                        });
                        
                        setTimeout(function(){
                            location.href = 'login.php'
                        },2000)
                               
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

