<?php
	require_once ("Outils.inc");
?>

<html>
	<head>
		<title>Panier</title>
		<hr/>
			<center>	
		<hr/>
	</head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<body bgcolor="silver">
	<form method="POST" action="SuppSelection.php" target="Panier">
		<?php
			
			$con = DB_connect();
			if(!isset($_COOKIE["selection"]) || $_COOKIE['selection'][0]==0)
				echo 'Aucun film selectionné';
			else{
				$cpt=$_COOKIE["selection"][0];
				for($var=1; $var<=$cpt;$var++){
					$numfilm=$_COOKIE["selection"][$var];
					$requete = "SELECT f.Titre FROM FILMS f WHERE f.NoFilm ='$numfilm'";
					$rep = DB_execSQL($requete, $con);
					$tmp = mysql_fetch_object($rep);
					echo "$tmp->Titre $numfilm";
					echo'<input type="checkbox" name="Case'.$var.'" value="'.$numfilm.'"/>';
					echo'<input type="hidden" name="CaseSub'.$var.'" value="'.$numfilm.'"/>';
					echo"<br/>";
				}
			}
			echo '<p><input type="submit" value="Supprimer"/> </p>';
			echo '</form>';
			echo '<form method="POST" action="ViderSelection.php" target="Panier">';
			echo '<p><input type="submit" value="Vider Selection"/></p>';		
			echo '</form>';
		?>
	</body>
</html>
