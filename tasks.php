<?php

$tasks = array();


$tasks[] = array(
	'id' => '01_neo',
	'title' => 'Ты меня слушаешь, Нео?',
	'description' => 'Прочитайте код из матрицы
		<img src="files/red.jpg" width=100%>',
	'image' => 'images/task1.png',
	'flag' => 'flag:wakeupneo',
);


$tasks[] = array(
	'id' => '02_tele',
	'title' => 'Какой толк от телефона, если сейчас вы немы?',
	'description' => 'Определите номер из зашифрованного сигнала<br>
		(Внимание 5 кратный роутинг)<br>
		<div class="form-group">
		  <textarea class="form-control" id="readOnlyInput"  type="text" readonly="">
VlhwT2QxSnJNSGRPVkZwWVZrWktVVlpyVmtabFJsSnpWV3h3VVZWVU1Eaz0=</textarea>
	  </div>
	',
	'image' => 'images/task2.png',
	'flag' => 'flag:+1776890556',
);

$tasks[] = array(
	'id' => '03_tuck_tuck',
	'title' => 'Тук-тук, Нео',
	'description' => 'У вас уже есть ответ на этот вопрос. Что вам известно о дебаге в вашем браузере?',
	'image' => 'images/task3.png',
	'flag' => 'flag:gentlen',
);

$tasks[] = array(
	'id' => '04_wakeup',
	'title' => 'Проснись, Нео…',
	'image' => 'images/task4.png',
	'description' => '',
	'flag' => '',
);

$tasks[] = array(
	'id' => '05_spoon',
	'title' => 'Не пытайся согнуть ложку; это невозможно',
	'image' => 'images/task5.png',
	'description' => '',
	'flag' => '',
);

$tasks[] = array(
	'id' => '06_real',
	'title' => 'Добро пожаловать в реальный мир',
	'image' => 'images/task6.png',
	'description' => '',
	'flag' => '',
);

$tasks[] = array(
	'id' => '07_kill',
	'title' => 'Убить Вас — наслаждение, мистер Андерсон',
	'image' => 'images/task7.png',
	'description' => '
<pre>
;nasm 2.11.08
section .data
data: 	db 65h, 6bh, 60h, 66h, 39h, 6dh, 60h, 72h, 6ch, 68h, 72h, 64h, 60h, 72h, 64h, 10
dataLen:  equ $-data        	 
section .text
global _start
_start:
xor ecx, ecx
mov ecx, 0eh
L1:
mov ah, [data+ecx]
inc ah
mov [data+ecx], ah
loop L1
mov ah, [data]
inc ah
mov [data], ah    
mov eax,4
mov ebx,1
mov ecx,data
mov edx,dataLen
int 80h        	 
mov eax,1
mov ebx,0
int 80h;
</pre>',
	'flag' => 'flag:nasmisease',
);
