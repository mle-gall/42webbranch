<?php

Include('../config/database.php');
session_start();
if (isset($_SESSION['id']) AND $_SESSION['connexion_status'] === 'connected')
{
    try
    {
        echo($_SESSION['id']);
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $sql ="USE ".$db.";";
        $bdd->exec($sql);
        $req = $bdd->prepare('SELECT * FROM `pictures` WHERE `CreatorID` LIKE ?');
        $req->execute(array(intval($_SESSION['id'])));
    }
    catch (PDOException $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    while($data = $req->fetch())
    {
    }
    $req->closeCursor();
}
else {
    echo("not ok\n");
}
?>
