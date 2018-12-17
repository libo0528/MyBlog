<?php
namespace Controller\Admin;
class UserController extends BaseController{
    //显示 用户管理
    public function listAction(){
        $model= new \Core\Model('user');
        $list=$model->select(array('is_admin'=>0));
        $this->smarty->assign('list',$list);
        $this->smarty->display('user_list.html');
    }
    //删除普通用户
    public function delAction(){
        $user_id=(int)$_GET['user_id'];
        $model=new \Core\Model('user');
        if($model->delete($user_id)){
            $this->success('index.php?p=Admin&c=User&a=list','删除成功');
        }else{
             $this->error('index.php?p=Admin&c=User&a=list','删除失败');
        }
    }
    //个人设置
    public function editAction() {
        if(!empty($_POST)){
            //1、修改密码
            $pwd= trim($_POST['password']);
            if(!empty($pwd)){
                $data['user_pwd']= md5($pwd);
            }
            //2、修改头像
            if($_FILES['face']['error']!=4){
                $path=$GLOBALS['config']['app']['upload_path'];
                $size=$GLOBALS['config']['app']['upload_size'];
                $type=$GLOBALS['config']['app']['upload_type'];
                $model=new \Lib\Upload($path, $size, $type);
                if($path=$model->uploadOne($_FILES['face'])){
                    $data['user_face']=$path;
                }else{
                    $this->error('index.php?p=Admin&c=User&a=edit',$model->getError());
                }
            }
            //3、更改用户信息
            if(!empty($data)){
                //更改用户信息时  update里必须有id
                $data['user_id']=$_SESSION['user']['user_id'];
                $model=new \Core\Model('user');
                $result=$model->update($data);
                if($result===0){
                    $this->error('index.php?p=Admin&c=User&a=edit','新密码和原始密码一样');
                }else if($result===false){
                    $this->error('index.php?p=Admin&c=User&a=edit','修改失败！');
                }
                else{
                    session_destroy();
                    echo <<<str
                    <script type="text/javascript">
                        alert('修改成功！即将跳转，请重新登录');
                        //top关键字表示所有框架最顶端的窗口。
                        top.location.href='index.php?p=Admin&c=Login&a=login'
                  </script>
str;
                }
            }        
        }
        $this->smarty->display('user_edit.html');
    }
    
}

