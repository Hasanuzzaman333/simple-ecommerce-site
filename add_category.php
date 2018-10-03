<?php
/**
 * Created by IntelliJ IDEA.
 * User: HiddenDimension
 * Date: 12/18/2017
 * Time: 10:41 AM
 */

   require_once ("mySuperClass.php");
    $cate= $_GET['name'];

    if($cate) {
        addCategory($cate);


    }

header("Location: index.php"); /* Redirect browser */
exit();


?>