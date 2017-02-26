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
				//var_dump($cpt);
				$nbsupp=0;
				$index=1;
				for($var=1; $var<=$cpt;$var++){
					if(!isset($_POST['Case'.$var.''])){
						setcookie("selection[$index]",$_POST['CaseSub'.$var.''],time()+60*60*24*30);
						$index++;
						$nbsupp++;						
					}
				}
				for($var=$nbsupp+1; $var<=$cpt;$var++)
					setcookie("selection[$var]");
				$tmp=$cpt-$nbsupp;
				setcookie("selection[0]",$nbsupp,time()+60*60*24*30);
				echo "<p>Nombre de films supprimés : $tmp</p>";
			}
		?>
	    <form method="POST" action="VoirSelection.php" target="Panier" >
	    <input type="submit" value="VoirSelection"/></form>
	     </form>
	</body>
</html>		
