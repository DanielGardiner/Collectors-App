<?php
require_once('functions.php');

$db = establishDisease_dbConnection();
$allData = retrieveData($db);
$allOrganisms = grabAllOrganisms($allData);

if (isset($_POST['submit'])) {

}


if (isset($_POST['organism']) &&
    isset($_POST['incubation_usual']) &&
    isset($_POST['incubation_range']) &&
    isset($_POST['symptoms']) &&
    isset($_POST['severity']) &&
    isset($_POST['avg_annual_incidence']) &&
    isset($_FILES['img']) &&
    $_FILES['img']['name'] != '') {

}

$organismArray = grabDataForSelectOrganism($allData);

if (isset($_POST['edit-organism'])) {
    var_dump(grabDataForSelectOrganism($allData));
    echo '<form method="post" enctype="multipart/form-data">
    <p>Organism</p>
    <p><input type="text" name="organism" value = "' .
    $organismArray['Organism'] .
    '"></p><p>Incubation usual</p><p><input type="text" name="incubation_usual" value="' .
    $organismArray['Incubation_usual'] .
    '"></p><p>Incubation range</p><p><input type="text" name="incubation_range" value="' .
    $organismArray['Incubation_range'] .
    '"></p><p>Symptoms</p><p><input type="text" name="symptoms" value="' .
    $organismArray['Symptoms'] .
    '"></p><p>Severity</p><p><input type="text" name="severity" value="' .
    $organismArray['Severity'] .
'"></p><p>Average annual incidence</p><p><input type="number" name="avg_annual_incidence" value="' .
$organismArray['Avg_annual_incidence'] .
'"></p>
    <p>Image</p><p><input type="file" name="img"></p><p><input type="submit" value="Edit disease"></p></form>' ;
} else {

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
        <div class="heading"><p>Add Disease</p></div>
        <div class="heading underline"><p>Edit Disease</p></div>
        <div class="heading"><a href="remove_item.php"><p>Remove disease</p></a></div>
    </nav>
</div>

<div class="container remove_item">
    <form class="remove_item" method="post">
        <p>Select disease to edit</p>
        <select name="edit-organism" >
            <?php  echo createAllOrganismDropDown($allOrganisms); ?>
            <input class="submit-remove" type="submit" value="Edit disease">
        </select>
    </form>
</div>

<div>
    <p>Update details:</p>
</div>


<div class="container edit_item">
    <form method="post" enctype="multipart/form-data">
        <p>Organism</p>
        <p><input type="text" name="organism" value = "organism1"></p>
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
        <p><input type="submit" value="Edit disease"></p>
    </form>
</div>


</body>
</html>
