<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Retour cassettes</title>
		<hr/>
			<center>
			<h1><b><font color="red">videoEXPRESS</font></b></h1>
			<h5><i>&copy; Huang-Zerroug</i></h5>	
		<hr/>
	</head>
	<body bgcolor="silver">
	<br/>
			<h3><b>Radiation</b></h3>
			<?php
			$nomabo = $_POST["nom"];
			$numeroabo = $_POST["numero"];
			if(($nomabo == "") || ( $numeroabo == "")){
				echo "<p>Vous devez saisir une information dans tous les champs.</p>";
				echo "<a href='AccueilRadiation.php'><button type='button'>Retour</button></a>";
				return 0;
			}
			$con = DB_connect();
			$requete="select * from ABONNES where Nom=\"$nomabo\" and Code=\"$numeroabo\"";
			$rep = DB_execSQL($requete, $con);
			if(mysql_fetch_object($rep)) {
				DB_execSQL("delete from ABONNES where Nom=\"$nomabo\" and Code=\"$numeroabo\"", $con);
				$req="select NoFilm, NoExemplaire from EMPRES where CodeAbonne=\"$numeroabo\"";
				$rep2=DB_execSQL($req, $con);
				while($tmp=mysql_fetch_object($rep2)){
					$numEx=$tmp->NoExemplaire;
					$numFilm=$tmp->NoFilm;
					$rep=DB_execSQL("update CASSETTES set Statut=\"disponible\" where NoExemplaire=$numEx and NoFilm=$numFilm", $con);
				}
				DB_execSQL("delete from EMPRES where CodeAbonne=\"$numeroabo\"", $con);
				echo "<p>Abonné radié</p>";
			}else
				echo "<p>L'abonné n'existe pas.</p>";
			echo "<a href='AccueilRadiation.php'><button type='button'>Retour</button></a>";
			?>
	</center>
	</body>
</html>
				
