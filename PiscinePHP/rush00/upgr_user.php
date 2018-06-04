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
            <form class="backdivbg" action="upgrade_user.php" method="post">
            <p>
                <?php
                if(isset($_GET["action"]) && $_GET["action"] === "create")
                    echo("<div class=msgsucces><a>User has been upgraded ! Yupi !</a></div>");
                else if(isset($_GET["action"]) && $_GET["action"] === "error")
                    echo("<div class=msgerror><a>ERROR : Check title, Login and Password</a></div>");
                ?>
                <h1>Upgrade an user</h1>
                <input class=forminput placeholder="User login" type="text" name="user_login" autofocus required />
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
<?php
include 'footer.php';
?>
