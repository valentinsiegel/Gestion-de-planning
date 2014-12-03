<?php
class login
{
	function UserLog($bdd, $noicom) {
		try{
			$aclecall= $bdd->query('SELECT ID_ASSOCIATION FROM association WHERE NO_ICOM='.$noicom.' LIMIT 1');
			$acleanswer = $aclecall->fetch(); 
			$nomembre=$acleanswer['ID_ASSOCIATION'];
			$aclecall->closeCursor();
		}catch (Exception $e){
			$nomembre='error';
		}
		return $nomembre;
	}
	function AdminLog($mail, $password){
		try{
			try {
				$bdd = new PDO ('mysql:host=localhost;dbname=mlr3;port=3306', 'root', 'root');
			}catch(Exception $e){
				die ('Erreur de connexion a la base de données : '.$e->getMessage());
				$idadmin='0';
			}
			$aclecall= $bdd->query ("SELECT MDP,ID_ADMIN FROM admin WHERE mail='".$mail."' LIMIT 1")or die(print_r($bdd->errorInfo()));
			$acleanswer = $aclecall->fetch(); 
			if($acleanswer['MDP']==md5($password)){
			$idadmin=$acleanswer['ID_ADMIN'];
			}
			$aclecall->closeCursor();
		}catch (Exception $e){
			$idadmin='0';
		}

	return $idadmin;
	}




	//Comment utiliser fonction
	//list($d, $m, $y) = explode('-', '26-02-2009'); 
	//echo 'DEBUT : '.debutsem($y,$m,$d).' - FIN : '.finsem($y,$m,$d);


}
?>