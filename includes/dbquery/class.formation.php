<?php

class formation
{
	//Fonction d'ajout de formation
	function addFormation($bdd, $notheme, $nosalle, $libelle, $datedeb, $heuredeb, $datefin, $heurefin, $intervention, $objectif, $prerequis, $contenu, $prixrepas, $nbreplaces)
		{
		if($objectif!=""){
			try{
			//ENVOI DE LA REQUETE A LA BDD
			$req = $bdd->prepare('INSERT INTO formation(NO_THEME, NO_SALLE, LIBELLE, DATE_DEB, HEURE_DEB, DATE_FIN, HEURE_FIN, INTERVENTION, OBJECTIF, PREREQUIS, CONTENU, PRIX_REPAS, NOMBRE_PLACE) VALUES(:NO_THEME, :NO_SALLE, :LIBELLE, :DATE_DEB, :HEURE_DEB, :DATE_FIN, :HEURE_FIN, :INTERVENTION, :OBJECTIF, :PREREQUIS, :CONTENU, :PRIX_REPAS, :NOMBRE_PLACE)');
						$req->execute(array(
							'NO_THEME'=>$notheme,
							'NO_SALLE'=>$nosalle,
							'LIBELLE'=>$libelle,
							'DATE_DEB'=>$datedeb,
							'HEURE_DEB'=>$heuredeb,
							'DATE_FIN'=>$datefin,
							'HEURE_FIN'=>$heurefin,
							'INTERVENTION'=>$intervention,
							'OBJECTIF'=>$objectif,
							'PREREQUIS'=>$prerequis,
							'CONTENU'=>$contenu,
							'PRIX_REPAS'=>$prixrepas,
							'NOMBRE_PLACE'=>$nbreplaces
							));
						 
						echo "<div id='principal' class='container_12'>La formation a bien été ajouté. cliquez <a href='./accueil.php'>ici</a> pour retourner a la page d'accueil.</div>";

			}catch(Exception $e){echo "<div id='principal' class='container_12'>Une erreur lié aux données saisie empéche l'ajout du membre.<a href='http://localhost/ppec/accueil.php?content=creerFormation'>ici</a> pour retourner remplir le formulaire.</div>";}
		}else{echo "<div id='principal' class='container_12'>Le formulaire est vide. cliquez <a href='./accueil.php?content=creerFormation'>ici</a> pour retourner remplir le formulaire.</div>";}
		
		
		
	}
	
	//Suppression d'une formation par son ID . ( ID_FORMATION )
	
	function deleteFormation($bdd, $idformation)
	{
		try
		{
			//ENVOI DE LA REQUETE A LA BDD
			$req=$bdd->query('DELETE FROM formation WHERE ID_FORMATION='.$idformation);
			$req->closeCursor();
			echo "<div id='principal' class='container_12'>Formation supprimé avec succés.<a href='./accueil.php'>ici</a> pour retourner a l'accueil</div>";
		}
		catch (Exception $e){die ('Erreur : '.$e->getmessage());}
	}
	function getFormation($bdd, $id_association)
	{
	
		$req=$bdd->query('SELECT * FROM formation WHERE ID_FORMATION='.$id_association);
		$reqans=$req->fetch();
		return $reqans;

	}
	function updateFormation($bdd, $notheme, $nosalle, $libelle, $datedeb, $heuredeb, $datefin, $heurefin, $intervention, $objectif, $prerequis, $contenu, $prixrepas, $nbreplaces, $idformation)
	{
		try{
		//ENVOI DE LA REQUETE A LA BDD
		$req = $bdd->prepare('UPDATE formation SET NO_THEME = :NO_THEME, NO_SALLE = :NO_SALLE, LIBELLE = :LIBELLE, DATE_DEB = :DATE_DEB, HEURE_DEB = :HEURE_DEB, DATE_FIN = :DATE_FIN, HEURE_FIN = :HEURE_FIN, INTERVENTION = :INTERVENTION, OBJECTIF = :OBJECTIF, PREREQUIS = :PREREQUIS, CONTENU = :CONTENU, PRIX_REPAS = :PRIX_REPAS, NOMBRE_PLACE = :NOMBRE_PLACE WHERE ID_FORMATION = :ID_FORMATION');
		$req->execute(array(
			'NO_THEME'=>$notheme,
			'NO_SALLE'=>$nosalle,
			'LIBELLE'=>$libelle,
			'DATE_DEB'=>$datedeb,
			'HEURE_DEB'=>$heuredeb,
			'DATE_FIN'=>$datefin,
			'HEURE_FIN'=>$heurefin,
			'INTERVENTION'=>$intervention,
			'OBJECTIF'=>$objectif,
			'PREREQUIS'=>$prerequis,
			'CONTENU'=>$contenu,
			'PRIX_REPAS'=>$prixrepas,
			'NOMBRE_PLACE'=>$nbreplaces,
			'ID_FORMATION'=>$idformation
		));
		echo "<div id='principal' class='container_12'>Formation modifié avec succés.<a href='./accueil.php'>ici</a> pour retourner a l'accueil</div>";
		}catch (Exception $e){die ('Erreur : '.$e->getmessage());}
		
	}
	//Cette fonction permet de Verifier la présence d'une date entre deux dates donnés.
	function CompareDate($date, $comparedate1, $comparedate2)
	{
		//La fonction $compare1->format('Ymd') permet de convertir la date sous la forme Année Mois Jour
		$compare1=new DateTime($comparedate1);
		$U_compare1=$compare1->format('Ymd');
		//Idem pour $compare2
		$compare2=new DateTime($comparedate2);
		$U_compare2=$compare2->format('Ymd');
		//Idem pour $date
		$date=new DateTime($date);
		$U_date=$date->format('Ymd');
		//Comparaison des résultat
		if($U_date>=$U_compare1){
			if($U_date<=$U_compare2){
				$autorisation=true;
			}else{
			$autorisation=false;
			}
		}else{
			$autorisation=false;
		}
		return $autorisation;
	}
	
}
?>