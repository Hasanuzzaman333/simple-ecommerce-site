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
  
  <!--for modal-->
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
        <li ><a href="index.php">Home</a></li>
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
				echo '<li class="active"><a href="user.php"><span class="glyphicon glyphicon-user"></span> '.$row["name"].'</a></li>';
				echo '<li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>';
			}
			else{
				echo '<li><a id="signin" href="#myModal1" ><span class="glyphicon glyphicon-log-in"></span> Signin</a></li>';
				echo '<li><a id="signup" href="#myModal2"><span class="glyphicon glyphicon-user"></span> Signup</a></li>';
			}
		?>
				
		
        <li><a href="viewcart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<!-- user info  -->
<?php

    if(isset($_SESSION["id"])) {
        $sql = "SELECT * FROM user where id =" . $_SESSION["id"];
        $res = mysqli_query($con, $sql);

        $row = $res->fetch_assoc();
        $name = $row["name"];
        $email = $row["email"];
        $password = $row["password"];
        $address = $row["address"];

    }
	
?>

<div class="container">
      <div class="row">
		</br>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Info</h3>
            </div>
            <div class="panel-body">
              <div class="row">
             
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Name:</td>
                        <td><?php echo $name ?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo $email ; require_once ('mySuperClass.php');

                            showInvalidMailErrorMessage();?>
                            </td>


                      </tr>
                      <tr>
                        <td>Password</td>
                        <td><?php echo $password ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Address</td>
                        <td><?php echo $address ?></td>
                      </tr>
                       
                     
                    </tbody>
                  </table>
                
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        
                        <span class="pull-Center">
                            <a id="edt" title="Edit" href="#edit"  type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a  type="button" onclick="myFunction()" title="Delete" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>



<br><br><br><br><br><br>
<footer class="container-fluid text-center"> 
  <span class="glyphicon glyphicon-registration-mark"> All Rights Reserved</span>
</footer>


<!--modal signin-->
		
		<div class="container">
		  <!-- Modal -->
		  <div class="modal fade" id="edit" role="dialog">
			<div class="modal-dialog">
			
			   <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header" style="padding:35px 50px;">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4><span class="glyphicon glyphicon-cog"></span> Edit</h4>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
				  <form role="form" action="edit_user.php" method="POST">
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
					  <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required>
					</div>
					<div class="form-group">
					  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					  <input type="text" name="password" class="form-control" id="psw" value="<?php echo $password ?>" required>
					</div>
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Email</label>
					  <input type="text" class="form-control" name="email" value="<?php echo $email ?>" required>
					</div>
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-home"></span> Address</label>
					  <input type="text" class="form-control" name="address" value="<?php echo $address ?>" required>
					</div>
					
					  <button type="submit" formaction='edit_user.php' class="btn btn-success btn-block"><span class="glyphicon glyphicon-cog"></span> Edit</button>
				  </form>
				</div>
				<div class="modal-footer">
				  <button type="submit"  class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				  
				</div>
			  </div>
			  
			</div>
		  </div> 
		</div>
		 
		<script>
		$(document).ready(function(){
			$("#edt").click(function(){
				$("#edit").modal();
			});
		});
		</script>
		
		
		<script>
		function myFunction() {
			var x;
			var r = confirm("Do you want delete?");
			if (r == true) {
				x = "Your Data is Cleared";
				window.location.href = "delete_account.php";
			}
			else {
				x = "You pressed Cancel!";
				die();
			}
			document.getElementById("demo").innerHTML = x;
		}
		</script>
		
		



</body>
</html>
