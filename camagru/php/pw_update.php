<?php
session_start();
include('user_functions.php');
if($_POST['submit'] === "OK" && isset($_POST['opasswd']) && isset($_POST['npasswd']) && isset($_POST['npasswdr']) && isset($_SESSION['id']) && ($_SESSION['connexion_status'] == "connected"))
{
    if(hash('sha512', $_POST['npasswd']) === hash('sha512', $_POST['npasswdr']))
    {
        if(hash('sha512', $_POST['npasswd']) !== hash('sha512', $_POST['opasswd']))
        {
            if(update_pw(hash('sha512', $_POST['opasswd']), hash('sha512', $_POST['npasswd']), $_SESSION['id']) == TRUE)
            {
                echo("here");

                header('Location: ../userpanel.php?psuccess=updated');
            }
            else
            {
                header('Location: ../userpanel.php?perror=oldpw');
            }
        }
        else
        {
            header('Location: ../userpanel.php?perror=same');
        }
    }
    else
    {
        header('Location: ../userpanel.php?perror=dontmatch');
    }
}
else
{
    header('Location: ../userpanel.php?error=error');
}
?>
