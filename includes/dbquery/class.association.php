<?php

class association
{
	function addAssociation($bdd, $noicom, $nom, $telephone)
	{
		if($telephone!=""){
			try{
			//ENVOI DE LA REQUETE A LA BDD
			$req = $bdd->prepare('INSERT INTO association(`NO_ICOM`, `NOM`, `TELEPHONE`) VALUES (:NO_ICOM, :NOM, :TELEPHONE)');
						$req->execute(array(
							'NO_ICOM'=>$noicom,
							'NOM'=>$nom,
							'TELEPHONE'=>$telephone
							));
			$req->closeCursor();
			//SI probleme SQL l'echo sert a afficher les données recu par la fonction
			//echo $noicom.'  :  '.$nom.'  :  '.$telephone.'  ::END';
			echo "<div id='principal' class='container_12'>Association ajouté avec succés.<a href='./accueil.php'>ici</a> pour retourner a l'accueil</div>";
			}catch(Exception $e){echo "<div id='principal' class='container_12'>Une erreur lié aux données saisie empéche l'ajout de l'association.<a href='./accueil.php?content=creerFormation'>ici</a> pour retourner remplir le formulaire.</div>";}
		}else{echo "<div id='principal' class='container_12'>Le formulaire est vide ou n'est pas complet. cliquez <a href='./ppec/accueil.php?content=creerFormation'>ici</a> pour retourner remplir le formulaire.</div>";}
	}
	
	//GET BY NO_ICOM
	function getAssociation($bdd,$noicom)
	{
			//ENVOI DE LA REQUETE A LA BDD
			$req=$bdd->query('SELECT * FROM association WHERE NO_ICOM='.$noicom);
			$reqans=$req->fetch();
			return $reqans;
			$req->closeCursor();
	}
		
	// Suppression d'une association selon son numero ICOM ( NO_ICOM ) 
	function deleteAssociation($bdd, $idassociation)
	{
		try
		{
			//ENVOI DE LA REQUETE A LA BDD
			$req=$bdd->query('DELETE FROM association WHERE ID_ASSOCIATION='.$idassociation);
			$req->closeCursor();
			echo "<div id='principal' class='container_12'>Association supprimé avec succés.<a href='./accueil.php'>ici</a> pour retourner a l'accueil</div>";
		}
		catch (Exception $e){die ('Erreur : '.$e->getmessage());}
	}
	// Fonction de mise a jour des associations
	function updateAssociation($bdd, $idassoc, $noicom, $nom, $telephone)
	{
		try{
		//ENVOI DE LA REQUETE A LA BDD
		$req = $bdd->prepare('UPDATE association SET NO_ICOM = :NO_ICOM, NOM = :NOM, TELEPHONE = :TELEPHONE WHERE ID_ASSOCIATION = :ID_ASSOCIATION');
		$req->execute(array(
		'NO_ICOM' => $noicom,
		'NOM' => $nom,
		'TELEPHONE' => $telephone,
		'ID_ASSOCIATION'=>$idassoc,
		));
		echo "<div id='principal' class='container_12'>Association modifié avec succés.<a href='./accueil.php'>ici</a> pour retourner a l'accueil</div>";
		}catch (Exception $e){die ('Erreur : '.$e->getmessage());}
		
	}
}
?>