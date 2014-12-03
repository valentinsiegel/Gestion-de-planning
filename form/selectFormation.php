<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
<?php
	if(isset($_POST['del_form'])){
	$obj= new formation();
	$obj->deleteFormation($bdd, $_POST['del_form']);
	}
	if(isset($_POST['ID_FORMATION_U'])){
	$obj= new formation();
	$notheme="2";
	$idformation=$_POST['ID_FORMATION_U'];
	$nosalle=$_POST['NO_SALLE_U'];
	$libelle=$_POST['LIBELLE_U'];
	$datedeb=$_POST['DATE_DEB_U'];
	$heuredeb=$_POST['HEURE_DEB_U'];
	$datefin=$_POST['DATE_FIN_U'];
	$heurefin=$_POST['HEURE_FIN_U'];
	$intervention=$_POST['INTERVENTION_U'];
	$objectif=$_POST['OBJECTIF_U'];
	$prerequis=$_POST['PREREQUIS_U'];
	$contenu=$_POST['CONTENU_U'];
	$prix_repas=$_POST['PRIX_REPAS_U'];
	$nbreplaces=$_POST['NOMBRE_PLACE_U'];
	$obj->updateFormation($bdd, $notheme, $nosalle, $libelle, $datedeb, $heuredeb, $datefin, $heurefin, $intervention, $objectif, $prerequis, $contenu, $prix_repas, $nbreplaces, $idformation);
	}
	if(isset($_POST['ID_FORMATION'])){
	$obj=new formation();
	$formation=$obj->getFormation($bdd, $_POST['ID_FORMATION']);
	$ID_FORMATION=$formation['ID_FORMATION'];
	$NO_SALLE=$formation['NO_SALLE'];
	$LIBELLE=$formation['LIBELLE'];
	$DATE_DEB=$formation['DATE_DEB'];
	$HEURE_DEB=$formation['HEURE_DEB'];
	$DATE_FIN=$formation['DATE_FIN'];
	$HEURE_FIN=$formation['HEURE_FIN'];
	$INTERVENTION=$formation['INTERVENTION'];
	$OBJECTIF=$formation['OBJECTIF'];
	$PREREQUIS=$formation['PREREQUIS'];
	$CONTENU=$formation['CONTENU'];
	$PRIX_REPAS=$formation['PRIX_REPAS'];
	$NOMBRE_PLACE=$formation['NOMBRE_PLACE'];
?>
	<form method="post" action="" onsubmit="">
		<fieldset><legend>Information sur la formation</legend>
			<p>Selectionner une salle à remplacer :</p>
			<select name="NO_SALLE_U">
				<?php 
					$srchass=$bdd->query("SELECT NO_SALLE,TYPE FROM salle ");
					while($listanswer=$srchass->fetch()){
						echo '<option value="'.$listanswer["NO_SALLE"].'">'.$listanswer["TYPE"].'</option>';
					}
					$srchass->closeCursor();
				?>
			</select>
			<p>Libellé :</p><input type="text" value="<?php echo $LIBELLE;?>" name="LIBELLE_U"/>
			<p>Date de début :</p><input type="date" value="<?php echo $DATE_DEB;?>" name="DATE_DEB_U"/>
			<p>Date de fin :</p><input type="date" value="<?php echo $DATE_FIN;?>" name="DATE_FIN_U"/>
			<label for="HEURE_DEB_U">Selectionner une heure de début pour la modifier :</label>
			<select name="HEURE_DEB_U" id="HEURE_DEB_U">
			<?php
			$i=8;
			while ($i<=11){
			?>
			<option value="<?php echo $i;?>:00:00"><?php echo $i;?>:00</option>
			<?php
			$i++;
			}
			
			?>
			</select>
			<label for="HEURE_FIN_U">Sélectionner une heure de fin pour la modifier :</label>
			<select name="HEURE_FIN_U">
			<?php 
			$e=14;
			while ($e<=17){
			?>
			<option value="<?php echo $e;?>:00:00"><?php echo $e;?>:00</option>
			<?php
			$e++;
			}
			?>
			</select>
			<p>Intervenant :</p><input type="text" value="<?php echo $INTERVENTION;?>" name="INTERVENTION_U"/>
			<p>Objectif de la formation :</p><textarea name="OBJECTIF_U"><?php echo $OBJECTIF;?></textarea>
			<p>Prerequis de la formation :</p><input type="text" value="<?php echo $PREREQUIS;?>" name="PREREQUIS_U"/>
			<p>Contenu de la formation :</p><input type="text" value="<?php echo $CONTENU;?>" name="CONTENU_U"/>
			<p>Modifier tarif du prix repas (0 pour pas de prise en charge) :</p><input type="number" value="<?php echo $PRIX_REPAS; ?>" name="PRIX_REPAS_U"/><br />
			<p>Modifier le nombre de place :</p><input type="number" value="<?php echo $NOMBRE_PLACE; ?>" name="NOMBRE_PLACE_U"/><br />
			<input type="hidden" value="<?php echo $ID_FORMATION; ?>" name="ID_FORMATION_U"/>
			<p style="margin-left:40px;"><input type="submit" id="submitter" style="width:200px;margin-top:10px;margin-left:40px;"value="Mettre à jour le membre" /></p>
		</fieldset>
	</form>	
	<form method="post" action="" onsubmit="">
		<input type="hidden" value="<?php echo $ID_FORMATION; ?>" name="del_form"/>
		<input type="submit" id="submitter" value="Supprimer ce membre" style="width:200px;margin-top:10px;background-color:red;" />
	</form><?php
}else{
?>
	<form method="post" action="" onsubmit="">
		<fieldset><legend>Selection de la formation a modifier :</legend>
			<label for="ID_FORMATION">Selectionner la formation a modifier :</label>
			<select name="ID_FORMATION">
				<?php 
					$srchass=$bdd->query("SELECT ID_FORMATION,LIBELLE FROM formation ");
					while($listanswer=$srchass->fetch()){
						echo '<option value="'.$listanswer["ID_FORMATION"].'">'.$listanswer["LIBELLE"].'</option>';
					}
					$srchass->closeCursor();
				?>
			</select>
			<input type="submit" id="submitter" style="width:200px;margin-top:10px;"value="Modifier cette association" />
		</fieldset>
	</form>
	
<?php 
}


?>