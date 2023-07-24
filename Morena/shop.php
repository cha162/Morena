<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

// add to cart
if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

	
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Morena's Cosmetic Shop</title>
	<!-- icon -->
	<link rel="icon" href="images/xoxo.png" type="image/x-icon" />
	
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <p> <a href="home.php">Home</a> / Shop / Products </p>
</section>
<section class="products">

   <h1 class="title">Products</h1>
   <h2 class="title-2"> Foundation </h2>
   <div class="box-container">

   <?php
    function displayProductsByCategory($conn, $category) {
    $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE `cake_type` = '$category'") or die('query failed');

    if(mysqli_num_rows($select_products) > 0){
        while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="POST" class="box">
                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
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
    } else {
        echo '<p class="empty">No products added yet in this category!</p>';
    }
}

// Assuming $category contains the desired category name or ID
$category = 'Foundation';
displayProductsByCategory($conn, $category);
?>

</div>


<h2 class="title-2"> Concealer </h2>
<div class="box-container">
    <?php
        $category = 'Concealer';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Loose Powder </h2>
<div class="box-container">
    <?php
        $category = 'Loose Powder';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Highlights </h2>
<div class="box-container">
    <?php
        $category = 'Highlights';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Blush </h2>
<div class="box-container">
    <?php
        $category = 'Blush';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Lipstick </h2>
<div class="box-container">
    <?php
        $category = 'Lipstick';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Bronzer </h2>
<div class="box-container">
    <?php
        $category = 'Bronzer';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Eyeshadow </h2>
<div class="box-container">
    <?php
        $category = 'Eyeshadow';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Eyebrows </h2>
<div class="box-container">
    <?php
        $category = 'Eyebrows';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Day and Night Mascara </h2>
<div class="box-container">
    <?php
        $category = 'Day and Night Mascara';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Setting Spray </h2>
<div class="box-container">
    <?php
        $category = 'Setting Spray';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Sunscreen </h2>
<div class="box-container">
    <?php
        $category = 'Sunscreen';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Moisturizer and Primer </h2>
<div class="box-container">
    <?php
        $category = 'Moisturizer and Primer';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Body Scrub </h2>
<div class="box-container">
    <?php
        $category = 'Body Scrub';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Facial Cleanser </h2>
<div class="box-container">
    <?php
        $category = 'Facial Cleanser';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Shampoo and Conditioner </h2>
<div class="box-container">
    <?php
        $category = 'Shampoo and Conditioner';
        displayProductsByCategory($conn, $category);
    ?>


</div>
<h2 class="title-2"> Cosmetics Tools </h2>
<div class="box-container">
    <?php
        $category = 'Cosmetics Tools';
        displayProductsByCategory($conn, $category);
    ?>


</div>


</section>






<?php @include 'footer_guest.php'; ?>

<script src="js/script.js"></script>

</body>
</html>