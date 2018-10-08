<?php
include('utils.php');
$content = trim(file_get_contents("php://input"));
session_start();
if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content) && isset($_SESSION['id']) AND $_SESSION['connexion_status'] === 'connected')
{
    $decoded = json_decode($content, true);
    $creatorID = getCreatorId($decoded['picid']);
    $request = $bdd->prepare('SELECT * FROM `USERS` WHERE `ID` = ?');
    $request->execute(array(
        $creatorID
    ));
    $data = $request->fetch();
    $request->closeCursor();
    if($data['Mailing'] == "1") {
        include('../mails/comment-template.php');
        mail($data['Email'], "Activity on one of your pictures", $template, $headers);
    }
    $req = $bdd->prepare('INSERT INTO `COMMENTS` (ID, CreatorID, PicID, Content) VALUES(NULL, :creator, :pic, :content);');
    $req->execute(array(
        'creator' => $_SESSION['id'],
        'pic' => $decoded['picid'],
        'content' => $decoded['content']
    ));
    $req->closeCursor();
}

?>
