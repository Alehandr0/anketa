<?
$result.="<body>\n";
for($i=1; $i<=6; $i++)
{
	$hi="\$h{$i}";
	eval("\$hi=$hi;");
	if(isset($hi))$result.="<h$i>$hi</h$i>\n";
}
if(isset($content))$result.="$content\n";
if(isset($form)){$result.="<form method=POST action=page_{$form[0]["page"]}.{$form[0]["header"]}.{$form[0]["body"]}.{$form[0]["footer"]}.html>\n"; for($i=1; $i<=$form[0][0]; $result.=elf($form[$i]), $i++){}}
if(isset($kap4a))require_once("./includes/kap4a.php");
if(isset($form))$result.="</form>\n";
if(isset($ol))$li="ol";elseif(isset($ul))$li="ul";
if(isset($li))
{
	$result.="<$li>\n"; $el="</$li>\n";
	eval("\$li=$$li;");
	for($i=1; $i<=$li[0]; $result.="<li><a href='page_{$li[$i]["href"]}.html'>{$li[$i]["li"]}</a></li>\n", $i++){}
	$result.=$el;
}