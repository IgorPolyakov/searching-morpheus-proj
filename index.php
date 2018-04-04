<?php
	include_once("tasks.php");
	foreach($tasks as $k => $v){
		$tasks[$k]['solved'] = false;
	}
	$solved = 0;
	if(isset($_COOKIE['u'])){
		$username = $_COOKIE['u'];
		if(preg_match("/[0-9a-zA-Z]/i", $username)) {
			foreach($tasks as $k => $v){
				if(file_exists('sess/'.$username.'/task'.$v['id'].'.solved')){
					$tasks[$k]['solved'] = true;
					$solved++;
				}
			}
		}
	}
	$countTasks = count($tasks);
	$percent = floor(($solved*100) / $countTasks);
	$dateOfEnd = '2018-04-26 12:00:00';

	$endTime = strtotime($dateOfEnd);
?>
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

		.card:hover{
			transform: scale(1.1);
		}

		.card.solved{
			-webkit-filter: blur(5px);
			-moz-filter: blur(5px);
			-o-filter: blur(5px);
			-ms-filter: blur(5px);
			filter: blur(5px);
		}

		.task-icon{
			height: 100px;
			width: 100px;
			border-radius: 100px;
			display: block;
			background-repeat: no-repeat;
			background-position: center;
			margin-top: -30px;
			box-shadow: 0px 0px 10px 3px #1c1e22;
			transform: skewX(0deg);
			 -webkit-transition: all 0.4s;
			transition: all 0.4s;
		}

		.card:hover .task-icon{
			transform: translate(10px) skewX(-15deg);
		}

		.task-description{
			display: none;
		}

	</style>

  <!-- body style="padding-top: 20px; background-image: url(http://mtdata.ru/u24/photo0F6F/20656638759-0/original.gif);" -->
	<body style="padding-top: 20px; background-size: 100% 100%; background-image: url(images/source.gif);">

	<div class="container text-center">
		<?php
			if($endTime - time() < 0){
				echo "<table style='width: 100%; height: 100%; text-align: center;'><tr><td>";
				echo "<h1>Не успели? Ждите, и ищите следующие крошки.</h1>";
				echo "</td></tr></table>";
				exit;
			}

			if($solved == $countTasks){
				echo "<table style='width: 100%; height: 100%; text-align: center;'><tr><td>";
				echo "<h1> Приходи!<br><br>Суббота, 17:00, Красноармейская 146, офис 805 (дверь без номера).<br><br>Не забудь пароль: `Следовал за белым кроликом`</h1>";
				echo "</td></tr></table>";
				exit;
			}

		?>

		<h2 class="lead  alert alert-primary" id="countdown">Осталось: ... </h2>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p class="lead">Разрешите вашему браузеру Cookie для этого сайта.</p>
				<p class="lead">Чтобы узнать, где искать Морфеуса, необходимо решить все задачи:</p>
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: <?php echo $percent; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<?php
					echo "<small>Решено: $solved из $countTasks задач ($percent%)</small>";
				?>
          </div>
        </div>
        <hr>


		<?php

			if($solved == $countTasks){
				echo "<h1> Приходи! Суббота, 17:00, Красноармейская 146, офис 805 (дверь без номера).<br>Не забудь пароль: `Следовал за белым кроликом`</h1>";
			}else{
				echo "<p> Формат ответа: 'flag:some'</p>";
				foreach($tasks as $k => $v){
					if(!$v['solved']){
						echo '<div class="card border-dark mb-3 task-card" taskid="'.$v['id'].'">
							<div class="task-icon" style="background-image: url('.$v['image'].');" alt="Card image"></div>
							<div class="card-body">
								<h4 class="card-title">'.$v['title'].'</h4>
							</div>
							<div class="task-description">'.$v['description'].'</div>
						</div>';
					}
				}
			}
		?>
		<script>
			$('.task-card').unbind().bind('click', function(){
				var title = $(this).find('.card-title').html();
				window.taskid = $(this).attr('taskid');

				$('#modal_title').html(title);

				$('#user_flag').val('');

				var description = $(this).find('.task-description').html();
				$('#modal_description').html(description);
				$('#error_send_flag').hide();

				$('#send_flag').unbind().bind('click', function(){
					$('#error_send_flag').hide();
					$('#error_send_flag').html('');

					var url = 'send_flag.php?';
					url += 'flag=' + encodeURIComponent($('#user_flag').val());
					url += '&';
					url += 'taskid=' + encodeURIComponent(window.taskid);

					$.ajax({
						type: 'GET',
						url: url,
					}).done(function(r){
						console.log(r);
						window.location.reload();
					}).fail(function(err){
						console.error(err);
						if(err.responseJSON && err.responseJSON.error){
							$('#error_send_flag').show();
							$('#error_send_flag').html(err.responseJSON.error);
						}
					});
				});

				$('#task_show').modal();
			});

			var dateOfEnd = new Date('<?php echo $dateOfEnd; ?>');
			var timeOfEnd = <?php echo $endTime; ?>;
			// dateOfEnd = Math.floor(dateOfEnd.getTime()/1000);
			dateOfEnd = timeOfEnd;
			function updateCountdown(){
				var currDate = new Date();
				currDate = Math.floor(currDate.getTime()/1000);
				var left = dateOfEnd - currDate;
				var seconds = left % 60;
				left = (left - seconds)/60;
				var minutes = left % 60;
				var hours = (left - minutes)/60;
				var text = "Осталось: ";
				text += hours + " час";
				text += ((hours % 10 == 2 || hours % 10 == 3 || hours % 10 == 4) && (hours < 10 || hours > 20) ? "a" : "");
				text += ((hours % 10 == 0 || hours % 10 > 4) || (hours >= 10 && hours < 21) ? "ов" : "");

				text += " " + minutes + " минут";
				text += (minutes % 10 == 1 ? "a" : "");
				text += (minutes % 10 == 2 || minutes % 10 == 3 || minutes % 10 == 4 ? "ы" : "");

				text += " " + seconds + " секунд";
				text += (seconds % 10 == 1 ? "a" : "");
				text += (seconds % 10 == 2 || seconds % 10 == 3 || seconds % 10 == 4 ? "ы" : "");

				$('#countdown').html(text);
			}
			updateCountdown();

			setInterval(updateCountdown,1000);


		</script>


	<div class="modal fade show" id="task_show">
		<div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="modal_title" >Modal title</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			  </button>
			</div>
			<div class="modal-body" >
				<div id="modal_description"></div>
				<hr>
				<h3>Нашел ответ? </h3>
				<input type="text" id="user_flag" placeholder="flag:some" class="form-control"><br>
				<button type="button" id="send_flag" class="btn btn-primary">Отправить</button>
				<br><br>
				<div id="error_send_flag" class="alert alert-danger" style="display: none;"></div>
			</div>
		  </div>
		</div>
	  </div>

 </div>

<!-- based: https://bootswatch.com/slate/ -->
</body></html>




















































<script>
	console.log("flag:gentlen");
</script>
