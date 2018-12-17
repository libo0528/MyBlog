<?php
namespace Core;
class Framework{
    //封装运行方法  给index入口文件调用
    public static function run(){
        self::initConst();
        self::initConfig();
        self::initError();
        self::initRoutes();
        self::initLoadClass();        
        self::initdispatch();
    }
    //定义路径常量，方便后面使用
    private static function initConst(){
        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT_PATH', getcwd().DS);
        define('APP_PATH', ROOT_PATH.'Application'.DS);
        define('FRAMEWORK_PATH', ROOT_PATH.'Framework'.DS);
        define('PUBLIC_PATH', ROOT_PATH.'Public'.DS);
        define('CONFIG_PATH', APP_PATH.'Config'.DS);
        define('CONTROLLER_PATH', APP_PATH.'Controller'.DS);
        define('MODEL_PATH', APP_PATH.'Model'.DS);
        define('VIEW_PATH', APP_PATH.'View'.DS);
        define('CORE_PATH', FRAMEWORK_PATH.'Core'.DS);
        define('LIB_PATH',FRAMEWORK_PATH.'Lib'.DS );
    }
    //初始化配置信息，单独将配置文件放在config里面 修改连接数据库和PDO的文件
    private static function initConfig(){
        $GLOBALS['config']=require CONFIG_PATH.'config.php';
    }
    //配置路由信息 p c a  
    private static function initRoutes(){
        $p=$_GET['p']??$GLOBALS['config']['app']['default_platform'];
        $c=$_GET['c']??$GLOBALS['config']['app']['default_controller'];
        $a=$_GET['a']??$GLOBALS['config']['app']['default_action'];
        $p= ucfirst(strtolower($p));
        $c= ucfirst(strtolower($c));
        $a= strtolower($a);
        define('PLATFORM_NAME', $p);
        define('CONTROLLER_NAME', $c);
        define('ACTION_NAME', $a);
        //当前控制器的路径
        define('__URL__', CONTROLLER_PATH.$p.DS);
        //当前视图的路径
        define('__VIEW__',VIEW_PATH.$p.DS);
        define('__VIEWC__', APP_PATH.'Viewc'.DS.$p.DS);
    }
    //初始化自动加载类
    private static function initLoadClass(){
        spl_autoload_register(function($class_name){
            $namespace= dirname($class_name);
            $class_name= basename($class_name);
            //由于Smarty存储路径不规则，需要将Smarty类名和地址做一个映射
            $map=array(
                'Smarty'=>CORE_PATH.'Smarty'.DS.'Smarty.class.php'
            );
            if(isset($map[$class_name])){
                $path=$map[$class_name];
            }elseif(in_array($namespace, array('Core','Lib'))){
                $path=FRAMEWORK_PATH.$namespace.DS.$class_name.'.class.php';
            }elseif($namespace=='Model'){
                $path=MODEL_PATH.$class_name.'.class.php';
            }else{
                $path=__URL__.$class_name.'.class.php';
            }
            if(file_exists($path)){
                require $path;
            }
        });
    }
    //确定分发
    private static function initdispatch(){
        $controller_name='Controller\\'.PLATFORM_NAME.'\\'.CONTROLLER_NAME.'Controller';
        $action_name=ACTION_NAME.'action';
        $obj=new $controller_name;
        $obj->$action_name();
    }
    //初始化错误处理机制
    private static function initError(){
        ini_set('error_reporting', E_ALL);
        if($GLOBALS['config']['app']['debug']){             //开发模式
            ini_set('display_errors', 'On');                  //错误显示在浏览器上
            ini_set('log_errors', 'Off');                      //关闭日志
        }else{
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            $logname=date('Y-m-d').'.log';
            ini_set('error_log','D:\wamp\go\Blog\log\\'.$logname);
        }
    }
}


