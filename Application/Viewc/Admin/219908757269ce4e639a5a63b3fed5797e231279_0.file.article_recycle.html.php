<?php
/* Smarty version 3.1.32, created on 2018-09-29 08:30:25
  from 'D:\wamp\go\Blog\Application\View\Admin\article_recycle.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5baec7a1cf17e9_46662367',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '219908757269ce4e639a5a63b3fed5797e231279' => 
    array (
      0 => 'D:\\wamp\\go\\Blog\\Application\\View\\Admin\\article_recycle.html',
      1 => 1538181020,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5baec7a1cf17e9_46662367 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>拼图后台管理-后台管理</title>
    <link rel="stylesheet" href="./Application/View/Admin/css/pintuer.css">
    <link rel="stylesheet" href="./Application/View/Admin/css/admin.css">
    <?php echo '<script'; ?>
 type="text/javascript">
        window.onload=function(){
            //全选
            document.getElementById('checkall').onclick=function(){
                var boxes=document.getElementsByName('art_id');
                for(var i=0;i<boxes.length;i++){
                    boxes[i].checked=!boxes[i].checked;
                }
            }
            //批量删除
            document.getElementById('recy_all').onclick=function(){
                var ids=[];                 //保存删除的id编号，数组格式
                var boxes=document.getElementsByName('art_id');
                
                for(var i=0;i<boxes.length;i++){
                    if(boxes[i].checked){
                        ids.push(boxes[i].value);
                    }
                }
                if(ids.length!=0){
                    //将元素连接成字符串 逗号连接
                    ids=ids.join();
                    location.href="index.php?p=Admin&c=Article&a=roll&art_id="+ids;
                }
            }
        }
    <?php echo '</script'; ?>
>
</head>

<body>
<div class="admin">
<form method="post">
<div class="panel admin-panel">
<!-- <div class="panel-head"><strong>文章检索</strong>&nbsp;&nbsp;&nbsp;&nbsp;
	类别：
    <select></select>
    标题：<input type="text" name="title">
    内容：<input type="text" name="content">
    是否公开：<select><option value="">不限</option><option value="1">是</option><option value="0">否</option></select>
    是否置顶：<select><option value="">不限</option><option value="1">是</option><option value="0">否</option></select>
    <input type="submit" name="submit" value="搜索">
</div> -->
</div>
</form>
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>回收站</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" id="checkall" checkfor="id" value="全选" />
            <input type="button" class="button button-small border-green" value="返回文章列表" onClick="location.href='index.php?p=Admin&c=Article&a=list'"/>
            <input type="button" class="button button-small border-blue" id="recy_all" value="批量恢复" />
            <input type="button" class="button button-small border-yellow" value="清空回收站" 
            onClick="location.href='index.php?p=Admin&c=Article&a=kong'"/>
        </div>
        <table class="table table-hover">
            <tr>
                <th width="45">选择</th>
                <th width="120">分类</th>
                <th width="*">名称</th>
                <th>内容</th>
                <th width="100">时间</th>
                <th width="150">操作</th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['art_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
            <tr>
                <td><input type="checkbox" name="art_id" value="<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['art_title'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['art_content'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['art_time'];?>
</td>
                <td>
                    <a class="button border-blue button-little" href="index.php?p=Admin&c=Article&a=roll&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
">恢复</a>
                    <a class="button border-yellow button-little" href="index.php?p=Admin&c=Article&a=kong&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
" onclick="return confirm('确认删除?')">彻底删除</a>
                    <!-- <a class="button border-blue button-little" href="#">置顶</a> -->
                </td>
            </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
        <div class="panel-foot text-center">
            <ul class="pagination"><li><a href="#">上一页</a></li></ul>
            <ul class="pagination pagination-group">
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
            </ul>
            <ul class="pagination"><li><a href="#">下一页</a></li></ul>
        </div>
    </div>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">传智播客</a>构建</p>
</div>
</body>
</html><?php }
}
