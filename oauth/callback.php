<?php

	$url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=217911&client_secret=b68b1fe2abdf241466a0eae7731ab45f&code=".$_GET['code']."&state=".$_GET['state']."&redirect_uri=".urlencode("http://www.sxlzrc.com/");
	
	
	//parse_str(get_contents($url));
	
	$str = get_contents($url);
	parse_str($str);
	
	$openid = "https://graph.qq.com/oauth2.0/me?access_token=".$access_token;
	
	//callback( {"client_id":"100217911","openid":"75035FBF0E061730F6964FE9DD525B66"} );
	
	$callback = get_contents($openid);
	
	$callback = str_replace("(","('",$callback);
	$callback = str_replace(")","')",$callback);
	//echo $callback;
	eval('$data='.$callback);
	
	//var_dump($data);
	
	function get_contents($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
			
		$response =  curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
	function callback($data){
		//echo $data;
		return json_decode($data,true);
	}
	
	
	//判断openid是否存在
	//$sql = "select openid from user where openid='$data['openid']'";
	
	$sql = "select openid from user where openid=:openid";
	
	$pdo = new PDO("mysql:host=localhost;dbname=test","root","123123");
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->execute(array("openid"=>$data['openid']));
	
	$user = $stmt->fetchall(PDO::FETCH_ASSOC);
	
	//var_dump($user);
	
	session_start();
	
	$_SESSION['openid'] = $data['openid'];
	
	$_SESSION['access_token'] = $access_token;
	
	//var_dump($data);
	
	if(empty($user)){
		$location_url = "bind.php";
	}else{
		$location_url = "login.php";
	}
	
	//header("location:".$location_url);
	
	echo "<script>top.location.href='$location_url'</script>";