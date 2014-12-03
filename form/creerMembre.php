<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
	<?php
	if(!isset($_POST['NOM_M'])){
	?>
	<form method="post" action="" ><!-- onsubmit="return checkMembre()"-->
			<fieldset><legend>Information du membre</legend>
				<label for="searchNOM">Selectionner une association:</label>
				<select name="searchNOM" id="searchNOM" value="">
					<?php 
					$srchass=$bdd->query("SELECT NOM,ID_ASSOCIATION FROM association ");
					while($listanswer=$srchass->fetch()){
						echo '<option value="'.$listanswer["ID_ASSOCIATION"].'">'.$listanswer["NOM"].'</option>';
					}
					$srchass->closeCursor();
					?>
				</select>	
				<label for="NOM_M">Nom du membre :</label>
					<input type="text" name="NOM_M" id="NOM_M" onblur="checkText('NOM_M','32')">
				<label for="PRENOM_M">Prénom du membre :</label>
					<input type="text" name="PRENOM_M" id="PRENOM_M" onblur="checkText('PRENOM_M','32')">
				<label for="PRIORITE">Priorité du membre :</label>
					<input type="number" min="1" max="3" step="1" name="PRIORITE" id="PRIORITE" onblur="checkNumber('PRIORITE', '3')">
			</fieldset>
			<input id="submitter" type="submit" name="valider" value="Enregistrer ce membre"></input>
		</form>
	<?php	
	}
	if(isset($_POST['NOM_M'])){
		$obj = new membre();
		$assoc=$_POST['searchNOM'];	
		$nom_m=$_POST['NOM_M'];
		$prenom_m=$_POST['PRENOM_M'];
		$priorite=$_POST['PRIORITE'];
		
		$obj->addMembre($bdd, $assoc, $nom_m, $prenom_m, $priorite);
		 
		//ECHO '<script language="JavaScript">window.location.href="./index.php?uploadbdd=ok"</script>';

	}
		
	?>