<?php
/* Smarty version 3.1.32, created on 2018-09-30 16:29:10
  from 'D:\wamp\go\Blog-2\Application\View\Admin\menu.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bb089562420c1_44805387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23d9ea49b57bb7fd0c4e341735b944afb1a600a3' => 
    array (
      0 => 'D:\\wamp\\go\\Blog-2\\Application\\View\\Admin\\menu.html',
      1 => 1538277498,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bb089562420c1_44805387 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="./Application/View/Admin/css/pintuer.css">
<link rel="stylesheet" href="./Application/View/Admin/css/admin.css">
</head>

<body>
<ul class="nav nav-inline admin-nav">
    <li class="active">
        <ul>
        	<?php if ($_SESSION['user']['is_admin'] == 1) {?>
        	<li><a href="index.php?p=Admin&c=User&a=list" target="mainFrame">用户管理</a></li>
			<li><a href="index.php?p=Admin&c=Category&a=list" target="mainFrame">类别管理</a></li>	
            <li><a href="index.php?p=Admin&c=Link&a=list" target="mainFrame">友情链接</a></li>
			<?php }?>
        	<li><a href="index.php?p=Admin&c=Article&a=list" target="mainFrame">文章管理</a></li><li><a href="index.php?p=Admin&c=User&a=edit" target="mainFrame">个人设置</a></li>
        </ul>
    </li>
</ul>
</body>
</html>
<?php }
}
