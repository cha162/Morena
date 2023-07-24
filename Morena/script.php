<?php
	require "functions.php";
	
	if(isset($_POST['cake_type'])){
		$cake_type = $_POST['cake_type'];
		
		if($cake_type === ""){
			$products = getAllProducts();
		}else{
			$products = getProductsByCategory($cake_type);

		}
		echo json_encode($products);
	} 
