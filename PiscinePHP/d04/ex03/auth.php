<?php
function auth($login, $passwd)
{
	$hpasswd = hash("sha512", $passwd);
	if(isset($login) && isset($passwd))
	{
		if (file_exists("../private"))
		{
			$file = unserialize(file_get_contents("../private/passwd"));
			foreach ($file as $elem)
			{
				if ($elem["login"] == $login)
				{
					$setpw = $elem["passwd"];
					if($hpasswd === $setpw)
						return(TRUE);
				}
			}
		}
	}
	return(FALSE);
}
?>