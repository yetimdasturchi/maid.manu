<?php 
namespace Model;
use IntlChar;

class Emojis
{
	private $string;

	private $width = 20;
	private $height = 20;
	private $image_url = '';

	private $re = "/[\x{0080}-\x{02AF}'
        .'\x{0300}-\x{03FF}'
        .'\x{0600}-\x{06FF}'
        .'\x{0C00}-\x{0C7F}'
        .'\x{1DC0}-\x{1DFF}'
        .'\x{1E00}-\x{1EFF}'
        .'\x{2000}-\x{209F}'
        .'\x{20D0}-\x{214F}'
        .'\x{2190}-\x{23FF}'
        .'\x{2460}-\x{25FF}'
        .'\x{2600}-\x{27EF}'
        .'\x{2900}-\x{29FF}'
        .'\x{2B00}-\x{2BFF}'
        .'\x{2C60}-\x{2C7F}'
        .'\x{2E00}-\x{2E7F}'
        .'\x{3000}-\x{303F}'
        .'\x{A490}-\x{A4CF}'
        .'\x{E000}-\x{F8FF}'
        .'\x{FE00}-\x{FE0F}'
        .'\x{FE30}-\x{FE4F}'
        .'\x{1F000}-\x{1F02F}'
        .'\x{1F0A0}-\x{1F0FF}'
        .'\x{1F100}-\x{1F64F}'
        .'\x{1F680}-\x{1F6FF}'
        .'\x{1F910}-\x{1F96B}'
        .'\x{1F980}-\x{1F9E0}]/u";

	function __construct($set = [])
	{
		if ( count( $set ) > 0 ) {
            foreach( $set as $key => $val ){
                $this->$key = $val;
            }
        };
	}

	public function set($string='')
	{
		$this->string = $string;
		return $this;
	}

	public function toBB()
	{
		$emojis = json_decode( file_get_contents( FCPATH.'res/smileys/emojis.json' ), TRUE);
		$emoticons = array_flip($emojis);
		$this->string = preg_replace_callback($this->re,function($m) use ($emoticons){
    		$code = strtolower(sprintf('%X', IntlChar::ord($m[0])));
    		return ( !empty($emoticons[$code] )) ? $emoticons[$code] : $m[0];
    	}, $this->string);
		
		return $this;
	}

	public function remove(){
	    $regex_alphanumeric = '/[\x{1F100}-\x{1F1FF}]/u';
	    $clear_string = preg_replace($regex_alphanumeric, '', $this->string);

	    $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
	    $clear_string = preg_replace($regex_symbols, '', $clear_string);

	    $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
	    $clear_string = preg_replace($regex_emoticons, '', $clear_string);

	    $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
	    $clear_string = preg_replace($regex_transport, '', $clear_string);
	    
	    $regex_supplemental = '/[\x{1F900}-\x{1F9FF}]/u';
	    $clear_string = preg_replace($regex_supplemental, '', $clear_string);

	    $regex_misc = '/[\x{2600}-\x{26FF}]/u';
	    $clear_string = preg_replace($regex_misc, '', $clear_string);

	    $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
	    $clear_string = preg_replace($regex_dingbats, '', $clear_string);

	    $this->string = $clear_string;
		return $this;
	}

	public function toImg()
	{
		$this->toBB();
		$image_url = rtrim($this->image_url, '/').'/';
		$emojis_gd = json_decode( file_get_contents( FCPATH.'res/smileys/emojis_gd.json' ), TRUE );
		foreach ($emojis_gd as $key => $val)
		{
			$this->string = str_replace($key, '<img class="smileys" src="'.$image_url.$val.'" alt="'.str_replace(":", '', $key).'" style="width: '.$this->width.'px; height: '.$this->height.'px; border: 0;" />', $this->string);
		}

		return $this;
	}

	public function parse()
	{
		return $this->string;
	}
}