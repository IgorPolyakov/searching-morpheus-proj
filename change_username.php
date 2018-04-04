<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once("tasks.php");

if(!isset($_GET['new'])){
	http_response_code(400);
	echo json_encode(array('error' => 'Ожидается параметр new'));
	exit;
}

if(!isset($_COOKIE['u'])){
	http_response_code(400);
	echo json_encode(array('error' => 'Вы не сдали еще не одного таска. Что бы поменять имя необходимо рещить хотя б один таск.'));
	exit;
}

$username = $_COOKIE['u'];
$username_new = $_GET['new'];
$username_new = trim($username_new);

if(strlen($username_new) == 0){
	http_response_code(403);
	echo json_encode(array('error' => 'Новое имя не может быть пустым'));
	exit;
}

if(strlen($username_new) > 15){
	http_response_code(403);
	echo json_encode(array('error' => 'Новое имя не может быть больше 15 символов'));
	exit;
}

if (!preg_match("/^[0-9a-zA-Z]+$/", $username_new)) {
	http_response_code(403);
	echo json_encode(array('error' => 'Имя может быть только из английских букв разного регистра и цифр'));
	exit;
}

if(!file_exists("sess/".$username)){
	http_response_code(404);
	echo json_encode(array('error' => 'Нет такого пользователя'));
	exit;
}

if(file_exists("sess/".$username_new)){
	http_response_code(403);
	echo json_encode(array('error' => 'Имя уже занято'));
	exit;
}

rename("sess/".$username,"sess/".$username_new);
setcookie('u', $username_new, time() + 3600*24*35);

http_response_code(200);
echo json_encode(array('result' => 'Поменял имя'));
exit;
