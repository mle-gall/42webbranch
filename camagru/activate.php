<?php
if(isset($_GET['id']))
{
    if($_GET['id'][0] >= 0 && $_GET['id'][0] <= 9)
    {
        $nb = $_GET['id'][0];
        $id = hash('sha512', 'camagru'.$nb);
        $got = explode("-", $_GET['id']);
        $hash = end($got);
        $name = substr($_GET['id'], 0, -129);
        $name = substr($name, 1);
        if ($hash === $id)
        {
            try
            {
                include('db_connect.php');
                $sql = "UPDATE `users` SET `Activated` = '1' WHERE `users`.`Name` = '".$name."';";
                $bdd->exec($sql);
            }
            catch(PDOException $e)
            {
                header('Location: login.php?error=noactivate');
            }
            header('Location: login.php?success=activate');
        }
        else
        {
            header('Location: login.php?error=noactivate');
        }
    }
    else
    {
        header('Location: login.php?error=noactivate');
    }
}
?>
