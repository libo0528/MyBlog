<?php
namespace Controller\Home;
class ArticleController extends BaseController{
    //文章列表控制器
    public function listAction() {
        $cat_id=(int)$_GET['cat_id'];
        //实例化Article模型 通过cat_id获取文章列表
        $art_model=new \Model\ArticleModel();
                //分页
        $recordcount=$art_model->getCategoryArticleCount($cat_id);         //获取分类总记录数
        $page=new \Lib\Page($recordcount, $GLOBALS['config']['app']['pagesize']);    //实例化分页
         //获取分页字符串
        $page_str=$page->show(array('cat_id'=>$cat_id));        
                //分页完成
        $art_list=$art_model->getCategoryPageList($page->startno,$GLOBALS['config']['app']['pagesize'],$cat_id);
         //实例化类别模型  获取类别树
        $cat_model=new \Model\CategoryModel();
        $cat_list=$cat_model->getCategoryTree();
        //实例化父类模型，操作link表  获取所有友情链接
        $link_model=new \Core\Model('link');
        $link_list=$link_model->select();
        $this->smarty->assign('data',array(
            'art_list'=>$art_list,
            'cat_list'=>$cat_list,
            'link_list'=>$link_list,
            'page_str'=>$page_str
        ));
        $this->smarty->display('list.html');
    }
    //文章内容页面
    public function articleAction() {
        $art_id=(int)$_GET['art_id'];   //文章id
        //判断是否是子评论
         $data['parent_id']=$_GET['reply_id']??0;
     //执行添加主评论
        if(!empty($_POST)){
            if(!isset($_SESSION['user'])){          //先验证是否登录
                $this->error('index.php?p=Admin&c=Login&a=login','评论前请先登录！');
            }
            //如果登录了就添加评论的数据
            $data['art_id']=$art_id;
            $data['reply_time']=time();
            $data['user_id']=$_SESSION['user']['user_id'];
            $data['reply_content']=$_POST['txaArticle'];           
            $reply_model=new \Core\Model('reply');
            if($reply_model->insert($data)){
                $this->success('index.php?p=Home&c=Article&a=article&art_id='.$art_id,'评论成功！');
            }else{
                $this->error('index.php?p=Home&c=Article&a=article&art_id='.$art_id,'评论失败！');
            }
        }
        $art_model=new \Model\ArticleModel();
     //更新阅读数
        $art_model->updateArticleReadCount($art_id);
     //显示文章内容
        $info=$art_model->Find($art_id);
    //获取评论树
        $reply_model=new \Model\ReplyModel();
        $reply_list=$reply_model->getReplyTree($art_id);
        $this->smarty->assign('data',array(
            'info'  =>$info,
            'reply_list'=>$reply_list
        ));
        $this->smarty->display('article.html');
    }
    //踩赞
    public function UpDownAction() {
        $art_id=(int)$_GET['art_id'];
        $flag=(int)$_GET['flag'];
        $art_model=new \Model\ArticleModel();
        $msg=$flag?'赞':'踩';
        if($art_model->setUpDown($art_id, $flag)){
            $this->success('index.php?p=Home&c=article&a=article&art_id='.$art_id,$msg.'成功！');
        }else{
            $this->error('index.php?p=Home&c=article&a=article&art_id='.$art_id,$msg
                    .'失败！您已经点评过了');
        }
    }
    //上一篇， 下一篇
    public function prevNextArticleAction() {
        $art_id_1=$_GET['art_id'];         //当前文章id
        $type=$_GET['type'];            //0上一篇，1下一篇
        $art_model=new \Model\ArticleModel();
        if($art_id_2=$art_model->getPrevOrNextArtId($art_id_1, $type)){
            header("location:index.php?p=Home&c=Article&a=article&art_id=$art_id_2");
        }else{
            $msg=$type?'这是最后一篇文章了':'已经是第一篇文章了';
            $this->error("index.php?p=Home&c=Article&a=article&art_id=".$art_id_1,$msg);
        }
    }   
}

