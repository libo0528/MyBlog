<?php
namespace Controller\Home;
class IndexController extends BaseController{
    //显示首页
    public function indexAction() {
        //实例化article模型
        $art_model=new \Model\ArticleModel();
        $search_content=$_REQUEST['search_content']??'';
        //获取所有可以公开的文章
        if(!empty($_REQUEST['search_content'])){
            //如果是搜索的 获取搜索的列表
            $recordcount=$art_model->getSeArticleCount();         //获取总记录数
            $page=new \Lib\Page($recordcount, $GLOBALS['config']['app']['pagesize']);    //实例化分页
            $art_list=$art_model->getPageSearList($page->startno, $GLOBALS['config']['app']['pagesize']);
            $page_str=$page->show(array('search_content'=>$search_content));
        }else{
            $recordcount=$art_model->getArticleCount();         //获取总记录数
            $page=new \Lib\Page($recordcount, $GLOBALS['config']['app']['pagesize']);    //实例化分页
            $art_list=$art_model->getPageList($page->startno, $GLOBALS['config']['app']['pagesize']);
             //获取分页字符串
            $page_str=$page->show();
        }
       
        //实例化类别模型  获取类别树
        $cat_model=new \Model\CategoryModel();
        $cat_list=$cat_model->getCategoryTree();
        //实例化父类模型，操作link表//获取所有友情链接
        $link_model=new \Core\Model('link');
        $link_list=$link_model->select();
        $this->smarty->assign('data',array(
            'art_list'=>$art_list,
            'cat_list'=>$cat_list,
            'link_list'=>$link_list,
            'page_str'=>$page_str
        ));
        $this->smarty->display('index.html');
    }
  
   
}
