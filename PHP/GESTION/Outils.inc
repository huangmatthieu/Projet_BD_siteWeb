<?php

function banniere($page,$auteurs){
if(!isset($_COOKIE["identite"])){
	echo "<hr/>
		<h1><b><font color=\"red\">videoEXPRESS</font></b></h1>
		<h5><i>&copy; ".$auteurs."</i></h5>";
	
	$tmp="<a href='Accueil.php'><b>Accueil</b></a>&nbsp;";
		
	switch ($page) {
    case "AccueilDescriptif.php":
        $tmp.="<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='IdentificationC.php'><b>Commande de cassettes</b></a>
			<a href='IdentificationD.php'><b>Liste des cassettes d&eacute;tenues</b></a>";
        break;
    case "AccueilRecherche.php":
        $tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='IdentificationC.php'><b>Commande de cassettes</b></a>
			<a href='IdentificationD.php'><b>Liste des cassettes d&eacute;tenues</b></a>";
        break;
    case "IdentificationC.php":
        $tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='IdentificationD.php'><b>Liste des cassettes d&eacute;tenues</b></a>";
        break;
    case "IdentificationD.php":
    	$tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='IdentificationC.php'><b>Commande de cassettes</b></a>";
		break;
	default:
		$tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='IdentificationC.php'><b>Commande de cassettes</b></a>
			<a href='IdentificationD.php'><b>Liste des cassettes d&eacute;tenues</b></a>";
		break;
	}
}else{
	echo "<hr/>
		<h1><b><font color=\"red\">videoEXPRESS</font></b></h1>
		<h5><i>&copy; ".$auteurs."</i></h5>";
	$tmp="<a href='Accueil.php'><b>Accueil</b></a>&nbsp;";
	switch ($page) {
    case "AccueilDescriptif.php":
        $tmp.="<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='IdentificationC.php'><b>Commande de cassettes</b></a>
			<a href='IdentificationD.php'><b>Liste des cassettes d&eacute;tenues</b></a>";
        break;
    case "AccueilRecherche.php":
        $tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='Commande.php'><b>Commande de cassettes</b></a>
			<a href='Detenues.php'><b>Liste des cassettes d&eacute;tenues</b></a>";
        break;
	case "Detenues.php":
    	$tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='Commande.php'><b>Commande de cassettes</b></a>";
		break;
	case "Commande.php":
    	$tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='Detenues.php'><b>Liste des cassettes détenues</b></a>";
		break;
	default:
		$tmp.="<a href='AccueilDescriptif.php'><b>Descriptif d'un film</b></a>
			<a href='AccueilRecherche.php'><b>Recherche de films</b></a>
			<a href='Commande.php'><b>Commande de cassettes</b></a>
			<a href='Detenues.php'><b>Liste des cassettes d&eacute;tenues</b></a>";
		break;
	}
}
	echo $tmp."<br/><hr/>";	
}

function DB_connect(){
	//$con = mysql_connect("localhost", "root", "19920805");
	$con = mysql_connect("localhost", "root", "19920805");
    if (!$con){
		echo "Probleme de connexion au serveur : ".mysql_error();
		return 0;
	}
	$b = mysql_select_db("videoexpress");
	if (!$b){
		echo "Probleme de connexion à root : ".mysql_error();
		return 0;
	}
	return $con;
}
function DB_execSQL($req, $con){
	$sql = mysql_query($req,$con);
	if (!$sql){
		echo "Probleme de requete sql : ".mysql_error();
		return 0;
	}
	return $sql;
}
?>
