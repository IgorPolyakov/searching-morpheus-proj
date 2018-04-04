<html lang="en"><head>
    <meta charset="utf-8">
    <title>Searching Morpheus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="./css/custom.min.css" media="screen">

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <style>
		.card{
		    min-width: 15rem;
			max-width: 15rem;
			margin: 10px;
			display: inline-block;
		    margin-top: 50px !important;
		    border-radius: 400px;
		    box-shadow: 0px 0px 10px 3px #1c1e22;
		    cursor: pointer;
		    -webkit-transition: all 0.4s;
			transition: all 0.4s;
			height: 15rem;
			vertical-align: top;
		}
		td.solved{
			font-weight: bold;
			text-align: center;
			background-color: green;
		}
		td,th{
			text-align: center;
		}
		
	</style>
    <!-- body style="padding-top: 20px; background-image: url(http://mtdata.ru/u24/photo0F6F/20656638759-0/original.gif);" -->
	<body style="padding-top: 20px; background-size: 100% 100%; background-image: url(images/original.gif);">

	<div class="container text-center">
		<h2 class="lead alert alert-primary" id="countdown">Рейтинг</h2>
        <hr>
        
<?php

include_once("tasks.php");

$sess_dir = './sess';

$files = scandir($sess_dir,1);

echo "
<style>
table{
	width: 100%;
}
</style>
<table class='table table-hover table-dark'>
	<tr>
		<thead>
			<th>Username</th>
";
foreach($tasks as $task){
	echo "<th>".$task['id']."</th>";
}

echo "
		</thead>
	</tr>
";

foreach($files as $f){
	$d = $sess_dir.'/'.$f;
	if(is_dir($d) && $f != '.' && $f != '..'){
		echo "<tr>
          	      <td>".$f."</td>
	        ";
		foreach($tasks as $task){
			if(file_exists($d.'/task'.$task['id'].'.solved')){
        	                echo "<td class='table-success solved'>+</td>";
	                }else{
                	        echo "<td>-</td>";
	                }
		}
		echo "</tr>";
	}
}
echo "</table>";
