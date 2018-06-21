<?php
function create_table_user($bdd)
{
    $table = "USERS";
    try
    {
        $sql = "CREATE TABLE IF NOT EXISTS $table(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            Name VARCHAR( 50 ) NOT NULL,
            Password VARCHAR( 200 ) NOT NULL,
            Activated 
            Email VARCHAR( 50 ) NOT NULL);" ;
            $bdd->exec($sql);
            print("Created $table Table.\n");
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
function create_table_pictures($bdd)
{
    $table = "PICTURES";
    try
    {
        $sql = "CREATE TABLE IF NOT EXISTS $table(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            CreatorID VARCHAR( 50 ) NOT NULL,
            link VARCHAR( 200 ) NOT NULL);";
            $bdd->exec($sql);
            print("Created $table Table.\n");
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
function create_table_comments($bdd)
{
    $table = "COMMENTS";
    try
    {
        $sql ="CREATE TABLE IF NOT EXISTS $table(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            CreatorID VARCHAR( 50 ) NOT NULL,
            Content VARCHAR( 1000 ) NOT NULL);";
            $bdd->exec($sql);
            print("Created $table Table.\n");
            header('Location: ../index.php');
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

?>
