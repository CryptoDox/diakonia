<?php 
	/* Fonction fichier go */

	/* Variables */
	require_once $GLOBALS['DOCUMENT_ROOT'].('include/tele_var.inc.php');
	/* Fonction telecharge */
	require_once $GLOBALS['DOCUMENT_ROOT'].('include/fonction_tele.inc.php');

	/* Fonctions de verification du token */
	require_once $GLOBALS['DOCUMENT_ROOT'].('include/fonction_captcha_verif_secure.inc.php');

	if ($response && $response->success) {
	/*  All good. Token verified! */
	/* action telechargement par appel de la fonction */
	require_once $GLOBALS['DOCUMENT_ROOT'].('include/tele_go.inc.php');
	/* Fin */
	exit;
} else {
	/* Bad Niet Kaput. Token not verified */
	exit;
}
?>