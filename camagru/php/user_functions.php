<?php
include('../config/database.php');
if(isset($bdd) == 0)
{
    include('db_connect.php');
}
function add_user($name, $pass, $activ, $mail, $bdd)
{
    $response = $bdd->prepare("SELECT * FROM USERS WHERE Name LIKE ? OR Email LIKE ? LIMIT 1");
    $response->execute(array($name, $mail));
    $data = $response->fetch();
    $response->closeCursor();
    if(empty($data))
    {
        $req = $bdd->prepare('INSERT INTO USERS(Name, Password, Activated, Email) VALUES(:name, :passwd, :activ, :mail)');
        $req->execute(array(
            'name' => $name,
            'passwd' => $pass,
            'activ' => $activ,
            'mail' => $mail
        ));
        echo ("okey0");
        if ($activ === 0)
        {
            echo ("okey1");
            $nb = rand(0, 9);
            $id = hash('sha512', 'camagru'.$nb);
            mail($mail, "Activate your account", "Hello, click on link below to activate your account :<br />$site_adress/activate?id=$nb$name-$id");
            echo ("Hello, click on link below to activate your account :<br />".$site_adress."/activate.php?id=".$nb.$name."-".$id);
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
    $response = $bdd->prepare("SELECT * FROM USERS WHERE Name LIKE ? OR Email LIKE ?");
    $response->execute(array($name, $name));
    $data = $response->fetch();
    $response->closeCursor();
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
