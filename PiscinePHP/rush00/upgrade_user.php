<?php
session_start();

function check_admin()
{
    $pass = hash('whirlpool', $_POST['password']);
    $array = file_get_contents('private/users');
    $unserialized_array = unserialize($array);
    foreach ($unserialized_array as $element)
    {
        if ($element['login'] === $_POST['admin_login'] AND $element['admin'] === 'yes' AND $pass == $element['passwd'])
            return TRUE;
    }
    return FALSE;
}

function already_registered()
{
    $array = file_get_contents('private/users');
    $unserialized_array = unserialize($array);
    foreach ($unserialized_array as $element)
    {
        if ($element['login'] === $_POST['user_login'])
            return TRUE;
    }
    return FALSE;
}

function upgrade_user($user)
{
    $i = 0;
    $array = file_get_contents('private/users');
    $unserialized_array = unserialize($array);
    foreach ($unserialized_array as $account)
    {
        if ($_POST['user_login'] === $account['login'])
        {
            $unserialized_array[$i]['admin'] = 'yes';
            $serialized_array = serialize($unserialized_array);
            file_put_contents('private/users', $serialized_array);
            return TRUE;
        }
        $i++;
    }
    return FALSE;
}

if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm=\'\'Admin area\'\'');
}
else
{
    if ($_POST['submit'] === 'OK' AND $_POST['user_login'] != NULL AND $_POST['admin_login'] != NULL AND $_POST['password'] != NULL)
    {
        if (check_admin() == TRUE AND already_registered() == TRUE)
        {
            upgrade_user($_POST['user_login']);
            header('Location: upgr_user.php?action=create');
        }
        else
            header('Location: upgr_user.php?action=error');
    }
}
?>
