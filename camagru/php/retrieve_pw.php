<?php
include('utils.php');
if($_POST['submit'] === "OK" && isset($_POST['login']) && isset($_POST['mail']))
{
    if(user_fits_mail($_POST['login'], $_POST['mail']))
    {
        header('Location: ../login.php?sucess=retrievelink');
    }
    else
    {
        header('Location: ../retrieve.php?error=error');
    }
}
else
{
    header('Location: ../retrieve.php?error=error');
}
?>
