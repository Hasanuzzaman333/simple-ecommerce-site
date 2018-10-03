<?php

	session_start();
	require_once('db_connect.php');
	require_once ('mySuperClass.php');

	$con = mysqli_connect( HOST, USER, PASS, DB );
	
	
		
	/*	if(isset($_SESSION["nuid"]))
		{
			header("Location: createaccount.php");
			
		}
		else if(isset($_SESSION["id"]))
		{
			$uid = $_SESSION["id"];
		}
		
		if(isset($_GET["cart_id"])){
			 $sql = "insert into order (item_id,qty,user_id,date_time,price)values()";
			$res = mysqli_query( $con, $sql );
			header("Location: empty.php"); 
		}*/
		
		
	//	echo "<img src='uc.jpg' style='width:300px;height:300px;'>";

if(isset($_SESSION["id"])) {

    $_SESSION["automaticErrorMessage"] =("sending a  mail as a  confirmation message to " . getMailFromSession() );


    $to = getMailFromSession();
    $subject = "Buy It - Purchase";
    $txt = "You have ordererd some  products below from BuyIt.com :".getInfoOfCart(). " Thanks..";
    $headers = "From: mhasanuzzaman142017@bscse.uiu.ac.bd";



    if (isValidEmail(getMailFromSession())) {
        mail($to, $subject, $txt, $headers);

        order();

        header("Location: index.php"); /* Redirect browser */


        exit();


    }

    else {

        // echo 'please update your mail to a valid mail';

        {
            $_SESSION["invalidEmailErrorMessage"] = "Please update your mail";

            header("Location: user.php"); /* Redirect browser */
            exit();

            //showAlert("Please update your mail");


        }
    }


}

else {



    header("Location: viewcart.php#signup"); /* Redirect browser */
    exit();





}

?>