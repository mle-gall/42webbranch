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
        <form class="backdivbg" action="delete_category.php" method="post">
        <p>
            <?php
            if(isset($_GET["action"]) && $_GET["action"] === "create")
                echo("<div class=msgsucces><a>Your category has been deleted ! Yupi !</a></div>");
            else if(isset($_GET["action"]) && $_GET["action"] === "error")
                echo("<div class=msgerror><a>ERROR : Check title, Login and Password</a></div>");
            ?>
            <h1>Delete category</h1>
            <input class=forminput placeholder="Title" type="text" name="category" autofocus required />
            <br>
            <input class=forminput placeholder="Your Login" type="text" name="admin_login" autofocus required />
            <br>
            <input class=forminput placeholder="Your Password" type="text" name="password" autofocus required />
            <br>
            <input class=buttoninput type="submit" name="submit" value="OK" />
        </p>
        </form>
        </div>
</div>
<?php
include 'footer.php';
?>
