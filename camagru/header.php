<?php
 session_start();
?>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<body>
    <div class=headbar>
        <div class=logodiv>
            <a href=index.php><img class=logoimg src="uploads/icons/logo.svg" alt="Logo Camagru"/></a>
        </div>
        <?php
            if (isset($_SESSION['connexion_status']) == 0 OR $_SESSION['connexion_status'] != 'connected')
            {
                echo "
                    <div class=icons>
                        <div class=menutab>
                            <a href=register.php><img class=menicon src='uploads/icons/register.svg'/></a>
                        </div>
                        <div class=menutab>
                            <a href=login.php><img class=menicon src='uploads/icons/login.svg'/></a>
                        </div>
                    </div>";
            }
        ?>
    </div>
    <div class=headerspace>
    </div>
</html>
