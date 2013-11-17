<?php
	header("content-type:text/html;charset=utf-8");
	function get_contents($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
			
		$response =  curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	session_start();
	
	$openid = $_SESSION['openid'];
	
	$url = "https://graph.qq.com/user/get_user_info?access_token=".$_SESSION['access_token']."&oauth_consumer_key=217911&openid=".$_SESSION['openid']."&format=json";
	$user = json_decode(get_contents($url),true);
	$_SESSION['qq'] = $user;
?>

	<form action="dobind.php" method="post">
		<img src="<?php echo $user['figureurl_qq_2']?>" /><br />
		用户名:<input type="text" name="username" /><br />
		昵称:<input type="text" name="pickname" value="<?php echo $user['nickname']?>" /><br />
		密码:<input type="password" name="password" /><br />
		<input type="submit" name="bind" value="绑定" />
		<input type="submit" name="reg" value="注册" />
	</form>
	