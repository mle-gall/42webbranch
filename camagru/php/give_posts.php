<?php
$content = trim(file_get_contents("php://input"));
session_start();

if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content))
{
    if($content !== '')
    {
        try
        {
            $sql ="USE ".$db.";";
            $bdd->exec($sql);
            $req = $bdd->prepare('SELECT * FROM `PICTURES` WHERE `link` > ? LIMIT 10');
            $req->execute(array($content));
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    else
    {
        try
        {
            $sql ="USE ".$db.";";
            $bdd->exec($sql);
            $req = $bdd->prepare('SELECT * FROM `PICTURES` ORDER by `id` DESC LIMIT 10');
            $req->execute();
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    $i = 0;
    while($datas[$i] = $req->fetch())
    {
        $i++;
    }
    $req->closeCursor();
    foreach($datas as $elem)
    {
        if (isset($elem['link']))
        {
            if (getLikeForId($elem['CreatorID'], $elem['link']) === 1)
            {
                $likeurl = 'uploads/icons/liked.svg';
            }
            else
            {
                $likeurl = 'uploads/icons/like.svg';
            }
            echo "<div class=imgdiv id=".$elem['link'].">
                    <div class=usr>
                        <a>";
                        echo(getNameForID($elem['CreatorID']));
                        echo $creatorname['Name'];
                        echo "
                        </a>
                    </div>
                    <div class=pic>
                        <img src='uploads/images/".$elem['link']."' />
                    </div>
                    <div class=comsection>
                        <div class=actions>
                            <a class=like><img id='".$elem['link']."' class=likebtn src='".$likeurl."'/></a>
                            <a class=like><img class=acticon src='uploads/icons/comment.svg'/></a>
                        </div>
                        <a class=comment id='".$elem['link']."likes'>loading...</a>
                        <div class=comment>
                        <div class=username>
                            <b>Nom</b>
                        </div>
                        <div class=text>
                            <a>Commentaire</a>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }
}

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
