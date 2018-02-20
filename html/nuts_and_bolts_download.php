<?php 
/* Scripts head */
require_once $GLOBALS['DOCUMENT_ROOT'].('include/scripts_tete.inc.php');
echo "<title>Nuts and Bolts Download</title>\n";
echo "</head>\n";
echo "<body>\n";
/* CORPS */
/* Contexte*/
/* Fonction de formatage de chaine de caracteres */
require_once $GLOBALS['DOCUMENT_ROOT'].('include/fonction_fix_balises.inc.php');
/* Variables textes et HTML dont certaines on besoins de la fonction de formatage */
require_once $GLOBALS['DOCUMENT_ROOT'].('include/fonction_captcha_var.inc.php');
/* Balise DIV qui affiche la requete de reactivation de JavaScript si non actif (utilise les variables) */
require_once $GLOBALS['DOCUMENT_ROOT'].('include/no_javascript_message.inc.php');
/* Test provosoire de bon chargement des inclures et requires */
//if ((require 'include/fonction_captcha_var.inc.php') == '1') {
//		echo 'OK';
//}
//	else {
//		echo 'NO';
//}
?>
	<!-- Fonction en JS qui teste JavaScript et cache la requete quand il est actif "testJavascript" -->	
	<script language="javascript">
			function testJavascript(id) {
    document.getElementById(id).style.visibility = "hidden"; /* Hide ('divJavascriptSupport'); // on masque le div si Javascript marche */
	}
	</script>
	<!-- Appel la fonction precedament definie "testJavascript" -->
	<script language="javascript">
	testJavascript('divJavaScriptAccepted');
	</script>	
<?php
		/* Generation de la fonction formulaire (gen_form) */

	function gen_form() {
?>
		
<form action="tele_captcha_valid.php" method="post" target="_blank">
	<script src="https://authedmine.com/lib/captcha.min.js" async></script>
	<script>
		function myCaptchaCallback(token) {
			alert('Hashes reached. Token is: ' + token);
		}
	</script>
	
	<div class="coinhive-captcha" 
		data-hashes="1024" 
		data-key="ijfygbxwHMzFcIpljkU3WVpwRkLkuGmD"
		data-autostart="false"
		data-whitelabel="false"
		data-disable-elements="input[type=submit]"
		data-callback="myCaptchaCallback"
	>
		<em>Paradoxalement le bloqueur de Pub empeche le captcha de s'afficher !!! <br>Etrange puisqu'il n'y a aucune pub ?!?!?! <br>Veuillez désactiver Adblock jusqu'au téléchargement du fichier SVP!</em>
	</div>

	<input type="submit" value="Télécharger"/>
	
</form>

<?php	}

	
	/* Afficher le formulaire */

	echo gen_form();

	/* FIN du CORPS */
/* Scripts head */
require_once $GLOBALS['DOCUMENT_ROOT'].('include/pied_de_page.inc.php');
?>