<?php
function getNameForID($id)
{
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try
    {
        $creator = $bdd->prepare('SELECT * FROM `USERS` where `ID` = ?; LIMIT 1;');
        $creator->execute(array($id));
    }
    catch (PDOException $e)
    {
        return('error');
    }
    $data = $creator->fetch();
    $creator->closeCursor();
    return($data['Name']);
}

function getLikeForId($id, $pic)
{
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try
    {
        $creator = $bdd->prepare('SELECT * FROM `LIKES` WHERE `USER` = ? AND `PicID` = ? LIMIT 1;');
        $creator->execute(array($id, $pic));
    }
    catch (PDOException $e)
    {
        return('error');
    }
    $data = $creator->fetch();
    $creator->closeCursor();
    if($data == '')
    {
        return(0);
    }
    else
    {
        return(1);
    }
}
?>
