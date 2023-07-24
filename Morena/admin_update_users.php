<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_users'])){

   $update_u_id = $_POST['update_u_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
	
   mysqli_query($conn, "UPDATE `users` SET name = '$name', email = '$email', user_type = '$user_type' WHERE id = '$update_u_id'") or die('query failed');


   $message[] = 'User updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Morena's Cosmetic Shop - Admin| Update Users</title>
	<!-- icon -->
	<link rel="icon" href="images/logo.png" type="image/x-icon" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>
  <h1 class="title" style = "margin-top: 22px;">Update users account</h1>
<section class="update-product">

<?php

   $update_id = $_GET['update'];
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$update_id'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      while($fetch_users = mysqli_fetch_assoc($select_users)){
?>

<form action="" method="post" enctype="multipart/form-data">
   
   <input type="hidden" value="<?php echo $fetch_users['id']; ?>" name="update_u_id">
   <input type="text" class="box" value="<?php echo $fetch_users['name']; ?>" required placeholder="Update username" name="name">
   <input type="text" class="box" value="<?php echo $fetch_users['email']; ?>" required placeholder="Update email" name="email">
  
   <select class="box" name="user_type">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>					
    </select>
  
   <input type="submit" value="Update User" name="update_users" class="btn">
   <a href="admin_users.php" class="option-btn">Go Back</a>
</form>

<?php
      }
   }else{
      echo '<p class="empty">No update user selected</p>';
   }
?>

</section>






<script src="js/admin_script.js"></script>

</body>
</html>