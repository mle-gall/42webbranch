<?php
$content = trim(file_get_contents("php://input"));
session_start();
if(isset($bdd) == 0)
{
    include('db_connect.php');
}
echo("oki");
if (isset($content) && isset($_SESSION['id']) AND $_SESSION['connexion_status'] === 'connected')
{
    $decoded = json_decode($content, true);
    $req = $bdd->prepare('INSERT INTO `COMMENTS` (ID, CreatorID, PicID, Content) VALUES(NULL, :creator, :pic, :content);');
    $req->execute(array(
        'creator' => $_SESSION['id'],
        'pic' => $decoded['picid'],
        'content' => $decoded['content']
    ));

    echo("ici");

    echo("Ok");
}
?>
