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

function getCreatorId($picid)
{
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try
    {
        $req = $bdd->prepare('SELECT * FROM `PICTURES` WHERE `link` = ?');
        $req->execute(array(
            $picid
        ));
    }
    catch (PDOException $e)
    {
        return('error');
    }
    $data = $req->fetch();
    $creatorID = $data['CreatorID'];
    $req->closeCursor();
    return($creatorID);
}

function getHash($user)
{
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try
    {
        $req = $bdd->prepare('SELECT * FROM `USERS` WHERE `ID` = ?');
        $req->execute(array(
            $user
        ));
    }
    catch (PDOException $e)
    {
        return('error');
    }
    $data = $req->fetch();
    $hash = $data['Password'];
    $req->closeCursor();
    return($hash);
}

?>
