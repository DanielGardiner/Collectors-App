<?php
require_once('functions.php');

if (isset($_POST['organism']) &&
    isset($_POST['incubation_usual']) &&
    isset($_POST['incubation_range']) &&
    isset($_POST['symptoms']) &&
    isset($_POST['severity']) &&
    isset($_POST['avg_annual_incidence']) &&
    isset($_FILES['img']) &&
    $_FILES['img']['name'] != '') {
    $imgFileName = moveUploadedImgToFolderAndGrabName();
    $db = establishDisease_dbConnection();
    addNewDiseaseToDB($db, $imgFileName);
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add item</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div class="nav-panel">
        <nav>
            <div class="heading"><a href="index.php"><p>Collection</p></a></div>
            <div class="heading underline"><p>Add disease</p></div>
            <div class="heading"><a href="remove_item.php"><p>Remove disease</p></a></div>
        </nav>
    </div>
    <div class="container add_item">
        <form method="post" enctype="multipart/form-data">
            <p>Organism</p>
            <p><input type="text" name="organism"></p>
            <p>Incubation usual</p>
            <p><input type="text" name="incubation_usual"></p>
            <p>Incubation range</p>
            <p><input type="text" name="incubation_range"></p>
            <p>Symptoms</p>
            <p><input type="text" name="symptoms"></p>
            <p>Severity</p>
            <p><input type="text" name="severity"></p>
            <p>Average annual incidence</p>
            <p><input type="number" name="avg_annual_incidence"></p>
            <p>Image</p>
            <p><input type="file" name="img"></p>
            <p><input type="Add disease!"></p>
        </form>
    </div>
</body>
</html>
