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
			setcookie('identite[0]',$nom);
			setcookie('identite[1]',$pass);
		}
	}
?>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Liste des cassettes détenues</title>
			<center>			
	</head>
	<body bgcolor="silver">
	<?php banniere_cookie("Detenues.php","Huang-Zerroug",$bool);?>
			<br/>
			<h3><b>Liste des cassettes détenues</b></h3>
			<br/><br/>
			<?php
			if($bool || (isset($_COOKIE['identite']['0']) && isset($_COOKIE['identite']['1']))){
				if(isset($_COOKIE['identite']['0']) && isset($_COOKIE['identite']['1'])){
					$nom=$_COOKIE['identite']['0'];
					$pass=$_COOKIE['identite']['1'];
				}else{
					$nom=$_POST["NOM"];
					$pass=$_POST["PASS"];
				}
				$requete = "select * from abonnes where code='$pass' and nom='$nom'";
				$rep = DB_execSQL($requete, $con);
				$abo=mysql_fetch_object($rep);
				if($abo->NbCassettes == 0)echo "Vous n'avez aucune cassette.";
				else {
					$requete2 = "select c.NoFilm, c.NoExemplaire, f.Titre, f.Realisateur, e.DateEmpRes from FILMS f, CASSETTES c, EMPRES e where e.CodeAbonne='$abo->Code' and f.NoFilm=c.NoFilm and c.NoFilm=e.NoFilm and c.NoExemplaire=e.NoExemplaire";
					$rep2 = DB_execSQL($requete2, $con);
					while($tmp = mysql_fetch_object($rep2)) {
						$date = $tmp->DateEmpRes;
						echo "<ul><i>Film n° : </i>$tmp->NoFilm <br>
							<i>Exemplaire n° : </i>$tmp->NoExemplaire<br/>
							<i>Titre : </i>$tmp->Titre<br/>
							<i>Realisateur : </i>$tmp->Realisateur<br/>
							<i>Date d'emprunt : </i>$date<br/></ul>";
					}
				}
			}else{
				echo "Le nom ou le numéro d'abonné est incorrect<br/><br/>";
			}
			?>
			
	</body>
	</center>
</html>