<?php
date_default_timezone_set('Europe/Paris');
	if (file_exists("../private/chat") == TRUE)
	{
		$file = unserialize(file_get_contents("../private/chat"));
		foreach ($file as $elem) 
		{
			echo ("[".date("H:i", $elem['time'])."] "."<b>".$elem['login']."</b>: ".$elem['msg']."<br />");
		}
	}
?>