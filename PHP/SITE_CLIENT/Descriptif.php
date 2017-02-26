<?php
	require_once ("Outils.inc");
?>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>AccueilRecherche</title>
			<center>			
	</head>
	<body bgcolor="silver">
	<?php banniere("Descriptif.php","Huang-Zerroug");?>
<?php
$numero = $_POST['numero'];
 
$requete = "SELECT f.NoFilm, f.Titre, f.Nationalite, f.Realisateur, f.Couleur, f.Annee, f.Genre, f.Duree, f.Synopsis FROM films f WHERE f.NoFilm = '$numero'";
$requete2 = "select a.acteur from acteurs a where a.NoFilm='$numero'";
$con = DB_connect();
$rep = DB_execSQL($requete, $con);
$rep2 = DB_execSQL($requete2, $con);
$tmp = mysql_fetch_object($rep);
if(!$tmp){
	echo "<br/><br/><h2>Numéro de film inexistant.</h2>";
	return;
}
echo '<table border=1>
	<caption><h3>Résultat descriptif</h3></caption><br/>
	<tr>
	<th>Numéro du film</th>
	<th>Titre</th>
	<th>Nationalité</th>
	<th>Réalisateur</th>
	<th>Année de production</th>
	<th>Résumé</th>
	<th>Genre</th>
	<th>Liste des acteurs</th>
	</tr>';
echo "<tr>
	<td>$tmp->NoFilm</td>
	<td>$tmp->Titre</td>
	<td>$tmp->Nationalite</td>
	<td>$tmp->Realisateur</td>
	<td>$tmp->Annee</td>		
	<td>$tmp->Synopsis</td>
	<td>$tmp->Genre</td>
	<td>";
while($tmp2 = mysql_fetch_object($rep2)){
	echo "<li>$tmp2->acteur</li><br/>";
	}
echo '</td></tr></table>';
?>
    <form method="POST" action="AjoutSelection.php" target="Panier">
    <?php echo "<input type=\"hidden\" name=\"NumFilm\" value=\"$tmp->NoFilm\" /><br/>";?>
    <input type="submit" value="AjoutSelection"/>
    </form><form method="POST" action="VoirSelection.php" target="Panier" >
    <input type="submit" value="VoirSelection"/></form>
</body></center></html>
