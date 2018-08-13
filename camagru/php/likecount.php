<?php
$content = trim(file_get_contents("php://input"));

if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content))
{
    $req = $bdd->prepare('SELECT * FROM `LIKES` WHERE `PicID` = ?');
    $req->execute(array(
        $content
    ));
}
$i = 0;
while($data = $req->fetch())
{
    $i++;
}
echo($i);
?>
