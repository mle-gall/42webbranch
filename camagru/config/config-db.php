<?php
    if ($_POST['submit'] === 'OK' && $_POST['login'] != NULL && $_POST['passwd'] != NULL && $_POST['host'] != NULL && $_POST['name'] != NULL)
    {
        if(file_exists('database.php') && file_exists('sample'))
        {
            $file = file('database.php');
            $sample = file('sample');
            if ($file === $sample)
            {
                $file[1] =  "\$DB_DSN = 'mysql:host=".$_POST['host']."';\n";
                $file[2] =  "\$DB_USER = '".$_POST['login']."';\n";
                $file[3] =  "\$DB_PASSWORD = '".$_POST['passwd']."';\n";
                $file[4] =  "\$db = '".$_POST['name']."';\n";
                $file[5] =  "\$admin_pw = '".$_POST['admin_pw']."';\n";
                file_put_contents('database.php', $file);
                header('Location: dbcheck.php');
            }
            else
            {
                header('Location: ../config.php?error=cannotchange');
            }
        }
    }
?>
