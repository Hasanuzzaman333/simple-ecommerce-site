<?php

	session_start();

	require_once('db_connect.php');

	$con = mysqli_connect( HOST, USER, PASS, DB );

	if(isset($_POST["name"]) && isset($_POST["password"]))
	{
		
		if(isset($_SESSION["nuid"]))
		{
			$sql = "update user set name='".$_POST["name"]."',password='".$_POST["password"]."',email='".$_POST["email"]."' ,address='".$_POST["address"]."',is_guest='".false ."' where id=".$_SESSION["nuid"];
			$res = mysqli_query( $con, $sql );
			$xx = $_SESSION["nuid"];
			session_destroy();
			session_start();
			$_SESSION["id"] = $xx;
			header("Location: index.php");
		}
		else{
				
			$sql = "INSERT INTO user (name,password,email,address,is_guest)VALUES('".$_POST['name']."','".$_POST['password']."','".$_POST['email']."','".$_POST['address']."','false')";

			if ($con->query($sql) === TRUE) {
				
				$id = $con->insert_id;
				//echo $id;
			}
			else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}

			$con->close();

			
			$_SESSION["id"] = $id;
			header('Location: index.php?msg="Welcome!"');
		}
	}
	else
	{
		
	}
	
	

?>