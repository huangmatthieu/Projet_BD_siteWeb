<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Descriptif d'un film</title>
			<center>			
	</head>
	<body bgcolor="silver">
		<form method="POST" action="Descriptif.php">
		<?php banniere("AccueilDescriptif.php","Huang-Zerroug");?>
			<br/>
			<h3><b>Descriptif d'un film</b></h3>
			<br/><br/><br/>
			Numéro de film<input type="text" name="numero"><br/><br/><br/>
			<input type="submit" name="soumission" value="Envoyer">
		</form>
		</center>
	</body>
</html>
