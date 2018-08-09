<?php

Include('../config/database.php');
session_start();
if (isset($_SESSION['id']) AND $_SESSION['connexion_status'] === 'connected')
{
    try
    {
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $sql ="USE ".$db.";";
        $bdd->exec($sql);
        $req = $bdd->prepare('SELECT * FROM `PICTURES` WHERE `CreatorID` LIKE ? ORDER BY ID DESC');
        $req->execute(array(intval($_SESSION['id'])));
    }
    catch (PDOException $e)
    {
        echo(0);
        die('Erreur : ' . $e->getMessage());
    }
    $i = 0;
    while($data = $req->fetch())
    {
        echo('<div class=sidepic>
        <img src=uploads/images/'.$data['link'].' class=prev />
        <div class="removebutton" id='.$data['link'].' >
        <a>Remove Picture</a>
        </div>
        </div>');
        $i = 1;
    }
    if ($i = 0) {
        echo(0);
    }
    $req->closeCursor();
}
else {
    echo('0');
}
?>
