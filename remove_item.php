<?php
require_once('functions.php');

$allData = retrieveData();
$allOrganisms = grabAllOrganisms($allData);
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

    <form class="remove_item">
        <p>Organism</p>
        <select>
            <div class="options">
                <?php  echo createAllOrganismDropDown($allOrganisms); ?>
            </div>
            <div class="submit-remove_item"><input type="submit" value="Remove disease!"></div>
        </select>
    </form>
</div>
</body>
</html>
