#!/usr/bin/php
<?php
while(true)
{
	echo "Entrez un nombre: ";
	$input = trim(fgets(STDIN));
	if(feof(STDIN) == TRUE)
		exit();
	if(!is_numeric($input))
		echo  "'".$input."' n'est pas un chiffre"."\n";
	else
	{
		echo "Le chiffre ".$input." est ";
		if (substr($input, -1) % 2 == 0)
			echo  "Pair\n";
		else
			echo "Impair\n";
	}
}
?>
