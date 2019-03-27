#!/usr/bin/php
<?php
if ($argc == 1)
	exit();
$i = 1;
while($i < $argc)
{
	echo($argv[$i]."\n");
	$i++;
}
?>