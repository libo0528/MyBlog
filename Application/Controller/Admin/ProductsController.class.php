<?php
namespace Controller\Admin;
class ProductsController extends \Core\Controller{
	//展示商品
	public function listAction(){
		//调用模型 连接数据库 获取表格信息
		$products=new \Core\Model('products');
		$list=$products->select(); //直接调用基础模型类中的万能的方法
		//加载显示页面
		$this->smarty->assign('list',$list);
		$this->smarty->display('products_list.html');
	}
	//删除商品
	public function delAction(){
		$proid=$_GET['proid'];				//获取删除商品的ID
		$model=new \Model\ProductsModel();			//实例化模型
		if($model->delete($proid)){			//直接调用基础模型类中的万能的方法
                    $this->success('index.php?p=Admin&c=Products&a=list','删除成功');
		}else{
                    $this->error('index.php?p=Admin&c=Products&a=list','删除失败');
		}
	}	
	//修改商品
	public function updaAction(){
		$proid=$_GET['proid'];				//获取删除商品的ID
		$updatepro=new \Model\ProductsModel();			//实例化模型
		$list=$updatepro->upda($proid);			//调用方法 获得要修改的数据
		$this->smarty->assign('list',$list);
		$this->smarty->display('products_update.html');		
	}
	public function upda2Action(){
		if(isset($_POST['btn'])){
			$arr['proID']=$_POST['proID'];	
			$arr['proname']=$_POST['proname'];
			$arr['proguige']=$_POST['proguige'];
			$arr['proprice']=$_POST['proprice'];
			$arr['proamount']=$_POST['proamount'];
			$products=new \Model\ProductsModel();
			if($products->update($arr)){
				// $list=$products->getList();
				// require './products_list.html';
                            $this->success('index.php?p=Admin&c=Products&a=list','修改成功');
			}else{
                            $this->error('index.php?p=Admin&c=Products&a=list','修改失败');
			}
		}		
	}
	//增加商品
	public function addAction(){
		
		// $proid=$_POST['proID'];
		if(isset($_POST['btn'])){
			$arr['proname']=$_POST['proname'];
			$arr['proguige']=$_POST['proguige'];
			$arr['proprice']=$_POST['proprice'];
			$arr['proamount']=$_POST['proamount'];
			// $proiamges=$_POST['proiamges'];
			// $proweb=$_POST['proweb'];
			$products=new \Model\ProductsModel();
			if($products->insert($arr)){
				// $list=$products->getList();
                            $this->success('index.php?p=Admin&c=Products&a=list','增加成功');
			}else{
                            $this->error('index.php?p=Admin&c=Products&a=list','增加失败');
			}
                }else{
			$this->smarty->display('products_add.html');		
                }	
		
	}
}