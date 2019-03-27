#!/usr/bin/php
<?php
if($argc != 2)
{
	echo("Incorrect Parameters\n");
	exit();
}
$output = preg_split("/(\/|\*|\+|-|%|\s+)/", $argv[1], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
$i = 0;
$j = 0;
foreach($output as $elem)
{
	if ($elem != " ")
	{
		$ok[$j] = $elem;
		$j++;
	}
	$i++;
}
if($j != 3)
{
	if($ok[2] == "-" || $ok[2] == "+")
	{
		$ok[2] = $ok[2].$ok[3];
		if($ok[4] == "-" || $ok[4] == "+")
		{
			echo("Syntax Error\n");
			exit ();
		}
	}
	else
	{
		echo("Syntax Error\n");
		exit();
	}
}
$str2 = $ok[1];
if(is_numeric($ok[0]) && is_numeric($ok[2]))
{
	$a = intval($ok[0]);
	$b = intval($ok[2]);
	if($str2 == "+")
		echo($a + $b."\n");
	else if($str2 == "-")
		echo($a - $b."\n");
	else if($str2 == "/")
		echo($a / $b."\n");
	else if($str2 == "*")
		echo($a * $b."\n");
	else if($str2 == "%")
		echo($a % $b."\n");
	else
	echo("Syntax Error\n");
}
else
	echo("Syntax Error\n");
?>
