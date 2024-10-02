<?php
    require_once('DB.class.php');

    if (!isset($_GET['PersonID'])) {
        header('Location: Lab4_1.php');
        die();
    }

    $db = new DB();
    $idQuery = $_GET['PersonID'];

    echo $db->getAllPhoneNumsAsTable($idQuery);

    echo "<p>(<a href='Lab4_1.php'>Go Back to Lab4_1.php</a>)</p>";
?>