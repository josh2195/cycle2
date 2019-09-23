<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 9/23/2019
 * Time: 11:51 AM
 */
?>
<ul>
    <?php
    echo ($currentfile == "index.php") ? "<li>Home</li>" : "<li><a href='index.php'>Home</a></li>";
    echo ($currentfile == "createaccount.php") ? "<li>Create New Account</li>" : "<li><a href='createaccount.php'>Create New Account</a></li>";
    if(isset($_SESSION['ID'])){echo "<li><a href='filestorage.php'>Upload A File</a></li>";}
    if(isset($_SESSION['ID'])){echo "<li><a href='viewfiles.php'>View Files</a></li>";}
    echo (isset($_SESSION['ID'])) ? "<li><a href='logout.php'>Log Out</a></li>" : "<li><a href='login.php'>Log In</a></li>";
    if (isset($_SESSION['ID'])){echo "Welcome back, " . $_SESSION['username'] . ". ";}
    ?>
</ul>