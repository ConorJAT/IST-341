<?php
    require_once('PDO.DB.class.php');

    if (!isset($_GET['PersonID'])) {
        header('Location: Lab4_3.php');
        die();
    }

    $dbh = new DB();
    $idQuery = $_GET['PersonID'];

    echo $dbh->getPhoneNumsAsAssocTable($idQuery);
    echo "<hr/>";
    echo $dbh->getPhoneNumsAsClassTable($idQuery);

    echo "<p>(<a href='Lab4_3.php'>Go Back to Lab4_3.php</a>)</p>";
?>