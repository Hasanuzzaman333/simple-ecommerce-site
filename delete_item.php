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

    deleteItem($name);


header("Location: index.php"); /* Redirect browser */
exit();


?>