<?php
/**
 * Created by IntelliJ IDEA.
 * User: HiddenDimension
 * Date: 12/18/2017
 * Time: 11:15 AM
 */

require_once ("mySuperClass.php");
$cate= $_GET['name'];
$upcate= $_GET['updated_name'];



if($cate)
    updateCategory($cate,$upcate);


header("Location: index.php"); /* Redirect browser */
exit();

?>