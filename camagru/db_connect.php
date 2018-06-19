<?php
include (config.php);
try
{
    $bdd = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $password);
}
catch (Exception $e)
{
        die('Error : ' . $e->getMessage());
}
?>
