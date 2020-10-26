<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="index.css">
  <title>Edit
  </title>
</head>
<body>
  <div class = "Edit">
    <?php

//----------------------------------------- Gets file and explodes it ------------------------------------------

$Datei = $_GET['Datei'];
$data  = explode("|||", file_get_contents($Datei));

//---------------------------------------------------- Form ----------------------------------------------------

echo '<form action="index.php?Datei=' . $Datei . '" method="post">';
echo '<p>Write your new Titel below:</p> <textarea id="Textarea" name="Titel" rows="1" cols="50%" value="' . $data[1] . '" 
required maxlength="80" required="required" ></textarea>';
echo '<p>Write your new comment below:</p> <textarea id="Textarea" name="Comment" rows="5" cols="100%" value="' . $data[2] . '" 
required maxlength="2000" required="required" ></textarea>';
echo '<br><input type="submit" name="edit" value="Edit">';
echo '</form>';

//-------------------------------------- To return home, without editing ---------------------------------------

?>
    <form action="index.php">
      <br>
      <input type="submit" value="Return Home" />
    </form>
  </div>
</body>
</html>
