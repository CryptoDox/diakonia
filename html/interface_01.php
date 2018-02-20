<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>

		<meta charset="utf-8" />
		<script src="http://code.jquery.com/jquery.js" type="text/javascript"></script>
		
		<LINK rel="stylesheet" type="text/css" href="../style.css">

		<title>Titre du site</title>
		<meta name="Description" content="Description du site"/>
		<meta name="author" content="Interface 01" />
		<meta name="Keywords" content="a, b, c"/>

		<SCRIPT TYPE="text/javascript">
			$(function() {
		
				$("#butFonctionAjax").click(function() {

					var form = $('#FormMonFormulaire01');
					var str = form.serialize();
					
					$.ajax( {
						type: "POST",
						url: 'AjaxTemplate02.php',
						data: str,
						success: function( response ) {
							$('#divAffichageResultat').html( response ); //Affichage de l'url cible, ici AjaxTemplate02.php, dans une DIV
							$('#status').text('Posté');
							//console.log( response );
						},
						error: function( response ) {
							$('#status').text('Erreur pour poster le formulaire : '+ response.status + " " + response.statusText);
							//console.log( response );
						}						
					} );
				});

			});	
		</SCRIPT>
		
	</HEAD>

	<BODY>

		<div id="bloc_page">
<?php

	//Tiré de http://www.siteduzero.com/informatique/tutoriels/les-magic-quotes-ou-guillemets-magiques/desactiver-les-magic-quotes
	//Cette option permet de retirer les magic quotes sur un serveur où c'est activé et où vous n'avez pas la main. C'est importante lorsque l'on poste récupère des valeurs de champs Input et textarea faute de quoi, par exemple, "C'est" deviendra "C\'est"
	function stripslashes_r($var) // Fonction qui supprime l'effet des magic quotes
	{
		if(is_array($var)) // Si la variable passée en argument est un array, on appelle la fonction stripslashes_r dessus
		{
			return array_map('stripslashes_r', $var);
		}
		else // Sinon, un simple stripslashes suffit
		{
			return stripslashes($var);
		}
	}

	if(get_magic_quotes_gpc()) // Si les magic quotes sont activés, on les désactive avec notre super fonction ! ;)
	{
		$_GET = stripslashes_r($_GET);
		$_POST = stripslashes_r($_POST);
		$_COOKIE = stripslashes_r($_COOKIE);
	}				
				
	echo "<FORM METHOD=\"POST\" id=\"FormMonFormulaire01\">\n";
	echo "<input type=\"text\" name=\"TxtChampInput01\" id=\"TxtChampInput01\" size=10 value=\"\" /><br />\n";
	echo "<input type=\"text\" name=\"TxtChampInput02\" id=\"TxtChampInput02\" size=10 value=\"\" /><br />\n";
	echo "</FORM>\n";				

	echo "<INPUT id=\"butFonctionAjax\" type=\"BUTTON\" value=\"Lancer fonction Ajax\"><br />\n";
	
	echo "<div STYLE=\"margin-left:auto; margin-right:auto; width:400px; position:relative; font-size:10pt; font-family:verdana; border: 2px black solid;\" id=\"divAffichageResultat\"></div>\n<br />";
	echo "<span id=\"status\"></span><br />\n";	
	
?>
		</div> <!-- div bloc_page -->
	</BODY>
</HTML>
