<?php
Include('config/database.php');
try
{
    if ($DB_DSN === "mysql:host=localhost")
        $DB_DSN = "mysql:host=127.0.0.1;port=8889";
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
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
