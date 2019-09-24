<?php
require('functions.php');

$allData = retrieveData();


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>


<div class="page">
    <nav>
        <div class="link"><a href="#"><p>Collection</p></a></div>
        <div class="link"><a href="#"><p>Add disease</p></a></div>
    </nav>
    <div class="container">
        <?php echo displayDisease($allData); ?>
    </div>
</div>
</body>
</html>
