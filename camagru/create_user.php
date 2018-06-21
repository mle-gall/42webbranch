<?php
include('user_functions.php');
if($_POST['submit'] === "OK" && isset($_POST['login']) && isset($_POST['email']) && isset($_POST['passwd1']) && isset($_POST['passwd2']))
{
    if(hash('sha512', $_POST['passwd1']) === hash('sha512', $_POST['passwd2']))
    {
        if(add_user($_POST['login'], hash('sha512', $_POST['passwd1']), 0, $_POST['email'], $bdd) === FALSE)
        {
            header('Location: register.php?error=alreadyexists');
        }
        else
        {
            header('Location: register.php');
        }
    }
    else
    {
        header('Location: register.php?error=passdontmatch');
    }
}
else {
    header('Location: register.php?error=emptyfield');
}
?>
