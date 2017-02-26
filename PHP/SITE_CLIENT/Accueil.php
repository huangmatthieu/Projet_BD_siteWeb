<html>
	<head>
		<title>Accueil</title>
		<hr/>
			<center>
			<h1><b><font color="red">videoEXPRESS</font></b></h1>
			<h5><i>&copy; Huang-Zerroug</i></h5>	
		<hr/>
	</head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<body bgcolor="silver">
		<form method="POST">
				<br/><br/>
				<?php
				if(!isset($_COOKIE["identite"])){
					echo '<a href="AccueilDescriptif.php"><b>Descriptif d\'un film</b></a><br/><br/>';
					echo '<a href="AccueilRecherche.php"><b>Recherche de films</b></a><br/><br/>';
					echo '<a href="IdentificationC.php"><b>Commande de cassettes</b></a><br/><br/>';
					echo '<a href="IdentificationD.php"><b>Liste des cassettes détenues</b></a><br/><br/>';
				}else{
					echo '<a href="AccueilDescriptif.php"><b>Descriptif d\'un film</b></a><br/><br/>';
					echo '<a href="AccueilRecherche.php"><b>Recherche de films</b></a><br/><br/>';
					echo '<a href="Commande.php"><b>Commande de cassettes</b></a><br/><br/>';
					echo '<a href="Detenues.php"><b>Liste des cassettes détenues</b></a><br/><br/>';
				}
				?>
			</center>
		</form>	
	</body>
</html>
