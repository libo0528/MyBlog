<?php
namespace Model;
class ArticleModel extends \Core\Model{
    //显示文章列表
    public function getHomeCount() {
        $sql="select count(*) from article a inner join category c using(cat_id) where"
                . " is_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        return $this->db->fetchColumn($sql);    
    }
    
    //获取后台文章管理分页
    public function getHomePageList($startno,$pagesize) {
        if($startno<0){
            $startno=0;
        }
        $sql="select a.*,c.cat_name from article a inner join category c using(cat_id) where"
                . " is_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        $sql.=" limit {$startno},{$pagesize}";
        return $this->db->fetchAll($sql);
    }
    
    //软删除 is_recycle=1
    public function softdelete($art_id){
        $sql="update article set is_recycle=1 where art_id in ($art_id)";
        return $this->db->exec($sql);
    }
    //显示回收站文章列表
    public function getrecy() {
        $sql="select a.*,c.cat_name from article a inner join category c using(cat_id) where"
                . " is_recycle=1 and user_id=".$_SESSION['user']['user_id'];
        return $this->db->fetchAll($sql);    
    }
    //恢复回收站的文章
    public function rollback($art_id){
        $sql="update article set is_recycle=0 where art_id in ($art_id)";
        return $this->db->exec($sql);
    }
    //彻底删除文章
    public function kong(){
        if(isset($_GET['art_id'])){
            $sql="delete from article where is_recycle=1 and art_id={$_GET['art_id']}";
        }else{
            $sql="delete from article where is_recycle=1";
        }
        return $this->db->exec($sql);
    }
    //检索文章
    public function searchList() {
        $sql="select a.*,c.cat_name from article a inner join category c using(cat_id) "
                . "where is_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        if($_POST['cat_id']!==''){
            //找cat_id子级
            $cat_model=new \Model\CategoryModel();
            $sub_cat_list=$cat_model->getCategoryTree($_POST['cat_id']);
            //将自己的cat_id 和子级cat_id放入数组 用于在自己和子级里面查找
            $sub_cat_ids[0]=$_POST['cat_id'];
            foreach ($sub_cat_list as $rows) {
                $sub_cat_ids[]=$rows['cat_id'];
            }
            $ids= implode(',', $sub_cat_ids);
            $sql.=" and cat_id in ({$ids})";
        }
        if($_POST['title']!==''){
            $sql.=" and art_title like '%{$_POST['title']}%'";
        }
        if($_POST['content']!==''){
            $sql.=" and art_content like '%{$_POST['content']}%'";
        }
        if($_POST['is_top']!==''){
            $sql.=" and is_top = {$_POST['is_top']}";
        }
        if($_POST['is_public']!==''){
             $sql.=" and is_public = {$_POST['is_public']}";
        }
        return $this->db->fetchAll($sql);
    }
    //获取可以公开的文章
    public function getHomeList() {
        //三表查询 查询首页要显示的文章信息
        $sql="select a.*,c.cat_name,u.user_name from category c natural join article a inner join "
                . "user u using (user_id) where is_recycle=0 and is_public=1 order by is_top desc";
        return $this->db->fetchAll($sql);
    }
    //通过类别id获取对应的文章
    public function getArticleListByCatId($cat_id) {
        //实例化Category模型  获取cat_id的子级
        $cat_model=new CategoryModel();
        $sub_cat_list=$cat_model->getCategoryTree($cat_id);
        //$ids数组保存自己和子级的cat_id
        $ids[]=$cat_id;
        foreach ($sub_cat_list as $rows){
            $sub_cat_id=$rows['cat_id'];
            $ids[]=$sub_cat_id;
        }
        $ids= implode(',', $ids);
        $sql="select a.*,c.cat_name,u.user_name from article a inner join category c using (cat_id) inner join "
                . "user u using (user_id) where is_recycle=0 and is_public=1 and cat_id in ($ids) order by is_top desc";
        return $this->db->fetchAll($sql);
    }
    //更新阅读数  如果打开过该文章，将文章编号存到session   如果在session中找不到编号，则+1 
    public function updateArticleReadCount($art_id) {
        if(isset($_SESSION['art_'.$art_id])){
            return;
        }
        //给这个会话存入一个非false的自定义值  用来建立这个会话
        $_SESSION['art_'.$art_id]=1;
//        表示编号是$art_id的文章已经读过了,用来防止灌水
        $sql="update article set art_read=art_read+1 where art_id=$art_id";
        return $this->db->exec($sql);
    }
    //设置踩赞的业务逻辑
    /*
     * 踩和赞
     * @param $art_id int 文章编号
     * @param $falg int  1表示赞，0表示踩 
     */
    public function setUpDown($art_id,$flag) {
        if(isset($_SESSION['updown_'.$art_id])){
            return;
        }
        $_SESSION['updown_'.$art_id]=1; 
        if($flag){          //赞
            $sql="update article set art_up=art_up+1 where art_id=$art_id";
        }else{              //踩
            $sql="update article set art_down=art_down+1 where art_id=$art_id";
        }
        return $this->db->exec($sql);
    }
      /*
     * 获取上一篇或下一篇的文章编号
     * @param $art_id int 当前文章id
     * @param $type int 0上一篇 1下一篇
     * @return int 上一篇或下一篇的编号
     */
    public function getPrevOrNextArtId($art_id,$type) {
          if($type){
              $sql="select art_id from article where art_id>$art_id and"
                      . " is_recycle=0 and is_public=1 order by art_id limit 1";
          }else{
              $sql="select art_id from article where art_id<$art_id and"
                      . " is_recycle=0 and is_public=1 order by art_id desc limit 1";
          }
          return $this->db->fetchColumn($sql);
      }
  //首页按标题搜索文章
