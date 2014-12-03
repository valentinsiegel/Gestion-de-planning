<?php
	include_once("./conf.php");

	// Si la varaible $_POST['LIBELLE'] n'existe alors j'affiche le formulaire 
	if(!isset($_POST['LIBELLE'])){
?>
<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
		<form method="post" action="" onsubmit="">
			<fieldset style="float:left;"><legend>Information sur la formation</legend>
				<label for="LIBELLE">Libellé de la formation :</label>		
					<input type="text" name="LIBELLE" id="LIBELLE" onBlur="checkText('LIBELLE','32')">
				<label for="INTERVENANT">Intervenant de la formation :</label>
					<input type="text" name="INTERVENANT" id="INTERVENANT" onBlur="checkText('INTERVENANT','32')">
				<label for="OBJECTIF">Objectif de la formation :</label>
					<textarea name="OBJECTIF" id="OBJECTIF" onBlur="checkText('OBJECTIF','500')"></textarea>
				<label for="NOMBRE_PLACE">Nombre de places dans la formation :</label>
					<input type="number" id="NOMBRE_PLACE" name="NOMBRE_PLACE" min="1" max="20" step="1" onblur="checkNumber('NOMBRE_PLACE', '20')">
				<label for="NO_SALLE">Salle:</label>
				<select name="NO_SALLE" id="NO_SALLE">
							<?php
								//Boucle permettant d'afficher les salles disponibles
								$srchass=$bdd->query("SELECT NO_SALLE,TYPE FROM salle ");
								while($listanswer=$srchass->fetch()){
									echo '<option value="'.$listanswer["NO_SALLE"].'">'.$listanswer["TYPE"].'</option>';
								}
								$srchass->closeCursor();
							?>
				</select>
			</fieldset>
			<fieldset style="float:left;"><legend>Prise en charge des repas</legend>
				<label for="REPAS">Le repas est-il pris en charge?</label>
					<input type="radio" name="REPAS" value="OUI" id="repas_y" checked onClick="show('repas_y','prix_repas')"/>Oui
					<input type="radio" name="REPAS" value="NON" id="repas_n" onClick="show('repas_y','prix_repas')"/>Non
			<div id="prix_repas">
				<label for="PRIX_REPAS">Prix du repas en cas de non prise en charge :</label>
					<input type="number" name="PRIX_REPAS" id="PRIX_REPAS" min="1" step="1" onblur="checkNumber('PRIX_REPAS', '50')">
			</div>
			</fieldset>
			<fieldset style="float:left;"><legend>Détails sur la formation</legend>
				<label for="CONTENU">Contenu de la formation :</label>
					<textarea name="CONTENU" id="CONTENU" onBlur="checkText('CONTENU','500')"></textarea>
				<label for="PREREQUIS">Prérequis de la formation :</label>
					<textarea name="PREREQUIS" id="PREREQUIS" onBlur="checkText('PREREQUIS','500')"></textarea>
			</fieldset>
			<fieldset style="float:left;"><legend>Date et heure</legend>
				<label for="DATE_DEB">Debut de la formation :</label>
					<input type="date" name="DATE_DEB" id="DATE_DEB" onblur="checkDate('DATE_DEB')">
				<label for "DATE_FIN">Fin de la formation :</label>
					<input type="date" name ="DATE_FIN" id="DATE_FIN" onblur="checkDate('DATE_FIN')">
				<label for="HEURE_DEB">Début de la journée de formation :</label>
					<select name="HEURE_DEB" id="HEURE_DEB">
					<?php
					//i=8 représente l'heure minimal de début soit 8 , Ensuite une boucle va afficher toute les heures jusqu'a que i=16 soit 16h00 
					$i=8;
					while ($i<=16){
					?>
					<option value="<?php echo $i;?>:00:00"><?php echo $i;?>:00</option>
					<?php
					$i++;
					}
					
					?>
					</select>
				<label for="HEURE_FIN">Fin de la journée formation :</label>
					<select name="HEURE_FIN" id="HEURE_FIN">
					<?php 
					$e=9;
					//il s'agit de la même méthode pour l'heure de fin
					while ($e<=17){
					?>
					<option value="<?php echo $e;?>:00:00"><?php echo $e;?>:00</option>
					<?php
					$e++;
					}
					?>
					</select>
			</fieldset>
			<input type="submit" id="submitter" value="valider" />
		</form>
		<?php 
		}
		//Traitement d'ajout d'une formation si  la variable $_POST['LIBELLE'] existe alors j'insere les données dans la bdd
		if(isset($_POST['LIBELLE'])){
			if($_POST['REPAS']=='OUI'){
			$prixrepas=$_POST['PRIX_REPAS'];
			}
			if($_POST['REPAS']=='NON'){
			$prixrepas=0;
			}
			$obj = new formation();
			$libelle=$_POST['LIBELLE'];	
			$prerequis=$_POST['PREREQUIS'];
			$objectif=$_POST['OBJECTIF'];
			$dated= new DateTime($_POST['DATE_DEB']);
			$datedeb=$dated->format('Y-m-d');
			$heuredeb=$_POST['HEURE_DEB'];
			$datef=new DateTime($_POST['DATE_FIN']);
			$datefin=$datef->format('Y-m-d');
			$heurefin=$_POST['HEURE_FIN'];
			$intervention=$_POST['INTERVENANT'];
			$contenu=$_POST['CONTENU'];
			$prixrepas=$_POST['PRIX_REPAS'];
			$nbreplaces=$_POST['NOMBRE_PLACE'];
			$nosalle=$_POST['NO_SALLE'];
			$notheme="2";
			$obj->addFormation($bdd, $notheme, $nosalle, $libelle, $datedeb, $heuredeb, $datefin, $heurefin, $intervention, $objectif, $prerequis, $contenu, $prixrepas, $nbreplaces);
			
		}
		?>