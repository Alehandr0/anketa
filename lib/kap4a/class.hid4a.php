<?

# KCAPTCHA PROJECT VERSION 2.1

# Automatic test to tell computers and humans apart

# Copyright by Kruglov Sergei, 2006, 2007, 2008, 2011, 2016
# www.captcha.ru, www.kruglov.ru

# System requirements: PHP 4.0.6+ w/ GD
# NOTE! decomment string "function KCAPTCHA(){" and comment "function __construct(){" to complify with php below 5.0

# KCAPTCHA is a free software. You can freely use it for developing own site or software.
# If you use this software as a part of own sofware, you must leave copyright notices intact or add KCAPTCHA copyright notices to own.
# As a default configuration, KCAPTCHA has a small credits text at bottom of CAPTCHA image.
# You can remove it, but I would be pleased if you left it. ;)

# See config.a.php for customization

require_once(dirname(__FILE__).'/config.a.php');
class Hid4a extends Kap4a_config_a
{
// generates only $kap4a and $nam4a

function __construct()
{
parent::__construct();
$this->kap_nam();
}

function kap_nam()
{
while(true)
  {
	$this->kap4a='';
	for($i=0; $i<$this->length; $i++)
	  {
		$this->kap4a.=$this->allowed_symbols{mt_rand(0,strlen($this->allowed_symbols)-1)};
	}
//	echo"\$this->bad=$this->bad<br>";					//	отладчик
	if(!preg_match($this->bad, $this->kap4a)) break;
}
$s=mt_rand(5, 7); $this->nam4a='n'.substr(md5(base64_encode(strrev($this->kap4a))), 3+$this->length+$s*2, $s-1);
}
}
$hid4a=new Hid4a;