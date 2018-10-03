<?php
/**
 * Created by IntelliJ IDEA.
 * User: HiddenDimension
 * Date: 12/18/2017
 * Time: 8:47 AM
 */

if (session_status() == PHP_SESSION_ACTIVE) {
   // echo 'Session is active';
}
else {

    session_start();
}


 function getMailFromSession() {

     // session_start();
     require_once('db_connect.php');

     $con = mysqli_connect( HOST, USER, PASS, DB );

     $sql = "SELECT email FROM `user` WHERE id=".$_SESSION["id"];
     $res = mysqli_query( $con, $sql );


     if ($res->num_rows > 0) {
         // output data of each row
         while($row = $res->fetch_assoc()) {
             return $row["email"];
         }
     }

     $con->close();
    return "nomail";
 }


 function isValidEmail($email){



     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $_SESSION["invalidEmailErrorMessage"]="  (Please update your mail)";
         return false;
     }

     $_SESSION["invalidEmailErrorMessage"]="";
     return true;
 }

 function showInvalidMailErrorMessage(){


     isValidEmail(getMailFromSession());

     try {

         if ($_SESSION["invalidEmailErrorMessage"]) {

             echo $_SESSION["invalidEmailErrorMessage"];
         };


     }
     catch (Exception $e){

     }


    // return $_SESSION["invalidEmailErrorMessage"];
 }


function isAdmin()
{


    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


    $sql = "SELECT is_guest FROM `user` WHERE id=" . $_SESSION["id"];
    $res = mysqli_query($con, $sql);


    if ($res->num_rows > 0) {
        // output data of each row
        while ($row = $res->fetch_assoc()) {
            if ($row["is_guest"] == 2) return true;
        }
    }

    $con->close();

   }
    return false;
}


function createOrder($itemId , $qty , $totalPrice)
{


    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


        $sql = "INSERT INTO `order` (`id`, `item_id`, `user_id`, `qty`, `total_price`, `date_time`) VALUES (NULL, '".$itemId."', '".$_SESSION["id"]."', '".$qty."', '".$totalPrice."', '".date("Y-m-d h:i:sa")."')" ;
        $res = mysqli_query($con, $sql);


        if ($res->num_rows > 0) {
            // output data of each row
           return true;
        }

        $con->close();

    }
    return false;
}


function getItemPrice($id)
{


    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


        $sql = "SELECT * FROM `item` WHERE id =".$id;
        $res = mysqli_query($con, $sql);


        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {
                return ($row["price"]) ;
            }
        }

        $con->close();

    }
    return 0;
}

function getItemName($id)
{


    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


        $sql = "SELECT * FROM `item` WHERE id =".$id;
        $res = mysqli_query($con, $sql);


        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {
                return ($row["name"]) ;
            }
        }

        $con->close();

    }
    return "";
}

function deleteFromCart($id)
{


    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


        $sql = "DELETE FROM `cart` WHERE `cart`.`id` =".$id;
        $res = mysqli_query($con, $sql);


        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {
                if ($row["is_guest"] == 2) return true;
            }
        }

        $con->close();

    }
    return false;
}


function getInfoOfCart()
{

    $list="\r\n";

    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


        $sql = "SELECT * FROM cart WHERE user_id=" . $_SESSION["id"];
        $res = mysqli_query($con, $sql);


        if ($res->num_rows > 0) {
            // output data of each row
            $i =1;
            while ($row = $res->fetch_assoc()) {

              //  createOrder($row["item_id"] , $row["qty"] , getItemPrice($row["item_id"])* $row["qty"]);
               // deleteFromCart($row["id"]);

                $list.= $i++.". "."Item Name :".getItemName($row["item_id"]) ."  Quantity:".$row["qty"]." Total Price :".$row["qty"]*getItemPrice($row["item_id"])."\r\n";

            }
        }

        $con->close();

    }
    return $list;
}


