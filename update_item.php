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
$uprice = $_GET['uprice'];

$uname =  $_GET['uname'];



if($name)
    updateItem($name  , $uname , $uprice);


header("Location: index.php"); /* Redirect browser */
exit();


?>