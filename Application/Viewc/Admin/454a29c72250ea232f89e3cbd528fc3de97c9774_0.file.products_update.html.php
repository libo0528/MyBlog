<?php
/* Smarty version 3.1.32, created on 2018-09-22 11:52:46
  from 'D:\wamp\go\Smarty_Framework\Application\View\Admin\products_update.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ba5bc8ec0a3b3_71144300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '454a29c72250ea232f89e3cbd528fc3de97c9774' => 
    array (
      0 => 'D:\\wamp\\go\\Smarty_Framework\\Application\\View\\Admin\\products_update.html',
      1 => 1537588256,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ba5bc8ec0a3b3_71144300 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <form action="index.php?c=products&a=upda2" method="post">
 	<table border="1" cellspacing="0" cellpadding="0" align="center" width="980">
 		<caption><h2>修改商品信息</h2></caption>
		<th>编号</th>
		<th>商品名称</th>
		<th>规格</th>
		<th>价格</th>
		<th>库存量</th>
			<tr>
				<td><input type="text" name="proID" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['proID'];?>
"></input></td>
					
				<td><input type="text" name="proname" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['proname'];?>
"></input></td>
			
				<td><input type="text" name="proguige" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['proguige'];?>
"></input></td>	
				
				<td><input type="text" name="proprice" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['proprice'];?>
"></input></td>
				<td><input type="text" name="proamount" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['proamount'];?>
"></input></td>
		<tr align="center">
			<td colspan="5">
				<input type="submit" name="btn" value="修改">
			</td>
			
		</tr>
 	</table>	
 </form>

 </body>
 </html><?php }
}
