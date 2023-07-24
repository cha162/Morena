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

<header class="header">

    <div class="flex">

	<!-- logo -->
		<a href="home.php" class="logo"><img src="images/xoxo.png" alt="Logo" width=100 height= 100></img></a>
		
	<!-- navigation-->	
        <nav class="navbar">
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>				
				<li><a>SHOP <i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li><a href="shop.php">PRODUCTS</a></li>
                        
                    </ul>
                </li>
				<li><a href="orders.php">ORDERS</a></li>
				<li><a href="contact.php">CONTACT US</a></li>
            </ul>
        </nav>


	<!-- navigation with icons (fa: font awesome)-->	
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
     
			<!-- cart -->   
		   <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
		
			<!-- user -->  
			<div id="user-btn" class="fas fa-user"></div>
			
			
        </div>
        <div class="account-box">
			
            <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
			
            <a href="logout.php" class="delete-btn">LOG OUT</a>
        </div>
		
    </div>

</header>