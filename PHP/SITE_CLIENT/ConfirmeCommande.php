<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>ConfirmeCommande</title>
			<center>			
	</head>
	<script type="text/javascript">
function selectionListener(taille) {
    checkedStr = '';
    ok=0;
	for (var i=1;i<=taille;i++){
  		if (document.getElementById("Numfilm"+i).checked) {
   		     ok=1;break;
		}
	}
    if(ok==0){
    	document.getElementById("ExecCom").style.display="none";
	document.getElementById("NoExecCom").style.display="block";
    }
    else{
        document.getElementById("ExecCom").style.display="block";
		document.getElementById("NoExecCom").style.display="none";
   }
   console.log(ok);
}
	</script>
	<?php
		$size=0;
		$con=DB_connect();
		//pour avoir le nombre de checkbox dispo via $size lors de l'appel a la fonction selectionListener
		for($var=1 ; $var <= $_POST["TAILLE"] ; $var++){
			$nfilm=$_POST["NumFilm".$var];
			if($nfilm == "")continue;
			$support=$_POST["Support$var"];
			$requete2="SELECT NoFilm, Support, NoExemplaire FROM CASSETTES WHERE NoFilm=$nfilm AND Statut='disponible' AND Support=\"$support\"";// FILMS DISPO SUR BON SUPPORT
			$requete3="SELECT NoFilm, Support, NoExemplaire FROM CASSETTES WHERE NoFilm=$nfilm AND Statut='disponible' AND Support!=\"$support\"";// FILMS DISPO SUR MAUVAIS SUPPORT;
			$rep2=DB_execSQL($requete2,$con);
			$rep3=DB_execSQL($requete3,$con);
			if($tmp2=mysql_fetch_object($rep2)){
				$size++;
				$noExemplaire=$tmp2->NoExemplaire;
				DB_execSQL("update CASSETTES set Statut='reservee' where NoFilm=".$nfilm." and NoExemplaire=".$noExemplaire, $con);
				$exemplaires[]=$noExemplaire;
				$supports[]=$support;
				$numfilms[]=$nfilm;
			}			
			elseif($tmp3=mysql_fetch_object($rep3)){
				$size++;
				$noExemplaire=$tmp3->NoExemplaire;
				DB_execSQL("update CASSETTES set Statut='reservee' where NoFilm=".$nfilm." and NoExemplaire=".$noExemplaire, $con);
				$exemplaires[]=$noExemplaire;
				$supports[]=$support;
				$numfilms[]=$nfilm;
			}			
		}
		//remise des exemplaires 'reserves' a 'disponible'
		for($var=0 ; $var < $size ; $var++){
			$requete2="SELECT NoFilm, Support, NoExemplaire FROM CASSETTES WHERE NoFilm=$numfilms[$var] AND Statut='reservee' AND Support=\"$supports[$var]\"";// FILMS DISPO SUR BON SUPPORT
			$requete3="SELECT NoFilm, Support, NoExemplaire FROM CASSETTES WHERE NoFilm=$numfilms[$var] AND Statut='reservee' AND Support!=\"$supports[$var]\"";// FILMS DISPO SUR MAUVAIS SUPPORT;
			$rep2=DB_execSQL($requete2,$con);
			$rep3=DB_execSQL($requete3,$con);
			if($tmp2=mysql_fetch_object($rep2)){
				$noExemplaire=$tmp2->NoExemplaire;
				DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=".$numfilms[$var]." and NoExemplaire=".$exemplaires[$var], $con);
			}			
			elseif($tmp3=mysql_fetch_object($rep3)){
				$noExemplaire=$tmp3->NoExemplaire;
				DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=".$numfilms[$var]." and NoExemplaire=".$exemplaires[$var], $con);
			}			
		}
		//var_dump($size);
		echo '<body bgcolor="silver" onload="selectionListener('.$size.')">'; ?>
	<form method="POST" action="ExecuteCommande.php">
	<?php banniere("ConfirmeCommande.php","Huang-Zerroug");?>
	<br/>
		<h3><b>Confirmation de commande</b></h3>
		<br/><br/>
		<?php
		$nom = $_POST["NOM"];
		$pass = $_POST["PASS"];
		$taille = $_POST["TAILLE"];
	echo "<table border=\"1\">
	<caption><h3>Résultat descriptif</h3></caption><br/>
	<tr>
	<th>Numéro du film</th>
	<th>Titre</th>
	<th>Disponibilité</th>
	<th>Choix</th>
	</tr>";
		//var_dump($size);
		$index=1;
		for($var=1 ; $var <= $taille ; $var++){
			$nfilm=$_POST["NumFilm".$var];
			if($nfilm == "")continue;
			$support=$_POST["Support$var"];
			$requete="SELECT f.Titre FROM FILMS f WHERE NoFilm=$nfilm";
			$requete2="SELECT NoFilm, Support, NoExemplaire FROM CASSETTES WHERE NoFilm=$nfilm AND Statut='disponible' AND Support=\"$support\"";// FILMS DISPO SUR BON SUPPORT
			$requete3="SELECT NoFilm, Support, NoExemplaire FROM CASSETTES WHERE NoFilm=$nfilm AND Statut='disponible' AND Support!=\"$support\"";// FILMS DISPO SUR MAUVAIS SUPPORT
			$rep=DB_execSQL($requete,$con);
			$rep2=DB_execSQL($requete2,$con);
			$rep3=DB_execSQL($requete3,$con);
			$tmp=mysql_fetch_object($rep);
			echo "<tr><td>$nfilm</td>
			      <td> $tmp->Titre</td>";
			if($tmp2=mysql_fetch_object($rep2)){
				echo '<td> oui </td>';
				$bool=1;
				$noExemplaire=$tmp2->NoExemplaire;
				$exemp[$var]=$noExemplaire;
				$film[$var]=$nfilm;
				DB_execSQL("update CASSETTES set Statut='reservee' where NoFilm=".$nfilm." and NoExemplaire=".$noExemplaire, $con);
				DB_execSQL("insert into EMPRES values($tmp2->NoFilm, $tmp2->NoExemplaire, '".$pass."', NOW())", $con);
			}			
			elseif($tmp3=mysql_fetch_object($rep3)){
				echo '<td> oui mais '.$tmp3->Support.' </td>';
				$bool=2;
				$noExemplaire=$tmp3->NoExemplaire;
				$exemp[$var]=$noExemplaire;
				$film[$var]=$nfilm;
				DB_execSQL("update CASSETTES set Statut='reservee' where NoFilm=".$nfilm." and NoExemplaire=".$noExemplaire, $con);
				DB_execSQL("insert into EMPRES values($tmp3->NoFilm, $tmp3->NoExemplaire, '".$pass."', NOW())", $con);
			}
			else{	
				echo '<td> non </td>';
				$bool=0;
			}
			
			if($bool==1){
				echo '<td> <input id="Numfilm'.$index.'" type="checkbox" checked="checked" name="Numfilm'.$var.'" value="'.$nfilm.'" " onclick="selectionListener('.$size.');"/> 
					  <input type="hidden" name="Ex'.$var.'" value="'.$noExemplaire.'"/>
					  <input type="hidden" name="movie'.$var.'" value="'.$nfilm.'"/></td>';	
				$index++;
			}
			elseif($bool==2){
				echo '<td> <input id="Numfilm'.$index.'" type="checkbox" name="Numfilm'.$var.'" value="'.$nfilm.'" " onclick="selectionListener('.$size.');"/> 
				      <input type="hidden" name="Ex'.$var.'" value="'.$noExemplaire.'"/>
					  <input type="hidden" name="movie'.$var.'" value="'.$nfilm.'"/></td>';	
				$index++;
			}
			else{
				echo '<td>  </td>';			
			}
			echo '</tr>';
		}
	echo " </table>";
	echo '<input type="hidden" name="TAILLE" value="'.$taille.'"/>';
	echo '<input type="hidden" name="PASS" value="'.$pass.'"/>';
	echo '<input type="hidden" name="NOM" value="'.$nom.'"/>';
	echo '<br/><input id="ExecCom" name="commander" type="submit" value="Commander"/> <div id="NoExecCom">Vous n\'avez choisi aucun film disponible</div>';
	//revoir le choix on transmet les donnees necessaires a Commande.php pour mettre les tables a jour.
	echo '</form><form method="POST" action="Commande.php">';
	echo '<input type="hidden" name="PASS" value="'.$pass.'"/>';
	echo '<input type="hidden" name="NOM" value="'.$nom.'"/>';
	for($var=1 ; $var <= $taille ; $var++){
			$nfilm=$_POST["NumFilm".$var];
			if($nfilm == "")continue;
			if(isset($exemp[$var]) && isset($film[$var])){
				echo '<input type="hidden" name="Numfilm'.$var.'" value="'.$film[$var].'"/> 
					  <input type="hidden" name="Ex'.$var.'" value="'.$exemp[$var].'"/>';			
			}			
	}
	echo '<input type="hidden" name="RETOUR" value="retour"/>';
	echo '<input type="hidden" name="TAILLE" value="'.$taille.'"/>';
	echo '<input type="submit" value="Revoir le choix"/>';
	echo '</form>';
		?>
		
	</center>
	</body>
</html>
