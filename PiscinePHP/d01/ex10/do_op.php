#!/usr/bin/php
<?php
if($argc !=4)
{
	echo("Incorrect Parameters\n");
	exit();
}
$str1 = $argv[1];
$str2 = $argv[2];
$str3 = $argv[3];
$str2 = trim(preg_replace('/\s+/S', "", $str2));
$a = intval($str1);
$b = intval($str3);
if($str2 == "+")
	echo($a + $b."\n");
if($str2 == "-")
	echo($a - $b."\n");
if($str2 == "/")
	echo($a / $b."\n");
if($str2 == "*")
	echo($a * $b."\n");
if($str2 == "%")
	echo($a % $b."\n");
?>