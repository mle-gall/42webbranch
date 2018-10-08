<?php
include('user_functions.php');
if($_POST['submit'] === "OK" && isset($_POST['login']) && isset($_POST['passwd']))
{
    $id = log_user($_POST['login'], hash('sha512', $_POST['passwd']), $bdd);
    if(intval($id) > 0)
    {
        session_start();
        $_SESSION['connexion_status'] = 'connected';
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['id'] = $id;
        header('Location: ../index.php');
    }
    else if(log_user($_POST['login'], hash('sha512', $_POST['passwd']), $bdd) === "-1")
    {
        header('Location: ../login.php?error=unvalidatedaccount');
    }
    else if(log_user($_POST['login'], hash('sha512', $_POST['passwd']), $bdd) === "0")
    {
        header('Location: ../login.php?error=invalidpw');
    }
    else
    {
        header('Location: ../login.php');
    }
    else
    {
        header('Location: register.php');
    }
}
?>
