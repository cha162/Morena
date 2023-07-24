<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message sent already!';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'message sent successfully!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sweets Zone | Contact</title>
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
    <p> <a href="home.php">Home</a> / Contact Us </p>
</section>

<section class="contact">

    <form action="" method="POST">
        <h3>send us a message!</h3>
        <input type="text" name="name" placeholder="Enter your name" class="box" required> 
        <input type="email" name="email" placeholder="Enter your email" class="box" required>
        <input type="number" name="number" placeholder="Enter your number" class="box" required>
        <textarea name="message" class="box" placeholder="Enter your message" required cols="30" rows="10"></textarea>
        <input type="submit" value="SEND" name="send" class="btn">
    </form>

</section>

<section class="home-info">

	<div class="box-container">

		<div class="box">
			<i class='fas fa-map-marker-alt' style='font-size:36px'></i>
            <h3>Nueve de febrero st., Mandaluyong City, 1550</h3>
        </div>
		
		<div class="box">
		<i class='fas fa-business-time' style='font-size:36px'></i>
			<h3>Open from Monday to Sunday | 12:00PM to 8:00PM</h3>
		</div>
		
		<div class="box">
		<i class='fas fa-phone-alt' style='font-size:36px'></i>
			<h3>+123-456-7890 morenabeauty@gmail.com </h3>
		</div>
	</div>
   
</section>





<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>