<?php
/* Smarty version 3.1.32, created on 2018-09-30 11:13:54
  from 'D:\wamp\go\Blog\Application\View\Home\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bb03f724bd1a9_81115333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3fcd00bd794efc8ba75ee98a7e76d3bcbb4e7f76' => 
    array (
      0 => 'D:\\wamp\\go\\Blog\\Application\\View\\Home\\index.html',
      1 => 1538277039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bb03f724bd1a9_81115333 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp\\go\\Blog\\Framework\\Core\\Smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="zh-CN" />
	<title>www.myblog.com - Welcome to 我的博客 - Powered by PHP150912</title>
	<link rel="stylesheet" rev="stylesheet" href="./Public/style/default.css" type="text/css" media="all"/>
	<?php echo '<script'; ?>
 src="./Public/script/common.js" type="text/javascript"><?php echo '</script'; ?>
>
</head>
<body class="multi index">

<!-- top bar -->
<div id="top">
	<div class="center">
    <div class="menu-left">
    <ul>
     <li><a href="javascript:;" onclick="setHomepage('http://www.myblog.com');">设为首页</a></li>
     <li><a href="javascript:;" onclick="addFavorite('http://www.myblog.com','www.myblog.com - Welcome to 我的博客')">收藏本站</a></li>      
    </ul>
    </div>
    <div class="menu-right">
	    	<ul id="info">
		<?php if (isset($_SESSION['user'])) {?>
        	<li>欢迎  <?php echo $_SESSION['user']['user_name'];?>
！</li> 
        	<li><a href="index.php?p=Admin&c=Admin&a=admin" target="_blank">管理</a></li>
        	<li><a href="index.php?p=Admin&c=Login&a=logout">退出</a></li>
        <?php } else { ?>
        	<li>游客
        	<a href="index.php?p=Admin&c=Login&a=login" target="_blank">请登录，</a>
        	<a href="index.php?p=Admin&c=Login&a=register" target="_blank">注册</a>
        	</li>
        <?php }?>              
    </ul>
	    </div>
   </div>	
</div>
  
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		<div id="divTop">
			<h1 id="BlogTitle"><a href="http://www.myblog.com">www.myblog.com</a></h1>
			<h3 id="BlogSubTitle">Welcome to 我的博客</h3>
		</div>
		<div id="divNavBar">
			<ul>
				<li id="nvabar-item-index"><a href="index.php?p=Home&c=Index&a=index">首页</a></li>
			</ul>
		</div>
		<div id="divMain">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['art_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
		<div class="post multi">
			<h4 class="post-date"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rows']->value['art_time'],'%Y-%m-%d %H:%M:%S');?>
</h4>
			<h2 class="post-title">
				<a href="index.php?p=Home&c=Article&a=article&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['rows']->value['art_title'];?>
</a>
			</h2>
			<div class="post-body">
				<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_content'];?>

			</div>
			<h5 class="post-tags"></h5>
			<h6 class="post-footer">
				作者: <?php echo $_smarty_tpl->tpl_vars['rows']->value['user_name'];?>
| 分类:<?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_name'];?>
 | 阅读:<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_read'];?>
 | 赞:<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_up'];?>
 | 踩：<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_down'];?>
</h6>
		</div>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
echo $_smarty_tpl->tpl_vars['data']->value['page_str'];?>

 <!--  <select onChange="location.href='index.php?module=Index&action=index&page=' + this.value;">
 	<option value='1' selected='selected'>1</option>
 </select>&nbsp;&nbsp;		
 <form method="GET" action="index.php" style="display:inline">
 			<input type="hidden" name="module" value="Index"/>
 			<input type="hidden" name="action" value="index"/>
 			
 			<input type="text" id="page" name="page" value="1"  style="width:20px" onFocus="input_focus(this)" onBlur="input_blur(this)"/>
 			<input type="submit" value="提交"/>
 </form>
 		<?php echo '<script'; ?>
>
 			function input_focus(e){
 				if(e.value == e.defaultValue) e.value = '';
 			}
 
 			function input_blur(e){
 				if(e.value == '') e.value = e.defaultValue;
 			}
 		<?php echo '</script'; ?>
> -->

		</div>
<div id="divSidebar">
 
<dl class="function" id="divSearchPanel">
<dt class="function_t">文章标题搜索</dt><dd class="function_c">

<div>
	<form method="post" action="">
		<input type="text" name="search_content" size="11" value=
		"<?php echo isset($_POST['search_content']) ? $_POST['search_content'] : '';?>
"/> 
		<input type="submit" value="搜索" />
	</form>
</div>


</dd>
</dl> 
<dl class="function" id="divCalendar">
<dt style="display:none;"></dt><dd class="function_c">

<div></div>


</dd>
</dl> 
<dl class="function" id="divCatalog">
<dt class="function_t">文章分类</dt>
<dd class="function_c">
<ul>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['cat_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
	<li>
		<a href="index.php?p=Home&c=Article&a=list&cat_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_id'];?>
"><?php echo str_repeat('&nbsp;',$_smarty_tpl->tpl_vars['rows']->value['deep']*4);
echo $_smarty_tpl->tpl_vars['rows']->value['cat_name'];?>
</a>
	</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
</dd>
</dl> 
<dl class="function" id="divLinkage">
  <dt class="function_t">友情链接</dt><dd class="function_c">
<ul>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['link_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['rows']->value['link_url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['rows']->value['link_name'];?>
</a>
	</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>

</dd>
</dl> 
<dl class="function" id="divMisc">
<dt style="display:none;"></dt><dd class="function_c">

</dd>
</dl>		</div>
		<div id="divBottom">
        	<h3 id="BlogCopyRight">
                                            	Copyright © 2008-2028 PHP150912 All Rights Reserved            </h3>
			<h4 id="BlogPowerBy">Powered by <a href="" title="myblog" target="_blank">myblog V1.0 Release 20151116</a></h4>
		</div><div class="clear"></div>
	</div><div class="clear"></div>
	</div><div class="clear"></div>
</div>
</body>
</html><?php }
}
