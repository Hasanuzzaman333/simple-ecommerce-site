<?php
/**
 * Created by IntelliJ IDEA.
 * User: HiddenDimension
 * Date: 12/18/2017
 * Time: 10:41 AM
 */
session_start();
require_once ("mySuperClass.php");


$name= $_GET['name'];
$price = $_GET['price'];

$cate =  $_SESSION['category'];

echo  $cate;


if($cate)
    addItem($cate  , $name , $price);


header("Location: index.php"); /* Redirect browser */
exit();


?>