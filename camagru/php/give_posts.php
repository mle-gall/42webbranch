<?php
Include('../config/database.php');
// $content = trim(file_get_contents("php://input"));
$content = '00001.04.1';

if (isset($content))
{
    $delta = explode(".",$content);
    try
    {
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $sql ="USE ".$db.";";
        $bdd->exec($sql);
        $req = $bdd->prepare('SELECT * FROM `PICTURES` WHERE `ID` BETWEEN ? AND ?;');
        $req->execute(array(intval($delta[0]), intval($delta[1])));
        $req->closeCursor();
    }
    catch (PDOException $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    while($data = $req->fetch())
    {

        print_r($data);
        echo '<br';
    }
}
?>
