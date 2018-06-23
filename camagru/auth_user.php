<?php
include('user_functions.php');
if($_POST['submit'] === "OK" && isset($_POST['login']) && isset($_POST['passwd']))
{
    if(log_user($_POST['login'], hash('sha512', $_POST['passwd']), $bdd) === "1")
    {
        // header('Location: register.php?error=alreadyexists');
        echo("Okey");
    }
    else if(log_user($_POST['login'], hash('sha512', $_POST['passwd']), $bdd) === "-1")
    {
        echo("Account unactivated");
    }
    else if(log_user($_POST['login'], hash('sha512', $_POST['passwd']), $bdd) === "0")
    {
        echo("Invalid Password");
    }
    else {
        echo"J'ai chié dans la kol";
    }
    // else
    // {
    //     header('Location: register.php');
    // }
}
?>
