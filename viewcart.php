
<?php
	session_start();
	
	
	require_once('db_connect.php');
	$con = mysqli_connect( HOST, USER, PASS, DB );
	
	if( isset($_GET["msg"]))
	{
		echo "<script type='text/javascript'>alert('".$_GET["msg"]."');</script>";
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Buy It</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
  
  <!--for viwe cart-->
    <style>
	  .modal-header, h4, .close {
		  background-color: #5cb85c;
		  color:white !important;
		  text-align: center;
		  font-size: 30px;
	  }
	  .modal-footer {
		  background-color: #f9f9f9;
	  }
  </style>
  
  
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><img src="logo.png" height="25px"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
		
		<li>
		
			<a class="dropdown" class="dropdown-toggle" data-toggle="dropdown">Categories
			  <span class="caret"></span>
			  <ul class="dropdown-menu">
				<?php

					$sql = "SELECT * FROM Category";
					$res = mysqli_query( $con, $sql );

					while($row = $res->fetch_assoc()) {
						echo "<li><a href='item.php?id=".$row["id"]."&cat_name=".$row["cat_name"]."' >". $row["cat_name"]."</a></li>";
					}
				?>
			  </ul>
			</a>
		
		</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  
		<?php
			if( isset($_SESSION["id"]))
			{
				$res = mysqli_query( $con, "SELECT name FROM user WHERE id = ".$_SESSION["id"] );
				$row = $res->fetch_assoc();
				echo '<li><a href="user.php"><span class="glyphicon glyphicon-user"></span> '.$row["name"].'</a></li>';
				echo '<li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>';
			}
			else{
				echo '<li><a id="signin" href="#signin"><span class="glyphicon glyphicon-log-in"></span> Signin</a></li>';
				echo '<li><a id="signup" href="#signup"><span class="glyphicon glyphicon-user"></span> Signup</a></li>';
			}
		?>
        <li><a href="viewcart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<!--cart view-->
<div class="container">
	<div class='row'> 
		
	<?php

		require_once('db_connect.php');
		$con = mysqli_connect( HOST, USER, PASS, DB );
		
		if(isset($_SESSION["id"]) || isset($_SESSION["nuid"]))
		{
			if(isset($_SESSION["id"]))
				$uid = $_SESSION["id"];
			
			else if(isset($_SESSION["nuid"]))
				$uid = $_SESSION["nuid"];
			
			$sql = "select item.price,cart.id as cid,item.name,item_id as iid,user_id,qty from cart join item where cart.user_id=".$uid." and cart.item_id = item.id";
			$res = mysqli_query( $con, $sql );
			
			if($res){
				$row_cnt = $res->num_rows;
						
						echo '<div class="form-group">';
						while($row = $res->fetch_assoc()) {
																					
							echo "<div class='col col-md-4 col-sm-6'>";
								echo "<div>";
									echo "<ul class='list-group'>";
										echo "<li class='list-group-item list-group-item-success'>";
											echo "<h3>".$row['name']."</h3>";
											echo "<form method='POST' >";
											echo "<label for='".$row["qty"]."'>Quantity<input class='form-control' type='number' min='1' max='100' name='qty' id='".$row["qty"]."' value='".$row["qty"]."'></label></br>";
											
											echo "<p>price: ".$row["price"] * $row["qty"]. " $</p>";
											echo "<button class='btn btn-info' type='submit' name='cart' formaction='vc.php?qty=".$row["qty"]."&cart_id=".$row["cid"]."'>Update</button>";
											echo "<button class='btn btn-danger' value='Add to Cart' type='submit' name='delete' formaction='vcdelete.php?cart_id=".$row["cid"]."'>Remove</button>";
											echo "</form>";
										echo "</li>";
									echo "</ul>";
								echo "</div>";
							echo "</div>";
							
							
						}
						
					echo "<form method='POST' >";
					echo '<div class="row">';
					echo '<div class=" col col-lg-12 text-center" >';
					
						if($row_cnt > 0){
							
							
								echo "</br><button class='btn btn-primary' type='submit' name='order' formaction='order.php' style='margin-bottom: 5px;'>Checkout</button>";

								require_once ("mySuperClass.php");
								if(!isRegistered())
                                showAlert("Please sign in or sign up to check out");
						}
						else{
							echo '<h2>Cart is Empty</h2>';
						}
					echo '</div>';echo '</div>';
				echo "</form>";
			}
			else{
				echo "Error retrieving data.";
			}
		}
		else
			echo "<div class='col col-md-4 col-sm-6'> <h2>Cart is Empty</h2> </div>";
	?>

	</div>
</div>


<!--modal signin-->
		
		<div class="container">
		  <!-- Modal -->
		  <div class="modal fade" id="myModal1" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header" style="padding:35px 50px;">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4><span class="glyphicon "></span> Signin</h4>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
				  <form role="form" action="signin_backend.php" method="POST">
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
					  <input type="text" class="form-control" name="email" placeholder="Enter email" required>
					</div>
					<div class="form-group">
					  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					  <input type="password" name="password" class="form-control" id="psw" placeholder="Enter password" required>
					</div>
					
					  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon "></span> Signin</button>
				  </form>
				</div>
				<div class="modal-footer">
				  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				  
				</div>
			  </div>
			  
			</div>
		  </div> 
		</div>
		 
		<script>
		$(document).ready(function(){
			$("#signin").click(function(){
				$("#myModal1").modal();
			});
		});
		</script>
		
		
		<!--modal signin-->
		
		<div class="container">
		  <!-- Modal -->
		  <div class="modal fade" id="myModal2" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header" style="padding:35px 50px;">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4><span class="glyphicon "></span> Signup</h4>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
				  <form role="form" action="signup_backend.php" method="POST">
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
					  <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
					</div>
					<div class="form-group">
					  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					  <input type="password" name="password" class="form-control" id="psw" placeholder="Enter password" required>
					</div>
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Email</label>
					  <input type="text" class="form-control" name="email" placeholder="Enter Name" required>
					</div>
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-home"></span> Address</label>
					  <input type="text" class="form-control" name="address" placeholder="Enter Address" required>
					</div>
					
					  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon "></span> Signup</button>
				  </form>
				</div>
				<div class="modal-footer">
				  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				  
				</div>
			  </div>
			  
			</div>
		  </div> 
		</div>
		 		
		
		<script>
		$(document).ready(function(){
			$("#signup").click(function(){
				$("#myModal2").modal();
			});
		});
		</script>



<footer class="container-fluid text-center"> 
  <span class="glyphicon glyphicon-registration-mark"> All Rights Reserved</span>
</footer>

</body>
</html>
