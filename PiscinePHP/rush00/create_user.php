<?php
function already_registered()
{
    $array = file_get_contents('private/users');
    $unserialized_array = unserialize($array);
    foreach ($unserialized_array as $element)
    {
        if ($element['login'] === $_POST['login'])
            return TRUE;
    }
    return FALSE;
}

function add_user($hashed_pw)
{
    $array = file_get_contents('private/users');
    $unserialized_array = unserialize($array);
    $unserialized_array[] = array('login' => $_POST['login'], 'passwd' => $hashed_pw, 'admin' => 'no');
    $serialized_array = serialize($unserialized_array);
    file_put_contents('private/users', $serialized_array);
    header("Location: connexion.php?action=create");

}

if ($_POST['submit'] === 'OK' && $_POST['login'] != NULL && $_POST['passwd1'] != NULL && $_POST['passwd2'] != NULL)
{
    $hashed_pw = hash('whirlpool', $_POST['passwd1']);
    $hashed_pw_confirm = hash('whirlpool', $_POST['passwd2']);

    if ($hashed_pw != $hashed_pw_confirm)
        header("Location: inscription.php?action=error&login=".$_POST['login']);
    else
    {
        if (!(file_exists('/private')))
        {
            mkdir('private/', 0777, true);
            $array = array(array('login' => $_POST['login'], 'passwd' => $hashed_pw, 'admin' => 'no'));
            $serialized_array = serialize($array);
            file_put_contents('private/users', $serialized_array);
        }
        else
        {
            if (already_registered() == TRUE)
                header("Location: inscription.php?action=error2");
            else
                add_user($hashed_pw);
        }
    }
}
?>
