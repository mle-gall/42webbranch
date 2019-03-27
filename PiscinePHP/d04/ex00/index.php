<?php
session_start(); 
if (isset($_GET["submit"]))
{
	if ($_GET["submit"] == "OK")
	{
		 $_SESSION['login'] = $_GET['login'];
		 $_SESSION['passwd'] = $_GET['passwd'];
	}
}
?> 
<html>
<head>
	<title>CREATION/CHANGEMENT MOT DE PASSE</title>
</head>
<body>
	<div class=mid>
	<form method="get" action=".">  
		<input type="text" class="input" name="login" placeholder="identifiant" value="<?php if(isset($_SESSION["login"])){echo $_SESSION["login"];}?>" />
		<br>
		<input type="password" class="input" name="passwd" placeholder="mot de passe" value="<?php if (isset($_SESSION["passwd"])){echo $_SESSION["passwd"];} ?>" />
		<br>
		<input type="submit" class="but" value="OK" name="submit">
	</form>
	</div>
</body>
</html>