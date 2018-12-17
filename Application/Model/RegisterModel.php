<?php
//namespace Model;
    $user_name= addslashes($_GET['username']); 
    $pdo=new PDO('mysql:dbname=mvc;host=localhost','root','root');
    $sql="select * from user where user_name='{$user_name}'";
    $statement=$pdo->query($sql);
    $info=$statement->fetch();
    if($info){
        echo 1;
    }else{
        echo 0;
    }
//class RegisterModel extends \Core\Model{
//    function register(){
//        $user_name= addslashes($_GET['username']); 
//        $info=$this->registerFetch($user_name);
//        if($info){
//            return 1;
//        }else{
//            return 0;
//        }
//    }
//}

