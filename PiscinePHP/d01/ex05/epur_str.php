#!/usr/bin/php
<?php
	if ($argc == 2)
	{
		$in = trim($argv[1]);
		$tmp = explode(" ", $in);
		$i = 0;
		foreach($tmp as $elem)
		{
			if ($elem != "")
				$tmp2[$i] = $elem;
			$i++;
		}
		$out = implode($tmp2, " ");
		echo($out."\n");
	}
?>
