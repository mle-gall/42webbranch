#!/usr/bin/php
<?php
function ft_split($in)
{
	$tmp = explode(" ", $in);
	$i = 0;
	foreach($tmp as $elem)
	{
		if ($elem != "")
			$out[$i] = $elem;
		$i++;
	}
	sort($out);
	return($out);
}
?>
