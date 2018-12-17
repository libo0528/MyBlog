<?php
/* Smarty version 3.1.32, created on 2018-09-23 12:52:19
  from 'D:\wamp\go\Blog\Application\View\Admin\products_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ba71c034331a4_93941780',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7d86eb8ecc04434f8db2f5f27adc8c387c24bfd' => 
    array (
      0 => 'D:\\wamp\\go\\Blog\\Application\\View\\Admin\\products_list.html',
      1 => 1537598293,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ba71c034331a4_93941780 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<style type="text/css">
		table tr:nth-of-type(even){
			background-color: #cad3de;
		}
 	</style>
 </head>
 <body>
 	<table border="1" cellspacing="0" cellpadding="0" align="center" width="980">
 		<caption><h2>商品信息表</h2>
 			<p><a href="?c=products&a=add">增加商品</a></p></caption>
		<th>编号</th>
		<th>商品名称</th>
		<th>规格</th>
		<th>价格</th>
		<th>库存量</th>
		<th>删除</th>
		<th>修改</th>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['v']->value['proID'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['v']->value['proname'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['v']->value['proguige'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['v']->value['proprice'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['v']->value['proamount'];?>
</td>
				<td><a href="?c=products&a=del&proid=<?php echo $_smarty_tpl->tpl_vars['v']->value['proID'];?>
">删除</a></td>
				<td><a href="?c=products&a=upda&proid=<?php echo $_smarty_tpl->tpl_vars['v']->value['proID'];?>
">修改</a></td>
			</tr>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
 	</table>	
 </body>
 </html><?php }
}
