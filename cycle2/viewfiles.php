<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 9/23/2019
 * Time: 1:56 PM
 */

$pagetitle = "View Files";
include_once "head.php";

try{
    //query the data
    $sql = "SELECT * FROM accountfiles";
    $result = $pdo->query($sql);
    ?>
    <?php
    echo "<p><b><a href='filestorage.php'>Upload New File</a></b></p>";
    echo "<table>
            <tr><th>ID</th><th>Title</th><th>File Type</th></tr>";
    //loop through the results and display to the screen
    foreach ($result as $row){
        echo "<tr><td>{$row['ID']}</td><td>" .$row['title']."</td><td>{$row['filetype']}</td><td>"; "</tr>";
    }
    echo "</table>";
}
catch (PDOException $e)
{
    die( $e->getMessage() );
}
require_once "foot.php";