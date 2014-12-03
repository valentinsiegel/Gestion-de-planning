<?php

class membre
{

	function addMembre($bdd, $id, $nom, $prenom, $priorite)
	{
		if($priorite!=""){
			try{
			//ENVOI DES DONNEES A LA BDD
			$req = $bdd->prepare('INSERT INTO membre(ID_ASSOCIATION, NOM_M, PRENOM_M, PRIORITE) VALUES(:ID_ASSOCIATION, :NOM_M, :PRENOM_M, :PRIORITE)');
						$req->execute(array(
							'ID_ASSOCIATION'=>$id,
							'NOM_M'=>$nom,
							'PRENOM_M'=>$prenom,
							'PRIORITE'=>$priorite,
							));
						 
						echo "<div id='principal' class='container_12'>Le membre a bien été ajouté. cliquez <a href='./accueil.php'>ici</a> pour retourner a la page d'accueil.</div>";

			}catch(Exception $e){echo "<div id='principal' class='container_12'>Une erreur lié aux données saisie empéche l'ajout du membre.<a href='./accueil.php?content=creerFormation'>ici</a> pour retourner remplir le formulaire.</div>";}
		}else{echo "<div id='principal' class='container_12'>Le formulaire est vide. cliquez <a href='./accueil.php?content=creerFormation'>ici</a> pour retourner remplir le formulaire.</div>";}
		
		
		
	}
	
	//Fonction qui retourne les informations identifiant un membre dans un tableau qui se lira par la variable qui a appellé cette fonction (voir ./form/selectMembre.php)
	
	function getMembre($bdd, $NOM_M)
	{
		//ENVOI DES DONNEES A LA BDD
		$req=$bdd->query("SELECT * FROM membre WHERE NOM_M='".$NOM_M."'");
		$reqans=$req->fetch();
		return $reqans;
		$req->closeCursor();
	
	}
	//Fonction de suppression d'un membre
	function deleteMembre($bdd, $NO_MEMBRE)
	{
		try
		{
			//ENVOI DES DONNEES A LA BDD
			$req=$bdd->query('DELETE FROM membre WHERE NO_MEMBRE='.$NO_MEMBRE);
			$req->closeCursor();
			echo "<div id='principal' class='container_12'>Membre supprimé avec succés.<a href='./accueil.php'>ici</a> pour retourner a l'accueil</div>";
		}
		catch (Exception $e){die ('Erreur : '.$e->getmessage());}
	}
	
	//Fonction de mise a jour des données concernant un membre
	function updateMembre($bdd, $nom_m, $prenom_m, $priorite, $nomembre, $idassoc)
	{
		try{
		//ENVOI DES DONNEES A LA BDD
		echo $idassoc.' : '.$nomembre.' : '.$prenom_m.' : '.$nom_m.' : '.$priorite;
		$req = $bdd->prepare('UPDATE membre SET ID_ASSOCIATION= :ID_ASSOCIATION, NOM_M = :NOM_M, `PRENOM_M`= :PRENOM_M, `PRIORITE`= :PRIORITE WHERE NO_MEMBRE= :NO_MEMBRE');
		$req->execute(array(
		'ID_ASSOCIATION'=>$idassoc,	
		'NOM_M' => $nom_m,
		'PRENOM_M' => $prenom_m,
		'PRIORITE' => $priorite,
		'NO_MEMBRE' => $nomembre

		));
		echo "<div id='principal' class='container_12'>Association modifié avec succés.<a href='./accueil.php'>ici</a> pour retourner a l'accueil</div>";
		}catch (Exception $e){die ('Erreur : '.$e->getmessage());}
		
	}
}
?>