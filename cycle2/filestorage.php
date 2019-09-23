<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 9/20/2019
 * Time: 8:42 PM
 */

$pagetitle = "Store A File";
include_once "head.php";

//set variables
$showform = 1;
$errmsg = 0;
$errtitle = "";
$errfiletype = "";
$errfile = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //sanitize data. remove white space
    $formdata['title'] = trim($_POST['title']);
    $formdata['filetype'] = trim($_POST['filetype']);

    //check for empty fields
    if (empty($formdata['title'])) {
        $errtitle = "Title is required.";
        $errmsg = 1; }

    if (empty($formdata['filetype'])) {
        $errfiletype = "File type is required.";
        $errmsg = 1; }

    //check for existing files
    $sql = "SELECT LCASE(title) FROM accountfiles WHERE ?";
    $count = checkDup($pdo, $sql, strtolower($formdata['title']));
    if($count > 0)
    {
        $errmsg = 1;
        $errtitle = "This file already exists.";
    }

    //checks for errors with the file
    if($_FILES['userfile']['error'] == 0)
    {
        $userfile = $_FILES['userfile']['name'];
        $pathparts = pathinfo($userfile);
        $extension = $pathparts['extension'];
        $finalfile = $_SESSION['username'] . "_" . $rightnow . "." .$extension;
        $workingfile = "/var/www/html/uploads/" . $finalfile;

        if(file_exists($workingfile))
        {
            $errmsg = 1;
            $errfile = "File already exists.";
        }

        if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $workingfile))
        {
            $errmsg = 1;
            $errfile = "Could not move file.";
        }
    }
    else
    {
        $errmsg = 1;
        $errfile = "Cannot process file!";
    }

    //error handling
    if($errmsg == 1)
    {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }
    else
    {
        //insert file into database
        try{
            $sql = "INSERT INTO accountfiles (title, filetype, inputdate)
                    VALUES (:title, :filetype, :inputdate) ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':title', $formdata['title']);
            $stmt->bindValue(':filetype', $formdata['filetype']);
            $stmt->bindValue(':inputdate', $rightnow);
            $stmt->execute();

            $showform = 0;
        }
        catch (PDOException $e)
        {
            die( $e->getMessage() );
        }
        echo "<p class='awesome'>Thank you for uploading your file!</p>";
        $showform = 0;
    }
}

//display form if showform is true
if($showform == 1)
{
    ?>
    <form name="filestorage" id="filestorage" method="post" action="filestorage.php" enctype="multipart/form-data">
        <table>
            <tr><th><label for="userfile">Upload Your File:</label><span class="important">*</span></th>
                <td><input name="userfile" id="userfile" type="file" />
                    <span class="important"><?php if(isset($errfile)){echo $errfile;}?></span></td>
            </tr>
            <tr><th><label for="title">Title:</label><span class="important">*</span></th>
                <td><input name="title" id="title" type="text"  placeholder="Title"
                           value="<?php if(isset($formdata['title'])){echo $formdata['title'];}?>"/>
                    <span class="important"><?php if(isset($errtitle)){echo $errtitle;}?></span></td>
            </tr>
            <tr><th><label for="filetype">File Type:</label><span class="important">*</span></th>
                <td><span class="important"><?php if(isset($errdetails)){echo $errdetails;}?></span>
                    <select name="filetype" id="filetype"><?php if(isset($formdata['details'])){echo $formdata['details'];}?>
                        <option value="document">DOC/DOCX</option>
                        <option value="image">JPG/JPEG or PNG</option>
                        <option value="entertainment">mp3/mp4</option>
                        <option value="presentation">ppt/pptx</option>
                        <option value="misc">Other</option>
                    </select>
                </td>
            </tr>
            <tr><th><label for="submit">Submit:</label></th>
                <td><input type="submit" name="submit" id="submit" value="UPLOAD"/></td>
            </tr>

        </table>
    </form>
    <?php
}
include_once "foot.php";
?>
