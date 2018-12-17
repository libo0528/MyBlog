<?php
namespace Lib;
class Page{
   
    private $recordcount;       //总记录数
    private $pagesize;          //页面大小 每个显示级记录数
    private $pageno;            //当前页码
    private $pagecount;            //总页数
    public $startno;             //起始位置
    public function __construct($recordcount,$pagesize=10) {
        $this->initParam($recordcount, $pagesize);
    }
    //计算参数 初始化
    private function initParam($recordcount,$pagesize) {
        $this->recordcount=$recordcount;
        $this->pagesize=$pagesize;
        $this->pageno=$_REQUEST['pageno']??1;
        $this->pagecount= ceil($this->recordcount/$this->pagesize);
        if($this->pageno < 1){
            $this->pageno=1;
        }
        if($this->pageno > $this->pagecount){
            $this->pageno= $this->pagecount;
        }
        $this->startno=($this->pageno-1)*$this->pagesize;
    }
    //拼接字符串 可以直接放入html文件使用
    public function show($arr=array()) {
        if(isset($arr)){
            //将形参获得的数组处理 连接成&a=b 的形式
            $ks= array_keys($arr);
            $arrs= array_map(function($k) use($arr){
                return "{$k}=$arr[$k]";
            }, $ks);
            $condtion= implode('&', $arrs);
            //定义分页字符串
            $str="<div class='pagebar' > ";
            $str.="<span>当前一共有{$this->recordcount}条记录，当前每页显示"
            . "{$this->pagesize}条记录，当前是第<b>{$this->pageno}</b>页！</span>&nbsp;&nbsp;";
            $url="index.php?p=".PLATFORM_NAME."&c=".CONTROLLER_NAME."&a=".ACTION_NAME."&".$condtion;
            $str.="<a href='{$url}&pageno=1'>首页</a>&nbsp;&nbsp;";
            $str.="<a href='{$url}&pageno=".($this->pageno-1)."'>上一页</a>&nbsp;&nbsp;";
            for($i=1;$i<=($this->pagecount);$i++){
                $str.="<a href='{$url}&pageno={$i}'>{$i}</a>&nbsp;&nbsp;";
            }
            $str.="<a href='{$url}&pageno=".($this->pageno+1)."'>下一页</a>&nbsp;&nbsp;";
            $str.="<a href='{$url}&pageno={$this->pagecount}'>尾页</a>&nbsp;&nbsp;";
            $str.="</div>";
        }else{
            $str="<div class='pagebar' > ";
            $str.="<span>当前一共有{$this->recordcount}条记录，当前每页显示"
            . "{$this->pagesize}条记录，当前是第<b>{$this->pageno}</b>页！</span>&nbsp;&nbsp;";
            $url="index.php?p=".PLATFORM_NAME."&c=".CONTROLLER_NAME."&a=".ACTION_NAME;
            $str.="<a href='{$url}&pageno=1'>首页</a>&nbsp;&nbsp;";
            $str.="<a href='{$url}&pageno=".($this->pageno-1)."'>上一页</a>&nbsp;&nbsp;";
            for($i=1;$i<=($this->pagecount);$i++){
                $str.="<a href='{$url}&pageno={$i}'>{$i}</a>&nbsp;&nbsp;";
            }
            $str.="<a href='{$url}&pageno=".($this->pageno+1)."'>下一页</a>&nbsp;&nbsp;";
            $str.="<a href='{$url}&pageno={$this->pagecount}'>尾页</a>&nbsp;&nbsp;";
            $str.="</div>";
        }    
        return $str;
    }
    //拼接字符串 可以直接放入html文件使用
    public function show2($arr=array()) {
//        if(isset($arr)){
            //将形参获得的数组处理 连接成&a=b 的形式       
            $ks= array_keys($arr);
            $arrs= array_map(function($k) use($arr){
                return "{$k}=$arr[$k]";
            }, $ks);
            $condtion= implode('&', $arrs);
            //定义分页字符串
            $str="<div class='panel-foot text-center'> ";
            $url="index.php?p=".PLATFORM_NAME."&c=".CONTROLLER_NAME."&a=".ACTION_NAME."&".$condtion;
            $str.=" <ul class='pagination'><li><a href='{$url}&pageno=".($this->pageno-1)."'>上一页</a></li></ul>";
            $str.="<ul class='pagination pagination-group'>";
            for($i=1;$i<=($this->pagecount);$i++){
                $str.="<li class='active'><a href='{$url}&pageno={$i}'>{$i}</a></li>";
            }
            $str.="</ul>";
            $str.="<ul class='pagination'><li><a href='{$url}&pageno=".($this->pageno+1)."'>下一页</a></li></ul>";
            $str.="</div></div>";
//        }else{
//            $str="<div class='panel-foot text-center'> ";           
//            $url="index.php?p=".PLATFORM_NAME."&c=".CONTROLLER_NAME."&a=".ACTION_NAME;           
//            $str.=" <ul class='pagination'><li><a href='{$url}&pageno=".($this->pageno-1)."'>上一页</a></li></ul>";
//            $str.="<ul class='pagination pagination-group'>";
//            for($i=1;$i<=($this->pagecount);$i++){
//                $str.="<li class='active'><a href='{$url}&pageno={$i}'>{$i}</a></li>";
//            }
//            $str.="</ul>";
//            $str.="<ul class='pagination'><li><a href='{$url}&pageno=".($this->pageno+1)."'>下一页</a></li></ul>";
//            $str.="</div></div>";
//        }      
        return $str;
    }
}

          
         
        
         
             
         
         
     
    
  
 
 
 

