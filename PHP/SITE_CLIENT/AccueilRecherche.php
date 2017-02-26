<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Recherche de films</title>
			<center>		
	</head>
	<body bgcolor="silver">
		<form method="POST" action="Recherche.php">
		<?php banniere("AccueilRecherche.php","Huang-Zerroug");?>	
			<br/>
			<h3><b>Recherche de films</b></h3>
			<br/><br/><br/>
			Titre<input type="text" name="titre"><br/><br/>
			<SELECT name="support" size="1">
				<OPTION>DVD</OPTION>
				<OPTION>VHS</OPTION>
				<OPTION selected>Indifférent</OPTION>
			</SELECT>
			<SELECT name="dispo" size="1">
				<OPTION>disponible</OPTION>
				<OPTION selected>Indifférent</OPTION>
			</SELECT>
			
<?php 
			
			$con = DB_connect();
			echo "<SELECT name='genre' size='1'>";
			$req = "SELECT DISTINCT Genre FROM FILMS";
			$sql = DB_execSQL($req, $con);
			while($data = mysql_fetch_assoc($sql)){
				echo "<OPTION>".$data['Genre'];
			}
			echo "<OPTION value='Indifférent' selected>Genre indifférent</option>";
			echo "</SELECT>";
			
			echo "<br/><br/>";
			
			echo "réalisateur<SELECT name='realisateur' size='1'>";
			$req = "SELECT DISTINCT Realisateur FROM FILMS";
			$sql = DB_execSQL($req, $con);
			echo "<OPTION selected>Indifférent";
			while($data = mysql_fetch_assoc($sql)){
				echo "<OPTION>".$data['Realisateur'];
			}
			echo "</SELECT>";
			
			echo "<br/><br/>";
			
			echo "acteur<SELECT name='acteur' size='1'>";
			$req = "SELECT DISTINCT Acteur FROM ACTEURS";
			$sql = DB_execSQL($req, $con);
			echo "<OPTION selected>Indifférent</OPTION>";
			while($data = mysql_fetch_assoc($sql)){
				echo "<OPTION>".$data['Acteur'].'</OPTION>';
			}
			echo "</SELECT>";			
?>
			<br/><br/><br/>
			<input type="submit" name="soumission" value="Envoyer">
		</form>
		</center>
	</body>
</html>
