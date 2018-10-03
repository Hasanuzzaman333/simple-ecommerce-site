<?php
		
			
		require_once('db_connect.php');

		$con = mysqli_connect( HOST, USER, PASS, DB );
		
		session_start();
		
		if(isset($_SESSION["id"]))
		{
		
		
			if(isset($_GET["id"]))
			{
				$sql ="select * from cart where item_id=".$_GET["id"]." and user_id=".$_SESSION["id"];
				$res = mysqli_query( $con, $sql);
				$row_cnt = $res->num_rows;
				
				
				if ($row_cnt) {
					
					//echo $row["count"];
					if(isset($_GET["cat_id"]) && isset($_GET["cat_name"])){
						header("Location: item.php?id=".$_GET["cat_id"]."&cat_name=".$_GET["cat_name"]."&msg=Already added");
					}
					else{
						header("Location: item_detail.php?id=".$_GET["id"]."&msg=Already added");
					}
					$con->close();
				}
				else{
					
								
				
				
					if(isset($_SESSION["id"]))
					{
						$sql = "INSERT INTO cart (item_id,qty,user_id)VALUES(".$_GET["id"].",".$_POST["qty"].",".$_SESSION["id"].")";

					if ($con->query($sql) === TRUE) {
						//
						if(isset($_GET["cat_id"]) && isset($_GET["cat_name"])){
							header("Location: item.php?id=".$_GET["cat_id"]."&cat_name=".$_GET["cat_name"]."&msg=Added%20to%20cart");
						}
						else{
							header("Location: item_detail.php?id=".$_GET["id"]."&msg=Added%20to%20cart");
						}
					}
					else {
						echo "Error: " . $sql . "<br>" . $con->error;
					}

					$con->close();
				
				
					
					}
				}
			}
		}
		else {	
			if(!isset($_SESSION["nuid"])){
				
				
				$sql = "INSERT INTO user (is_guest)VALUES(true)";

				if ($con->query($sql) === TRUE) {
					
					$uid = $con->insert_id;
					//echo $id;
				}
				else {
					echo "Error: " . $sql . "<br>" . $con->error;
				}

				
				
				
				$_SESSION["nuid"] = $uid;
				//header("Location: index.php");  
			
			}
			
			
			if(isset($_GET["id"]) && $_SESSION["nuid"])
			{
				$sql ="select * from cart where item_id=".$_GET["id"]." and user_id=".$_SESSION["nuid"];
				$res = mysqli_query( $con, $sql);
				$row_cnt = $res->num_rows;
				
				
					if ($row_cnt) {
						
						//echo $row["count"];
						
						if(isset($_GET["cat_id"]) && isset($_GET["cat_name"])){
							header("Location: item.php?id=".$_GET["cat_id"]."&cat_name=".$_GET["cat_name"]."&msg=Already%20Added");
						}
						else{
							header("Location: item_detail.php?id=".$_GET["id"]."&msg=Already%20Added");
						}
						
						$con->close();
					}
				
				
				if(isset($_SESSION["nuid"]))
				{
					$sql = "INSERT INTO cart (item_id,qty,user_id)VALUES(".$_GET["id"].",".$_POST["qty"].",".$_SESSION["nuid"].")";

					if ($con->query($sql) == TRUE) {
						
						if(isset($_GET["cat_id"]) && isset($_GET["cat_name"])){
							header("Location: item.php?id=".$_GET["cat_id"]."&cat_name=".$_GET["cat_name"]."&msg=Added%20to%20cart");
						}
						else{
							header("Location: item_detail.php?id=".$_GET["id"]."&msg=Added%20to%20cart");
						}
					}
					else {
						echo "Error: " . $sql . "<br>" . $con->error;
					}

					$con->close();
			
		
				}
				
				
				
			}
			
		}
	
	
	

?>