<?php
namespace Controller\Admin;
class CategoryController extends BaseController{
    //显示类别
    public function listAction() {
        $model=new \Model\CategoryModel();
        $list=$model->getCategoryTree();
        $this->smarty->assign('list',$list);
        $this->smarty->display('cat_list.html');
    }
    //添加类别
    public function addAction() {
        $model=new \Model\CategoryModel();
        if(!empty($_POST)){
            //将post提交的表单元素名和表的字段名一致，并且个数一样，就可以直接使用POST当做数组插入表格
           if($model->insert($_POST)){
               $this->success('index.php?p=Admin&c=Category&a=list','添加类别成功');
           }else{
               $this->error('index.php?p=Admin&c=Category&a=add','添加类别失败');
           }
        }
        //将类别展示在下拉框中，用于添加时选择
        $cat_list=$model->getCategoryTree();
        $this->smarty->assign('cat_list',$cat_list);
        $this->smarty->display('cat_add.html');
    }
    //修改类别
    /*
     * 1、指定的父级不能是自己
     * 2、指定的父级不能是自己的子级
     */
    public function editAction() {
        $cat_id=(int)$_GET['cat_id'];
        $model=new \Model\CategoryModel();
        if(!empty($_POST)){
            //指定的父级不能是自己
            if($_POST['parent_id']==$cat_id){
                $this->error('index.php?p=Admin&c=Category&a=edit&cat_id='.$cat_id,
                        '指定的父级不能是自己！');
            }
            //指定的父级不能是自己的子级  先获取自己自己的列表
            $sub_list=$model->getCategoryTree($cat_id);
            //在子级列表里面遍历 有没有子级的id是选框提交过来的id的
            foreach ($sub_list as $rows) {
                if($rows['cat_id']==$_POST['parent_id']){
                    $this->error('index.php?p=Admin&c=Category&a=edit&cat_id='.$cat_id,
                        '指定的父级不能是自己的自己！');
                }
            }
            //执行更改逻辑
            $_POST['cat_id']=$cat_id;
            if($model->update($_POST)){
                $this->success('index.php?p=Admin&c=Category&a=list','修改类别成功！');
            }else{
                 $this->error('index.php?p=Admin&c=Category&a=edit&cat_id='.$cat_id,
                        '修改失败，请重新修改！');
            }  
        }
        //将需要更改的类别展示在网页中
        $cat_list=$model->getCategoryTree();
        $info=$model->Find($cat_id);
        $this->smarty->assign('data',array(
            'cat_list'=>$cat_list,
            'info'=>$info
        ));
        $this->smarty->display('cat_edit.html');
    }
    /*
     * 删除
     * 判断是否是叶子节点 true 可以删除  false 还有子类不能删除
     */
    public function delAction(){
        $cat_id=(int)$_GET['cat_id'];
        $model=new \Model\CategoryModel();
        $art_model=new \Model\ArticleModel();
        if($model->isLeaf($cat_id)){
            if($model->delete($cat_id) && $art_model->delCatArt($cat_id)){
                $this->success('index.php?p=Admin&c=Category&a=list','删除成功');
            }else{
                $this->error('index.php?p=Admin&c=Category&a=list','删除失败！');
            }
        }else{
            $this->error('index.php?p=Admin&c=Category&a=list','当前删除的类别有子节点，不允许删除！');
        }
    }
}

