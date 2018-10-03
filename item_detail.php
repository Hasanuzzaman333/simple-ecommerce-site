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
				
					if( isset($_GET["msg"]))
					{
						echo "<script type='text/javascript'>alert('".$_GET["msg"]."');</script>";
					}
	

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


<div class="container text-center">    
  <div class="row">
    <div class="col-sm-2"></div>
	<div class="col-sm-8"> 
		<div class="row row-eq-height">
		<?php
			
			if(isset($_GET["id"]))
			{
				$id = $_GET["id"];
			}
			
			require_once('db_connect.php');
			$con = mysqli_connect( HOST, USER, PASS, DB );
			
			$sql = "SELECT * FROM Item where id = $id";
			$res = mysqli_query( $con, $sql );

			while($row = $res->fetch_assoc()) {
				
				echo "<div>";
					echo "<h2>".$row["name"]."</h2>";
					echo "<form method='POST'>";
						
						echo "<label >Quantity<input class='form-control' type='number' min='1' max='100' name='qty' value='1'></label></br>";
						echo "<p>Unit price: ".$row["price"]." $</p>";
						echo "<input type='submit' value='Add to Cart' class='btn btn-info' formaction='cart.php?id=".$id."'>";
						//echo '<a class="btn btn-info" href="cart.php?id='.$id.'">Add to Cart</a>';
					echo "</form >";
				echo "</div>";
					
				//echo "<a href='item_detail.php?id=".$row["id"]."' >". $row["name"]."<a></br></br>";
			}
		
		?>
			
		</div>
	</div>
    <div class="col-sm-2"></div>
  </div>
</div><br><br>


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
