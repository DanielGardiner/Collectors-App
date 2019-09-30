<?php
session_start();
$_SESSION['started'] = 'Yes';
require_once('functions.php');

$db = establishDisease_dbConnection();
$allData = retrieveData($db);
$allOrganisms = grabAllOrganisms($allData);

if (isset($_POST['edit-organism'])) {
    $organismArray = grabDataForSelectedOrganism($allData, $_POST['edit-organism']);
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
    && isset($_POST['avg-annual-incidence'])) {
    $imgFileName = moveUploadedImgToFolderAndGrabName();
    editOrganism($db, $_SESSION['selectedOrganism'], $_POST['organism'], $_POST['incubation-usual'],
                 $_POST['incubation-range'], $_POST['symptoms'], $_POST['severity'], $_POST['avg-annual-incidence'],
                 $imgFileName);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add item</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body class="edit-item-page">
<div class="nav-panel">
    <nav>
        <div class="heading"><a href="index.php"><p>Collection</p></a></div>
        <div class="heading"><a href="add_item.php"><p>Add Disease</p></a></div>
        <div class="heading underline"><p>Edit Disease</p></div>
        <div class="heading"><a href="remove_item.php"><p>Remove Disease</p></a></div>
    </nav>
</div>

<div class="container edit-item">
    <form class="edit-item" method="post">
        <select name="edit-organism" >
            <?php  echo createAllOrganismDropDown($allOrganisms); ?>
            <input class="submit-remove" type="submit" value="Select disease">
        </select>
    </form>
</div>

<div class="edit-item">
<?php echo $formWithGrabbedOrganismData; ?>
</div>

</body>
</html>
