#!/usr/bin/php
<?php
if ($argc > 1)
{
	$in = trim($argv[1]);
	$tmp = explode(" ", $in);
	$i = 0;
	foreach($tmp as $elem)
	{
		if ($elem != "")
			$out[$i] = $elem;
		$i++;
	}
	$i= 0;
	foreach($out as $elem)
	{
		if($i != 0)
			echo ($elem." ");
		$i++;
	}
	echo($out[0]);
	echo ("\n");
}
?>
