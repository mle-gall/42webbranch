<?php
$title = "Reinitialize your Password";
Include("php/header.php");
?>
    <div class=contentform>
    <form class="formbg" action="php/reint_pw.php" method="post">
    <p>
        <?php
        if(isset($_GET["error"]) && $_GET["error"] === "passdontmatch")
            echo("<div class=msgerror><p>ERROR : The two password don't match.</p></div>");
        ?>
        <h1>Reinitialize your Password</h1>
        <input type='hidden' name='key' value='<?php echo $_GET['id'];?>' />
        <input class=forminput placeholder="New Password" type="password" name="passwd1" minlength="6" maxlength="200" required />
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
