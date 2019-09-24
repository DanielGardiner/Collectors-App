<?php

/**
 * Simple function to retrieve data from database
 *
 * @return array containing all data from database
 */
function retrieveData(): array {
    $db = new PDO('mysql:host=db;dbname=Disease_db', 'root', 'password');

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->query('SELECT `Organism`, `Incubation_usual`, `Incubation_range`, `Symptoms`, `Severity`, `Avg_annual_incidence`, `Img_location` FROM disease_table');

    $output = $query->fetchAll();

    return $output;
}

/**
 * Produce html text to display data
 *
 * @param array an array to present in the browser
 *
 * @return string a string containing html code
 */
function displayDisease(array $data): string {
    $htmlToOutput = '';
    foreach ($data as $row) {
        $htmlForRow = '<div><img src="' . $row['Img_location'] . '" alt=""></div>';
        unset($row['Img_location']);
        foreach ($row as $key => $value) {
            $htmlForRow =  $htmlForRow . '<strong>' . $key . '</strong><br>' . $value . '<br>' ;
        }
        $htmlForRow = '<div class="disease-item">' . $htmlForRow . '</div>' ;
        $htmlToOutput = $htmlToOutput . $htmlForRow;
    }
    return $htmlToOutput;
}
























