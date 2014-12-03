<p><a id="returnAccueil" href="./accueil.php">Retourner a l'accueil</a></p>
<div style="width:1024px;height:100px;">
<?php 
$annee=date('Y');
$mois=date('m');
$jour=date('j');



?>
<form method="post" action="">


	<label for="PRENOM_M">Selectionner une formation dans la liste afin d'afficher son planning :</label>
		<select name="searchNOM" id="searchNOM" value="">
				<?php 
					$srchass=$bdd->query("SELECT ID_FORMATION,LIBELLE FROM formation WHERE DATE_DEB > '.$obj->debutsem($annee,$mois,$jour);.' ");
					while($listanswer=$srchass->fetch()){
						echo '<option value="'.$listanswer["NO_SALLE"].'">'.$listanswer["LIBELLE"].'</option>';
					}
					$srchass->closeCursor();
				?>
		</select>
		<label for="NOM_M">Selectionner une date de reference pour afficher le planning de la semaine concerné :</label>
		 <input type="DATE" name="DATE" id="DATE" />
		 
		<input style="width:200px;height:30px;float:right;margin-right:25%;" id="submitter" type="submit" name="valider" value="Actualiser le planning"/>
</form>
</div>