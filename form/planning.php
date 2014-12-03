<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
<?php
//Initialisation d'une date : Si aucune date selectionné je selectionne la date du jour sinon je récupére la date et je la convertir au format nécessaire pour la lecture par la BDD 
			include('./includes/class/class.date.php');
			if(isset($_POST['DATE'])){
				$d1= new DateTime($_POST['DATE']);
				$annee=$d1->format("Y");
				$mois=$d1->format("m");
				$jour=$d1->format("d");
				$date_info=true;
			}else{
				$date_info=false;
			}
			if(!isset($annee)){
				$annee=date('Y');
				$mois=date('m');
				$jour=date('d');
			}
			$NO_SALLE="";
			$SALLE="";
			$LIBELLE="";
			$INTERVENTION="";
			$DATE_DEB="";
			$HEURE_DEB="";
			$DATE_FIN="";
			$HEURE_FIN="";
		?>
		<div style="width:1024px;height:100px;">
		<!-- Formulaire de selection de formation et déplacement a travers les dates -->
		<form method="post" action="">


			<label for="ID_FORMATION">Selectionner une formation dans la liste afin d'afficher son planning : <?php?></label>
				<select name="ID_FORMATION" id="ID_FORMATION" value="">
						<?php 
							$srchass=$bdd->query("SELECT ID_FORMATION,LIBELLE FROM formation WHERE DATE_DEB > '.$obj->debutsem($annee,$mois,$jour);.' ");
							while($listanswer=$srchass->fetch()){
								echo '<option value="'.$listanswer["ID_FORMATION"].'">'.$listanswer["LIBELLE"].'</option>';
							}
							$srchass->closeCursor();
						?>
				</select><br/>
				<input type="DATE" name="DATE" id="DATE" />
				<input style="width:200px;height:30px;float:right;margin-right:25%;" id="submitter" type="submit" name="valider" value="Actualiser le planning"/>
		</form>
		</div>
		<link rel="stylesheet" type="text/css" href="./css/planning.css" media="all" />
		<div id="case-prin">
			<?php
			//JE RECUPERE TOUTE LES INFORMATIONS CONCERNANT UNE FORMATION NECESSAIRE
			$obj= new datee;
			if(isset($_POST['ID_FORMATION'])){
			//REQUETE + RECUPERATION DES RESULTATS
			$id=$_POST['ID_FORMATION'];
			$reqform=$bdd->query('SELECT * FROM formation WHERE ID_FORMATION='.$id);
			$reqans=$reqform->fetch();
			$NO_SALLE=$reqans['NO_SALLE'];
			$LIBELLE=$reqans['LIBELLE'];
			$INTERVENTION=$reqans['INTERVENTION'];
			$DATE_DEB=$reqans['DATE_DEB'];
			$HEURE_DEB=$reqans['HEURE_DEB'];
			$DATE_FIN=$reqans['DATE_FIN'];
			$HEURE_FIN=$reqans['HEURE_FIN'];
			$reqform->closeCursor();
			$reqsalle=$bdd->query('SELECT * FROM salle WHERE NO_SALLE='.$NO_SALLE.'');
			$reqans2=$reqsalle->fetch();
			$SALLE=$reqans2['TYPE'];
			$d=new DateTime($DATE_DEB);
			$DATE_DEB=$d->format('d-m-Y');
			$d=new DateTime($DATE_FIN);
			$DATE_FIN=$d->format('d-m-Y');
			}
			if($DATE_DEB!=""){
			?>
			<p style="text-align:center;font-wieght:bold;color:red;">Ce Planning est valable pour la formation <?php echo $LIBELLE; ?> se deroulant du <?php echo $DATE_DEB; ?> au <?php echo $DATE_FIN; ?></p>
			
			<?php } ?><div id="case-verticale">
				<p style="height:40px;border-bottom:1px solid black;width:168px;text-align:center;border-left:1px solid #"></p>
					<div id="case-horaire" class='heure'>08h00-09h00</div>
					<div id="case-horaire" class='heure'>09h00-10h00</div>
					<div id="case-horaire" class='heure'>10h00-11h00</div>
					<div id="case-horaire" class='heure'>11h00-12h00</div>
					<div id="case-horaire" class='pausemidi'></div>
					<div id="case-horaire" class='heure'>13h00-14h00</div>
					<div id="case-horaire" class='heure'>14h00-15h00</div>
					<div id="case-horaire" class='heure'>15h00-16h00</div>
					<div id="case-horaire" class='heure'>16h00-17h00</div>
			</div>
			<div id="case-verticale">
				<p style="height:40px;border-bottom:1px solid black;width:168px;text-align:center;">Lundi
				<?php
					//REQUETE POUR VERIFIER SI LE LUNDI EST CONCERNE PAR LA FORMATION
					$endlun=false;
					$hdebl="0";
					$statelun=false;
					$datelun = $obj->datedeb($annee, $mois, $jour);
					echo $obj->debutsem($annee, $mois,$jour);
					$libellelun="";
					$ask=new formation();
					$beglun=$ask->CompareDate($datelun,$DATE_DEB,$DATE_FIN);
				
				?>
				</p>
				<div id="case-horaire" ><?php 
				//Test sur l'heure de début pour verifier affichage
				if($HEURE_DEB=="08:00:00" AND $beglun==true){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebl="1"; //Cette variable permet d'annoncer que l'heure de début a deja etait trouvé
					}
					
					?></div>
					<div id="case-horaire"><?php if($beglun==true){
					if($HEURE_DEB=="09:00:00" OR $hdebl=="1") {
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebl="1";
					}}?></div>
					<div id="case-horaire" ><?php if($beglun==true){
					if($HEURE_DEB=="10:00:00" OR $hdebl=="1") {
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebl="1";
					}} ?></div>
					<div id="case-horaire" ><?php if($beglun==true){
					if($HEURE_DEB=="11:00:00" OR $hdebl=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebl="1";
					}}?></div>
					
					<div id="case-horaire" class='pausemidi'></div>
					
					<div id="case-horaire" >
