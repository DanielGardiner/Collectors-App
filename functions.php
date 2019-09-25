<?php

/**
 * Simple function to retrieve data from database
 *
 * @return array containing all data from database
 */
function retrieveData(): array {
    $db = new PDO('mysql:host=db;dbname=Disease_db', 'root', 'password');

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->query('SELECT `Organism`, `Incubation_usual`, `Incubation_range`, `Symptoms`, `Severity`, `Avg_annual_incidence`, `Img_location` FROM `disease_table` WHERE `Deleted` = 0');

    $output = $query->fetchAll();

    return $output;
}

/**
 * Produce html text to display disease data in browser
 *
 * @param array to present in the browser
 *
 * @return string containing html code
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

/**
 * Securely add user input to database
 */
function addNewDiseaseToDB()
{
    $db = new PDO('mysql:host=db;dbname=Disease_db', 'root', 'password');

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare('INSERT INTO `disease_table` (`Organism`, `Incubation_usual`, `Incubation_range`, `Symptoms`, `Severity`, `Avg_annual_incidence`) 
VALUES (:organism, :incubation_usual, :incubation_range, :symptoms, :severity, :avg_annual_incidence)');

    $query->execute(['organism' => $_POST['organism'],
        'incubation_usual' => $_POST['incubation_usual'],
        'incubation_range' => $_POST['incubation_range'],
        'symptoms' => $_POST['symptoms'],
        'severity' => $_POST['severity'],
        'avg_annual_incidence' => $_POST['avg_annual_incidence']]);
}


/**
 * Grab all organism key-value pairs from a multidimensional array
 *
 * @param array $data to grab organisms from
 *
 * @return array of just organisms
 */
function grabAllOrganisms(array $data): array {
    $organisms = [];
    foreach ($data as $row){
        $organisms[] = $row['Organism'];
    }
    return $organisms;
}

/**
 * Create an html drop down menu of organisms from an array of organisms
 *
 * @param array $organismArray containing set of organisms to pick from
 *
 * @return string containing html text to produce drop down menu of organisms
 */
function createAllOrganismDropDown(array $organismArray): string {
    $htmlToOutput = '';

    foreach ($organismArray as $organism) {
        $htmlToOutput .= '<option value="' . $organism . '">' . $organism . '</option>';
    }
    return $htmlToOutput;
}

/**
 * Delete organism from list of diseases on collection page
 *
 * @param string $organism specifying which to remove
 */
function deleteOrganism(string $organism) {
    $db = new PDO('mysql:host=db;dbname=Disease_db', 'root', 'password');

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare('UPDATE `disease_table` SET `Deleted` = 1 WHERE `Organism` = :organism');

    $query->execute(['organism' => $organism]);

}













