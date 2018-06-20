<?php
    $sample = "$DB_DSN = ''";
    if ($_POST['submit'] === 'OK' && $_POST['login'] != NULL && $_POST['passwd'] != NULL && $_POST['host'] != NULL && $_POST['name'] != NULL)
    {
        echo "ok1";
        if(file_exists('database.php') && file_exists('sample'))
        {
            echo "ok2";
            $file = file('database.php');
            $sample = file('sample');
            print_r($file);
            print_r($sample);
            if ($file === $sample)
            {
                $file[0] =  "\$DB_DSN = 'mysql:host='".$_POST['host']
                $file[1] =  "\$DB_DSN = 'mysql:host='".$_POST['host']
                echo "ok";
            }
        }
    }
?>
