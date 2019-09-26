<?php
session_start();
require_once('functions.php');

$db = establishDisease_dbConnection();
$allData = retrieveData($db);
$allOrganisms = grabAllOrganisms($allData);

if (isset($_POST['edit-organism'])) {
    $organismArray = grabDataForSelectOrganism($allData);
    $_SESSION['selectedOrganism'] = $organismArray['Organism'];
    $formWithGrabbedOrganismData = createOrganismEditForm($organismArray);
} else {
    $formWithGrabbedOrganismData = '';
}

if (isset($_POST['organism'])
    && isset($_POST['incubation-usual'])
    && isset($_POST['incubation-range'])
    && isset($_POST['symptoms'])
    && isset($_POST['severity'])
    && isset($_POST['avg-annual-incidence'])
    && isset($_FILES['disease-img'])
    && $_FILES['disease-img']['name'] != '') {
    $imgFileName = moveUploadedImgToFolderAndGrabName();
    editOrganism($db, $imgFileName, $_SESSION['selectedOrganism']);
}

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
        <div class="heading"><a href="index.php"><p>Collection</p></a></div>
        <div class="heading"><a href="add_item.php"><p>Add Disease</p></a></div>
        <div class="heading underline"><p>Edit Disease</p></div>
        <div class="heading"><a href="remove_item.php"><p>Remove disease</p></a></div>
    </nav>
</div>

<div class="container edit-item">
    <form class="edit-item" method="post">
        <p>Select disease to edit</p>
        <select name="edit-organism" >
            <?php  echo createAllOrganismDropDown($allOrganisms); ?>
            <input class="submit-remove" type="submit" value="Edit disease">
        </select>
    </form>
</div>

<div class="edit-item">
<?php echo $formWithGrabbedOrganismData; ?>
</div>

</body>
</html>
