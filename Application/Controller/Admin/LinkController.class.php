<?php
namespace Controller\Admin;
class LinkController extends BaseController{
    public function listAction(){
        $model=new \Core\Model('link');
        $list=$model->select();
        $this->smarty->assign('list',$list);
        $this->smarty->display('link_list.html');
    }
     public function delAction(){
        $link_id=(int)$_GET['link_id'];
        $model=new \Core\Model('link');
        if($model->delete($link_id)){
            $this->success('index.php?p=Admin&c=Link&a=list','删除成功！');
        }else{
            $this->error('index.php?p=Admin&c=Link&a=list','删除失败！');
        }
    }
     public function editAction(){
        $link_id=(int)$_GET['link_id'];
        $model=new \Core\Model('link');
        if(!empty($_POST)){
            $data['link_name']=$_POST['link_name'];
            $data['link_url']=$_POST['link_url'];
            $data['link_id']=$link_id;
            $rs=$model->update($data);
            if($rs){
                $this->success('index.php?p=Admin&c=Link&a=list','修改成功！');
            }elseif($rs===0){
                $this->error('index.php?p=Admin&c=Link&a=edit','没有数据更新！');
            }else{
                $this->error('index.php?p=Admin&c=Link&a=edit','修改失败！');
            }
        }
        $list=$model->Find($link_id);
        $this->smarty->assign('list',$list);
        $this->smarty->display('link_edit.html');
    }
     public function addAction(){
         if(!empty($_POST)){
            $model=new \Core\Model('link');
            $_POST['link_time']=time();
            if($model->insert($_POST)){
                $this->success('index.php?p=Admin&c=Link&a=list','添加链接成功！');
            }else{
                $this->error('index.php?p=Admin&c=Link&a=add','添加链接失败！');
            }
         } 
       //显示添加的页面
        $this->smarty->display('link_add.html');
    }
    
}

