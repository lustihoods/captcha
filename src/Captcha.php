<?php
namespace lustihoods\captcha;

class Captcha{
     
    private $width;
     
    private $height;
     
    private $str = 'abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHIJKMNPQRSTUVWXYZ';
     
    private $len;
     
    private $font_dir = 'C:\Users\lampol\Desktop\php\phpstudy\PHPTutorial\WWW\php\6-19\code.ttf';
     
    private  $img;
     
    private $code;
     
    public function __construct($config=['width'=>200,'height'=>50,'len'=>4]){
        $this->width = $config['width'];
        $this->height = $config['height'];
        $this->len = $config['len'];
         
    }
     
    public function entry(){
        $this->createBg();
        $this->getCode();
        $this->setCode();
        $this->setLine();
        $this->setDot();
        $this->outImg();
    }
     
    //创建背景图片
    private function createBg(){
        $this->img = imagecreate($this->width,$this->height);
        imagecolorallocate($this->img,135,206,235);
    }
     
    //生成验证码
     
    private function getCode(){
        for ($i=0;$i<$this->len;$i++){
            $key = mt_rand(0,strlen($this->str)-1);
            $this->code.=$this->str{$key};
        }
        $this->setSession();
    }
     
    //把验证码存到session
     
    private function  setSession(){
        session_start();
         
        $_SESSION['code'] = strtolower($this->code);
         
    }
     
    //验证码 写到背景图片
     
    private function setCode(){
         
        for($i=0;$i<$this->len;$i++){
     
            $font_color = imagecolorallocate($this->img,mt_rand
            (100,255),mt_rand(100,255),mt_rand(100,255));
             
            $x = ($this->width/$this->len)*$i+5;
             
            $font_size = mt_rand(18,30);
             
            $font_height = imagefontheight($font_size);
             
            $y = mt_rand($font_height,$this->height);
             
            imagettftext($this->img,$font_size,mt_rand(-25,25),$x,$y,$font_color,
            $this->font_dir,$this->code{$i});
     
        }
         
    }
     
    //画线
     
    private  function  setLine(){
        for($i=0;$i<$this->len;$i++){
     
            $line_color = imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imageline ($this->img,mt_rand(0,$this->width/$this->len),mt_rand(0,50),
            mt_rand($this->width-$this->width/$this->len,$this->width),mt_rand(0,50),$line_color);
             
        }
 
    }
    //画点
     
    private  function  setDot(){
        for($i=0;$i<100;$i++){
             
            $dot_color = imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),$dot_color);
             
        }
    }
     
    private  function outImg(){
         
        ob_end_clean();
        header('Content-type:image/jpeg');
        imagejpeg($this->img);
         
    }
     
    //销毁资源
    public function __destruct(){
        imagedestroy($this->img);
    }
}
