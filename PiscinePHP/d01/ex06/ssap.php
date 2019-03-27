#!/usr/bin/php
<?php

function ft_split($s1)
{
	$tab = explode(" ", $s1);
	sort($tab);
	return($tab);
}
$out = array();
foreach ($argv as $elem)
{
	if ($elem != $argv[0])
	{
		$tab = ft_split($elem);
		$out = array_merge($out, $tab);
	}
}
sort($out);
foreach ($out as $elem)
	if ($elem != "")
		echo $elem."\n";
?>