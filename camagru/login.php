<?php
$title = "Log-in to Camagru";
Include("php/header.php");
?>
    <div class=contentform>
    <form class="formbg" action="php/auth_user.php" method="post">
    <p>
        <?php
        if(isset($_GET["success"]) && $_GET["success"] === "activate")
            echo("<div class=msgsuccess><a>Your account has been activated. Welcome to Camagru !</a></div>");
        if(isset($_GET["error"]) && $_GET["error"] === "unvalidatedaccount")
            echo("<div class=msgerror><a>Your account is not validated. Check your inbox and activate it.</a></div>");
        if(isset($_GET["error"]) && $_GET["error"] === "invalidpw")
            echo("<div class=msgerror><a>Invalid login or password. Try again !</a></div>");
        ?>
        <h1>Log-in</h1>
        <input class=forminput placeholder="Login or email" type="text" name="login" autofocus required />
        <br>
        <input class=forminput placeholder="Password" type="password" name="passwd" required />
        <br>
        <input class=buttonin type="submit" name="submit" value="OK" />
    </p>
    </form>
    </div>

<?php
include "php/footer.php";
?>
