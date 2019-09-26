<?php
require_once('functions.php');

$db = establishDisease_dbConnection();
$allData = retrieveData($db);


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
            <div class="heading"><a href="add_item.php"><p>Add Disease</p></a></div>
            <div class="heading"><a href="edit_item.php"><p>Edit disease</p></a></div>
            <div class="heading"><a href="remove_item.php"><p>Remove Disease</p></a></div>
        </nav>
    </div>
    <div class="container">
        <?php echo displayDisease($allData); ?>
    </div>
</body>
</html>
