<?php
require('functions.php');

$allData = retrieveData();

// echo displayData($allData);



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>

<div class="container">
    <?php echo displayData($allData); ?>
</div>

</body>
</html>
