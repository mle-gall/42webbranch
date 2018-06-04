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

function delete_user($user)
{
    $i = 0;
    $array = file_get_contents('private/users');
    $array = unserialize($array);
    foreach ($array as $element)
    {
        if ($element['login'] === $user)
        {
            unset($array[$i]);
            sort($array);
            $array = serialize($array);
            file_put_contents('private/users', $array);
        }
        $i++;
    }

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
            delete_user($_POST['user_login']);
            header('Location: remove_user.php?action=create');
        }
        else
            header('Location: remove_user.php?action=error');
    }
}


?>
