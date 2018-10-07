<?php
session_start();
$content = trim(file_get_contents("php://input"));

if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content) && isset($_SESSION['id']) && $_SESSION['connexion_status'] == "connected")
{
    try
    {
        $sql ="USE ".$db.";";
        $bdd->exec($sql);
        $req = $bdd->prepare('SELECT * FROM `LIKES` WHERE `USER` = ?  AND `PicID` = ? LIMIT 1;');
        $req->execute(array(
            $_SESSION['id'],
            $content
        ));
    }
    catch (PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    $isliked = $req->fetch();
    $req->closeCursor();
    if ($isliked == '')
    {
        try
        {
            $req = $bdd->prepare('INSERT INTO LIKES(USER, PicID) VALUES(:user, :picid)');
            $req->execute(array(
                'user' => $_SESSION['id'],
                'picid' => $content
            ));
        }
        catch (PDOException $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        echo('adding');
    }
    else
    {
        $req = $bdd->prepare('DELETE FROM `LIKES` WHERE `USER` = ? AND `PicID` = ?;');
        $req->execute(array(
            $_SESSION['id'],
            $content
        ));
        echo('removing');
    }
}
?>
