<?php
/* Smarty version 3.1.32, created on 2018-10-18 21:02:32
  from 'D:\wamp\go\Blog-2\Application\View\Admin\register.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bc88468b73b29_87002505',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f87743a9ca670153817ce1b8fa1321b2d2720fbc' => 
    array (
      0 => 'D:\\wamp\\go\\Blog-2\\Application\\View\\Admin\\register.html',
      1 => 1539867749,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bc88468b73b29_87002505 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>拼图后台管理-用户注册</title>
    <link rel="stylesheet" href="./Application/View/Admin/css/pintuer.css">
    <link rel="stylesheet" href="./Application/View/Admin/css/admin.css">
</head>

<body>
<div class="container">
    <div class="line">
        <div class="xs6 xm4 xs3-move xm4-move">
            <br /><br />
            <div class="media media-y"> <img src="./Application/View/Admin/images/logo.png" class="radius" alt="后台管理系统" />
            </div>
            <br /><br />
            <form action="" method="post" enctype="multipart/form-data">
            <div class="panel">
                <div class="panel-head"><strong>用户注册</strong></div>
                <div class="panel-body" style="padding:30px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input" name="username" id='username' placeholder="请输入用户名" />
                            <span class="icon icon-user"></span>
                             <span id="msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input" name="password" placeholder="请输入密码" />
                            <span class="icon icon-key"></span>
                        </div>
                    </div>
                   <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="file" class="input" name="face" placeholder="请输入头像">
                           
                            <span class="icon icon-camera"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input" name="passcode" placeholder="填写右侧的验证码" />
                            <img src="index.php?p=Admin&c=Login&a=createCaptcha" width="80" height="32" class="passcode" onClick="this.src='index.php?p=Admin&c=Login&a=createCaptcha&'+Math.random()"/>
                        </div>
                	</div>
                </div>
                <div class="panel-foot text-center">
                <input type="submit" id='btn' class="button button-block bg-main text-big"  style="float:left; margin-right:10px;" value="用户注册" />
                <input type="button"  class="button button-block bg-main text-big" value="返回" onClick="location.href='index.php?p=Admin&c=login&a=login'" />
                </div>
            </div>
            </form>
            <div class="text-right text-small text-gray padding-top">基于传智播客构建</div>
        </div>
    </div>
</div>

</body>
<?php echo '<script'; ?>
 type="text/javascript">
    window.onload=function(){
        document.getElementById('username').onblur=function(){
            var username=this.value;
            if(username==''){
                document.getElementById('msg').style.color='red';
                document.getElementById('msg').innerHTML='用户名不能为空';
                return;
            }
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(xhr.readyState==4){
                    if(xhr.status==200){
                        var res=xhr.responseText;
//                        console.log(res);
                        if(res=='1'){
                            document.getElementById('msg').style.color='red';
                            document.getElementById('msg').innerHTML='用户名已被注册';
                        }else{
                            document.getElementById('msg').style.color='green';
                            document.getElementById('msg').innerHTML='用户名可以使用';
                        }
                    }else{
                        document.getElementById('msg').style.color='red';
                        document.getElementById('msg').innerHTML='请求失败';
                    }
                }else{
                    document.getElementById('msg').style.color='black';
                    document.getElementById('msg').innerHTML='<img src="./Public/img/load.gif">';
                }
            }
            xhr.open('get','./Application/Model/registerModel.php?username='+username+'&_='+Math.random());
            xhr.send(null);
        }
    }
<?php echo '</script'; ?>
>
</html><?php }
}
