<html>
<head>
    <title>SetUp MySQL Informations</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<body>
    <div class=contentform>
        <form class="formbg" action="php/configure.php" method="post">
            <p>
                <?php
                if(isset($_GET['error']) && $_GET['error'] === 'cannotchange')
                {
                    echo("<div class=msgerror><a>ERROR : Impossible to write in file since infos have already been set. Please manually edit them in config/database.php</a></div>");
                }
                if(isset($_GET['error']) && $_GET['error'] === 'missingelement')
                {
                    echo("<div class=msgerror><a>ERROR : Unable to configure database since at least one of the elements in database.php is missing.</a></div>");
                }
                ?>
                <h1>Database Informations</h1>
                <input class=forminput placeholder="DB Login" type="text" name="login" autofocus required />
                <br>
                <input class=forminput placeholder="DB Password" type="text" name="passwd" autofocus required />
                <br>
                <input class=forminput placeholder="DB Adress" type="text" name="host" autofocus required />
                <br>
                <input class=forminput placeholder="DB Name" type="text" name="name" autofocus required />
                <br>
                <input class=forminput placeholder="admin Password" type="text" name="admin_pw" autofocus required />
                <br>
                <input class=forminput placeholder="Website URL" type="text" name="adress" autofocus required />
                <br>
                <input class=buttonin type="submit" name="submit" value="OK" />
            </p>
        </form>
    </div>
</body>
</html>
