<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 9/20/2019
 * Time: 8:45 PM
 */
session_start();
session_unset();
session_destroy();
if($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['state']==3) {
    header("Location: confirmuser.php?state=3");
}
else
{
    header("Location: confirmuser.php?state=1");
}
exit();
?>