<?

function elf($elf)
{
	switch ($elf[0])
	{
		case 1: $result.="1 case = $elf[1]<br>"; break;
		case 2: $result.="2 case = $elf[1]<br>"; break;
		case 3: $result.="3 case = $elf[1]<br>"; break;
	}
	return $result;
}

function rendere($rendere)
{
	extract($rendere);
	
	if(isset($path)){$path="./view/".$path.".php"; require($path);}
	return $result;
}
