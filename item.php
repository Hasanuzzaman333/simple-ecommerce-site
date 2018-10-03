<?php
	session_start();

    //$_SESSION[$cate]="";
	require_once('db_connect.php');
	$con = mysqli_connect( HOST, USER, PASS, DB );
	require_once("mySuperClass.php");
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


			
			if(isset($_SESSION["id"]))
			{
				$_SESSION["id"] = $_SESSION["id"];
			}
			
			if(isset($_GET["id"]))
			{
				$id = $_GET["id"];
				$cat_name = $_GET["cat_name"];

                $_SESSION['category'] = $cat_name;
				echo "<h1>".$cat_name."</h1></br>";


			}

           // $_SESSION[$cate]= $_GET["cat_name"];


			
			
			require_once('db_connect.php');
			$con = mysqli_connect( HOST, USER, PASS, DB );
			
			//echo $id;
			
			$sql = "SELECT * FROM Item where cat_id = $id";
			$res = mysqli_query( $con, $sql );
			
			while($row = $res->fetch_assoc()) {
				echo '<div class="col-md-6 col-sm-12">';
					echo '<div style="padding:15px; margin:2px; border-radius: 5px; background: #D5F5E3;">';	
						echo '<h5><a href="item_detail.php?id='.$row["id"].'" >'. $row["name"].'  </a></h5>';
						echo '<p>This is a quality product</p>';
						
						echo "<form method='POST'>";
						echo "<label >Quantity<input class='form-control' type='number' min='1' max='100' name='qty' value='1'></label></br>";
						echo "<p>Unit price: ".$row["price"]." $</p>";
						echo "<input type='submit' value='Add to Cart' class='btn btn-info' formaction='cart.php?id=".$row["id"]."&cat_id=".$id."&cat_name=".$cat_name."'>";
						echo "</form >";
						
					echo '</div>';
				echo '</div>';
			}
			
			

		?>
		</div>
		</div>
    <div class="col-sm-2"></div>
  </div>
</div><br><br>

<script type="text/javascript">

    function showDiv(divName) {
		if(divName == 'admin'){
			if(document.getElementById(divName).style.display != "block"){
				document.getElementById(divName).style.display = "block";
			}
			else{
				document.getElementById(divName).style.display = "none";
			}
			return;
		}
		
        if(document.getElementById(divName).style.display != "block"){
            document.getElementById(divName).style.display = "block";

            if(divName != 'create'){
                document.getElementById('create').style.display = "none";
            }
            if(divName != 'update'){
                document.getElementById('update').style.display = "none";
            }
			if(divName != 'delete'){
                document.getElementById('delete').style.display = "none";
            }
        }
    }

</script>
<?php if(isAdmin()){  ?>
<hr height="5px">


<div class="text-center">
		<ul class="list-group">
			<li class="list-group-item"><h3><a href="javascript:showDiv('admin')">Admin Panel</a></h3></li>
		</ul>
		</br>
</div>

<div class="container" id="admin" style="display:none;" >
	
    <div class="row text-center">
		<div class="col-md-4 text-center">
			<ul class="list-group">
				<li class="list-group-item"><a href="javascript:showDiv('create')">Create</a></li>
				<li class="list-group-item"><a href="javascript:showDiv('update')">Update</a></li>
				<li class="list-group-item"><a href="javascript:showDiv('delete')">Delete</a></li>
			</ul>
		</div>
        <div class="col-md-8 text-center">
			<div style="display:block;" id="create">
				<form action="add_item.php">
					<div class="form-group">
						<label for="add">Add New Item</label>
						<input type="text" class="form-control" name="name" id="add">
					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="text" class="form-control" name="price" id="price">
					</div>
					<button type="submit" class="btn btn-default">Add</button>
				</form>
			</div>
			
			<div style="display:none;" id="delete">
				<form action="delete_item.php">
					<div class="form-group">
						<label for="del">Delete</label>
						<!--input type="text" class="form-control" name="name" id="del" -->
						
						<select class="form-control" id="old" name="name" id="del">
							<?php 
								$sql = "SELECT name FROM Item where cat_id = $id";
								$res = mysqli_query( $con, $sql );
								while($row = $res->fetch_assoc()) {
									echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
								}
							?>
					    </select>
					</div>
					<button type="submit" class="btn btn-default">Delete</button>
				</form>
			</div>

			<div style="display:none;" id="update">
				<form action="update_item.php" method="get">
					<div class="form-group">
						<label for="old">Old Name</label>
						<!--input type="text" class="form-control" name="name" id="old" -->
						<select class="form-control" id="old" name="name">
							<?php 
								$sql = "SELECT name FROM Item where cat_id = $id";
								$res = mysqli_query( $con, $sql );
								while($row = $res->fetch_assoc()) {
									echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
								}
							?>
					    </select>
					</div>
					
					<div class="form-group">
						<label for="new">New Name</label>
						<input type="text" class="form-control" name="uname" id="new">
					</div>
					<div class="form-group">
						<label for="newprice">New Price</label>
						<input type="text" class="form-control" name="uprice" id="newprice">
					</div>
					<button type="submit" class="btn btn-default">Update</button>
				</form>
			</div>
        </div>
    </div>
</div>
<?php } ?>



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
