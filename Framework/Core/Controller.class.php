<?php
namespace Core;
abstract class Controller{
    protected $smarty;
    public function __construct(){
        $this->initSmarty();
        $this->initSession();
    }
    //开启Session回话，用来保存生成的验证码
    private function initSession(){
        new \Lib\Session();
    }
    private function initSmarty(){
        $this->smarty=new \Smarty();
        $this->smarty->setTemplateDir(__VIEW__);
        $this->smarty->setCompileDir(__VIEWC__);
    }
    public function success($url, $info='', $time=1){
        $this->jump($url, $info, $time, 'success');
    }
    public function error($url, $info='', $time=3){
        $this->jump($url, $info, $time,'error');
    }
    private function jump($url,$info='',$time=3,$flag='success'){
        if($info==''){
            header("location:{$url}");
        }else{
            echo<<<str
            <!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="{$time};{$url}">
        <style>
            body{text-align: center}
            #msg{font-size: 36px;
            margin: 20px 0;}
            .success{color: #090;}
            .error{color:#F00;}
        </style>
    </head>
    <body>
        <image src="./Public/img/{$flag}.fw.png">
        <div id="msg" class="{$flag}">{$info}</div>
        <div>{$time}秒后自动跳转</div>
    </body>
</html>
str;
        exit;
        }
    }
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

