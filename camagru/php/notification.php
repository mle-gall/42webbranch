<?php
function notifications($userid)
{
    Include('config/database.php');
    try
    {
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
    try
    {
        $req = $bdd->prepare('SELECT * FROM `USERS` WHERE `ID` = ?');
        $req->execute(array(
            $userid
        ));
    }
    catch (PDOException $e)
    {
        return('error');
    }
    $data = $req->fetch();
    $notifs = $data['Mailing'];
    $req->closeCursor();
    return $notifs;
}
?>
