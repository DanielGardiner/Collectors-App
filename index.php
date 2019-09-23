<?php

/*
 * Simple function to retrieve data from database
 *
 * @return array containing all data from database
 */
function retrieveData(): array {
    $db = new PDO('mysql:host=db;dbname=Disease_db', 'root', 'password');

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->query('SELECT `Organism`, `Incubation_usual`, `Incubation_range`, `Symptoms`, `Severity`, `Avg_annual_incidence` FROM disease_table');

    $output = $query->fetchAll();

    return $output;
}

/*
 * Produce html text to display data
 *
 * @param array an array to present in the browser
 *
 * @return string a string containing html code
 */
function displayData(array $data): string {
    $htmlToOutput = null;

    foreach ($data as $row) {
        $htmlToOutput = '<div>' . $htmlToOutput;
        foreach ($row as $key => $value) {
            $htmlToOutput = $htmlToOutput . '<strong>' . $key . '</strong>: ' . $value . '<br>';
        }
        $htmlToOutput = $htmlToOutput . '</div>' .'<br>';
    }

    return $htmlToOutput;
}

$allData = retrieveData();

echo displayData($allData);

?>

