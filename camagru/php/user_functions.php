<?php
include('../config/database.php');
if(isset($bdd) == 0)
{
    include('db_connect.php');
}

function reint_pw($newpw, $key)
{
    if ($key == '0')
    {
        return FALSE;
    }
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try {
        $req = $bdd->prepare("UPDATE `USERS` SET `Password` = ? WHERE `USERS`.`ReintKey` = ?");
        $req->execute(array(
            $newpw,
            $key
        ));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $req->closeCursor();
    try {
        $req = $bdd->prepare("UPDATE `USERS` SET `ReintKey` = ? WHERE `USERS`.`ReintKey` = ?");
        $req->execute(array(
            '0',
            $key
        ));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $req->closeCursor();
    return TRUE;
}

function mail_update($mail, $userid)
{
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try {
        $req = $bdd->prepare("UPDATE `USERS` SET `Email` = ? WHERE `USERS`.`ID` = ?");
        $req->execute(array(
            $mail,
            $userid
        ));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $req->closeCursor();
    return TRUE;
}

function notif_update($val, $userid)
{
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try {
        $req = $bdd->prepare("UPDATE `USERS` SET `Mailing` = ? WHERE `USERS`.`ID` = ?");
        $req->execute(array(
            $val,
            $userid
        ));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $req->closeCursor();
    return TRUE;
}

function update_pw($old, $new, $userid)
{
    include('utils.php');
    $oldcheck = getHash($userid);
    if($oldcheck !== $old)
    {
        return FALSE;
    }
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try {
        $req = $bdd->prepare("UPDATE `USERS` SET `Password` = ? WHERE `USERS`.`ID` = ?");
        $req->execute(array(
            $new,
            $userid
        ));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $req->closeCursor();
    return TRUE;
}

function name_update_user($name ,$id)
{
    if(isset($bdd) == 0)
    {
        include('db_connect.php');
    }
    try {
        $req = $bdd->prepare("SELECT * FROM `USERS` WHERE `Name` LIKE ? LIMIT 1");
        $req->execute(array(
            $name
        ));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $data = $req->fetch();
    $req->closeCursor();
    if(empty($data))
    {
        try {
            $req = $bdd->prepare('UPDATE `USERS` SET `Name` = ? WHERE `ID` LIKE ?');
            $req->execute(array(
                $name,
                $id
            ));
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        return TRUE;
    }
    else {
        return FALSE;
    }
}

function add_user($name, $pass, $activ, $mail, $bdd)
{
    include('../config/database.php');
    $response = $bdd->prepare("SELECT * FROM USERS WHERE Name LIKE ? OR Email LIKE ? LIMIT 1");
    $response->execute(array($name, $mail));
    $data = $response->fetch();
    $response->closeCursor();
    if(empty($data))
    {
        try {
            $req = $bdd->prepare('INSERT INTO USERS(Name, Password, Activated, Email) VALUES(:name, :passwd, :activ, :mail)');
            $req->execute(array(
                'name' => $name,
                'passwd' => $pass,
                'activ' => $activ,
                'mail' => $mail
            ));
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        if ($activ === 0)
        {
            $nb = rand(0, 9);
            $id = hash('sha512', 'camagru'.$nb);
            include("../mails/activation-template.php");
            mail($mail, "Activate your account", $template, $headers);
        }
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function log_user($name, $pass, $bdd)
{
    try {
        $response = $bdd->prepare("SELECT * FROM USERS WHERE Name LIKE ? OR Email LIKE ?");
        $response->execute(array($name, $name));
        $data = $response->fetch();
        $response->closeCursor();
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    if(!empty($data))
    {
        if($pass === $data['Password'])
        {
            if($data['Activated'] != 0)
            return intval($data['ID']);
            else
            {
                return "-1";
            }
        }
        else
        {
            return "0";
        }
    }
    else
    return "0";
}
?>
