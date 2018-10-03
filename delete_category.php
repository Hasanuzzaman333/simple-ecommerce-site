<?php
/**
 * Created by IntelliJ IDEA.
 * User: HiddenDimension
 * Date: 12/18/2017
 * Time: 11:15 AM
 */

require_once ("mySuperClass.php");
$cate= $_GET['name'];

echo $cate;

if($cate)
    deleteCategory($cate);


header("Location: index.php"); /* Redirect browser */
exit();

?>