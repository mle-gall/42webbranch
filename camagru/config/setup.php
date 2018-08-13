<html>
<head>
    <title>Database Setup</title>
    <link rel="stylesheet" href="../style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<body>
    <?php
    include('database.php');
    include('../php/create_table.php');
    if(isset($DB_DSN) && isset($DB_USER) && isset($DB_PASSWORD) && isset($admin_pw) && isset($db))
    {
        try
        {
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $bdd->exec("CREATE DATABASE `$db`;")
            or die(print_r($bdd->errorInfo(), true));
        }
        catch (PDOException $e)
        {
            echo "<div class=warnbod>
            <div class=warn>
            <img class=warning src=../uploads/icons/warning.svg alt=warning/>
            <h1>Unable to setup database !</h1>
            <a>Database setup has already been done or MySQL connection informations provided in config/database.php are false. Once they're corrected, just refresh this page.</a>
            </div>
            </div>";
        }
        try
        {
            $sql ="USE ".$db.";";
            $bdd->exec($sql);
            print("Selected database.\n");
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

        create_table_user($bdd);
        $hash = hash('sha512', $admin_pw);
        include('../php/user_functions.php');
        add_user("admin", $hash, "1", "admin@trolol.com", $bdd);
        create_table_pictures($bdd);
        create_table_comments($bdd);
        create_table_likes($bdd);
    }
    else {
        header('Location: ../config.php?error=missingelement');
    }
    ?>