<?php 
					if($HEURE_FIN=="12:00:00"){
						$endlun=true;
					}
					if($beglun==true){
						if($endlun==false){
							if($HEURE_FIN=="14:00:00"){
								$endlun=true; // Cette variable permet d'informer le planning que l'heure de fin a etait trouvé.
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?>					</div>
					<div id="case-horaire" ><?php
					if($beglun==true){
						if($endlun==false){
							if($HEURE_FIN=="15:00:00"){
							$endlun=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
					<div id="case-horaire" ><?php 
					if($beglun==true){
						if($endlun==false){
							if($HEURE_FIN=="16:00:00"){
							$endlun=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
					<div id="case-horaire" ><?php
					if($beglun==true){
						if($endlun==false){
							if($HEURE_FIN=="15:00:00"){
								$endlun=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
			</div>
			<div id="case-verticale">
				<p style="height:40px;border-bottom:1px solid black;width:168px;text-align:center;">Mardi
				<?php
					$endmar=false;
					$hdebm="0";
					$d = $obj->datedeb($annee, $mois, $jour);
					$dm = new DateTime($d);
					$dm->modify("+1 day"); // Permet d'ajouter un jour a la date donnée, sachant que la variable envoyé est la date du lundi le plus proche de la formation désiré , donc LUNDI + 1 jour MARDI ..
					echo $dm->format("d-m-Y"); // jour-mois-ANNEE
					$datemar=$dm->format("Y-m-d");
					$libellemar="";
					$askday=new formation();
					$begmar=$ask->CompareDate($datemar,$DATE_DEB,$DATE_FIN);
				
				?>
				</p>
				<div id="case-horaire" ><?php if($begmar==true){
				if($HEURE_DEB=="08:00:00" ){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebm="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begmar==true){
					if($HEURE_DEB=="09:00:00" OR $hdebm=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebm="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begmar==true){
					if($HEURE_DEB=="10:00:00" OR $hdebm=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebm="1";
					}} ?></div>
					<div id="case-horaire" ><?php if($begmar==true){
					if($HEURE_DEB=="11:00:00" OR $hdebm=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebm="1";
					}} ?></div>
					
					<div id="case-horaire" class='pausemidi'></div>
					
					<div id="case-horaire" >
<?php 
					
					if($HEURE_FIN=="12:00:00"){
						$endmar=true;
					}
					if($begmar==true){
					if($endmar==false){
						if($HEURE_FIN=="14:00:00"){
							$endmar=true;
						}
						echo "".$LIBELLE."<br/>";
						echo "".$INTERVENTION."<br/>";
						echo "".$SALLE."";
					}}
?>					</div>
					<div id="case-horaire" ><?php
					if($begmar==true){
						if($endmar==false){
							if($HEURE_FIN=="15:00:00"){
							$endmar=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						} 
					}
?></div>
					<div id="case-horaire" ><?php 
					if($begmar==true){
						if($endmar==false){
							if($HEURE_FIN=="16:00:00"){
							$endmar=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
					<div id="case-horaire" ><?php 
					if($begmar==true){
						if($endmar==false){
							if($HEURE_FIN=="15:00:00"){
								$endmar=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
			</div>
			<div id="case-verticale">
				<p style="height:40px;border-bottom:1px solid black;width:168px;text-align:center;">Mercredi
				<?php
					$endmer=false;
					$hdebme="0";
					
					$dm = new DateTime($d);
					$dm->modify("+2 day");
					echo $dm->format("d-m-Y");
					$datemer=$dm->format("Y-m-d");
					$libellemer="";
					$askday=new formation();
					$begmer=$ask->CompareDate($datemer,$DATE_DEB,$DATE_FIN);
				
				?>
				</p>
				<div id="case-horaire" ><?php if($begmer==true){
				if($HEURE_DEB=="08:00:00"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebme="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begmer==true){
					if($HEURE_DEB=="09:00:00" OR $hdebme=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebme="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begmer==true){
					if($HEURE_DEB=="10:00:00" OR $hdebme=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebme="1";
					}} ?></div>
					<div id="case-horaire" ><?php if($begmer==true){
					if($HEURE_DEB=="11:00:00" OR $hdebme=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebme="1";
					}} ?></div>
					
					<div id="case-horaire" class='pausemidi'></div>
					
					<div id="case-horaire" >
<?php 
					if($HEURE_FIN=="12:00:00"){
						$endmer=true;
					}
					
					if($begmer==true){
						if($endmer==false){
							if($HEURE_FIN=="14:00:00"){
								$endmer=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?>					</div>
					<div id="case-horaire" ><?php
					if($begmer==true){
						if($endmer==false){
							if($HEURE_FIN=="15:00:00"){
							$endmer=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
					<div id="case-horaire" ><?php 
					if($begmer==true){
						if($endmer==false){
							if($HEURE_FIN=="16:00:00"){
							$endmer=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
					<div id="case-horaire" ><?php
					if($begmer==true){
						if($endmer==false){
							if($HEURE_FIN=="15:00:00"){
								$endmer=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
							}
					}
?></div>
			</div>
			<div id="case-verticale">
				<p style="height:40px;border-bottom:1px solid black;width:168px;text-align:center;">Jeudi
				<?php
					$endjeu=false;
					$hdebj="0";
					$dj= new DateTime($d);
					$dj->modify("+3 day");
					echo $dj->format("d-m-Y");	
					$datejeu=$dj->format("Y-m-d");
					$libellejeu="";
					$askday=new formation();
					$begjeu=$ask->CompareDate($datejeu,$DATE_DEB,$DATE_FIN);
				?>
				</p>
				<div id="case-horaire" ><?php if($begjeu==true){
				if($HEURE_DEB=="08:00:00"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebj="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begjeu==true){
					if($HEURE_DEB=="09:00:00" OR $hdebj=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebj="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begjeu==true){
					if($HEURE_DEB=="10:00:00" OR $hdebj=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebj="1";
					} }?></div>
					<div id="case-horaire" ><?php if($begjeu==true){
					if($HEURE_DEB=="11:00:00" OR $hdebj=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebj="1";
					}} ?></div>
					
					<div id="case-horaire" class='pausemidi'></div>
					
					<div id="case-horaire" >
<?php 
					if($HEURE_FIN=="12:00:00"){
						$endjeu=true;
					}
	
					if($begjeu==true){
						if($endjeu==false){
							if($HEURE_FIN=="14:00:00"){
								$endjeu=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?>					</div>
					<div id="case-horaire" ><?php
					if($begjeu==true){
						if($endjeu==false){
							if($HEURE_FIN=="15:00:00"){
							$endjeu=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						} 
					}
?></div>
					<div id="case-horaire" ><?php
					if($begjeu==true){					
						if($endjeu==false){
							if($HEURE_FIN=="16:00:00"){
							$endjeu=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
					<div id="case-horaire" ><?php 
					if($begjeu==true){
						if($endjeu==false){
							if($HEURE_FIN=="15:00:00"){
								$endjeu=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
			</div>
			<div id="case-verticale">
				<p style="height:40px;border-bottom:1px solid black;width:168px;text-align:center;">Vendredi
				<?php
					$hdebv="0";
					$endven=false;
					$dve = new DateTime($d);
					$dve->modify("+4 day");
					echo $dve->format("d-m-Y");
					$dateven=$dve->format("Y-m-d");
					$libelleven="";
					$askday=new formation();
					$begven=$ask->CompareDate($dateven,$DATE_DEB,$DATE_FIN);
				?>
				</p>
				<div id="case-horaire" ><?php if($begven==true){
				if($HEURE_DEB=="08:00:00"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebv="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begven==true){
					if($HEURE_DEB=="09:00:00" OR $hdebv=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebv="1";
					}}?></div>
					<div id="case-horaire" ><?php if($begven==true){
					if($HEURE_DEB=="10:00:00" OR $hdebv=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebv="1";
					}} ?></div>
					<div id="case-horaire" ><?php if($begven==true){
					if($HEURE_DEB=="11:00:00" OR $hdebv=="1"){
					echo "".$LIBELLE."<br/>";
					echo "".$INTERVENTION."<br/>";
					echo "".$SALLE."";
					$hdebv="1";
					}} ?></div>
					
					<div id="case-horaire" class='pausemidi'></div>
					
					<div id="case-horaire" >
<?php 
					if($HEURE_FIN=="12:00:00"){
						$endven=true;
					}
	
					if($begven==true){
						if($endven==false){
							if($HEURE_FIN=="14:00:00"){
								$endven=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?>					</div>
					<div id="case-horaire" ><?php
					if($begven==true){
						if($endven==false){
							if($HEURE_FIN=="15:00:00"){
							$endven=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						} 
					}
?></div>
					<div id="case-horaire" ><?php
					if($begven==true){
						if($endven==false){
							if($HEURE_FIN=="16:00:00"){
							$endven=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
					<div id="case-horaire" ><?php
					if($begven==true){
						if($endven==false){
							if($HEURE_FIN=="15:00:00"){
								$endven=true;
							}
							echo "".$LIBELLE."<br/>";
							echo "".$INTERVENTION."<br/>";
							echo "".$SALLE."";
						}
					}
?></div>
			</div>
		</div>
	