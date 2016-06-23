<?
$rendere["path"]="header_".$_GET["header"];
$result.=rendere($rendere);

$rendere["path"]="body_".$_GET["body"];
$result.=rendere($rendere);

$rendere["path"]="footer_".$_GET["footer"];
$result.=rendere($rendere);

echo $result;
