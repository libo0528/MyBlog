<?php
namespace Model;
//products表的模型，用来操作products表
//通过继承基础模型Model 来实现连接数据库
class ProductsModel extends \Core\Model{
	public function getList(){
		//获取products表的数据
		return $this->db->fetchAll("select * from products");
	}

/*
*删除商品
*@param  $proid int 删除商品的编号
*return 返回删除商品的行数
 */
	public function del($proid){
		//执行删除
		return $this->db->exec("delete from products where proid=$proid");
	}

	/*
	*修改商品
	*@param $proid int 修改商品的编号
	*return 修改商品的行数
	 */
	public function upda($proid){
		return $this->db->fetchRow("select * from products where proid=$proid");
		
	}
	public function upda2($proid,$proname,$proguige,$proprice,$proamount){
		return $this->db->exec("update products set proname='{$proname}',proguige='{$proguige}',proprice='{$proprice}',proamount='{$proamount}' where proid={$proid}");
	}
	/*
	*增加商品
	*@param 增加商品的信息$proname,$proguige,$proprice,$proamount
	 */
	public function add($proname,$proguige,$proprice,$proamount){
		return $this->db->exec("insert into products values (null,'{$proname}','{$proguige}','{$proprice}','{$proamount}',null,null)");
	}
}
	