<?php
	session_start();
	if ($_SESSION["loggued_on_user"] != "" && isset($_POST["submit"]))
	{
		if ($_POST["submit"] == "ENVOYER")
		{
			if (file_exists("../private/chat") == FALSE)
			{
				$file = array(array("time"=>time(), "login"=>$_SESSION["loggued_on_user"], "msg"=>$_POST["msg"]));
				$file = serialize($file);
				file_put_contents("../private/chat", $file);
			}
			else
			{
				$fp = fopen("../private/chat", "c+");
				flock($fp, LOCK_EX | LOCK_SH);
				$file = file_get_contents("../private/chat");
				$file = unserialize($file);
				$file[] = array("time"=>time(), "login"=>$_SESSION["loggued_on_user"], "msg"=>$_POST["msg"]);
				$file = serialize($file);
				file_put_contents("../private/chat", $file);
				flock($fp, LOCK_UN);
			}
		}
	}
?>
<html>
<script langage="javascript">top.frames["chat"].location = "chat.php";</script>
<head></head>
<body>
	<form method="POST" action="">  
		<input type="text" name="msg" value ="" />
		<input type="submit" name="submit" value="ENVOYER">
	</form>
</body>
</html>