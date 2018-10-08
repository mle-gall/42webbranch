<?php
$title = "Forgot your password ?";
Include("php/header.php");
if($_SESSION['connexion_status'] == "connected")
{
    header('index.php');
}

?>
    <div class=contentform>
    <form class="formbg" action="php/retrieve_pw.php" method="post">
    <p>
        <?php
        if(isset($_GET["error"]) && $_GET["error"] === "error")
            echo("<div class=msgerror><a>Your email didn't match your Login, or you supplied incorrect informations.</a></div>");
        ?>
        <h1>Retrieve Password</h1>
        <input class=forminput placeholder="Login" type="text" name="login" autofocus required />
        <br>
        <input class=forminput placeholder="E-mail address" type="text" name="mail" required />
        <br>
        <input class=buttonin type="submit" name="submit" value="OK" />
    </p>
    </form>
    </div>

<?php
Include("php/footer.php");
?>
