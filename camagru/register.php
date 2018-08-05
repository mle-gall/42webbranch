<?php
$title = "Register to Camagru";
include "php/header.php";
?>
    <div class=contentform>
    <form class="formbg" action="php/create_user.php" method="post">
    <p>
        <?php
        if(isset($_GET["error"]) && $_GET["error"] === "alreadyexists")
            echo("<div class=msgerror><a>ERROR : Login or email already used.</a></div>");
        if(isset($_GET["error"]) && $_GET["error"] === "passdontmatch")
            echo("<div class=msgerror><a>ERROR : The two password don't match.</a></div>");
        if(isset($_GET["error"]) && $_GET["error"] === "emptyfield")
            echo("<div class=msgerror><a>ERROR : One field is incorrect or missing.</a></div>");
        ?>
        <h1>Register to Camagru</h1>
        <input class=forminput placeholder="Login" type="text" name="login" autofocus required />
        <br>
        <input class=forminput placeholder="E-mail adress" type="email" name="email" required />
        <br>
        <input class=forminput placeholder="Password" type="password" name="passwd1" required />
        <br>
        <input class=forminput placeholder="Repeat Password" type="password" name="passwd2" required />
        <br>
        <input class=buttonin type="submit" name="submit" value="OK" />
    </p>
    </form>
    </div>

<?php
include "php/footer.php";
?>