function order()
{


    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


        $sql = "SELECT * FROM cart WHERE user_id=" . $_SESSION["id"];
        $res = mysqli_query($con, $sql);


        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {

             createOrder($row["item_id"] , $row["qty"] , getItemPrice($row["item_id"])* $row["qty"]);
             deleteFromCart($row["id"]);

            }

            $_SESSION["automaticErrorMessage"]="We are processing your order..";
        }

        $con->close();

    }
    return false;
}



function isRegistered()
{


    require_once('db_connect.php');

    $con = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_SESSION["id"])) {


        $sql = "SELECT is_guest FROM `user` WHERE id=" . $_SESSION["id"];
        $res = mysqli_query($con, $sql);


        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {
                if ($row["is_guest"] != 1) return true;
            }
        }

        $con->close();

    }
    return false;
}


function addCategory($category){



    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "INSERT INTO `category` (`id`, `cat_name`) VALUES (NULL, '".$category."')";

    $res = mysqli_query( $con, $sql );


    if ($res) {
        echo "New record created successfully";
        $_SESSION["automaticErrorMessage"]="We have added your new category";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    $con->close();
    return false;
}


function deleteCategory($category){



    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "Delete FROM category WHERE cat_name LIKE ". "'".$category."'";

    $res = mysqli_query( $con, $sql );


    if ($res) {
        echo "New record deleted successfully";
        $_SESSION["automaticErrorMessage"]="We have deleted your category";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    $con->close();
    return false;
}


function updateCategory($category , $updatedCategory){



    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "UPDATE category SET cat_name = '".$updatedCategory."' WHERE cat_name like '".$category."'";

    $res = mysqli_query( $con, $sql );


    if ($res) {
        echo "New record deleted successfully";
        $_SESSION["automaticErrorMessage"]="We have updated your category";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    $con->close();
    return false;
}


function getCategoryId($category ){



    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "SELECT id FROM category WHERE cat_name like "."'".$category."'";

    $res = mysqli_query( $con, $sql );


    if ($res->num_rows > 0) {
        // output data of each row
        while($row = $res->fetch_assoc()) {
            return $row["id"] ;
        }
    }

    $con->close();
    return false;
}



function addItem($category , $name , $price){



    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "INSERT INTO `item` (`id`, `cat_id`, `name`, `price`) VALUES (NULL, ".getCategoryId($category).", '".$name."', '".$price."')";

    $res = mysqli_query( $con, $sql );


    if ($res) {
        echo "New record deleted successfully";
        $_SESSION["automaticErrorMessage"]="We have added your item";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    $con->close();
    return false;
}


function getItemId($item ){



    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "SELECT id FROM item WHERE name like "."'".$item."'";

    $res = mysqli_query( $con, $sql );


    if ($res->num_rows > 0) {
        // output data of each row
        while($row = $res->fetch_assoc()) {
            return $row["id"] ;
        }
    }

    $con->close();
    return false;
}

function updateItem( $name , $uname, $uprice){

     $id = getItemId($name);

    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "UPDATE `item` SET `name` = '".$uname."', `price` = '".$uprice."' WHERE `item`.`id` = ".$id;

    $res = mysqli_query( $con, $sql );


    if ($res) {
        echo "New record updated successfully";
        $_SESSION["automaticErrorMessage"]="We have updated your item";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    $con->close();
    return false;
}


function showAlert( $messageAlert )
{
    echo '<script language="javascript">';
    echo 'alert("'.$messageAlert.'")';
    echo '</script>';

}


function automateAlert(  )
{

    if(isset($_SESSION["automaticErrorMessage"]))
    {

        echo '<script language="javascript">';
        echo 'alert("' . $_SESSION["automaticErrorMessage"] . '")';
        echo '</script>';


        $_SESSION["automaticErrorMessage"]=null;

    }

}

function deleteItem( $name ){




    require_once('db_connect.php');

    $con = mysqli_connect( HOST, USER, PASS, DB );

    $sql = "DELETE FROM item WHERE name like '".$name."'";

    $res = mysqli_query( $con, $sql );


    if ($res) {
        echo "New record deleted successfully";
        $_SESSION["automaticErrorMessage"]="We have deleted your item";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    $con->close();
    return false;
}



?>