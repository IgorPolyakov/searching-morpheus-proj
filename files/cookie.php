<html>
	<body style="background-image: url(cookie.gif)">
	
<?php

$access_admin = '0';
if(!isset($_COOKIE['admin_access'])){
	setcookie('admin_access', $access_admin, time() + 3600*24*35); // 35 days
}else{
	$access_admin = $_COOKIE['admin_access'];
}

echo "<table width=100% height=100%><tr><td align=center><h1 style='color: #ffa'>";
if($access_admin == '1'){
	echo "Вот он флаг flag:admincookienotgood";
}else{
	echo "Вы не админ. Чтобы увидеть флаг, нужны админские права.";
}
echo "</h1></td></td>";
	
	
	
