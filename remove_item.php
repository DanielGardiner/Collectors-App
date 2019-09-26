<?php
require_once('functions.php');

$db = establishDisease_dbConnection();
$allData = retrieveData($db);
$allOrganisms = grabAllOrganisms($allData);

if (isset($_POST['remove-organism'])) {
    deleteOrganism($db, $_POST['remove-organism']);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove item</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
<div class="nav-panel">
    <nav>
        <div class="heading"><a href="index.php"><p>Collection</p></a></div>
        <div class="heading"><a href="add_item.php"><p>Add disease</p></a></div>
        <div class="heading underline"><p>Remove disease</p></div>
    </nav>
</div>
<div class="container remove-item">
    <form class="remove-item" method="post">
        <p>Organism</p>
        <select name="remove-organism" >
            <?php  echo createAllOrganismDropDown($allOrganisms); ?>
            <input class="submit-remove" type="submit" value="Eradicate disease!">
        </select>
    </form>
</div>
</body>
</html>
