<?php
namespace Lib;
class Upload{
    private $error;     //错误信息
    private $type;      //上传的类型
    private $path;      //上传路径
    private $size;      //上传文件允许大小
    public function __construct($path,$size,$type) {
        $this->path=$path;
        $this->size=$size;
        $this->type=$type;
    }
    //显示错误
    public function getError(){
        return $this->error;
    }
    /*
     * 文件上传的方法
     * @param $files array $_FILES[]
     * @return string|false 成功返回图片地址，失败返回false;
     */
    public function uploadOne($files) {
        if($files['error']!=0){
            switch($files['error']){
                case 1:  $this->error='超过配置文件允许的大小'. ini_get('upload_max_filesize');                   
                    break;
                case 2:  $this->error='超过表单允许的最大值' ;                 
                    break;
                case 3:  $this->error='头像没有完全上传，只有部分上传';                  
                    break;
                case 4:  $this->error='没有头像上传';                  
                    break;
                case 6: $this->error='找不到临时文件' ;                 
                    break;
                case 7:  $this->error='文件写入失败' ;                 
                    break;
                default :$this->error='未知错误';
            }
            return false;
        }
        //验证文件大小
        if($files['size']>$this->size){
            //number_format  显示数字的格式
            $this->error='文件不能超过'.number_format($this->size/1024,2).'K';
            return false;
        }
        //验证文件格式
        $finfo= finfo_open(FILEINFO_MIME_TYPE);
        $info= finfo_file($finfo, $files['tmp_name']);
        if(!in_array($info, $this->type)){
            $this->error='文件类型错误，允许上传的类型有：'.implode(',', $this->type);
            return false;
        }
        //验证是否http上传的文件
        if(!is_uploaded_file($files['tmp_name'])){
            $this->error='必须是http上传的文件';
            return false;
        }
        //设置路径 
        //创建保存头像的文件夹
        $foldername=date('Y-m-d');
        $folderpath= $this->path.$foldername;
        if(!file_exists($folderpath)){
            mkdir($folderpath);
        }
        //文件上传
        $filename= uniqid('PHP',true).strrchr($files['name'], '.');
        $filepath=$folderpath.'/'.$filename;
        if(move_uploaded_file($files['tmp_name'], $filepath)){
            //上传成功返回路径，存储到数据库
            return "{$foldername}/{$filename}";
        }else{
            $this->error='文件上传失败';
            return false;
        }     
    }
}

