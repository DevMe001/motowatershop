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

if(!empty($update_image)){
    if($update_image_size > 2000000){
       $message[] = 'image is too large';
    }else{
       $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
       if($image_update_query){
          move_uploaded_file($update_image_tmp_name, $update_image_folder);
       }
       $message[] = 'image updated succssfully!';
    }
 }

?>

<header class="header">

    <div class="flex">

        <a href="home.php" class="logo">💦 Matos Water</a>

        <nav class="navbar">
            <ul>
                <li><a href="index.php"> home</a></li>
                <li><a href="#"> pages ▼</a>
                    <ul>
                        <li><a href="about_v2.php"> about</a></li>
                        <li><a href="contact_v2.php"> contact</a></li>
                        <li><a href="data_privacy_v2.php"> data privacy</a></li>
                    </ul>
                </li>
                <li><a href="shop_v2.php"> shop</a></li>
                <li><a href="#"> account ▼</a>
                    <ul>
                        <li><a href="login.php"> login</a></li>
                        <li><a href="register.php"> register</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            

        <div class="account-box">
            <a href="login.php" class="btn">login</a>
            <a href="register.php" class="delete-btn">register</a>
        </div>

    </div>

</header>