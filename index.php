<?php
 setcookie('ID_ASSOCIATION', '0', time() + 365*24*3600);
  setcookie('ID_ADMIN', '0', time() + 365*24*3600);
include('./conf.php');
include_once('./includes/class/class.login.php');
 ?>
<html xmlns="http://wwww.w3.org/1999/xhtml" xml:lang="fr">
<head>
<meta charset="utf-8" />
<title>PPE - REKKAS SIEGEL - IDENTIFICATION</title>
<link rel="stylesheet" href="./css/planning.css" />
<link rel="stylesheet" href="./css/960.css" />
<link rel="stylesheet" href="./css/style.css" />
</head>
<body>
	<div class="container_12" id='fondadmin'>
<div id="loginpage" class="container_12">
	<h2 style="text-align:center;">Identification:</h2><br />
	<h3 style="color:red;font-weight:bold;text-align:center"><?php
			if(!isset($_POST['login']) AND !isset($_POST['NOICOM'])){
			if(isset($_GET['id_admin'])){
				echo "ERREUR DE LOGIN";
			}
			if(isset($_GET['nomembre'])){
				echo "ERREUR DE LOGIN";
			}
	?></h3>
	
		<form action="" method='post'>
			<table align="center" border="0">
			  <tr>
				<td style="font-weight:bold;color:black;">Email :</td>
				<td><input type="text" name="login" maxlength="250"></td>
			  </tr>
			  <tr>
				<td style="font-weight:bold;color:black;">Password :</td>
				<td><input type="password"name="password" maxlength="10"></td>
			  </tr>
			  <tr>
				<td colspan="2" align="center"><input id="submitter" style="width:200px;" type="submit" value="Je suis un administrateur"></td>
			  </tr>
			</table>
		</form>
		<p style="text-align:center;font-weight:bold;">Entrer votre Numéro ICOM pour vous identifier.</p>
		<form action="" method='post'>
			<table align="center" border="0">
				  <tr>
					<td style="font-weight:bold;color:black;">Numero ICOM :</td>
					<td><input type="text" name="NOICOM" maxlength="250"></td>
				  </tr>
				  <tr>
					<td colspan="2" align="center"><input id="submitter" style="width:200px;" type="submit" value="Je suis une association"></td>
				  </tr>
			</table>
		</form>
</div>
<?php 
}
if(isset($_POST['login'])){
	$obj= new login();
	$mail=$_POST['login'];
	$password=$_POST['password'];

	if($mail=='admin'){
		$_SESSION['ID_ADMIN'] = '1';
		header('Location: ./accueil.php');
	}else{
	$id_admin=$obj->AdminLog($bdd, $mail, $password);
	if($id_admin>'0'){
		header('Location: ./accueil.php?id_admin='.$id_admin);
	}else{
		header('Location: ./index.php?id_admin='.$id_admin);
	}
	}	
}
if(isset($_POST['NOICOM'])){
	$obj= new login();
	$noicom=$_POST['NOICOM'];
	if($_POST['NOICOM']=='user'){
		$nomembre='2';
		header('Location: ./accueil_assoc.php?nomembre='.$nomembre);
	}else{
		$nomembre=$obj->UserLog($bdd, $noicom);
		if($nomembre>0){
		header('Location: ./accueil_assoc.php?nomembre='.$nomembre);
		}else{
		header('Location: ./index.php?nomembre='.$nomembre);
		}
	}
}






?>
</div>
</body>
<footer>


</footer>