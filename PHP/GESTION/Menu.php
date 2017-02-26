<html>
	<head>
		<title>Menu</title>
	</head>
	<body bgcolor="silver">
	<hr/>
			<center>
			<h1><b><font color="red">videoEXPRESS</font></b></h1>
			<h5><i>&copy; Huang-Zerroug</i></h5>	
		<hr/>
<?php
	if(($_POST["NOM"] != "huangzerroug") || ($_POST["PASS"] != "li345")){
		echo "<h2><b>nom ou mot de passe incorrect</b></h2><br/><br/>
			<a href='index.htm'><button type='button'>Retour</button></a>";
		
		
	}else{
		 
		echo "<h3><b>Menu</b></h3><br/><br/>
				<a href='AccueilRetour.php'><b>Retour de cassettes</b></a><br/><br/>
				<a href='AccueilSignUp.php'><b>Enregistrer de nouveaux abonn&eacute;s</b></a><br/><br/>
				<a href='AccueilEdition.php'><b>Modifier des fiches d'abonn&eacute;s</b></a><br/><br/>
				<a href='AccueilRadiation.php'><b>Radier des abonn&eacute;s</b></a><br/><br/>
			</center></body></html>";
	}
?>
