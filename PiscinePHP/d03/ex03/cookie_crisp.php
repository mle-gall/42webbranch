<?php
if (isset($_GET["action"]))
{
    $t = $_GET;
    if (isset($t["name"]))
    {
        if ($t['action'] == "set" && array_key_exists("value", $t))
            setcookie($t['name'], $t['value']);
        else if (isset($_COOKIE[$t['name']]) && $t['action'] == "get")
            echo ($_COOKIE[$t['name']])."\n";
        else if ($t['action'] == "del")
            setcookie($t['name'], "", time()-1);
    }
}
?>
