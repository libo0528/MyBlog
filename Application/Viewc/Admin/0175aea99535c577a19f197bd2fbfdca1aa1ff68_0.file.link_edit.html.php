<?php
/* Smarty version 3.1.32, created on 2018-09-28 20:10:18
  from 'D:\wamp\go\Blog\Application\View\Admin\link_edit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bae1a2a791c76_16142300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0175aea99535c577a19f197bd2fbfdca1aa1ff68' => 
    array (
      0 => 'D:\\wamp\\go\\Blog\\Application\\View\\Admin\\link_edit.html',
      1 => 1538136612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bae1a2a791c76_16142300 (Smarty_Internal_Template $_smarty_tpl) {
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
    	<div class="panel-head"><strong>修改友情链接</strong></div>
    <form method="post" action="">
        <table class="table table-hover" border="1" cellpadding="0" cellspacing="0">
            <tr border="1" align="center">
            	<th width="45">链接名</th>
                <th width="120">链接地址</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="link_name" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
">
                </td>
                <td>
                    <input type="text" name="link_url" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['link_url'];?>
">
                </td>        
            </tr>
              <tr align="center">
                <td colspan="2">
                    <input type="submit" class="button border-yellow button-little" value="修改">
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
