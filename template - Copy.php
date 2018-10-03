
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
				echo '<li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Signin</a></li>';
				echo '<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>';
			}
		?>
        <li><a href="viewcart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
  </div>
</div><br><br>

<footer class="container-fluid text-center"> 
  <span class="glyphicon glyphicon-registration-mark"> All Rights Reserved</span>
</footer>

</body>
</html>
