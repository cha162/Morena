<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
	$delivery = mysqli_real_escape_string($conn, $_POST['delivery']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
	// $proof = mysqli_real_escape_string($conn, $_POST['proof']);
    $address = mysqli_real_escape_string($conn, $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
	// $reference = mysqli_real_escape_string($conn, $_POST['reference']);
	$notes = mysqli_real_escape_string($conn, $_POST['notes']); 
	$placed_on = date('d-M-Y');
	
	$proof = $_FILES['proof']['name'];
	$image_size = $_FILES['proof']['size'];
	$image_tmp_name = $_FILES['proof']['tmp_name'];
	$image_folder = 'uploaded_img/'.$proof;
	
	$reference = $_FILES['reference']['name'];
	$ref_size = $_FILES['reference']['size'];
	$ref_tmp_name = $_FILES['reference']['tmp_name'];
	$ref_folder = 'uploaded_img/'.$reference;
	
	
    $cart_total = 0;
    $cart_products[] = '';
	
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND delivery = '$delivery' AND method = '$method' AND proof = '$proof' AND address = '$address' AND reference = '$reference' AND notes = '$notes' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'your cart is empty!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'order placed already!';
    }else{
        $insert_orders = mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, delivery, method, proof, address, reference, notes, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$delivery', '$method', '$proof', '$address', '$reference', '$notes', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'Order placed successfully!';
		
		if($insert_orders){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
         }
		 if($ref_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($ref_tmp_name, $ref_folder);
         }
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
   <title>Morena's Cosmetic Shop | Checkout</title>
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
    <p> <a href="home.php">Home</a> / Checkout </p>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['name'] ?> <span>(<?php echo '₱'.$fetch_cart['price'].' x '.$fetch_cart['quantity']  ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">your cart is empty</p>';
        }
    ?>
    <div class="grand-total">Total Price : <span>₱<?php echo $grand_total; ?></span></div>
</section>

<section class="home-info">

	<div class="box-container">
		<div class="box">
		<i class='fas fa-money-bill-wave' style='font-size:36px'></i>
			<h3>GCash: Ch**rl*s B***ni <br>09546578561</h3>

		</div>
		<div class="box">
		<i class='fas fa-credit-card' style='font-size:36px'></i>

            <h3>BPI: K**a P***t <br>09489357906</h3>
		</div>
	</div>
   
</section>
<section class="checkout">

    <form action="" method="POST" enctype="multipart/form-data">
		
        <h3>Personal Information for Delivery</h3>

        <div class="flex">
            <div class="inputBox">
                <span>Name :</span>
                <input type="text" name="name" placeholder="Enter your name">
            </div>
            <div class="inputBox">
                <span>Phone Number :</span>
                <input type="number" name="number" placeholder="Enter Your Number" class="box" onkeypress="if(this.value.length == 11) return false;" required>
            </div>
            <div class="inputBox">
                <span>E-mail :</span>
                <input type="email" name="email" placeholder="Enter your email">
            </div>
			<div class="inputBox">
                <span>Delivery Method :</span>
                <select name="delivery">
                    
                    <option value="Ship">Ship</option>

                </select>
            </div>
            <div class="inputBox">
                <span>Payment Method :</span>
                <select name="method">
                    <option value="Card">Credit Card</option>
                    <option value="Gcash">Gcash</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
			</div>
			<div class="inputBox">
				<span>Input Proof of Payment Image:</span>
				
				<input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="proof">
			</div>
			</div>
			
			 <h3>Shipping Address</h3>
			 
			<div class="flex">
            <div class="inputBox">
                <span>Address Line 1 :</span>
                <input type="text" name="flat" placeholder="e.g. unit no., street no.">
            </div>
            <div class="inputBox">
                <span>Address Line 2 :</span>
                <input type="text" name="street" placeholder="e.g. barangay">
            </div>
            <div class="inputBox">
                <span>City :</span>
                <input type="text" name="city" placeholder="e.g. Pasig">
            </div>
            <div class="inputBox">
                <span>Region :</span>
                <input type="text" name="state" placeholder="e.g. Metro Manila">
            </div>
            <div class="inputBox">
                <span>Country :</span>
                <!-- <input type="text" name="country" placeholder="e.g. india"> -->
				<select name="country">
                    <option value="Philippines">Philippines</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Postal Code :</span>
                <input type="number" min="0" name="pin_code" placeholder="e.g. 1234">
            </div>
			
			<div class="inputBox">
				<span>Input Image (for references):</span>
				<input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="reference">
			</div>
			<div class="inputBox">
				<span>Notes:</span>
				<textarea name="notes" required placeholder="Enter notes or instructions here..." cols="30" rows="10"></textarea>
			</div>
        </div>

        <input type="submit" name="order" value="order now" class="btn">

    </form>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>