<?php
	session_start();
	if(!empty($_POST['bind'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nickname = $_POST['pickname'];
	mysql_connect("localhost","root","123123");
	mysql_set_charset("utf8");
	mysql_select_db("test");
	$sql = "select id,username from user where username='$username' and password='$password'";
	$result = mysql_query($sql);
		if($result){
			$row = mysql_fetch_assoc($result);
			//var_dump($row);
			$sql = "update user set openid='".$_SESSION['openid']."' where id=".$row['id'];
			mysql_query($sql);
			$_SESSION['user_info'] = $row;
		}
	}
	header("location:http://www.sxlzrc.com/index.php");