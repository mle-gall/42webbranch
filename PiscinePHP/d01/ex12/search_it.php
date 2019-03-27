#!/usr/bin/php
<?php
foreach ($argv as $elem)
{
	if ($elem != $argv[0] && $elem != $argv[1])
	{
		$val = explode(':', $elem);
		if ($val[0] == $argv[1])
			$out = $val[1];
	}
}
echo $out;
if (is_null($out) == FALSE)
	echo "\n";
?>