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
 * @param PDO $db a connection to the database
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

/**
 * Set database Delete organism from list of diseases on collection page
 *
 * @param string $organism specifying which to remove
 */
function deleteOrganism(PDO $db, string $organism) {

    $query = $db->prepare('UPDATE `disease_table` SET `Deleted` = 1 WHERE `Organism` = :organism');

    $query->execute(['organism' => $organism]);

}

/**
 * Grab database data for the organism selected by the user
 *
 * @param array $allData from database
 *
 * @return array of data for a specific organism
 */
function grabDataForSelectedOrganism(array $allData): array {
    foreach ($allData as $row) {
        if ($row['Organism'] == $_POST['edit-organism']) {
            return $row;
        }
    }
}

/**
 * Create an html form which is pre-populated with data for the organism select by the user, this is so they can
 * edit data for this organism
 *
 * @param array $organismArray containing data for the specified organism
 *
 * @return string an html form with pre-populated data
 */
function createOrganismEditForm(array $organismArray): string {

    return ' <form method="post" enctype="multipart/form-data"><label for="organism">Organism</label><input type="text" name="organism" id="organism"  value = "' .
        $organismArray['Organism'] . '" required><label for="incubation-usual">Incubation usual</label><input type="text" name="incubation-usual" id="incubation-usual"  value = "' .
        $organismArray['Incubation_usual'] . '" required><label for="incubation-range">Incubation range</label><input type="text" name="incubation-range" id="incubation-range" value = "' .
        $organismArray['Incubation_range'] . '" required><label for="symptoms">Symptoms</label><input type="text" name="symptoms" id="symptoms" value = "' .
        $organismArray['Symptoms'] . '" required><label for="severity">Severity</label><input type="text" name="severity" id="severity"  value = "' .
        $organismArray['Severity'] . '" required><label for="avg-annual-incidence">Average annual incidence</label><input type="number" name="avg-annual-incidence" id="avg-annual-incidence"  value = "' .
        $organismArray['Avg_annual_incidence'] . '" required><label for="disease-img">Image</label><input type="file" name="disease-img" id="disease-img" required><input type="submit" value="Edit disease"></form>';
}

/**
 * Edit database data for a selected organism
 *
 * @param PDO $db database to edit
 * @param string $imgFileName details of the updated image file name
 * @param string $selectedOrganism the organism selected by the user to update data
 */
function editOrganism(PDO $db, string $imgFileName, string $selectedOrganism) {
    $query = $db->prepare('UPDATE `disease_table` SET `Organism` = :organism, `Incubation_usual` = :incubation_usual, `Incubation_range` = :incubation_range, `Symptoms` = :symptoms, 
`Severity` = :severity, `Avg_annual_incidence` = :avg_annual_incidence, `Img_location` = :img_location WHERE `Organism` = :selected_organism');

    $query->execute(['selected_organism' => $selectedOrganism,
        'organism' => $_POST['organism'],
        'incubation_usual' => $_POST['incubation-usual'],
        'incubation_range' => $_POST['incubation-range'],
        'symptoms' => $_POST['symptoms'],
        'severity' => $_POST['severity'],
        'avg_annual_incidence' => $_POST['avg-annual-incidence'],
        'img_location' => 'figures/' . $imgFileName]);
}