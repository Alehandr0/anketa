<?

# KCAPTCHA configuration file № 1

class Kap4a_config_a
{
function __construct()
{


$this->alphabet="0123456789abcdefghijklmnopqrstuvwxyz"; # do not change without changing font files!

# symbols used to draw CAPTCHA
//$allowed_symbols = "0123456789"; #digits
//$allowed_symbols = "23456789abcdegkmnpqsuvxyz"; #alphabet without similar symbols (o=0, 1=l, i=j, t=f)
//$allowed_symbols = "23456789abcdegikpqsvxyz"; #alphabet without similar symbols (o=0, 1=l, i=j, t=f)
$this->allowed_symbols="236789admpxy";

# CAPTCHA string length
//$this->length = 6;
$this->length=mt_rand(5, 7); # random 5 or 6 or 7

# паттерн забракованных знакосочетаний
$this->bad='/cp|ep|cb|eb|ck|ek|c6|c9|e6|e9|rn|rm|mm|nm|mn|nn|co|do|cl|db|qp|qb|dp|ww/';
//		echo"\$this->bad=$this->bad<br>";		//	отладчик
}
}
new Kap4a_config_a;