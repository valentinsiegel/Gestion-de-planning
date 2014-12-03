<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
	<?php
	// CE IF teste l'existence de la variable $_POST['NO_ICOM'] si la variable n'existe pas alors le formulaire sera affiché
	if(!isset($_POST['NO_ICOM'])){
	?>
		<form method="post" action="" onsubmit="">
			<fieldset><legend>Information sur la formation</legend>
				<p>Numéro ICOM de la société :</p><input type="text" name="NO_ICOM"/>
				<p>Nom de la société :</p><input type="text" name="NOM"/>
				<p>Numéro de téléphone :</p><input type="text" name="TELEPHONE"/><br />
				<input type="submit" id="submitter" style="width:200px;margin-top:10px;"value="Ajouter une association" />
			</fieldset>
		</form>
		<?php 
		}
		//Ce IF teste la même variable , si la variable existe alors j'instancie ma class association, Et appel la méthode qui me permet d'ajouter une association (addAssociation)
		if(isset($_POST['NO_ICOM'])){
			$obj=new association();
			$noicom=$_POST['NO_ICOM'];
			$nom=$_POST['NOM'];
			$telephone=$_POST['TELEPHONE'];
			$obj->addAssociation($bdd, $noicom, $nom, $telephone);
		}
		?>