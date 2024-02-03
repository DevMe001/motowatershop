<?php

include 'config.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php @include 'header_v2.php'; ?>

<section class="home">

   <div class="content">
      <h3>Mato's Water</h3>
      <p>Equipment and Supplies Trading</p>
      <a href="about_v2.php" class="btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page_v2.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="price">₱<?php echo $fetch_products['price']; ?>/-</div>
      <?php if($fetch_products['stock'] > 9){ ?>
         <span class="notif" style="color: green;"><i class="fas fa-check"></i> in stock</span>
      <?php }elseif($fetch_products['stock'] == 0){ ?>
         <span class="notif" style="color: red;"><i class="fas fa-times"></i> out of stock</span>
      <?php }else{ ?>
         <span class="notif" style="color: red;">hurry, only <?= $fetch_products['stock']; ?> left</span>
      <?php } ?>
         <div class="stock"><?php echo $fetch_products['stock']; ?>pc/s.</div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_stock" value="<?php echo $fetch_products['stock']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <a href="login.php" class="option-btn">Add to Wishlist</a>         
         <a href="login.php" class="btn">Add to Cart</a>      
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="shop_v2.php" class="option-btn">load more...</a>
   </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>