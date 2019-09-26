<?php
require_once('functions.php');

if (isset($_POST['organism'])
    && isset($_POST['incubation-usual'])
    && isset($_POST['incubation-range'])
    && isset($_POST['symptoms'])
    && isset($_POST['severity'])
    && isset($_POST['avg-annual-incidence'])
    && isset($_FILES['disease-img'])
    && $_FILES['disease-img']['name'] != '') {
    $imgFileName = moveUploadedImgToFolderAndGrabName();
    $db = establishDisease_dbConnection();
    addNewDiseaseToDB($db, $_POST['organism'], $_POST['incubation-usual'], $_POST['incubation-range'],
                      $_POST['symptoms'], $_POST['severity'], $_POST['avg-annual-incidence'], $imgFileName);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add item</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div class="nav-panel">
        <nav>
            <div class="heading"><a href="index.php"><p>Collection</p></a></div>
            <div class="heading underline"><p>Add Disease</p></div>
            <div class="heading"><a href="edit_item.php"><p>Edit Disease</p></a></div>
            <div class="heading"><a href="remove_item.php"><p>Remove Disease</p></a></div>
        </nav>
    </div>
    <div class="add-item">
        <form method="post" enctype="multipart/form-data">
            <label for="organism">Organism</label>
            <input type="text" name="organism" id="organism" required>
            <label for="incubation-usual">Incubation usual</label>
            <input type="text" name="incubation-usual" id="incubation-usual" required>
            <label for="incubation-range">Incubation range</label>
            <input type="text" name="incubation-range" id="incubation-range" required>
            <label for="symptoms">Symptoms</label>
            <input type="text" name="symptoms" id="symptoms" required>
            <label for="severity">Severity</label>
            <input type="text" name="severity" id="severity" required>
            <label for="avg-annual-incidence">Average annual incidence</label>
            <input type="number" name="avg-annual-incidence" id="avg-annual-incidence" required>
            <label for="disease-img">Image</label>
            <input type="file" name="disease-img" id="disease-img" required>
            <input type="submit">
        </form>
    </div>
</body>
</html>