<?php
namespace Model;
class CategoryModel extends \Core\Model{
    private $tree=array();
    //定义一个属性，防止执行方法时再初始化，用来存储树形结构
    //获得树形类别
    public function getCategoryTree($parent_id=0) {
        //select（）参数为空 默认搜索所有数据
        $list= $this->select();
        $this->createTree($list,$parent_id);
        return $this->tree;
    }
      /*
     * 创建树型结构
     * @param $list 二维数组
     * @param $parent_id int 父级id,指定从哪个父级下找子级
     * @param $deep int 缩进的深度
     */
    private function createTree($list,$parent_id=0,$deep=0){
        foreach ($list as $rows) {
            if($rows['parent_id']==$parent_id){
                $rows['deep']=$deep;
                $this->tree[]=$rows;
                $this->createTree($list,$rows['cat_id'],$deep+1);
            }
        }
    }
    //判断是否是叶子节点
    public function isLeaf($cat_id){
        $sql="select count(*) from category where parent_id=$cat_id";
        //查到结果为0的时候就是叶子节点，fetch为false  需要取反返回结果
        return !$this->db->fetchColumn($sql);
    }
}

