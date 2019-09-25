<?php
require_once('functions.php');

$allData = retrieveData();
$allOrganisms = grabAllOrganisms($allData);

if (isset($_POST['remove-organism'])) {
    deleteOrganism($_POST['remove-organism']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Remove item</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
<div class="nav-panel">
    <nav>
        <div class="link"><a href="index.php"><p>Collection</p></a></div>
        <div class="link"><a href="add_item.php"><p>Add disease</p></a></div>
        <div class="link underline"><p>Remove disease</p></div>
    </nav>
</div>
<div class="container remove_item">
    <form class="remove_item" method="post">
        <p>Organism</p>
        <select name="remove-organism" >
            <?php  echo createAllOrganismDropDown($allOrganisms); ?>
            <input class="submit-remove" type="submit" value="Remove disease!">
        </select>
    </form>
</div>
</body>
</html>
