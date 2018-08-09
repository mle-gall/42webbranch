<?php
$content = trim(file_get_contents("php://input"));
session_start();

if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content) && isset($_SESSION['id']) AND $_SESSION['connexion_status'] === 'connected')
{
    $path = '../uploads/images/'.$content;
    if(file_exists($path))
    {
        unlink($path);
    }
    $req = $bdd->prepare('DELETE FROM `PICTURES` WHERE `PICTURES`.`link` = ?');
    $req->execute(array($content));
}
?>
