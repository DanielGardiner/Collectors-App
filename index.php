<?php

$db = new PDO('mysql:host=db;dbname=Disease_db', 'root', 'password');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->query('SELECT `Organism`, `Incubation_usual`, `Incubation_range`, `Symptoms`, `Severity`, `Avg_annual_incidence` FROM disease_table');

$allData = $query->fetchAll();

foreach ($allData as $row) {
    foreach ($row as $key => $value) {
        echo '<strong>' . $key . '</strong>: ' . $value . '<br>';
    }
    echo '<br>';
}

?>

