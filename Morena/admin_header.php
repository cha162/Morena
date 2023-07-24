

<header class="header">

   <div class="flex">

     
	<!-- logo -->
		<a href="home.php" class="logo"><img src="images/xoxo.png" alt="Logo" width=100 height= 100></img></a> 
		<a href="admin_page.php" class="logo"><span>Administrator | Page</span></a>
		
      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Messages</a>
      </nav>
        <!-- ADMIN NAME -->

		<p style = "font-size: 20px;"><?php 
            echo $_SESSION['admin_name'];
         ?></p>

      <div class="icons">
		
      

         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>E-mail : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>New <a href="login.php">Log in</a> | <a href="register.php">Register</a> </div>
      </div>

   </div>

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

   <?php echo $_SESSION['add_product']; ?>
   <?php echo $_SESSION['update_product']; ?>


</header>