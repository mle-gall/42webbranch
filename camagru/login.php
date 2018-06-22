<?php
$title = "Log-in to Camagru";
include "header.php";
?>
    <div class=contentform>
    <form class="formbg" action="auth_user.php" method="post">
    <p>
        <?php
        if(isset($_GET["message"]) && $_GET["success"] === "activate")
            echo("<div class=msgsuccess><a>Your account has been activated. Welcome to Camagru !</a></div>");
        ?>
        <h1>Log-in</h1>
        <input class=forminput placeholder="Login" type="text" name="login" autofocus required />
        <br>
        <input class=forminput placeholder="Password" type="password" name="passwd" required />
        <br>
        <input class=buttonin type="submit" name="submit" value="OK" />
    </p>
    </form>
    </div>

<?php
include "footer.php";
?>
