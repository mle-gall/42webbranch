<?php
$title = "Register to Camagru";
include "php/header.php";
?>
    <div class=contentform>
    <form class="formbg" action="php/create_user.php" method="post">
    <p>
        <?php
        if(isset($_GET["error"]) && $_GET["error"] === "alreadyexists")
            echo("<div class=msgerror><p>ERROR : Login or email already used.</p></div>");
        if(isset($_GET["error"]) && $_GET["error"] === "passdontmatch")
            echo("<div class=msgerror><p>ERROR : The two password don't match.</p></div>");
        if(isset($_GET["error"]) && $_GET["error"] === "emptyfield")
            echo("<div class=msgerror><p>ERROR : One field is incorrect or missing.</p></div>");
        ?>
        <h1>Register to Camagru</h1>
        <input class=forminput placeholder="Login" type="text" name="login" autofocus maxlength="20" required/>
        <br>
        <input class=forminput placeholder="E-mail adress" type="email" name="email" minlength="3" maxlength="200" required />
        <br>
        <input class=forminput placeholder="Password" type="password" name="passwd1" minlength="6" maxlength="200" required />
        <br>
        <input class=forminput placeholder="Repeat Password" type="password" name="passwd2" required />
        <br>
        <input class=buttonin type="submit" name="submit" value="OK" />
    </p>
    </form>
    </div>

<?php
Include("php/footer.php");
?>
