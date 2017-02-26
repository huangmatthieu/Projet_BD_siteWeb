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
			<h3><b>Retour cassettes</b></h3>
			<?php
			$numFilm = $_POST["numero"];
			$numExemplaire = $_POST["exemplaire"];
			if(($numFilm == "") || ( $numExemplaire == "")){
				echo "<p>Vous devez saisir une information dans tous les champs.</p>";
				echo "<a href='AccueilRetour.php'><button type='button'>Retour</button></a>";
				return 0;
			}
			$con = DB_connect();
			$rep = DB_execSQL("select * from EMPRES where NoFilm=$numFilm and NoExemplaire=$numExemplaire", $con);
			// Test dans EMPRES
			if(mysql_fetch_object($rep)) {
			// MAJ cassettes 
			$rep = DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=$numFilm and NoExemplaire=$numExemplaire", $con);
			// MAJ abonnes
			$rep = DB_execSQL("select a.NbCassettes, a.Code from ABONNES a, EMPRES e where a.Code=e.CodeAbonne and e.NoFilm=$numFilm and e.NoExemplaire=$numExemplaire", $con );
			$tmp = mysql_fetch_object($rep);
			$nb_cassettes = intval($tmp->NbCassettes)-1;
			$code = $tmp->Code;
			$rep = DB_execSQL("update ABONNES set NbCassettes=$nb_cassettes where Code='$code'", $con);
			// MAJ empres
			$rep = DB_execSQL("delete from EMPRES where NoFilm=$numFilm and NoExemplaire=$numExemplaire and CodeAbonne='$code'", $con);
			echo "<p>Cassettes de nouveau disponible.</p>";
			}
			else
				echo "<p>La cassette n'est pas empruntée.</p>";
			echo "<a href='AccueilRetour.php'><button type='button'>Retour</button></a>";
				
			?>
	</center>
	</body>
</html>
