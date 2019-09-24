<?php

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
            <div class="link"><a href="index.php"><p>Collection</p></a></div>
            <div class="link underline"><p>Add disease</p></div>
        </nav>
    </div>
    <div class="container add_item">
        <form method="post">
            <p>Organism</p>
            <p><input type="text" name="organism"></p>
            <p>Incubation usual</p>
            <p><input type="text" name="incubation_usual"></p>
            <p>Incubation range</p>
            <p><input type="text" name="incubation_range"></p>
            <p>Symptoms</p>
            <p><input type="text" name="symptoms"></p>
            <p>Severity</p>
            <p><input type="number" name="severity"></p>
            <p>Average annual incidence</p>
            <p><input type="text" name="avg_annual_incidence"></p>
            <p>Image</p>
            <p><input type="file" name="img_location"></p>
            <input type="submit">
        </form>
    </div>
</body>
</html>
