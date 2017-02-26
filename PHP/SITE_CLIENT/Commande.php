<?php
	require_once ("Outils.inc");
	$con = DB_connect(); 
	$bool=false;
	if(!isset($_COOKIE['identite'])){
		$nom = $_POST["NOM"];
		$pass = $_POST["PASS"];
		$requete = "select * from abonnes where code='$pass' and nom='$nom'";
		$rep = DB_execSQL($requete, $con);
		if($abo = mysql_fetch_object($rep)) { 
			$bool=true;
			setcookie('identite[0]', $nom);
			setcookie('identite[1]', $pass);
		}
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Commande</title>
			<center>
			<?php banniere_cookie("Commande.php","Huang-Zerroug",$bool);?>			
	</head>
	<body bgcolor="silver">
	<form method="POST" action="ConfirmeCommande.php">
	<br/>
		<h3><b>Commande</b></h3>
		<br/><br/>
		<?php
			//on remet les tables a jour apres avoir clique sur "revoir le choix" dans ConfirmeCommande.php
			if(isset($_POST["RETOUR"])){
				for($var=1;$var<=$_POST["TAILLE"];$var++){
				//var_dump($_POST["Numfilm".$var]);var_dump($_POST["Ex".$var]);
					if(!isset($_POST["Numfilm".$var]))continue;
					$nexemplaire=$_POST["Ex".$var];
					$nfilm=$_POST["Numfilm".$var];
					//echo "yoyo";
					DB_execSQL("delete from EMPRES where NoFilm=$nfilm and NoExemplaire=$nexemplaire", $con);
					DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=$nfilm and NoExemplaire=$nexemplaire", $con);
				}
			}
			if($bool || (isset($_COOKIE['identite']['0']) && isset($_COOKIE['identite']['1']))){
				if(isset($_COOKIE['identite']['0']) && isset($_COOKIE['identite']['1'])){
					$nom=$_COOKIE['identite']['0'];
					$pass=$_COOKIE['identite']['1'];
				}
				else{
					$nom=$_POST["NOM"];
					$pass=$_POST["PASS"];
				}
				$requete = "select * from abonnes where code='$pass' and nom='$nom'";
				$rep = DB_execSQL($requete, $con);
				$nb_cassettes = mysql_fetch_object($rep)->NbCassettes;
				if($nb_cassettes > 2){
					echo "<p><h2>Quota atteint, vous ne pouvez plus commander de cassettes</h2></p>";
			
				}
				else{
					$taille=3-$nb_cassettes;
					echo "<p><h3>Vous pouvez commander encore $taille cassette(s)</h3></p>
						<table border=\"1\">
						<caption><h3>Tableaux de commande</h3></caption><br/>
						<tr>
						<th>Numéro du film</th>
						<th>Support</th>
						</tr>";
					for($var=1 ; $var <= $taille ; $var++){
						echo "<tr>
							<td><input type=\"text\" name=\"NumFilm$var\"></td>
							<td>DVD<input type=\"radio\" name=\"Support$var\" value=\"DVD\" checked=\"checked\"><br/>
								VHS<input type=\"radio\" name=\"Support$var\" value=\"VHS\">
							</td></tr>";
					}
					echo "</table><br/>";
					echo '<input type="submit" name="soumission" value="Envoyer">';
					echo "<input type=\"hidden\" name=\"NOM\" value=\"$nom\"/>
					  <input type=\"hidden\" name=\"PASS\" value=\"$pass\"/>
					  <input type=\"hidden\" name=\"TAILLE\" value=\"$taille\"/>";
				}		
			}
			else{
				echo "Le nom ou le numéro d'abonné est incorrect<br/><br/>";
				echo "<a href='IdentificationC.php'><button type='button'>Retour</button></a>";
			}
	
		?>
	</form>
	</center>
	</body>
</html>
