<?php
require_once('functions.php');

$allData = retrieveData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collection</title>
    <link rel="stylesheet" href="normalize.css" type="text/css">
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div class="nav-panel">
        <nav>
            <div class="heading underline"><p>Collection</p></div>
            <div class="heading"><a href="add_item.php"><p>Add disease</p></a></div>
            <div class="heading"><a href="remove_item.php"><p>Remove disease</p></a></div>
        </nav>
    </div>
    <div class="container">
        <?php echo displayDisease($allData); ?>
    </div>
</body>
</html>
