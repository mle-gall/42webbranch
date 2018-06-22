<?php
include('config/database.php');
if(isset($bdd) == 0)
{
    include('db_connect.php');
}
function add_user($name, $pass, $activ, $mail, $bdd)
{
    $response = $bdd->query("SELECT * FROM USERS WHERE Name LIKE '".$name."' OR Email LIKE '".$mail."' LIMIT 1");
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
    $response = $bdd->query("SELECT * FROM USERS WHERE Name LIKE '".$name."' OR Email LIKE '".$mail."'");
    $data = $response->fetch();
    $response->closeCursor();
    if(!empty($data))
    {
        if(hash('sha512', $pass) === $data['Password'] && $data['Activated'] != 0)
        {
            echo("Okey<br>");
        }
    }
}
?>
