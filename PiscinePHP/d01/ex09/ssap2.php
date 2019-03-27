#!/usr/bin/php
<?php

function charcmp($c1, $c2)
{
	if (ctype_alpha($c1) && ctype_alpha($c2))
	{	
		if(ctype_upper($c1))
			$lower1 = chr(ord($c1) + 32);
		else
			$lower1 = $c1;
		if(ctype_upper($c2))
			$lower2 = chr(ord($c2) + 32);
		else
			$lower2 = $c2;
		return(ord($lower1) - ord($lower2) > 0);
	}
	if(ctype_alpha($c2))
		return(1);
	else if (ctype_alpha($c1))
		return(0);
	if(is_numeric($c1) && is_numeric($c2))
	{	
		return($c1 - $c2 > 0);
	}
	if(is_numeric($c2))
		return(1);
	else if(!is_numeric($c1) && ord($c1) - ord($c2) > 0)
		return(1);
	return (0);
}

function compare($a, $b)
{
	if($a == $b)
		return(0);
	for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
	{
		if ($a[$i] != $b[$i])
		{
			if(strtolower($a[$i]) == strtolower($b[$i]))
				continue ;
			return(charcmp($a[$i], $b[$i]));
		}
	}
	if($i == strlen($b))
		return(1);
	return(0);
}

function mysort($arr) {
	$nb_elem = count($arr);
	$is_sorted = 0;
	while(!$is_sorted)
	{
		$is_sorted = 1;
		for($i = 0; $i < $nb_elem && $is_sorted; $i++)
		{
			for($j = $i; $j < $nb_elem - 1 - $i && $is_sorted; $j++)
			{
				if(compare($arr[$j], $arr[$j + 1]))
				{
					$is_sorted = 0;
					$tmp = $arr[$j + 1];
					$arr[$j + 1] = $arr[$j];
					$arr[$j] = $tmp;
				}
			}
		}
	}
	return($arr);
}

if($argc > 1)
{
	$tab = implode(" ", $argv);
	$tab = preg_replace('/\s+/', ' ', $tab);
	$tab = trim($tab);
	$tab = explode(" ", $tab);
	$i = 1;
	$j = 0;
	while($i < count($tab))
	{
		$out[$j] = $tab[$i];
		$j++;
		$i++;
	}
	$arr = mysort($out);
	foreach($arr as $element)
	echo "$element\n";
}
?>