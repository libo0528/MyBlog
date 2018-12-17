<?php
return array(
    //数据库配置信息
    'database'=>array(
        'type'=>'mysql',
        'user'=>'root',
        'psw'=>'root',
        'dbname'=>'mvc'
        
    ),
    //应用程序配置信息
    'app'=>array(
        'upload_path'   =>'./Public/Uploads/',
        'upload_size'   =>2222222,
        'upload_type'   =>array('image/png','image/gif','image/jpeg','image/jpg'),
        'default_platform'=>'Home',
        'default_controller'=>'Index',
        'default_action'=>'index',
        //用来记录开发模式还是运行模式
        'debug'         =>true,
        'pagesize'      =>2
        
    )
);

