<?php
include('user_functions.php');
if($_POST['submit'] === "OK" && isset($_POST['passwd1']) && isset($_POST['passwd2']) && isset($_POST['key']))
{
    if(hash('sha512', $_POST['passwd1']) === hash('sha512', $_POST['passwd2']))
    {
        if(reint_pw(hash('sha512', $_POST['passwd1']), $_POST['key']) === TRUE)
        {
            header('Location: ../login.php?success=activate');
        }
        else
        {
            header('Location: ../reint.php');
        }
    }
    else
    {
        header('Location: ../reint.php?error=passdontmatch');
    }
}
else
{
    header('Location: ../reint.php');
}
?>
