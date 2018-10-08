<?php
$title = "User Settings";
Include("php/header.php");
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected')
{
    header('HTTP/1.0 401 Unauthorized');
    header('Location: index.php');
}
?>
<div class="paneltitle">
    <h1>Your settings :</h1>
</div>
<div class=contentformpanel>
    <form class="formbg" action="php/name_update.php" method="post">
        <p>
            <?php
            if(isset($_GET["success"]) && $_GET["success"] === "updated")
                echo("<div class=msgsuccess><a>Your nickname has been changed !</a></div>");
            if(isset($_GET["error"]) && $_GET["error"] === "error")
                echo("<div class=msgerror><a>This nickname has already been taken.</a></div>");
            ?>
            <h1>Change Username</h1>
            <input class=forminput placeholder="New Login" type="text" name="login" autofocus maxlength="20" required />
            <br>
            <input class=buttonin type="submit" name="submit" value="OK" />
        </p>
    </form>
    <form class="formbg" action="php/pw_update.php" method="post">
        <p>
            <?php
            if(isset($_GET["psuccess"]) && $_GET["psuccess"] === "updated")
                echo("<div class=msgsuccess><a>Your password has been updated !</a></div>");
            if(isset($_GET["perror"]) && $_GET["perror"] === "oldpw")
                echo("<div class=msgerror><a>Old password is incorrect.</a></div>");
            if(isset($_GET["perror"]) && $_GET["perror"] === "dontmatch")
                echo("<div class=msgerror><a>Passwords don't match.</a></div>");
            if(isset($_GET["perror"]) && $_GET["perror"] === "same")
                echo("<div class=msgerror><a>You must change your password.</a></div>");
            ?>
            <h1>Change Password</h1>
            <input class=forminput placeholder="Old Password" type="password" name="opasswd" required />
            <br>
            <input class=forminput placeholder="New Password" type="password" name="npasswd" minlength="6" maxlength="200" required />
            <br />
            <input class=forminput placeholder="Retype New Password" type="password" name="npasswdr" minlength="6" maxlength="200" required />
            <br>
            <input class=buttonin type="submit" name="submit" value="OK" />
        </p>
    </form>
    <form class="formbg" action="php/mail_update.php" method="post">
        <p>
            <?php
            if(isset($_GET["msuccess"]) && $_GET["msuccess"] === "updated")
                echo("<div class=msgsuccess><a>Your Email address has been updated !</a></div>");
            if(isset($_GET["merror"]) && $_GET["merror"] === "error")
                echo("<div class=msgerror><a>An error occured.</a></div>");
            ?>
            <h1>Change E-mail</h1>
            <input class=forminput placeholder="New E-mail" type="email" name="email" minlength="3" maxlength="200" required />
            <br>
            <input class=buttonin type="submit" name="submit" value="OK" />
        </p>
    </form>
</div>
<?php
Include("php/footer.php");
?>
