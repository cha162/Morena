<?php

@include 'config.php';

session_start();

	
// add to cart
if(isset($_POST['add_to_cart'])){
	header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>MORENA'S COSMETIC SHOP</title>
	<!-- icon -->
	<link rel="icon" href="images/xoxo.png" type="image/x-icon" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header_guest.php'; ?>

<section class="home">

   <div class="content">
      <h3>a beauty that you deserve</h3>
      <p>To meet everyone's wants and desires for beauty in all of its infinite variety, it is our objective and duty to provide the best in beauty to every individual</p>
      <a href="about_guest.php" class="btn">learn more!</a>
   </div>

</section>

<section class="products">

   <h1 class="title">Featured Products</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page_guest.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="price">₱<?php echo $fetch_products['price']; ?></div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">SHOP NOW</a>
   </div>

</section>

<section class="home-info">

	<div class="box-container">

		<div class="box">
			<i class='fas fa-truck' style='font-size:36px'></i>
            <h3>Ship to your address</h3>
        </div>
		
		<div class="box">
		<i class='fas fa-store' style='font-size:36px'></i>
			<h3>Nueve de febrero st., Mandaluyong City, 1550</h3>
		</div>
		
		<div class="box">
		<i class='fas fa-money-bill-wave' style='font-size:36px'></i>
			<h3>Pay using GCash, Cash on Delivery or online banking</h3>
		</div>
	</div>
   
</section>

<section class="home-contact">

   <div class="content">
      <h3>Message us!</h3>
      <p>Do you have any questions or inquiries? Send us a message!</p>
      <a href="contact.php" class="btn">CONTACT US</a>
   </div>

</section>




<?php @include 'footer_guest.php'; ?>

<script src="js/script.js"></script>

</body>
</html>