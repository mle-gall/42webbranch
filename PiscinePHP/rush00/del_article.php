<?php
include 'header.php';
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
    header('HTTP/1.0 401 Unauthorized');
    header('Location: index.php');
}
?>
<div class=pageback>
    <?php include'sidebar.php'?>
    <div class=backcontent>
        <div class=backdivbg>
            <form class="formbg" action="delete_article.php" method="post">
            <p>
                <?php
                if(isset($_GET["action"]) && $_GET["action"] === "create")
                    echo("<div class=msgsucces><a>Your article has been deleted ! Yupi !</a></div>");
                else if(isset($_GET["action"]) && $_GET["action"] === "error")
                    echo("<div class=msgerror><a>ERROR : Invalid Login or Password</a></div>");
                else if(isset($_GET["action"]) && $_GET["action"] === "error2")
                    echo("<div class=msgerror><a>ERROR : Invalid Title</a></div>");
                ?>
                <h1>Delete article</h1>
                <input class=forminput placeholder="Title" type="text" name="title" autofocus required />
                <br>
                <input class=forminput placeholder="Your login" type="text" name="admin_login" required />
                <br>
                <input class=forminput placeholder="Your password" type="password" name="password" required />
                <br>
                <input class=buttoninput type="submit" name="submit" value="OK" />
            </p>
            </form>
        </div>
        </div>
</div>
<?php
include 'footer.php';
?>
