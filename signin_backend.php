<?php

	session_start();
	
	/*if(isset($_SESSION["nuid"]))
		session_destroy();*/

	//


function updateSession($loggedId , $guestId) {

    echo $loggedId ."  ".$guestId ;





    $_SESSION["nuid"]=NULL;


    require_once('db_connect.php');
    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "UPDATE cart SET user_id = ".$loggedId." WHERE user_id = ".$guestId;
    $res = mysqli_query( $con, $sql );

    $con->close();







}

///
	
	
	require_once('db_connect.php');

	$con = mysqli_connect( HOST, USER, PASS, DB );

	if(isset($_POST["email"]) && isset($_POST["password"]))
	{
		$sql = "SELECT id,email,password FROM user";
		$res = mysqli_query( $con, $sql );
		
		while($row = $res->fetch_assoc()) {
			
			if($row["email"] == $_POST["email"] && $row["password"] == $_POST["password"])
			{
				$con->close();
	
			//	session_start();
				$_SESSION["id"] = $row["id"];

                updateSession($_SESSION["id"] ,$_SESSION["nuid"]);


				
				
			}
			
				
			
		}
	    
	}
	else
	{
		header('Location: index.php?msg="Fill all the field"');
	}
	
	if(isset($_SESSION["id"]))
	{
		header('Location: index.php?msg="Welcome!"');
				
	}
	else
	{
		header('Location: index.php?msg="Wrong email or password"');
	}
	
	
	
?>