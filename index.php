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
			width: 100%;
			display: block;
			background-repeat: no-repeat;
			background-position: center;
			margin-top: -30px;
		}
		
		.task-description{
			display: none;
		}

	</style>
  <body style="padding-top: 80px;">
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container">
        <a href="./" class="navbar-brand">Searching Morpheus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav">
				<li class="nav-item">
					<div class="nav-link">Кто прошел</div>
				</li>
			</ul>
			<ul class="nav navbar-nav ml-auto">
				<li class="nav-item">
					<div class="nav-link">Осталось: 32:00:00 </div>
				</li>
			</ul>

        </div>
      </div>
    </div>

	<?php 
		include_once("tasks.php");
	?>

	<div class="container text-center">
		<h1 class="lead">26 март 2018 - 26 апреля 2018</h1>
		<div class="row">
			<div class="col-lg-12 col-md-7 col-sm-12">
				
				<p class="lead">Что бы узнать где искать Морфеуса необходимо решить все задачи:</p>
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<small>Решено: 0 из <?php echo count($tasks); ?> задач (25 %)</small>
          </div>
        </div>
        <hr>
		<p> Формат ответа: "flag:some"</p>
			
		<?php 
			
			foreach($tasks as $k => $v){
				echo '<div class="card border-dark mb-3 task-card" id="'.$v['id'].'">
					<div class="task-icon" style="background-image: url('.$v['image'].');" alt="Card image"></div>
					<div class="card-body">
						<h4 class="card-title">'.$v['title'].'</h4>
					</div>
					<div class="task-description">'.$v['description'].'</div>
					<!-- div class="card-body">
						<a href="#" class="card-link">Подробнее</a>
					</div -->
				</div>';
			}
		
		?>
		<script>
			$('.task-card').unbind().bind('click', function(){
				var title = $(this).find('.card-title').html();
				$('#modal_title').html(title);
				
				var description = $(this).find('.task-description').html();
				$('#modal_description').html(description);

				$('#task_show').modal();
			});
		</script>


	<div class="modal fade show" id="task_show">
		<div class="modal-dialog" role="document">
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
				<input type="text" placeholder="Ответ" class="form-control"><br>
				<button type="button" class="btn btn-primary">Отправить</button>
			</div>
			<!-- div class="modal-footer">
			  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div -->
		  </div>
		</div>
	  </div>
    
 </div>

<!-- based: https://bootswatch.com/slate/ -->
    

</body></html>




















































<script>
	console.log("flag:gentlen");
</script>


