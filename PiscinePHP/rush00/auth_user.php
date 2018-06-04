<?php
session_start();

function auth($login, $passwd)
{
    $passwd = hash('whirlpool', $passwd);
    $array = file_get_contents('private/users');
    $array = unserialize($array);
    foreach ($array as $account)
    {
        if ($login === $account['login'] AND $passwd === $account['passwd'])
        {
            $_SESSION['admin'] = $account['admin'];
            return TRUE;
        }
    }
    return FALSE;
}

if (auth($_POST['login'], $_POST['passwd']) == TRUE)
{
    $_SESSION['connexion_status'] = 'connected';
    $_SESSION['login'] = $_POST['login'];
    header('Location: index.php');
}
else
    header('Location: connexion.php?action=error');
?>
