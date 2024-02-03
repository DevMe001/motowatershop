<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }
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
    
   <form id='regForm'>
       
      <h3>💦 Register now 💦</h3>
       <div id='showMsg' class='alert alert-info'></div>"
      <input type="text" name="name" class="box" placeholder="enter your username" required>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
      <span>choose picture :</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png"required>
        <p><input type="checkbox" id="toggle"required/> You have read and agree to our <a href="data_privacy_v3.php" target="_blank">(Data privacy).</a></p>
      <input type="submit" class="btn"  value="register now">
      <p>Already have an account? <a href="login.php">Login now</a></p>
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
            
            
           $('#regForm').submit(function(e){
                e.preventDefault();
                
                
                const forInfo = document.getElementById('regForm');
                const formData = new FormData(forInfo);
            
                $.ajax({
                    url:'registration.php',
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
                                    code:res.code,
                                    reset:false
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

