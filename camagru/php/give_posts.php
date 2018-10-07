<?php
include("utils.php");
$content = trim(file_get_contents("php://input"));
session_start();

if(isset($bdd) == 0)
{
    include('db_connect.php');
}
if (isset($content))
{
    console.log($content);
    if($content !== '')
    {
        try
        {
            $sql ="USE ".$db.";";
            $bdd->exec($sql);
            $req = $bdd->prepare('SELECT * FROM `PICTURES` WHERE `link` < ? ORDER by `id` DESC LIMIT 10');
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
            if (getLikeForId($_SESSION['id'], $elem['link']) === 1)
            {
                $likeurl = 'uploads/icons/liked.svg';
            }
            else
            {
                $likeurl = 'uploads/icons/like.svg';
            }
            echo "<div class=imgdiv id=".$elem['link'].">
                    <div class=usr>
                        <p>";
                        echo(getNameForID($elem['CreatorID']));
                        echo $creatorname['Name'];
                        echo "
                        </p>
                    </div>
                    <div class=pic>
                        <img src='uploads/images/".$elem['link']."' />
                    </div>
                    <div class=comsection>
                        <div class=actions>
                            <a class=like><img id='".$elem['link']."' class=likebtn src='".$likeurl."'/></a>
                            <a class=like><img class=acticon src='uploads/icons/comment.svg'/></a>
                            <a class=comment id='".$elem['link']."likes'>loading...</a>
                        </div>
                        <div class=comments id='".$elem['link']."com'>

                        </div>
                        <div class=addcomment id='".$elem['link']."'>
                            <form id='form'>
                                <input class='commentinput' id='field' placeholder='Your comment...' />
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }
}

?>
