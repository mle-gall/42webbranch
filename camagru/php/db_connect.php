<?php
include('../config/database.php');
try
{
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    if ($e->getMessage() == "SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost' (using password: YES)") {
        die("No database connection, if you did not installed your website, please do so by acessing /config.php");
    }
    else {
        die('Erreur : ' . $e->getMessage());
    }
}
try
{
    $sql ="USE ".$db.";";
    $bdd->exec($sql);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>
