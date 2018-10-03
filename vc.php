<?php

	session_start();
	require_once('db_connect.php');
	$con = mysqli_connect( HOST, USER, PASS, DB );
	
	echo $_GET["cart_id"];
	
	if(isset($_POST["qty"])){
		
		if(isset($_SESSION["nuid"]))
		{
			$uid = $_SESSION["nuid"];
		}
		else if(isset($_SESSION["id"]))
		{
			$uid = $_SESSION["id"];
		}
		
		
		if(isset($_GET["cart_id"])){
			$sql = "update cart set qty=".$_POST["qty"]." where id=".$_GET["cart_id"];
			$res = mysqli_query( $con, $sql );
			header("Location: viewcart.php");
		}
	}
	
?>