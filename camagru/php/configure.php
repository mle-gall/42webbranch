<?php
    if ($_POST['submit'] === 'OK' && $_POST['login'] != NULL && $_POST['passwd'] != NULL && $_POST['host'] != NULL && $_POST['name'] != NULL)
    {
        if(file_exists('../config/database.php') && file_exists('sample'))
        {
            $file = file('../config/database.php');
            $sample = file('sample');
            if ($file === $sample)
            {
                $file[1] =  "\$DB_DSN = 'mysql:host=".$_POST['host']."';\n";
                $file[2] =  "\$DB_USER = '".$_POST['login']."';\n";
                $file[3] =  "\$DB_PASSWORD = '".$_POST['passwd']."';\n";
                $file[4] =  "\$db = '".$_POST['name']."';\n";
                $file[5] =  "\$admin_pw = '".$_POST['admin_pw']."';\n";
                $file[6] =  "\$site_adress = '".$_POST['adress']."';\n";
                file_put_contents('../config/database.php', $file);
                header('Location: ../config/dbcheck.php');
            }
            else
            {
                header('Location: ../config.php?error=cannotchange');
            }
        }
    }
?>
