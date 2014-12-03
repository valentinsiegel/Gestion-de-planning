<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="./css/960.css" />
		<script  src="js/lib/jquery.min.js"></script>
		<script src="js/form.js"></script>
		<title>Gestionnaire de planning</title>
		<?php
		include('./conf.php');
		?>
	</head>
	<body><div id="wrapper" class="container_12">
		<header><h1>Consulter mes planning</h1></header>
		<nav class="menu">
				<li onmouseover="showmenu('Planning')" onmouseout="hidemenu('Planning')">Planning
						<nav class="sousmenu" id="Planning" style="display:none">
								<li><a href="./accueil_assoc.php?content=planning&id_association=<?php echo $_GET['nomembre']; ?>" style="text-decoration: none">Consulter le planning d'une formation :</a></li>					
						</nav>
				</li>
		</nav>
		<div class="content">
			<?php if(isset($_GET['content'])){
				$content=$_GET['content'];
				switch($content){
				
				case 'planning':
				include('./form/planning_user.php');
				break;
				
				case'':
				echo "wouelcome";
				break;
				
				}
			}
			
			?>
		</div>
	</div>
	</body>
</html>