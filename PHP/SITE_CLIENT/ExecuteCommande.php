<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>ConfirmeCommande</title>
			<center>
			<?php banniere("ConfirmeCommande.php","Huang-Zerroug");?>			
	</head>
	<body bgcolor="silver">
	<form method="POST" action="ExecuteCommande.php">
	<br/>
	<?php
	$pass = $_POST["PASS"];
	$taille = $_POST["TAILLE"];   
	$nom = $_POST["NOM"];
	$con = DB_connect();
	$bool=false;
	for($var =1; $var<=$taille; $var++) {
		if(isset($_POST["Numfilm".$var])) {  //si case cochée
			$noFilm = $_POST["Numfilm".$var];
			$noExemplaire = $_POST["Ex".$var];
			$requete="select * from EMPRES where CodeAbonne='".$pass."' and NoFilm=".$noFilm." and NoExemplaire=".$noExemplaire." and DateEmpRes> DATE_SUB(NOW(), INTERVAL 1 MINUTE)";
			$rep=DB_execSQL($requete,$con);
			$tmp=mysql_fetch_object($rep);
			if($tmp){  //si case cochée et non timeout
				DB_execSQL("update CASSETTES set Statut='empruntee' where NoFilm=".$noFilm." and NoExemplaire=".$noExemplaire, $con);
				DB_execSQL("update ABONNES set NbCassettes=NbCassettes+1 where Code='".$pass."'", $con);
			}
			else {  //si case cochée et timeout
				DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=".$noFilm." and NoExemplaire=".$noExemplaire, $con);
				DB_execSQL("delete from EMPRES where NoFilm=$noFilm and NoExemplaire=$noExemplaire",$con);
				$bool=true;
			}
		}
		elseif(isset($_POST["Ex".$var])){ //si case non cochée
			$noFilm = $_POST["movie".$var];
			$noExemplaire = $_POST["Ex".$var];
			DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=".$noFilm." and NoExemplaire=".$noExemplaire, $con);
			DB_execSQL("delete from EMPRES where NoFilm=$noFilm and NoExemplaire=$noExemplaire",$con);
		}
			
	}
	if($bool){
					echo '</form><form method="POST" action="Commande.php">';
					echo "<p>Temps écoulé</p>";
					echo '<input type="hidden" name="PASS" value="'.$pass.'"/>';
					echo '<input type="hidden" name="NOM" value="'.$nom.'"/>';
					echo '<br/><input name="retour" type="submit" value="Retour"/>';
					echo '</form>';
					exit;
				}
	echo "<p>Commande effectuée</p>"; 
	?>
</body>
</html>