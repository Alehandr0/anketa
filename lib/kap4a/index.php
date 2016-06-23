<?		session_start();

isset($_GET['h'])||$hid4a?$h=1:$h=0;					      //	hide picture
if($h){require_once('hid4a.php'); exit;}

isset($_GET['r'])?$r=floor(abs($_GET['r'])):$r=0;		//	reduce size
isset($_GET['c'])?$c=1:$c=0;							          //	capital letters
isset($_GET['s'])||$sign?$s=1:$s=0;						      //	sign a picture

$ini=array(3, $r, $c, $s);
require_once('class.kap4a.php');
if($_REQUEST[session_name()]){$_SESSION['kap4a']=$kap4a->kap4a; $_SESSION['nam4a']=$kap4a->nam4a;}
