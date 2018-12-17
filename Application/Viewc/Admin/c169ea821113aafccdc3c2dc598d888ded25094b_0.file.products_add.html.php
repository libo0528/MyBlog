<?php
/* Smarty version 3.1.32, created on 2018-09-22 11:52:52
  from 'D:\wamp\go\Smarty_Framework\Application\View\Admin\products_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ba5bc94b7ef05_72797635',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c169ea821113aafccdc3c2dc598d888ded25094b' => 
    array (
      0 => 'D:\\wamp\\go\\Smarty_Framework\\Application\\View\\Admin\\products_add.html',
      1 => 1537180311,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ba5bc94b7ef05_72797635 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <form action="index.php?c=products&a=add" method="post">
 	<table border="1" cellspacing="0" cellpadding="0" align="center" width="980">
 		<caption><h2>增加商品信息</h2></caption>
		<!-- <th>编号</th> -->
		<th>商品名称</th>
		<th>规格</th>
		<th>价格</th>
		<th>库存量</th>
		<!-- <th>图片</th> -->
		<!-- <th>网址</th> -->

			<tr>
				<!-- <td><input type="text" name="proID" value="<?php echo '<?php ';?>echo $list['proID']<?php echo '?>';?>"></input></td> -->					
				<td><input type="text" name="proname" ></input></td>
			
				<td><input type="text" name="proguige" ></input></td>	
				
				<td><input type="text" name="proprice"></input></td>
				<td><input type="text" name="proamount"></input></td>
				<!-- <td><input type="text" name="proimages"></input></td> -->
				<!-- <td><input type="text" name="proweb"></input></td> -->

		<tr align="center">
			<td colspan="5">
				<input type="submit" name="btn" value="增加">
				<input type="reset">
			</td>
			
		</tr>
 	</table>	
 </form>

 </body>
 </html><?php }
}
