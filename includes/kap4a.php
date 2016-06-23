<?	session_start();
		$Ol=$_SESSION['Ol'];
		$l1=strtolower($_POST[$Ol]);	

if(count($_POST)>0)$n=isset($_SESSION['kap4a'])&&$_SESSION['kap4a']===$l1;
$bot=!$n;
if(!isset($_SESSION['kap4a'])||!isset($_SESSION['Ol']))
{
	echo"<meta http-equiv=Refresh content='0; url=http://{$_SERVER['HTTP_HOST']}/page_{$_GET["page"]}.{$_GET["header"]}.{$_GET["body"]}.{$_GET["footer"]}.html'>";
	$hid4a=1; require_once("./lib/kap4a/index.php"); exit;
}
if($bot)
{
	$result.="<p>Введите текст, показанный ниже:</p>
	<p><img src='http://{$_SERVER['HTTP_HOST']}/lib/kap4a/index.php?s&c&r=5'></p>";
	$lO=$_SESSION['Ol']=$_SESSION['nam4a'];
	$result.="<p><input name=$lO type=text size=16 maxlength=10></p>
	<p><input type=submit value='  Подтвердить ввод  '></p>";
	$result.="Результат ввода капчи : ".($n?"СОВПАДЕНИЕ":"ОШИБКА");
	$result.="<br>Отладчик\n";
}
