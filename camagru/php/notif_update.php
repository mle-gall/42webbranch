<?php
session_start();
include('user_functions.php');
if(($_POST['submit'] === "OK") && ($_SESSION['connexion_status'] == "connected"))
{
    if (isset($_POST['Notification']))
    {
    $val = 1;
    }
    else
    {
        $val = 0;
    }
    if(notif_update($val, $_SESSION['id']) === TRUE)
    {
        header('Location: ../userpanel.php?nsuccess=updated');
    }
    else
    {
        header('Location: ../userpanel.php?nerror=error');
    }
}
else
{
    header('Location: ../userpanel.php?merror=error');
}
?>
