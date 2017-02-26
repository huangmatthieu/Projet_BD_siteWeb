<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>index</title>
	</head>
	<body bgcolor="silver">
				<hr/>
			<center>
			<h1><b><font color="red">videoEXPRESS</font></b></h1>
			<h5><i>&copy; Huang-Zerroug</i></h5>	
		<hr/>
		<?php
		$con=DB_connect();
		$nom=$_POST["nom"];
		$prenom=$_POST["prenom"];
		$code=$_POST["code"];
		$adresse=$_POST["adresse"];
		$cp=$_POST["cp"];
		$ville=$_POST["ville"];
		$batiment=$_POST["batiment"];
		$etage=$_POST["etage"];
		$digicode=$_POST["digicode"];
		$telephone=$_POST["telephone"];
		$email=$_POST["email"];
		$banque=$_POST["banque"];
		$guichet=$_POST["guichet"];
		$compte=$_POST["compte"];
		if(mysql_fetch_object(DB_execSQL("select * from ABONNES where Code=\"$code\"",$con))){echo "<br/><br/><h3>code abonné déjà attribué</h3><p><a href='AccueilSignUp.php'><button type='button'>Retour</button></a></p>";exit;}
		$requete='insert into ABONNES values("'.$code.'","'.$nom.'","'.$prenom.'","'.$adresse.'","'.$cp.'","'.$ville.'","'.$batiment.'","'.$etage.'","'.$digicode.'","'.$telephone.'","'.$email.'",'.$banque.','.$guichet.',"'.$compte.'",0)';
		//var_dump($requete);die;
		if($res=DB_execSQL($requete,$con)==0){echo "<p><a href='AccueilSignUp.php'><button type='button'>Retour</button></a></p>";exit;}
		?>
		<p>inscription effectuée</p>
		<p><a href='AccueilSignUp.php'><button type='button'>Retour</button></a></p>
	</center></body></html>
