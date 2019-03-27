<?php
if ($_POST['submit'] == "OK" && $_POST['login'] !== "" && $_POST['passwd'] !== "")
{
	$pwd = hash('sha512', $_POST['passwd']);
	if (file_exists("../private") == FALSE)
	{
		mkdir("../private", 0777, true);
		$array = array(array('login'=>$_POST['login'], 'passwd'=>$pwd));
		$seri = serialize($array);
		file_put_contents("../private/passwd", $seri);
		echo "OK\n";
	}
	else
	{
		$file = unserialize(file_get_contents("../private/passwd"));
		$i = 0;
		foreach ($file as $elem)
		{
			if ($elem['login'] == $_POST['login'])
				$i = 1;
		}
		if ($i == 0)
		{
			$file[] = array('login'=>$_POST['login'], 'passwd'=>$pwd);
			$change = serialize($file);
			file_put_contents("../private/passwd", $change);
			echo "OK\n";
		}
		else
			echo "ERROR\n";
	}
}
else
	echo "ERROR\n";
?>
