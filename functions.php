<?php

/**
 * Establish a connection to Disease_db database
 *
 * @return PDO connection to Disease_db database
 */
function establishDisease_dbConnection(): PDO {
    $db = new PDO('mysql:host=db;dbname=Disease_db', 'root', 'password');

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $db;
}

/**
 * Simple function to retrieve data from database
 *
 * @return array containing all data from database
 */
function retrieveData(PDO $db): array {
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
 * Move file uploaded by user into the figures folder and grab name of that file
 *
 * @return string containing the name of the uploaded file
 */
function moveUploadedImgToFolderAndGrabName() {
    $fileName = $_FILES['disease-img']['name'];
    $fileTmpName = $_FILES['disease-img']['tmp_name'];
    $fileSize = $_FILES['disease-img']['size'];
    $fileError = $_FILES['disease-img']['error'];

    $fileNameParts = explode('.', $fileName);
    $fileExt = strtolower(end($fileNameParts));
    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
    if (in_array( $fileExt, $allowed) && $fileError === 0 && $fileSize < 900000) {
        $fileNameNew = uniqid($fileName, true) . '.' . $fileExt;
        $fileDestination = 'figures/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        return $fileNameNew;
    } else {
        exit('Image upload error!');
    }
}


/**
 * Securely add user input to database as new row
 *
 * @param string $imgFileName describing the name of the uploaded image file
 */
function addNewDiseaseToDB(PDO $db, string $imgFileName)
{
    $query = $db->prepare('INSERT INTO `disease_table` (`Organism`, `Incubation_usual`, `Incubation_range`, `Symptoms`, `Severity`, `Avg_annual_incidence`, `Img_location`) 
VALUES (:organism, :incubation_usual, :incubation_range, :symptoms, :severity, :avg_annual_incidence, :img_location)');

    $query->execute(['organism' => $_POST['organism'],
        'incubation_usual' => $_POST['incubation-usual'],
        'incubation_range' => $_POST['incubation-range'],
        'symptoms' => $_POST['symptoms'],
        'severity' => $_POST['severity'],
        'avg_annual_incidence' => $_POST['avg-annual-incidence'],
        'img_location' => 'figures/' . $imgFileName]);
}


/**
 * Creating an array of organism key-value pairs which will be used to select which organisms to delete from database
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













