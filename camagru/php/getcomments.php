<?php
include("utils.php");
$content = trim(file_get_contents("php://input"));

if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content))
{
    $req = $bdd->prepare('SELECT * FROM `COMMENTS` WHERE `PicID` = ?');
    $req->execute(array(
        $content
    ));
}
$rows = array();
while($r = $req->fetch())
{
    $r['CreatorName'] = getNameForID($r['CreatorID']);
    $rows[] = $r;
}
print json_encode($rows);
?>
