<?php
session_start();
?>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <script type="text/javascript" src="js/standalone.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
    <link rel="manifest" href="favicons/site.webmanifest">
    <link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
    <div class=headbar>
        <div class=logodiv>
            <a href=index.php><img class=logoimg src="uploads/icons/logo.svg" alt="Logo Camagru"/></a>
        </div>
        <?php
        if (isset($_SESSION['connexion_status']) == 0 || $_SESSION['connexion_status'] !== 'connected')
        {
            echo "
            <div class=icons>
            <div class=menutab>
            <a href=register.php title='Register'><img class=menicon src='uploads/icons/register.svg'/></a>
            </div>
            <div class=menutab>
            <a href=login.php title='Log-In'><img class=menicon src='uploads/icons/login.svg'/></a>
            </div>
            </div>";
        }
        else if(isset($_SESSION['connexion_status']) && $_SESSION['connexion_status'] === 'connected')
        {
            echo "
            <div class=icons>
            <div class=menutab>
            <a href=take_pic.php title='Take a Picture'><img class=menicon src='uploads/icons/camera.svg'/></a>
            </div>
            <div class=menutab>
            <a href=php/unauth_user.php title='Log-Out'><img class=menicon src='uploads/icons/logout.svg'/></a>
            </div>
            </div>";
        }
        ?>
    </div>
    <div class=headerspace>
    </div>
    </html>
