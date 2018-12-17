<?php
$conn=mysqli_connect('localhost','root','root','mvc');
mysqli_set_charset($conn,'utf8');
$rs=mysqli_query($conn,'select * from category');
$list=mysqli_fetch_all($rs,MYSQLI_ASSOC);
//递归创建树形结构
//全局，防止在递归的过程中被销毁
$tree=array();
function createTree($list,$parent_id=0,$deep=0){
    global  $tree;
    foreach ($list as $rows) {
        if($rows['parent_id']==$parent_id){
            $rows['deep']=$deep;
            $tree[]=$rows;
            createTree($list, $rows['cat_id'], $deep+1);
        }
    }
}
//createTree($list);
//foreach ($tree as $v) {
//    echo str_repeat('&nbsp;', $v['deep']*8).$v['cat_name'],'<br>';
//}
?>
<script type="text/javascript">
$i=2;$j=$i+$i++*++$i;
echo $j;
</script>




<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
{literal}
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
{/literal}