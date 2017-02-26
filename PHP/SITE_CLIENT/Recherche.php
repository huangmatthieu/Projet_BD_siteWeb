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
		<?php banniere("Recherche.php","Huang-Zerroug");?>	
			<br/>
			<h3><b>Recherche de films</b></h3>
			<br/><br/><br/>
			<?php $titre = $_POST["titre"];
$support = $_POST["support"];
$dispo = $_POST["dispo"];
$genre = $_POST["genre"];
$realisateur = $_POST["realisateur"];
$acteur = $_POST["acteur"];

$bool = false;

$requete = "select distinct(f.Titre), f.Realisateur, f.Annee, f.NoFilm from FILMS f , CASSETTES c , ACTEURS a";
if ($titre != "")  {  
	$requete .= " where f.Titre like '%$titre%'"; 
    $bool = true;
}
if ($genre!= "Indifférent") {  
  if($bool)
    $requete .= " and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.Genre = '$genre' "; 
}
if ($realisateur!= "Indifférent") {
  if($bool)
    $requete .= " and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.Realisateur = '$realisateur' "; 
}

if ($support != "Indifférent") { 
  if($bool)
    $requete .= " and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = c.NoFilm and c.Support = '$support' "; 
}
if ($dispo != "Indifférent") {
  if($bool)
    $requete .= " and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = c.NoFilm and c.Statut = '$dispo' "; 
}

if ($acteur != "Indifférent") {
  if($bool)
    $requete .= " and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = a.NoFilm and a.Acteur = '$acteur' ";
} 

$id = DB_connect();
$rep = DB_execSQL($requete, $id);

echo '<h1>Résultats de la recherche</h1><ul>';
while ($tmp = mysql_fetch_object($rep)) {	
	
  echo "$tmp->Titre, $tmp->Realisateur, $tmp->Annee";
  echo '<form method="POST" action="AjoutSelection.php" target="Panier">';
  echo '<input type="hidden" name="NumFilm" value="'.$tmp->NoFilm.'" />';
  echo '<p><input type="submit" value="AjoutSelection"/></p></form>';
}
echo '<form method="POST" action="VoirSelection.php" target="Panier">';
echo '<p><input type="submit" value="VoirSelection"/></p></form>';

?>
</center></body></html>
