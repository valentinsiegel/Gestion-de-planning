<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
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
		<header><h1>Gestionnaire de planning</h1></header>
		<?php if(!isset($_GET['content'])){    ?>
		<nav class="menu">
				<li onmouseover="showmenu('formation')" onmouseout="hidemenu('formation')">Formations
						<nav class="sousmenu" id="formation" style="display:none">							
								<li><a href="./accueil.php?content=creerFormation" style="text-decoration: none"><p id="mere">Ajouter une formation</p></a></li>
								<li><a href="./accueil.php?content=formmod" style="text-decoration: none"><p id="mere">Modifier une formation</p></a></li>				
						</nav>			
				</li>
				<li onmouseover="showmenu('membre')" onmouseout="hidemenu('membre')">Membre
						<nav class="sousmenu" id="membre" style="display:none">
								<li><a href="./accueil.php?content=creerMembre" style="text-decoration: none"><p id="mere">Ajouter un membre</p></a></li>
								<li><a href="./accueil.php?content=membremod" style="text-decoration: none"><p id="mere">Modifier un membre</p></a></li>				
						</nav>
				</li>
				<li onmouseover="showmenu('Association')" onmouseout="hidemenu('Association')">Association
						<nav class="sousmenu" id="Association" style="display:none">
								<li><a href="./accueil.php?content=assocadd" style="text-decoration: none"><p id="mere">Ajouter une Association</p></a></li>
								<li><a href="./accueil.php?content=assocmod" style="text-decoration: none"><p id="mere">Modifier une Association</p></a></li>										
						</nav>
				</li>
				<li onmouseover="showmenu('Planning')" onmouseout="hidemenu('Planning')">Planning
						<nav class="sousmenu" id="Planning" style="display:none">
								<li><a href="./accueil.php?content=planning" style="text-decoration: none"><p id="mere">Consulter le planning d'une formation</p></a></li>					
						</nav>
				</li>

		</nav>
		<?php } ?>
		<div class="content">
			<?php if(isset($_GET['content'])){
				$content=$_GET['content'];
				switch($content){
					//Appel de la page creation formation
					case 'creerFormation':
						include('./form/creerFormation.php');
					break;
					//Appel de la page creation membre
					case 'creerMembre' :
						include('./form/creerMembre.php');
					break;
					//Appel du planning
					case 'planning':
						include('./form/planning.php');
					break;
					//Appel de la page de la page de creation d'une association
					case 'assocadd':
						include('./form/creerAssociation.php');
					break;
					//Appel de la page de Modification/Suppression d'une association
					case 'assocmod':
						include('./form/selectAssociation.php');
					break;
					//Appel de la page de Modification/Suppression d'une Formation
					case'formmod':
						include('./form/selectFormation.php');
					break;
					//Appel de la page de Modification/Suppression d'un membre
					case'membremod':
						include('./form/selectMembre.php');
					break;				
				}
			}else{
			echo "<h3><br/>Bienvenue dans l'interface d'administration.<br /> Vous pourrez ici controler toute les données concernant la maison des ligues et notamment consulter le planning des formations </h3>";
			
			}
			
			?>
		</div>
	</div>
	</body>
</html>