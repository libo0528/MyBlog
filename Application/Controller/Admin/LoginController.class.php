<?php
namespace Controller\Admin;
class LoginController extends BaseController{
    //调用生成验证码的方法
    public function createCaptchaAction() {
        $captcha=new \Lib\Captcha();
        $captcha->generalCaptcha();
    }
    //登录
    public function loginAction(){       
         //登录业务逻辑
        if(!empty($_POST)){
            //验证输入的验证码是否正确
            $captcha=new \Lib\Captcha();
            if(!$captcha->checkCode($_POST['passcode'])){
                $this->error('index.php?p=Admin&c=Login&a=login','验证码输入错误，请重新输入！');
            }
            $model=new \Model\UserModel();
             //将输入的信息在数据库搜索，搜索到就登录，搜索不到就失败
            if($info=$model->isLogin()){         
                $_SESSION['user']=$info;         //登录成功将信息保存到session 后面通过检查session防止翻墙登录
                $model->updateLoginInfo();         //更新登录信息
                //将提交的账户信息保存在cookie中，用于7天免登录
                if(isset($_POST['remember'])){
                    $time=time()+3600*24*7;
                    setcookie('username',$_POST['username'],$time);
                    setcookie('pwd',$_POST['password'],$time);
                }
                $this->success('index.php?p=admin&c=admin&a=admin','登陆成功');
            }else{
                $this->error('index.php?p=admin&c=login&a=login','登录失败，请重新登录！');
            }
        }
        $username=$_COOKIE['username']??'';   //获取cookie的信息
        $pwd=$_COOKIE['pwd']??'';             //获取cookie的信息
        $this->smarty->assign('username',$username);
        $this->smarty->assign('pwd',$pwd);
        $this->smarty->display('login.html');
    }
    
    //注册
    public function registerAction() {
        //实现用户注册
        if(!empty($_POST)){
            //验证输入的验证码是否正确
            $captcha=new \Lib\Captcha();
            if(!$captcha->checkCode($_POST['passcode'])){
                $this->error('index.php?p=Admin&c=Login&a=login','验证码输入错误，请重新输入！');
            }
            $data['user_name']=$_POST['username'];          //用户名
            $data['user_pwd']= md5($_POST['password']);          //密码
            $model=new \Core\Model('user');
            //判断用户名是否已存在
            if($model->select(array('user_name'=> $data['user_name']))){
                $this->error('index.php?p=Admin&c=Login&a=register','该用户名已注册，请重新选择');
            };
            //上传头像
            $path=$GLOBALS['config']['app']['upload_path'];
            $size=$GLOBALS['config']['app']['upload_size'];
            $type=$GLOBALS['config']['app']['upload_type'];
            $upload=new \Lib\Upload($path,$size,$type);
            if($path=$upload->uploadOne($_FILES['face'])){
                $data['user_face']=$path;
            }else{
                $this->error('index.php?p=Admin&c=Login&a=register', $upload->getError()); 
            }
            //头像上传完成
            //用户名不存在，写入数据库
            if($model->insert($data)){
                $this->success('index.php?p=admin&c=login&a=login','注册成功，请登录！');
            }else{
                $this->error('index.php?p=admin&c=login&a=register','注册失败，请重新注册！');
            };
        }
        $this->smarty->display('register.html');
    }  
    //注销退出
    public function logoutAction(){
        session_destroy();
        header("location:index.php?p=Admin&c=Login&a=login");
    }
}

