<?php
/* Smarty version 3.1.32, created on 2018-10-03 23:57:48
  from 'D:\wamp\go\Blog-2\Application\View\Admin\link_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bb4e6fc37e309_56564398',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c64808a87cbb42be5d25636f7cfae444a39b76e6' => 
    array (
      0 => 'D:\\wamp\\go\\Blog-2\\Application\\View\\Admin\\link_add.html',
      1 => 1538213201,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bb4e6fc37e309_56564398 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>拼图后台管理-后台管理</title>
    <link rel="stylesheet" href="./Application/View/Admin/css/pintuer.css">
    <link rel="stylesheet" href="./Application/View/Admin/css/admin.css">
</head>

<body>
<div class="admin">
<form method="post">
<div class="panel admin-panel">
</div>
</form>
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>增加友情链接</strong></div>
    <form method="post" action="">
        <table class="table table-hover"  cellpadding="0" cellspacing="0">
            <tr border="1" align="center">            	
            	<th width="45">链接名</th>
                <th width="120">链接地址</th>              
           <tr>             
                <td>
                    <input type="text" name="link_name" style="border-color:#dddddd ">
                </td>
                <td>
                    <input type="text" name="link_url" style="border-color:#dddddd ">
                </td>         
            </tr>
            <tr align="center">
            	<td colspan="2">
                	<input type="submit" class="button border-yellow button-little" value="增加">
                </td>            
            </tr>           
        </table>
    </form>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">传智播客</a>构建</p>
</div>
</body>
</html>

<?php }
}
