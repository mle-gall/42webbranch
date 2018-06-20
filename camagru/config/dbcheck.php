<html>
    <head>
        <title>Database Check</title>
        <link rel="stylesheet" href="../style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    </head>
    <body>
<?php
Include('database.php');
$exists = 1;
try
{
    $bdd = new PDO($DB_DSN.';dbname='.$db.';charset=utf8', $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    $exists = 0;
}
if($exists === 0)
{
    echo "<div class=warnbod>
        <div class=warn>
            <img class=warning src=../uploads/icons/warning.svg alt=warning/>
            <h1>Connextion to DB failed !</h1>
            <a>Database is unexistant, or database connection informations provided are false.</a>
            <br />
            <a class=left>Options :</a>
            <br />
            <a class=left>1. If database exists, check informations provided in config/database.php</a>
            <br />
            <a class=left>2. If not, just click </a><a href=setup.php>here</a><a> to set your database up.</a>
        </div>
    </div>";
}
else
{
    header('Location: ../index.php');
}
?>
