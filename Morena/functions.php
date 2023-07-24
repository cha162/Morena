<?php
	function connect(){
		$mysqli = new mysqli('localhost','root','','shop_db'); 
	
		if ($mysqli->connect_errno != 0){
			return $mysqli->connect_error;
		}else{
			return $mysqli;
		}
	}
	function getAllProducts(){
		$products="";
		$mysqli = connect();
		
		$res = $mysqli->query("SELECT * FROM products ORDER BY RAND()");
		while($row = $res->fetch_assoc()){
			$products = $row;			
		}
		return $products;
	}
	
	function getProductsByCategory($cake_type){
		$mysqli = connect();
		$res = $mysqli->query("SELECT * FROM products WHERE cake_type='$cake_type'");
		while($row = $res->fetch_assoc()){
			$products[] = $row;
		}
		
		return $products;
	}
