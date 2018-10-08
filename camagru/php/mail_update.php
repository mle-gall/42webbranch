<?php
session_start();
include('user_functions.php');
if($_POST['submit'] === "OK" && isset($_POST['email']) && isset($_SESSION['id']) && ($_SESSION['connexion_status'] == "connected"))
{
    if(mail_update($_POST['email'], $_SESSION['id']) === TRUE)
    {
        header('Location: ../userpanel.php?msuccess=updated');
    }
    else
    {
        header('Location: ../userpanel.php?merror=error');
    }
}
else
{
    header('Location: ../userpanel.php?merror=error');
}
?>
