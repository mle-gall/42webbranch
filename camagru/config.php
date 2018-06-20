<html>
<head>
    <title>SetUp MySQL Informations</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<body>
    <div class=warnbod>
        <form class="warn" action="config/config-db.php" method="post">
            <p>
                <?php
                if(isset($_GET['error']) && $_GET['error'] === 'cannotchange')
                {
                    echo("<div class=msgerror><a>ERROR : Impossible to write in file since infos have already been set. Please manually edit them in config/database.php</a></div>");
                }
                ?>
                <h1>Database Informations</h1>
                <input class=forminput placeholder="Login" type="text" name="login" autofocus required />
                <br>
                <input class=forminput placeholder="Password" type="text" name="passwd" autofocus required />
                <br>
                <input class=forminput placeholder="Adress" type="text" name="host" autofocus required />
                <br>
                <input class=forminput placeholder="DB Name" type="text" name="name" autofocus required />
                <br>
                <input class=buttonin type="submit" name="submit" value="OK" />
            </p>
        </form>
    </div>
</body>
</html>
