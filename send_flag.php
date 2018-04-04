<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once("tasks.php");

if(!isset($_GET['flag'])){
	http_response_code(400);
	echo json_encode(array('error' => 'Ожидается параметр flag'));
	exit;
}

if(!isset($_GET['taskid'])){
	http_response_code(400);
	echo json_encode(array('error' => 'Ожидается параметр taskid'));
	exit;
}

$taskid = $_GET['taskid'];
$flag = $_GET['flag'];
$flag = strtolower($flag);

if(substr($flag,0,5) != 'flag:'){
	http_response_code(400);
	echo json_encode(array('error' => 'Вы забыли дописать flag:'));
	exit;
}

$t = null;
foreach($tasks as $k => $v){
	if($v['id'] == $taskid){
		$t = $v;
	}
}

if($t == null){
	http_response_code(404);
	echo json_encode(array('error' => 'Задача не найдена'));
	exit;
}

if($flag != $t['flag']){
	http_response_code(400);
	echo json_encode(array('error' => 'Неверный флаг'));
	exit;
}

$username = "";

if(!isset($_COOKIE['u'])){
	mt_srand((double)microtime()*10000); //optional for php 4.2.0 and up.
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	for ($i = 0; $i < 10; $i++) {
		$username .= $characters[rand(0, $charactersLength - 1)];
	}
	setcookie('u', $username, time() + 3600*24*35); // 35 days
}else{
	$username = $_COOKIE['u'];
	if (!preg_match("/^[0-9a-zA-Z]+$/", $username)) {
		http_response_code(403);
		echo json_encode(array('error' => 'Да вы, батенька, хакер! Не нужно менять свои куки и пытаться взломать меня.'));
		exit;
	}
}

if(!file_exists("sess/".$username)){
	if(!mkdir("sess/".$username, 0777)){
		http_response_code(500);
		echo json_encode(array('error' => 'Что то пошло не так...'));
		exit;
	}
}

if(file_exists("sess/".$username.'/task'.$taskid.'.solved')){
	http_response_code(400);
	echo json_encode(array('error' => 'Вы уже сдавали эту задачу'));
	exit;
}else{
	$myfile = fopen("sess/".$username.'/task'.$taskid.'.solved', "w");
}

http_response_code(200);
echo json_encode(array('result' => 'И это правильный ответ! Вы стали на шаг ближе на к Морфеусу.'));
exit;
