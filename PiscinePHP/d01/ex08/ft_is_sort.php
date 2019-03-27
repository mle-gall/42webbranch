#!/usr/bin/php
<?php
function ft_is_sort($ar)
{
	$sorted = $ar;
	sort($sorted);
	$i = 0;
	foreach($ar as $elem)
	{
		if ($elem != $sorted[$i])
		{
			return(0);
		}
		$i++;
	}
	return(1);
}
?>