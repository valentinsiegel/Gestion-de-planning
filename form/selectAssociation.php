<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
<?php
if(isset($_POST['NO_ICOM']) or isset($_POST['del_assoc']) or isset($_POST['NO_ICOM_U']) ){
	if(isset($_POST['del_assoc'])){
	$obj= new association();
	$obj->deleteAssociation($bdd, $_POST['del_assoc']);
	}
	if(isset($_POST['NO_ICOM_U'])){
	$obj= new association();
	$ID_ASSOCIATION=$_POST['ID_ASSOCIATION_U'];
	$NO_ICOM=$_POST['NO_ICOM_U'];
	$NOM=$_POST['NOM_U'];
	$TELEPHONE=$_POST['TELEPHONE_U'];
	$obj->updateAssociation($bdd, $ID_ASSOCIATION, $NO_ICOM, $NOM, $TELEPHONE);
	}
	$obj=new association();
	$association=$obj->getAssociation($bdd, $_POST['NO_ICOM']);
	$ID_ASSOCIATION=$association['ID_ASSOCIATION'];
	$NO_ICOM=$association['NO_ICOM'];
	$NOM=$association['NOM'];
	$TELEPHONE=$association['TELEPHONE'];
?>
<form method="post" action="" onsubmit="">
	<fieldset><legend>Information sur la formation</legend>
		<p>Numéro ICOM de la société :</p><input type="text" value="<?php echo $NO_ICOM; ?>" name="NO_ICOM_U"/>
		<p>Nom de la société :</p><input type="text" value="<?php echo $NOM;?>" name="NOM_U"/>
		<p>Numéro de téléphone :</p><input type="text" value="<?php echo $TELEPHONE; ?>" name="TELEPHONE_U"/><br />
		<input type="hidden" value="<?php echo $ID_ASSOCIATION; ?>" name="ID_ASSOCIATION_U"/>
		<p style="margin-left:55px;"><input type="submit" id="submitter" style="width:200px;margin-top:10px;"value="Mettre à jour l'association" /></p>
	</fieldset>
</form>	
<form method="post" action="" onsubmit="">
	<input type="hidden" value="<?php echo $ID_ASSOCIATION; ?>" name="del_assoc"/>
	<input type="submit" id="submitter" value="Supprimer cette association" style="width:200px;margin-top:10px;background-color:red;" />
</form>
<?php }else{ ?>

	<form method="post" action="" onsubmit="">
		<fieldset><legend>Entrer le numéro ICOM de l'association a modifier :</legend>
			<input type="text" name="NO_ICOM" />
			<input type="submit" id="submitter" style="width:200px;margin-top:10px;"value="Modifier cette association" />
		</fieldset>
	</form>
	
<?php 
	}
?>