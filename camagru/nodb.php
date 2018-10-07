<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    </head>
    <body>
        <div class=warnbod>
            <div class=warn>
                <img class=warning src=uploads/icons/warning.svg alt=warning/>
                <h1>Connection to DB failed !</h1>
                <p>Database is unexistant, or database connection informations provided are false.</p>
                    <div class=buttoninput>
                        <a href='config/setup.php' class=buttonin>Automatic Setup</a>
                    </div>
                </a>
            </div>
        </div>
    </body>
</html>
