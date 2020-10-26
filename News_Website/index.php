<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <div class="WebTitle">
        <a href='index.php'><h1>News</h1></a>
        </div>
    </head>
    <body>

<! ------------------------------------------------------- Form  ------------------------------------------------------ >

        <div class = "Form">
            <form enctype="multipart/form-data" method="POST" action="index.php">
            <p>Title:</p>
            <textarea id="Textarea" name="Titel" rows="1" cols="50%" require maxlength="80" required="required" ></textarea>
            <p>Author:</p>
            <textarea id="Textarea" name="User" rows="1" cols="50%" require maxlength="50" required="required" ></textarea>
            <p>Write a new comment:</p>
            <textarea id="Textarea" name="Comment" rows="5" cols="100%" require maxlength="2000" required="required" ></textarea>
            <p>Upload an image:<p>
            <input type="file" name="Bildhochladen" required/>
            <br><br>
            <input type="submit" name="submit" value="Upload"/>
     </form>
</div>
<div class="Resize">
<?php

//---------------------------------------------------- Assoziationen ----------------------------------------------------

if (isset($_POST['submit'])) {
    $titel   = $_POST['Titel'];
    $user    = $_POST['User'];
    $comment = $_POST['Comment'];
    $file    = $titel . ".txt";
    $date    = date("d.m.Y, H:i");
    $data    = $date . "|||" . $titel . "|||" . $user . "|||" . $comment;
//------------------------------------------------ Creates new .txt file ------------------------------------------------

if (file_exists("dateien\\$titel.txt")) {
    echo '<div class="Error">';
    echo '-----  Title already exists, choose a different Title!  -----';
    echo '</div>';
} else {
    file_put_contents("dateien\\" . $file, $data);
    echo '<div class="Uploaded">';
    echo 'Comment has been uploaded below';
    echo '</div>';
}

//--------------------------------------------------- Takes the image ---------------------------------------------------
    
    $bild        = $_FILES['Bildhochladen'];
    $bildName    = $_FILES['Bildhochladen']['name'];
    $bildTmpName = $_FILES['Bildhochladen']['tmp_name'];
    $bildGroesse = $_FILES['Bildhochladen']['size'];
    $bildFehler  = $_FILES['Bildhochladen']['error'];
    $bildTyp     = $_FILES['Bildhochladen']['type'];
    echo (isset($bildName) ? '' : '');
    if($bildGroesse > [5000000]){
        echo '<div class="Error">';
        echo 'Filesize is to big!';
        echo '</div>';
    }else{
    move_uploaded_file($bildTmpName, "images\\" . $titel . ".jpg");
}
}

//------------------------------------- To display all .txt files and .jpg images ---------------------------------------

foreach (glob("dateien/*.txt") as $Datei) {
    echo "<h3>All Messages</h3>";
    $data = explode("|||", file_get_contents($Datei));
    echo "<article>";
    echo '<div class="boxed"> <p>' . $data[0] . '</p>' . '<p>' . $data[1] . '</p>' . '<p>' . $data[2] . '</p>' . '<p>' . $data[3] . '</p>';

//--------------------------------------------- The image is assembled here ---------------------------------------------

$titel   =   $data[1];
    $bildort = explode('images\\', $titel);
    if (file_exists("images\\$titel.jpg")) {
        echo '<img src="images\\' . $titel . '.jpg" width=50%>';
    } else {
        echo "Couldn't load image";
    }

//---------------------------------------------- Button to edit and delete ----------------------------------------------

echo "<br><br>";
    echo ("<button onclick=\"location.href='edit.php?Datei=" . $Datei . "'\">Edit</button>");
    echo ("<button onclick=\"location.href='delete.php?Datei=" . $Datei . "'\">Delete</button>");
    echo "</div>";
}

//------------------------------------------ Puts data from edit.php together -------------------------------------------

if (isset($_POST['edit'])) {
    $Datei   = $_GET['Datei'];
    $titel   = $_POST['Titel'];
    $user    = isset($_POST['User']);
    $comment = $_POST['Comment'];
    $file    = $titel . ".txt";
    $date    = date("d.m.Y, H:i");
    $data    = $date . "|||" . $titel . "|||" . $user . "|||" . $comment;
    unlink($Datei);
    file_put_contents("dateien\\" . $file, $data);
}
    echo "</article>";

?>
</div>
    </body>
</html>