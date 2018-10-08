<?php
session_start();
include('user_functions.php');
if($_POST['submit'] === "OK" && isset($_POST['login']) && isset($_SESSION['id']) && ($_SESSION['connexion_status'] == "connected"))
{
    if(name_update_user($_POST['login'], $_SESSION['id']) === TRUE)
    {
        header('Location: ../userpanel.php?success=updated');
    }
    else
    {
        header('Location: ../userpanel.php?error=error');
    }
}
else
{
    header('Location: ../userpanel.php?error=error');
}
?>
