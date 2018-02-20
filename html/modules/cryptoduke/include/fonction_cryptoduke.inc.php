<?php 

	$keyData01 = $_POST['Data_01']; //Récupération de la Clef
	$varData02 = $_POST['Data_02']; //Récupération des données à encoder
	$keyData03 = $_POST['Data_03']; //Récupération de la Clef
	$varData04 = $_POST['Data_04']; //Récupération des données à decoder
	
	/* Class crypt */
	require_once $GLOBALS['DOCUMENT_ROOT'].('../class/class1_duke_crypt.inc.php');
	/* On teste s'il faut crypter ou decrypter */
	if (empty($varData04)) {
	/* Si on crypte: */
    $crypt = Chiffrement::crypt($varData02, $keyData01);
	/* Et on affiche le resultat */
	$MaDateMiseEnLigne = date("Y-m-d h:i:s");
	echo '<center>' . $MaDateMiseEnLigne . '</center>';
	echo "<br />\n" . "<br />\n";
	
	echo '<center>' . "Clef d'encodage :" . ' ' .  '[' . $keyData01 .']'  . '</center>' . "<br />\n";
	echo '<center>' . "Données cryptés :" . ' ' .  '[' . $crypt .']' . '</center>' . "<br />\n";
	
		} else {

	/* Sinon on decrypte: */
	$decrypt = Chiffrement::decrypt($varData04, $keyData03);
	/* Et on affiche le resultat */	
	$MaDateMiseEnLigne = date("Y-m-d h:i:s");
	echo '<center>' . $MaDateMiseEnLigne . '</center>';
	echo "<br />\n" . "<br />\n";
	
	echo '<center>' . "Clef d'encodage :" . ' ' .  '[' . $keyData03 .']'  . '</center>' . "<br />\n";
	echo '<center>' . "Données décryptés :" . ' ' .  '[' . $decrypt .']' . '</center>' . "<br />\n";	
		}
?>