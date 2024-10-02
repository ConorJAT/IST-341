<?php
    require_once('PDO.DB.class.php');

    $dbh = new DB();

    echo $dbh->getAllPeopleAsTable();
?>
