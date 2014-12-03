<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
<?php 
if(isset($_POST['NOM_M'])or isset($_POST['del_membre']) or isset($_POST['NOM_M_U']) ){

	if(isset($_POST['del_membre'])){
	$obj= new membre();
	$obj->deleteMembre($bdd, $_POST['del_membre']);
	}
	if(isset($_POST['NOM_M_U'])){
	$obj= new membre();
	$obj->updateMembre($bdd, $_POST['NOM_M_U'], $_POST['PRENOM_M_U'], $_POST['PRIORITE_U'], $_POST['NO_MEMBRE_U'], $_POST['ID_ASSOCIATION_U']);
	}
	if(isset($_POST['NOM_M'])){
	$obj=new membre();
	$membre=$obj->getMembre($bdd, $_POST['NOM_M']);
	$NO_MEMBRE=$membre['NO_MEMBRE'];
	$ID_ASSOCIATION=$membre['ID_ASSOCIATION'];
	$NOM_M=$membre['NOM_M'];
	$PRENOM_M=$membre['PRENOM_M'];
	$PRIORITE=$membre['PRIORITE'];
?>
	<form method="post" action="" onsubmit="">
		<fieldset><legend>Information sur la formation</legend>
			<p>Prenom du membre :</p><input type="text" value="<?php echo $PRENOM_M;?>" name="PRENOM_M_U"/>
			<p>Nom du membre :</p><input type="text" value="<?php echo $NOM_M;?>" name="NOM_M_U"/>
			<p>Priorité :</p><input type="number" value="<?php echo $PRIORITE; ?>" name="PRIORITE_U"/><br />
			<input type="hidden" value="<?php echo $ID_ASSOCIATION; ?>" name="ID_ASSOCIATION_U"/>
			<input type="hidden" value="<?php echo $NO_MEMBRE; ?>" name="NO_MEMBRE_U"/>
			<p style="margin-left:50px;"><input type="submit" id="submitter" style="width:200px;margin-top:10px;background_color:blue;"value="Mettre à jour le membre" /></p>
		</fieldset>
	</form>	
	<form method="post" action="" onsubmit="">
		<input type="hidden" value="<?php echo $NO_MEMBRE; ?>" name="del_membre"/>
		<input type="submit" id="submitter" value="Supprimer ce membre" style="width:200px;margin-top:10px;background-color:red;" />
	</form>
	<?php
	}
}else{
?>

	<form method="post" action="" onsubmit="">
		<fieldset><legend>Saisir le nom du membre a consulter :</legend>
			<input type="text" name="NOM_M"  />
			<input type="submit" id="submitter" style="width:200px;margin-top:10px;"value="Modifier cette association" />
		</fieldset>
	</form>
	
<?php } ?>