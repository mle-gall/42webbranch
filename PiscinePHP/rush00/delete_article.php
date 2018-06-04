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

function delete_article($article)
{
    $i = 0;
    $j == 0;
    $array = file_get_contents('private/articles');
    $array = unserialize($array);
    foreach ($array as $element)
    {
        if ($element['title'] === $article)
        {
            $j++;
            unset($array[$i]);
            sort($array);
            $array = serialize($array);
            file_put_contents('private/articles', $array);
        }
        $i++;
    }
    if ($j == 0)
        return FALSE;
    else
        return TRUE;
}

if ($_SESSION['login'] == '' OR $_SESSION['connexion_status'] != 'connected' OR $_SESSION['admin'] == 'no')
{
    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm=\'\'Admin area\'\'');
}
else
{
    if ($_POST['submit'] === 'OK' AND $_POST['title'] != NULL)
    {
        if (check_admin() == TRUE)
        {
            if (delete_article($_POST['title']) == TRUE)
                header('Location: del_article.php?action=create');
            else
                header('Location: del_article.php?action=error2');
        }
        else
            header('Location: del_article.php?action=error');
    }
}
?>
