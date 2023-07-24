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
   <title>Sweets Zone | Product View</title>
<!-- icon -->
	<link rel="icon" href="images/logo.png" type="image/x-icon" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header_guest.php'; ?>

<section class="quick-view">

    <h1 class="title">product details</h1>

    <?php  
        if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
    <form action="" method="POST">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">₱ <?php echo $fetch_products['price']; ?></div>
         <div class="details"><?php echo $fetch_products['details']; ?></div>
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
        echo '<p class="empty">No product details available!</p>';
        }
    }
    ?>

    <div class="more-btn">
        <a href="shop_all_guest.php" class="option-btn">Continue Shopping</a>
    </div>

</section>






<?php @include 'footer_guest.php'; ?>

<script src="js/script.js"></script>

</body>
</html>