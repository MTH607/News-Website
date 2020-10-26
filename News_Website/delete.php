<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="index.css">
  <title>Delete
  </title>
</head>
<body>
  <div class = "Delete">
    <?php

//------------------------------------------ Gets file and deletes it ------------------------------------------

$Datei = $_GET['Datei'];
unlink($Datei);
echo "Comment has been deleted</br>";
?>
    <form action="index.php">
      <br>
      <input type="submit" value="Return Home" />
    </form>
  </div>
</body>
</html>