//    public function searchtitle() {
//        if($_POST['search_content']!==''){
//            $search_model=new \Core\Model('article');
//            $sql="select a.*,c.cat_name,u.user_name from article a inner join category c using (cat_id) inner join "
//                . "user u using (user_id) where is_recycle=0 and is_public=1 and art_title like '%{$_POST['search_content']}%'"
//                . " order by is_top desc";
//        return $this->db->fetchAll($sql);   
//        }     
//    }
    //首页分页显示 获取每页显示的条数
    public function getPageList($startno,$pagesize){
        if($startno<0){
            $startno=0;
        }
        $sql="select a.*,u.user_name,c.cat_name from article a inner join category c using (cat_id) "
                . "inner join user u using (user_id) where is_recycle=0 and is_public=1 "
                . " order by is_top desc";
        $sql.=" limit {$startno},{$pagesize}";
        return $this->db->fetchAll($sql);
    }
    //获取总记录数
    public function getArticleCount(){
        $sql="select count(*) from article where is_recycle=0 and is_public=1";
        return $this->db->fetchColumn($sql);
    }
    
    
    
    
                //前台list分类页面分页操作
     //分页显示 获取每页显示的条数
    public function getCategoryPageList($startno,$pagesize,$cat_id){
        if($startno<0){
            $startno=0;
        }
         //实例化Category模型  获取cat_id的子级
        $cat_model=new CategoryModel();
        $sub_cat_list=$cat_model->getCategoryTree($cat_id);
        //$ids数组保存自己和子级的cat_id
        $ids[]=$cat_id;
        foreach ($sub_cat_list as $rows){
            $sub_cat_id=$rows['cat_id'];
            $ids[]=$sub_cat_id;
        }
        $ids= implode(',', $ids);
        $sql="select a.*,u.user_name,c.cat_name from article a inner join category c using (cat_id) "
                . "inner join user u using (user_id) where is_recycle=0 and is_public=1 "
                . " and cat_id in ($ids) order by is_top desc";
        $sql.=" limit {$startno},{$pagesize}";
        return $this->db->fetchAll($sql);
    }
    //获取前台分类总记录数
    public function getCategoryArticleCount($cat_id){
        //实例化Category模型  获取cat_id的子级
        $cat_model=new CategoryModel();
        $sub_cat_list=$cat_model->getCategoryTree($cat_id);
        //$ids数组保存自己和子级的cat_id
        $ids[]=$cat_id;
        foreach ($sub_cat_list as $rows){
            $sub_cat_id=$rows['cat_id'];
            $ids[]=$sub_cat_id;
        }
        $ids= implode(',', $ids);
        $sql="select count(*) from article a inner join category c using (cat_id) inner join "
                . "user u using (user_id) where is_recycle=0 and is_public=1 and cat_id in ($ids)";
        return $this->db->fetchColumn($sql);
    }
                //前台list分类页面分页操作完成
    
    
    
                        //后台检索文章+分页
    //1、获取后台检索到文章的总记录数
    public function searchHomeCount() {
        $sql="select count(*) from article a inner join category c using(cat_id) "
                . "where is_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        if($_REQUEST['cat_id']!==''){
            //找cat_id子级
            $cat_model=new \Model\CategoryModel();
            $sub_cat_list=$cat_model->getCategoryTree($_REQUEST['cat_id']);
            //将自己的cat_id 和子级cat_id放入数组 用于在自己和子级里面查找
            $sub_cat_ids[0]=$_REQUEST['cat_id'];
            foreach ($sub_cat_list as $rows) {
                $sub_cat_ids[]=$rows['cat_id'];
            }
            $ids= implode(',', $sub_cat_ids);
            $sql.=" and cat_id in ({$ids})";
        }
        if($_REQUEST['title']!==''){
            $sql.=" and art_title like '%{$_REQUEST['title']}%'";
        }
        if($_REQUEST['content']!==''){
            $sql.=" and art_content like '%{$_REQUEST['content']}%'";
        }
        if($_REQUEST['is_top']!==''){
            $sql.=" and is_top = {$_REQUEST['is_top']}";
        }
        if($_REQUEST['is_public']!==''){
             $sql.=" and is_public = {$_REQUEST['is_public']}";
        }
        return $this->db->fetchColumn($sql);
    }
    //获取后台检索文章的分页
    public function searchHomePageList($startno,$pagesize) {
        if($startno<0){
            $startno=0;
        }
        $sql="select a.*,c.cat_name from article a inner join category c using(cat_id) "
                . "where is_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        if($_REQUEST['cat_id']!==''){
            //找cat_id子级
            $cat_model=new \Model\CategoryModel();
            $sub_cat_list=$cat_model->getCategoryTree($_REQUEST['cat_id']);
            //将自己的cat_id 和子级cat_id放入数组 用于在自己和子级里面查找
            $sub_cat_ids[0]=$_REQUEST['cat_id'];
            foreach ($sub_cat_list as $rows) {
                $sub_cat_ids[]=$rows['cat_id'];
            }
            $ids= implode(',', $sub_cat_ids);
            $sql.=" and cat_id in ({$ids})";
        }
        if($_REQUEST['title']!==''){
            $sql.=" and art_title like '%{$_REQUEST['title']}%'";
        }
        if($_REQUEST['content']!==''){
            $sql.=" and art_content like '%{$_REQUEST['content']}%'";
        }
        if($_REQUEST['is_top']!==''){
            $sql.=" and is_top = {$_REQUEST['is_top']}";
        }
        if($_REQUEST['is_public']!==''){
             $sql.=" and is_public = {$_REQUEST['is_public']}";
        }
        $sql.=" limit {$startno},{$pagesize}";
        return $this->db->fetchAll($sql);
    }
                    //后台检索文章+分页结束
     //前台搜索标题总条数
    public function getSeArticleCount(){
         if($_REQUEST['search_content']!==''){
            $search_model=new \Core\Model('article');
            $sql="select count(*) from article where is_recycle=0 and is_public=1 and art_title like '%{$_REQUEST['search_content']}%'"
                . " order by is_top desc";
        return $this->db->fetchColumn($sql);   
        }     
    }
    //前台搜索分页显示
     public function getPageSearList($startno,$pagesize){
         if($startno<0){
            $startno=0;
        }
        $sql="select a.*,c.cat_name,u.user_name from article a inner join category c using (cat_id) inner join "
                . "user u using (user_id) where is_recycle=0 and is_public=1 and art_title like '%{$_REQUEST['search_content']}%'"
                . " order by is_top desc";
        $sql.=" limit {$startno},{$pagesize}";
        return $this->db->fetchAll($sql);
    }
    //删除类别时 同时删除该类别的文章
    public function delCatArt($cat_id){
        $sql="delete from article where cat_id={$cat_id}";
        return $this->db->exec($sql);
    }
}

