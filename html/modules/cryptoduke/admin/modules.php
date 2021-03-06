<?php 
/**
 * ****************************************************************************
 *  - CryptoDuke By CryptoDuke   - DEV MODULE FOR XOOPS
 *  - Licence Copyright (c) 2016 (https://elduke3d.shost.ca)
 *
 * Cette licence, contient des limitations!!!
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license     CryptoDuke Copyright (c) license
 * @author		CryptoDuke TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
include '../../../include/cp_header.php'; 
include_once("../include/functions.php");
include_once XOOPS_ROOT_PATH.'/modules/cryptoduke/class/cryptoduke_modules.php';

xoops_cp_header();
//appele du menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
CryptoDuke_adminmenu(1, _AM_CRYPTODUKE_MANAGER_MODULES);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (1,_AM_CRYPTODUKE_MANAGER_MODULES);
}

if (isset($_REQUEST['op'])) {
	$op = $_REQUEST['op'];
} else {
	@$op = 'default';
}

//load class
$modulesHandler =& xoops_getModuleHandler('cryptoduke_modules', 'CryptoDuke');

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/deco/modules.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;  height: 48px;"><strong>'._AM_CRYPTODUKE_MANAGER_MODULES.'</strong>';
echo '</div><br />';
?>

<script src="../../../jquery/jquery-3.2.1.js" type="text/javascript"></script>

		<SCRIPT TYPE="text/javascript">
			$(function() {

				$("#sendFonctionAjax").click(function() {
					$('#status').text('Encodage des données');

					var varValeurChampInput01 = $("#TxtChampInput01").val();
					var varValeurChampInput02 = $("#TxtChampInput02").val();
					
					if (varValeurChampInput01.length > 0){
						// $('#status').text('ArticleId : ' + varValeurChampInput01);
						
						$('#divAffichageResultat').load('../include/fonction_cryptoduke.inc.php', { Data_01:varValeurChampInput01, Data_02:varValeurChampInput02 }, function( response, status, xhr ) {
							if ( status == "error" ) {
								var msg = "Sorry but there was an error: ";
								// alert(msg);
								$( "#divAffichageResultat" ).html( msg + xhr.status + " " + xhr.statusText );
							}
							else{ //success espéré
								$('#status').text('Cryptage des données : ' + status);
							}
						});

					}
					else{
						$('#status').text('Pas de valeur indiquée dans le champ de saisi 01');
					}

				});

			});
		</SCRIPT>
		<SCRIPT TYPE="text/javascript">
			$(function() {

				$("#sendFonctionAjax1").click(function() {
					$('#status').text('Décodage des données');

					var varValeurChampInput01 = $("#TxtChampInput01").val();
					var varValeurChampInput02 = $("#TxtChampInput02").val();
					
					if (varValeurChampInput01.length > 0){
						// $('#status').text('ArticleId : ' + varValeurChampInput01);
						
						$('#divAffichageResultat').load('../include/fonction_cryptoduke.inc.php', { Data_03:varValeurChampInput01, Data_04:varValeurChampInput02 }, function( response, status, xhr ) {
							if ( status == "error" ) {
								var msg = "Sorry but there was an error: ";
								// alert(msg);
								$( "#divAffichageResultat" ).html( msg + xhr.status + " " + xhr.statusText );
							}
							else{ //success espéré
								$('#status').text('Décryptage des données : ' + status);
							}
						});

					}
					else{
						$('#status').text('Pas de valeur indiquée dans le champ de saisi 01');
					}

				});

			});
		</SCRIPT>
		
	</HEAD>

	<BODY>

		<div id="bloc_page">
<?php 

	/* Tiré de http://www.siteduzero.com/informatique/tutoriels/les-magic-quotes-ou-guillemets-magiques/desactiver-les-magic-quotes
	Cette option permet de retirer les magic quotes sur un serveur où c'est activé et où vous n'avez pas la main. C'est importante lorsque l'on poste récupère des valeurs de champs Input et textarea faute de quoi, par exemple, "C'est" deviendra "C\'est" */
	function stripslashes_r($var) /* Fonction qui supprime l'effet des magic quotes */
	{
		if(is_array($var)) /* Si la variable passée en argument est un array, on appelle la fonction stripslashes_r dessus */
		{
			return array_map('stripslashes_r', $var);
		}
		else /* Sinon, un simple stripslashes suffit */
		{
			return stripslashes($var);
		}
	}

	if(get_magic_quotes_gpc()) /* Si les magic quotes sont activés, on les désactive avec notre super fonction ! ;) */
	{
		$_GET = stripslashes_r($_GET);
		$_POST = stripslashes_r($_POST);
		$_COOKIE = stripslashes_r($_COOKIE);
	}
	echo "<h2 style=\"text-align: center; color: #022287;\">Interface d'encodage/décodage CryptoDuke 1.1</h2>";
	echo "<br />";
	echo "<hr />";
	echo "<br />";
	echo "<span style=\"color: #FC0004\">Clef de Cryptage:</span><br />";
	echo "<input type=\"text\" name=\"TxtChampInput01\" id=\"TxtChampInput01\" size=200 value=\"\" /><br />\n";
	echo "<br />";
	echo "<span style=\"color: #FC0004\">Données à Crypter ou à DéCrypter:</span><br />";
	echo "<input type=\"text\" name=\"TxtChampInput02\" id=\"TxtChampInput02\" size=300 value=\"\" /><br />\n";
	echo "<br />";
	echo "<INPUT id=\"sendFonctionAjax\" type=\"BUTTON\" value=\"Encoder les données\">";
	echo "<INPUT id=\"sendFonctionAjax1\" type=\"BUTTON\" value=\"Décoder les données\"><br />\n";
	echo "<br />";
	echo "<hr />";
	echo "<br />";
	echo "<br />";
	echo "<div STYLE=\"margin-left:auto; margin-right:auto; width:1800px; position:relative; font-size:12pt; font-family:verdana; border: 2px black solid;\" id=\"divAffichageResultat\"></div>\n<br />";
	echo "<span id=\"status\"></span><br />\n";
	
xoops_cp_footer();
?>