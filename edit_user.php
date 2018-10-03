<?php

	session_start();

	require_once('db_connect.php');

	$con = mysqli_connect( HOST, USER, PASS, DB );

	if(isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["password"]) && isset($_POST["password"]))
	{
		
		if(isset($_SESSION["id"]))
		{
				$sql = "update user set name='".$_POST["name"]."',password='".$_POST["password"]."' ,email='".$_POST["email"]."' ,address='".$_POST["address"]."' where id=".$_SESSION["id"];
				$res = mysqli_query( $con, $sql );
				
				if($res)
					header('Location: user.php?msg="Profile Edited"');
		
		}
		
	}
	else
		header("Location: user.php?msg='Fill all the field'");
	
?>