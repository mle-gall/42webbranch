<?php
Include('../config/database.php');
$content = trim(file_get_contents("php://input"));

if (isset($content))
{
    if($content !== '')
    {
        try
        {
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
        <a class=like><img class=acticon src='uploads/icons/like.svg'/></a>
        <a class=like><img class=acticon src='uploads/icons/comment.svg'/></a>
        </div>
        <div class=comment>
        <div class=username>
        <b>Malolollol</b>
        </div>
        <div class=text>
        <a>Haha tro drol dfghjklhf ojhv oiughp 0oiuhjoiuy hoihjloiu hoiuhj kjh0oiuh iuhji uhjkkj oiujhk ijk oijk iujhk iuhoiuh jiuhiu juhjuh iuhjuyhjuyh juhuh</a>
        </div>
        </div>
        <div class=comment>
        <div class=username>
        <b>max</b>
        </div>
        <div class=text>
        <a>Ben non...</a>
        </div>
        </div>
        </div>
        </div>";
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
    return($data['Name']);
}
?>
