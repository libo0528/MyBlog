<?php
namespace Controller\Admin;
class ArticleController extends BaseController{
    //文章列表
    public function listAction(){
        //获取文章列表
        $art_model=new \Model\ArticleModel();          
        if(!empty($_REQUEST['submit'])||!empty($_REQUEST['title'])||!empty($_REQUEST['content'])||!empty($_REQUEST['is_top'])
                ||!empty($_REQUEST['is_public'])||!empty($_REQUEST['cat_id'])){
            $recordcount=$art_model->searchHomeCount();        //获取总记录数
            ////实例化分页
            $page=new \Lib\Page($recordcount, $GLOBALS['config']['app']['pagesize']);
            //获取分页字符串
            $art_title=$_REQUEST['title'];
            $art_content=$_REQUEST['content'];
            $is_top=$_REQUEST['is_top'];
            $is_public=$_REQUEST['is_public'];
            $cat_id=$_REQUEST['cat_id'];
            $page_str=$page->show2(array(
                'art_title'=>$art_title,
                'art_content'=>$art_content,
                'is_top'=>$is_top,
                'is_public'=>$is_public,
                'cat_id'=>$cat_id
            ));
            $art_list=$art_model->searchHomePageList($page->startno, 5);
        }else{
            $recordcount=$art_model->getHomeCount();
             //实例化分页
            $page=new \Lib\Page($recordcount, 5);
            $art_list=$art_model->getHomePageList($page->startno, 5);
            $page_str=$page->show2();
        }
        
        //获取检索中的分类列表
        $cat_model=new \Model\CategoryModel();
        $cat_list=$cat_model->getCategoryTree();
        $this->smarty->assign('data',array(
                'art_list'=>$art_list,
                'cat_list'=>$cat_list,
                'page_str'=>$page_str
                ));
        $this->smarty->display('article_list.html');
    }
    //添加文章
    public function addAction(){
        //获取表单信息 执行添加逻辑
        if(!empty($_POST)){
            $data['art_title']=$_POST['art_title'];
            $data['art_content']=$_POST['content'];
            $data['art_time']=time();
            $data['cat_id']=$_POST['cat_id'];
            $data['user_id']=$_SESSION['user']['user_id'];
            $data['is_top']=$_POST['is_top'];
            $data['is_public']=$_POST['is_public'];
            $model=new \Core\Model('article');
            if($model->insert($data)){
                $this->success('index.php?p=Admin&c=Article&a=list','添加文章成功');
            }else{
                $this->error('index.php?p=Admin&c=Article&a=add','添加文章失败！请重新添加');
            }
        }
        //显示类别下拉框
        $cat_model=new \Model\CategoryModel();
        $cat_list=$cat_model->getCategoryTree();
        $this->smarty->assign('cat_list',$cat_list);
        //显示添加
        $this->smarty->display('article_add.html');
    }
    //修改文章
    public function editAction(){
        $art_id=(int)$_GET['art_id'];
        $art_model=new \Model\ArticleModel('article');
        //执行修改逻辑
        if(!empty($_POST)){
            $data['art_title']=$_POST['art_title'];
            $data['art_content']=$_POST['content'];
            $data['cat_id']=$_POST['cat_id'];
            $data['is_top']=$_POST['is_top'];
            $data['is_public']=$_POST['is_public'];
            $data['art_id']=$art_id;
            $rs=$art_model->update($data);
            if($rs){
                $this->success('index.php?p=Admin&c=Article&a=list','修改文章成功！');
            }elseif($rs===0){
                $this->error('index.php?p=Admin&c=Article&a=edit&art_id='.$art_id,'没有数据更新！');
            }else{
                 $this->error('index.php?p=Admin&c=Article&a=edit&art_id='.$art_id,'修改文章成功！');
            }
        }
        //显示修改页面
             //要修改的文章的信息
        $art_info=$art_model->Find($art_id);       
            //修改页面显示分类
        $cat_model=new \Model\CategoryModel();
        $cat_list=$cat_model->getCategoryTree();
        $this->smarty->assign('data',array(
            'art_info'=>$art_info,
            'cat_list'=>$cat_list
        ));
        $this->smarty->display('article_edit.html');
    }
    //删除文章 软删除 
    public function delAction() {
        $art_id=$_GET['art_id'];
//        print_r($art_id);
//        exit();
        $model=new \Model\ArticleModel();
        if($model->softdelete($art_id)){
            $this->success('index.php?p=Admin&c=Article&a=list','删除文章成功！');
        }else{
            $this->error('index.php?p=Admin&c=Article&a=list','删除文章失败！');
        }
    }
    //展示回收站的文章列表
    public function recyAction() {
        $art_model=new \Model\ArticleModel();
        $art_list=$art_model->getrecy();
        $this->smarty->assign('data',array(
                'art_list'=>$art_list
                ));
        $this->smarty->display('article_recycle.html');
    }
//    执行恢复文章
    public function rollAction() {
        $art_id=$_GET['art_id'];
        $model=new \Model\ArticleModel();
        if($model->rollback($art_id)){
            $this->success('index.php?p=Admin&c=Article&a=recy','恢复文章成功！');
        }else{
            $this->error('index.php?p=Admin&c=Article&a=recy','恢复文章失败！');
        }
    }
    //清空回收站 彻底删除文章
     public function kongAction() { 
        $model=new \Model\ArticleModel();
        if($model->kong()){
            $this->success('index.php?p=Admin&c=Article&a=recy','彻底删除成功！');
        }else{
            $this->error('index.php?p=Admin&c=Article&a=recy','彻底删除失败！');
        }
    } 
    //置顶
    public function topAction() {
        $data['art_id']=(int)$_GET['art_id'];
        $data['is_top']=(int)$_GET['is_top'];
        $model=new \Core\Model('article');
        if($model->update($data)){
            $this->success('index.php?p=Admin&c=Article&a=list','更新成功');
        }else{
            $this->error('index.php?p=Admin&c=Article&a=list','更新失败');
        }
    }
}

