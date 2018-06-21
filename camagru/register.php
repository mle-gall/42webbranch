<?php
$title = "Log-in to Camagru";
include "header.php";
?>
    <div class=contentform>
    <form class="formbg" action="auth_user.php" method="post">
    <p>
        <?php
        if(isset($_GET["message"]) && $_GET["message"] === "error")
            echo("<div class=msgerror><a>ERROR : Invalid Login/Password</a></div>");
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
