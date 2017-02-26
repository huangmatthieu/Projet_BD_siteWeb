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
		<?php
			if(!isset($_COOKIE["selection"]) || $_COOKIE['selection'][0]==0)
				echo 'Aucun film selectionné';
			else{
				$cpt=$_COOKIE["selection"][0];
				for($var=1;$var<=$cpt;$var++)
					setcookie("selection[$var]");
				setcookie("selection[0]",0);
				echo "La séléction est vide";
			}
		?>
	    <form method="POST" action="VoirSelection.php" target="Panier" >
	    <input type="submit" value="VoirSelection"/></form>
	     </form>
	</body>
</html>		
