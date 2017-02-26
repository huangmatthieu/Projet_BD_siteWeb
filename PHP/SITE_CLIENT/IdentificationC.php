<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Commande de cassettes</title>
			<center>
			<?php banniere("IdentificationC.php","Huang-Zerroug");?>			
	</head>
	<body bgcolor="silver">
		<form method="POST" action="Commande.php">
			<br/>
			<h3><b>Commande de cassettes</b></h3>
			<br/><br/><br/>
			Nom<input type="text" name="NOM"><br/>
			Numéro d'abonné<input type="text" name="PASS"><br/><br/><br/>
			<input type="submit" name="soumission" value="Envoyer">
		</form>
		</center>
	</body>
</html>
