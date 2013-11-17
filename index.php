<?php
	header("content-type:text/html;charset=utf-8");
	session_start();
	
	//var_dump($_SESSION);
	
	if(!empty($_SESSION['user_info']['id'])){
		echo "欢迎您回来，".$_SESSION['qq']['nickname']."，<a href='oauth/logout.php'>退出</a>";
		exit;
	}
?>

<meta property="qc:admins" content="026651267764150412156375716000" />
<script>
 function toLogin()
 {
   //以下为按钮点击事件的逻辑。注意这里要重新打开窗口
   //否则后面跳转到QQ登录，授权页面时会直接缩小当前浏览器的窗口，而不是打开新窗口
   window.location.href="oauth/index.php";
 } 
</script>


<a href="javascript:;" onclick="toLogin()" ><img src="http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_3.png" /></a>