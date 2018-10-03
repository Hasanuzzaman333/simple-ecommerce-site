<?php

	session_start();
	require_once('db_connect.php');
	$con = mysqli_connect( HOST, USER, PASS, DB );
	
	
	if(isset($_SESSION["id"])){
		$sql = "delete from user where id=".$_SESSION["id"];
		$res = mysqli_query( $con, $sql );
		session_destroy();
		header("Location: index.php");
	}

	
?>