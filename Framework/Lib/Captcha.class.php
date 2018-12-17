<?php
namespace Lib;
class Captcha{
    private $w;         //画布宽度
    private $h;         //画布高度
    private $font;      //内置字条大小  1、2、3、4、5
    private $len;       //验证码长度
    public function __construct($len=4,$font=5,$w=80,$h=32) {
        $this->font=$font;
        $this->len=$len;
        $this->w=$w;
        $this->h=$h;
    }
    //生成随机字符
    private function gengeralCode(){
        $char_array= array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        $index_array= array_rand($char_array, $this->len);
        shuffle($index_array);
        $str='';
        foreach ($index_array as $v){
            $str.=$char_array[$v];
        }
        $_SESSION['code']=$str;
        return $str;
    }
    //生成验证码
    public function generalCaptcha() {
        $str=$this->gengeralCode();
        $img= imagecreate($this->w, $this->h);
        imagecolorallocate($img,0, 153, 154);
        $color= imagecolorallocate($img, 255, 255, 255);
        $x=(imagesx($img)-imagefontwidth($this->font)*strlen($str))/2;          //起始点的x坐标
        $y=(imagesy($img)-imagefontheight($this->font))/2;                      //起始点的y坐标
        imagestring($img, $this->font, $x, $y, $str, $color);
        header('Content-type:image/png');
        imagepng($img);
    }
    //检查验证码是否输入正确
    public function checkCode($code){
        return strtoupper($code)== strtoupper($_SESSION['code']);
    }
}

