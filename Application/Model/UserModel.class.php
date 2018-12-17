<?php
namespace Model;
class UserModel extends \Core\Model{
    /*
     * 判断登录是否成功
     * @return array|false 如果登录成功，返回用户的信息，否则返回false
     */
    public function isLogin() {
        $data['user_name']= addslashes($_POST['username']);          //用户名
        $data['user_pwd']= md5($_POST['password']);          //密码
        if($info=$this->select($data)){
            $info=$info[0];                 //查询得到的是二维数组
            unset($info['user_pwd']);        //返回的信息不需要密码
            return $info;
        }
        return false;
    }
    //更新用户登录信息，在页面显示
    public function updateLoginInfo(){
        $data['last_login_ip']=ip2long($_SERVER['REMOTE_ADDR']);
        $data['last_login_time']=time();
        $data['login_count']=++$_SESSION['user']['login_count'];
        $data['user_id']=$_SESSION['user']['user_id'];
        return $this->update($data);
    }
}