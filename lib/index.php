<?
function lib($rendere)
{
	extract($rendere);
	if(isset($lib))
	{
		for($i=1; $i<=$lib[0]; $i++)
		{
			require($lib[$i]."/index.php");
		}
	}
}

lib($rendere);
