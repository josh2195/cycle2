<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 9/23/2019
 * Time: 12:45 PM
 */
$pagetitle = "Log In/Out Confirmation";
require_once "head.php";

if($_GET['state']==1)
{
    echo "<p>You have been logged out.  Please <a href='login.php'>log in</a> again to view restricted content.<p>";
}
elseif($_GET['state']==2)
{
    //echo "<p>Welcome back, <b>" . $_SESSION['username'] . "</b>!</p>";
}
elseif($_GET['state']==3)
{
    echo "<p>Your password has been changed and you have been logged out.  Please <a href='login.php'>log in</a> again to view restricted content.<p>";
}
else
{
    echo "<p>Please continue by choosing an item from the menu.</p>";
}

require_once "foot.php";
