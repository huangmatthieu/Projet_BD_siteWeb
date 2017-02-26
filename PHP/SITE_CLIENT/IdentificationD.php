<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Liste des cassettes détenues</title>
			<center>		
	</head>
	<body bgcolor="silver">
		<form method="POST" action="Detenues.php">
		<?php banniere("IdentificationD.php","Huang-Zerroug");?>	
			<br/>
			<h3><b>Liste des cassettes détenues</b></h3>
			<br/><br/><br/>
			Nom<input type="text" name="NOM"><br/>
			Numéro d'abonné<input type="text" name="PASS"><br/><br/><br/>
			<input type="submit" name="soumission" value="Envoyer">
		</form>
		</center>
	</body>
	</center>
</html>
