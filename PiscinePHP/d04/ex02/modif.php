<?php
if ($_POST["submit"] === "OK" && $_POST["nempw"] !== "")
{
	$oldpw = hash("sha512", $_POST["oldpw"]);
	$newpw = hash("sha512", $_POST["newpw"]);
	if (file_exists("../private") === FALSE)
		echo ("ERROR\n");
	else
	{
		$file = unserialize(file_get_contents("../private/passwd"));
		$i = 0;
		foreach ($file as $elem)
		{
			if ($elem["login"] === $_POST["login"])
			{
				$setpw = $elem["passwd"];
				if($setpw === $oldpw)
				{
					$file[$i]["passwd"] = $newpw; 
					$change = serialize($file);
					file_put_contents("../private/passwd", $change);
					echo ("OK\n");
					exit();
				}
				$i++;
			}
		}
	}
}
echo ("ERROR\n");
?>
