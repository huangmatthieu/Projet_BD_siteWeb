<?php
	require_once ("Outils.inc");
	$con = DB_connect();
	$time=time()+60*60*24*30;
		$bool=true;
	if(!isset($_COOKIE['selection'][0])){
		setcookie("selection[0]",1,$time);
		setcookie("selection[1]",$_POST["NumFilm"],$time);
	
		}
	else{
		for($var=1;$var<=$_COOKIE['selection'][0];$var++){
			if($_POST["NumFilm"] == $_COOKIE['selection'][$var]){$bool=false;break;}
		}
		if($bool){
			$cpt=$_COOKIE['selection'][0]+1;		
			setcookie("selection[0]",$cpt,$time);
			setcookie("selection[$cpt]",$_POST["NumFilm"],$time);
		}
	}
					//var_dump($_COOKIE["selection"]);
	
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
		if($bool)
			echo "film ajouté";
		else
			echo "film déjà ajouté";
		?>
	</body></html>
