<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Morena's Cosmetic Shop| Orders</title>
   <!-- icon -->
	<link rel="icon" href="images/logo.png" type="image/x-icon" />
	
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <p> <a href="home.php">Home</a> / Orders </p>
</section>

<section class="placed-orders">

    <h1 class="title">placed orders</h1>

    <div class="box-container">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="box">
        <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
        <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
        <p> Phone Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
        <p> E-mail : <span><?php echo $fetch_orders['email']; ?></span> </p>
        <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
		<p> Delivery Method : <span><?php echo $fetch_orders['delivery']; ?></span> </p>
        <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
		<p> Proof of Payment : <br><img class="image" src="uploaded_img/<?php echo $fetch_orders['proof']; ?>" alt="" style= "  height: 50rem; width: 50rem; object-fit: contain;"> </p>		
        <p> Orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
        <p> Reference Image : <br><img class="image" src="uploaded_img/<?php echo $fetch_orders['reference']; ?>" alt="No image inserted" style= "  height: 50rem; width: 50rem; object-fit: contain;"> </p>	
		<p> Notes : <span><?php echo $fetch_orders['notes']; ?></span> </p>
        <p> Total Price : <span>₱<?php echo $fetch_orders['total_price']; ?></span> </p>
        <p> Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">no orders placed yet!</p>';
    }
    ?>
    </div>

</section>







<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>