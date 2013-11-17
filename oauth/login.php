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
	$user['qq'] = json_decode(get_contents($url),true);
	
	mysql_connect("localhost","root","123123");
	
	mysql_set_charset("utf8");
	
	mysql_select_db("test");
	
	$sql = "select id,username,password from user where openid='$openid'";
	
	$result = mysql_query($sql);
	
	$user['user_info'] = mysql_fetch_assoc($result);
	
	$_SESSION['user_info'] = $user['user_info'];
	
	$_SESSION['qq'] = $user['qq'];
	
	/*echo "<pre>";
	var_dump($_SESSION);
	echo "</pre>";*/
	
	header("location:../index.php");