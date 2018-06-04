<?php
include "header.php";
if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected')
{
    header('HTTP/1.0 401 Unauthorized');
    header('Location: index.php');
}
?>
        <div class=contentform>
        <form class=formbg method="post" action="modif_password.php">
            <?PHP echo '<h2>Hello '.$_SESSION['login']." !</h2>";?>
            <h1>Change your password</h1>
            <input class=forminput placeholder="Old Password" type="password" name="oldpw" autofocus required />
            <br>
            <input class=forminput placeholder="New Password" type="password" name="newpw" required />
            <br>
            <input class=buttoninput type="submit" name="submit" value="OK" />
        </form>
        </div>

<?php
include "footer.php";
?>
