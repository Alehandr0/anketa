<?

# KCAPTCHA configuration file ¹ 2

class Kap4a_config_b extends Hid4a
{
function __construct()
{
parent::__construct();


# folder with fonts
$this->fontsdir='simbols';

# CAPTCHA image size (you do not need to change it, this parameters is optimal)
$this->width=160;
$this->height=80;

# symbol's vertical fluctuation amplitude
$this->fluctuation_amplitude=8;

#noise
//$this->white_noise=0; // no white noise
$this->white_noise=1/4;
//$this->black_noise=0; // no black noise
$this->black_noise_density=1/20;

# increase safety by prevention of spaces between symbols
$this->no_spaces=true;

# show credits
//$this->sh=true; # set to false to remove credits line.
$this->credits='USE ONLY ENGLISH'; # if empty, HTTP_HOST will be shown

# CAPTCHA image colors (RGB, 0-255)
$this->fO_l=0;
$this->fO_1=80;
$this->f0_l=220;
$this->f0_1=255;

# JPEG quality of CAPTCHA image (bigger is better quality, but larger file size)
$this->jpeg_quality=90;
}
}
new Kap4a_config_b;