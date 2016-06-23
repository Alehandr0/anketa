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

# See config.b.php for customization

require_once(dirname(__FILE__).'/class.hid4a.php');
require_once(dirname(__FILE__).'/config.b.php');
class Kap4a extends Kap4a_config_b
{
// generates kap4a and image

function __construct($ini)
{
parent::__construct();
$r=$ini[1];
$c=$ini[2];
$s=$ini[3];
//require_once(dirname(__FILE__).'/kap4a_config_a_.php');
//require_once(dirname(__FILE__).'/config.b.php');
if($r>0&&$r<=25){$height=$this->height-($r); $width=10+$height*2;}
else{$height=$this->height; $width=$this->width;}
$credits=$this->credits;
$foreground_color=array(mt_rand($this->fO_l, $this->fO_1), mt_rand($this->fO_l, $this->fO_1), mt_rand($this->fO_l, $this->fO_1),);
$background_color=array(mt_rand($this->f0_l, $this->f0_1), mt_rand($this->f0_l, $this->f0_1),mt_rand($this->f0_l, $this->f0_1),);
$s?$fO=1:$fO=0;
$fonts=array();
$f0=dirname(__FILE__)."/$this->fontsdir";
if($handle=opendir($f0))
  {
	while(false!==($file=readdir($handle)))
	  {
		if(preg_match('/\.png$/i', $file))
		  {
			$fonts[]=$f0.'/'.$file;
		}
	}
	closedir($handle);
}

$alphabet_length=strlen($this->alphabet);
do{
	// generating random $kap4a and $nam4a
	$this->kap_nam();
/*
	echo"\$this->bad=$this->bad<br>";				//	отладчик
	echo"\$this->kap4a=$this->kap4a<br>";			//	отладчик
	echo"\$this->alphabet=$this->alphabet<br>";		//	отладчик
///*///
	$font_file=$fonts[mt_rand(0, count($fonts)-1)];
	$font=imagecreatefrompng($font_file);
	imagealphablending($font, true);

	$fontfile_width=imagesx($font);
	$fontfile_height=imagesy($font)-1;

	$font_metrics=array();
	$symbol=0;
	$reading_symbol=false;

	// loading font
	for($i=0; $i<$fontfile_width&&$symbol<$alphabet_length; $i++)
	  {
		$transparent=(imagecolorat($font, $i, 0)>>24)==127;

		if(!$reading_symbol&&!$transparent)
		  {
			$font_metrics[$this->alphabet{$symbol}]=array('start'=>$i);
			$reading_symbol=true;
			continue;
		}

		if($reading_symbol&&$transparent)
		  {
			$font_metrics[$this->alphabet{$symbol}]['end']=$i;
			$reading_symbol=false;
			$symbol++;
			continue;
		}
	}

	$img=imagecreatetruecolor($width, $height);
	imagealphablending($img, true);
	$white=imagecolorallocate($img, 255, 255, 255);
	$black=imagecolorallocate($img, 0, 0, 0);

	imagefilledrectangle($img, 0, 0, $width-1, $height-1, $white);

	// draw text
	$x=1;
	$odd=mt_rand(0, 1);
	if($odd==0) $odd=-1;
	for($i=0; $i<$this->length; $i++)
	  {
		$m=$font_metrics[$this->kap4a{$i}];

		$fl=$this->fluctuation_amplitude;
		$y=(($i%2)*$fl-$fl/2)*$odd
			+mt_rand(-round($fl/3), round($fl/3))
			+($height-$fontfile_height)/2;

		if($this->no_spaces)
		  {
			$shift=0;
			if($i>0)
			  {
				$shift=10000;
				for($sy=3; $sy<$fontfile_height-10; $sy+=1)
				  {
					for($sx=$m['start']-1; $sx<$m['end']; $sx+=1)
					  {
		        		$rgb=imagecolorat($font, $sx, $sy);
		        		$opacity=$rgb>>24;
						if($opacity<127)
						  {
							$left=$sx-$m['start']+$x;
							$py=$sy+$y;
							if($py>$height) break;
							for($px=min($left,$width-1); $px>$left-200&&$px>=0; $px-=1)
							  {
				        		$color=imagecolorat($img, $px, $py)&0xff;
								if($color+$opacity<170) // 170 - threshold
								  {
									if($shift>$left-$px) $shift=$left-$px;
									break;
								}
							}
							break;
						}
					}
				}
				if($shift==10000) $shift=mt_rand(4,6);
			}
		  }
		  else
		  {
			$shift=1;
		}
		imagecopy($img, $font, $x-$shift, $y, $m['start'], 1, $m['end']-$m['start'], $fontfile_height);
		$x+=$m['end']-$m['start']-$shift;
	}
}while($x>=$width-10); // while not fit in canvas

//noise
$white=imagecolorallocate($font, 255, 255, 255);
$black=imagecolorallocate($font, 0, 0, 0);
for($i=0; $i<(($height-30)*$x)*$this->white_noise; $i++)
  {
	imagesetpixel($img, mt_rand(0, $x-1), mt_rand(10, $height-15), $white);
}
for($i=0; $i<(($height-30)*$x)*$this->black_noise; $i++)
  {
	imagesetpixel($img, mt_rand(0, $x-1), mt_rand(10, $height-15), $black);
}

$center=$x/2;


//	credits. To remove, see configuration file
$img2=imagecreatetruecolor($width, $height+($fO?$c?14:12:0));
$foreground=imagecolorallocate($img2, $foreground_color[0], $foreground_color[1], $foreground_color[2]);
$background=imagecolorallocate($img2, $background_color[0], $background_color[1], $background_color[2]);
imagefilledrectangle($img2, 0, 0, $width-1, $height-1, $background);
imagefilledrectangle($img2, 0, $height, $width-1, $height+($c?14:12), $foreground);
$credits=empty($credits)?$_SERVER['HTTP_HOST']:$credits;
$credits=$c?strtoupper($credits):strtolower($credits);
imagestring($img2, 2, $width/2-imagefontwidth(2)*strlen($credits)/2, $height+($c?0:-2), $credits, $background);

// periods
$rand1=mt_rand(750000,1200000)/10000000;
$rand2=mt_rand(750000,1200000)/10000000;
$rand3=mt_rand(750000,1200000)/10000000;
$rand4=mt_rand(750000,1200000)/10000000;
// phases
$rand5=mt_rand(0,31415926)/10000000;
$rand6=mt_rand(0,31415926)/10000000;
$rand7=mt_rand(0,31415926)/10000000;
$rand8=mt_rand(0,31415926)/10000000;
// amplitudes
$rand9=mt_rand(330,420)/110;
$rand10=mt_rand(330,450)/100;

//wave distortion

for($x=0; $x<$width; $x++)
  {
	for($y=0; $y<$height; $y++)
	  {
		$sx=$x+(sin($x*$rand1+$rand5)+sin($y*$rand3+$rand6))*$rand9-$width/2+$center+1;
		$sy=$y+(sin($x*$rand2+$rand7)+sin($y*$rand4+$rand8))*$rand10;

		if($sx<0||$sy<0||$sx>=$width-1||$sy>=$height-1) continue;
		  else
		  {
			$color=imagecolorat($img, $sx, $sy)&0xFF;
			$color_x=imagecolorat($img, $sx+1, $sy)&0xFF;
			$color_y=imagecolorat($img, $sx, $sy+1)&0xFF;
			$color_xy=imagecolorat($img, $sx+1, $sy+1)&0xFF;
		}

		if(255==$color&&255==$color_x&&255==$color_y&&255==$color_xy) continue;
		  elseif(0==$color&&0==$color_x&&0==$color_y&&0==$color_xy)
		  {
			$newred=$foreground_color[0];
			$newgreen=$foreground_color[1];
			$newblue=$foreground_color[2];
		  }
		  else
		  {
			$frsx=$sx-floor($sx);
			$frsy=$sy-floor($sy);
			$frsx1=1-$frsx;
			$frsy1=1-$frsy;

			$newcolor=(
				$color*$frsx1*$frsy1+
				$color_x*$frsx*$frsy1+
				$color_y*$frsx1*$frsy+
				$color_xy*$frsx*$frsy);

			if($newcolor>255) $newcolor=255;
			$newcolor=$newcolor/255;
			$newcolor0=1-$newcolor;

			$newred=$newcolor0*$foreground_color[0]+$newcolor*$background_color[0];
			$newgreen=$newcolor0*$foreground_color[1]+$newcolor*$background_color[1];
			$newblue=$newcolor0*$foreground_color[2]+$newcolor*$background_color[2];
		}
		imagesetpixel($img2, $x, $y, imagecolorallocate($img2, $newred, $newgreen, $newblue));
	}
}

header('Expires: Mon, 14 Jul 2008 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
if(function_exists("imagejpeg"))
  {
	header("Content-Type: image/jpeg");
	imagejpeg($img2, null, $this->jpeg_quality);
  }
  elseif(function_exists("imagegif"))
  {
	header("Content-Type: image/gif");
	imagegif($img2);
  }
  elseif(function_exists("imagepng"))
  {
	header("Content-Type: image/x-png");
	imagepng($img2);
}
}
}
$kap4a=new Kap4a($ini);