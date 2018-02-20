<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
//  Original Author: Alphalogic <alphafake@hotmail.com>					     //
//  Original Author Website: http://www.alphalogic-network.de		         //
//  ------------------------------------------------------------------------ //
//  XOOPS Version made by: (XOOPS 1.3.x and 2.0.x version)			         //
//  Jan304 <http://www.jan304.org>									         //
//  ------------------------------------------------------------------------ //
//  Author:     tank                                                         //
//  Website:    http://www.customvirtualdesigns.com                          //
//  E-Mail:     tanksplace@comcast.net                                       //
//  Date:       12/15/2008                                                   //
//  Module:     Shoutbox                                                     //
//  File:       language/english/modinfo.php                                 //
//  Version:    4.05                                                         //
//  ------------------------------------------------------------------------ //
//  Change Log                                                               //
//  ***                                                                      //
//  Version 4.01 Initial CVD Release 10/05/2008                              //
//  ***                                                                      //
//  Version 4.02  11/01/2008                                                 //
//  New: Add captcha enable parameter text                                   //
//  New: Improve upon some of the text translations                          //
//  ***                                                                      //
//  Version 4.03  11/15/2008                                                 //
//  New: Eliminate local module copy of the captcha class                    //
//  New: Add preference parameter for setting/enabling wordwrap              //
//  New: Add preference parameter to enable/disable avatar display in block  //
//  New: Add Frameworks captcha support                                      //
//  ***                                                                      //
//  Version 4.04  12/01/2008                                                 //
//  New: Add selectable guest avatars                                        //
//  ***                                                                      //
//  Version 4.05  12/15/2008                                                 //
//  Bug Fix: Clean up a few minor typos                                      //
//  ***                                                                      //

// The name of this module
define("_MI_SHOUTBOX_NAME","Shoutbox");

// A brief description of this module
define("_MI_SHOUTBOX_DESC","Permet un bloc de tchat avec un popup optionnel.");

// Menu
define('_MI_SHOUTBOX_MENU_DB','Base de données');
define('_MI_SHOUTBOX_MENU_FILE','Fichier');
define('_MI_SHOUTBOX_MENU_STATUS','Etat');

// Names of blocks for this module (Not all module has blocks)
define("_MI_SHOUTBOX_BLOCK","Shoutbox");

// Categories
define("_MI_SHOUTBOX_CAT1","--- Paramètres généraux ---");
define("_MI_SHOUTBOX_PREF_CAT1","Paramètres généraux"); 
define("_MI_SHOUTBOX_CAT2","--- Paramètres du bloc ---");
define("_MI_SHOUTBOX_PREF_CAT2","Paramètres du bloc");
define("_MI_SHOUTBOX_CAT3","--- Paramètres PopUp ---");
define("_MI_SHOUTBOX_PREF_CAT3","Paramètres PopUp"); 
define("_MI_SHOUTBOX_CAT4","--- Paramètres de tchat ---");
define("_MI_SHOUTBOX_PREF_CAT4","Paramètres"); 

// Config language definitions...
define("_MI_SHOUTBOX_TITLE1", "Les anonymes peuvent poster ?"); 
define("_MI_SHOUTBOX_TITLE2", "Les anonymes peuvent choisir un pseudo :");
define("_MI_SHOUTBOX_DESC2", "Si les anonymes sont autorisés à poster, peuvent-ils choisir leur propre pseudo ?");
define("_MI_SHOUTBOX_TITLE3", "Autoriser le bbcode");
define("_MI_SHOUTBOX_DESC3", "Permettre aux utilisateurs d'utiliser le bbcode ? Exemple [b], [url=], etc..");
define("_MI_SHOUTBOX_TITLE4", "Format de date/heure");
define("_MI_SHOUTBOX_DESC4", "Quel format doivent avoir la date et l'heure des messages ? (<a href='http://www.php.net/manual/en/function.date.php' target='_blank'>Notice</a>)");
define("_MI_SHOUTBOX_TITLE5", "Purge");
define("_MI_SHOUTBOX_DESC5", "Nombre de messages conservés avant qu'une purge ne soit effectuée. (0 = pas de limite, faire attention à ce paramètre !!!)");
define("_MI_SHOUTBOX_TITLE6", "Maximum de messages affichés");
define("_MI_SHOUTBOX_DESC6", "Combien de messages au maximum doivent être affichés dans le tchat?");
define("_MI_SHOUTBOX_TITLE7", "Stockage");
define("_MI_SHOUTBOX_DESC7", "Indiquez la méthode de stockage des messages");
define("_MI_SHOUTBOX_OP7_F", "Fichier [csv]");
define("_MI_SHOUTBOX_OP7_D", "Base de données [mysql]");

define("_MI_SHOUTBOX_TITLE11","Afficher la liste des smileys dans le bloc ?"); 
define("_MI_SHOUTBOX_TITLE12", "Largeur de l'iframe contenant le tchat");
define("_MI_SHOUTBOX_DESC12", "Largeur de l'iframe affichée dans le bloc");
define("_MI_SHOUTBOX_TITLE13", "Hauteur de l'iframe contenant le tchat");
define("_MI_SHOUTBOX_DESC13", "hauteur de l'iframe affichée dans le bloc");
define("_MI_SHOUTBOX_TITLE14", "Largeur de la bordure de l'iframe (en pixels)");
define("_MI_SHOUTBOX_TITLE15", "PopUp activé");
define("_MI_SHOUTBOX_DESC15", "Les utilisateurs peuvent-ils utiliser le tchat dans un PoPup ?");
define("_MI_SHOUTBOX_TITLE16", "Affichage de l'option de rafraîchissement auto");
define("_MI_SHOUTBOX_DESC16", "Affiche l'option de rafraîchissement auto");
define("_MI_SHOUTBOX_OP16_BA0", "Ne pas afficher l'option de rafraîchissement auto");
define("_MI_SHOUTBOX_OP16_BA1", "Afficher l'option de rafraîchissement auto");
define("_MI_SHOUTBOX_TITLE17", "Découpage des messages");
define("_MI_SHOUTBOX_DESC17", "Cette valeur fixe la limite du nombre de caractères affichés par ligne dans le tchat.<br /> 0 indique qu'il n'y a pas de découpage automatique.");
define("_MI_SHOUTBOX_TITLE18", "Affichage des avatars");
define("_MI_SHOUTBOX_DESC18", "Indique si les avatars doivent être affichés dans le tchat.");
define("_MI_SHOUTBOX_TITLE19", "Avatar pour les anonymes");
define("_MI_SHOUTBOX_DESC19", "<table><tr>
                               <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest1.gif\" width=60></td>
                               <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest2.gif\" width=60></td>
							   <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest3.gif\" width=60></td>
							   <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest4.gif\" width=60></td>
							   <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest5.gif\" width=60></td>
							   </tr><tr>
							   <td>anonyme1</td>
                               <td>anonyme2</td>
							   <td>anonyme3</td>
							   <td>anonyme4</td>
							   <td>anonyme5</td>
							   </tr></table>");
define("_MI_SHOUTBOX_OP19_GA0", "Aucun");
define("_MI_SHOUTBOX_OP19_GA1", "anonyme1");
define("_MI_SHOUTBOX_OP19_GA2", "anonyme2");
define("_MI_SHOUTBOX_OP19_GA3", "anonyme3");
define("_MI_SHOUTBOX_OP19_GA4", "anonyme4");
define("_MI_SHOUTBOX_OP19_GA5", "anonyme5");

define("_MI_SHOUTBOX_TITLE31", "Afficher 'Qui est en ligne' ?"); 
define("_MI_SHOUTBOX_DESC31", "Affiche qui est en ligne dans le PoPup. Attention : Le bloc 'Qui est en ligne' doit être activé !"); 
define("_MI_SHOUTBOX_TITLE32", "Afficher la liste des smileys dans le PoPup"); 
define("_MI_SHOUTBOX_TITLE33", "Jouer un son lors d'un nouveau message ?"); 
define("_MI_SHOUTBOX_TITLE34", "Les anonymes peuvent utiliser le PoPup"); 
define("_MI_SHOUTBOX_DESC34", "Si le PoPup est activé, les anonymes peuvent l'utiliser ?"); 
define("_MI_SHOUTBOX_TITLE35", "Activer les fonctions IRC"); 
define("_MI_SHOUTBOX_DESC35", "Active les commandes IRC. Pour le moment 2 types (quit et nick) sont disponibles."); 
define("_MI_SHOUTBOX_TITLE36", "Auto-focus"); 
define("_MI_SHOUTBOX_DESC36", "Afficher automatiquement le PoPup au premier plan lorsqu'un nouveau message arrive."); 
define("_MI_SHOUTBOX_TITLE37", "Largeur du PoPup"); 
define("_MI_SHOUTBOX_DESC37", "Largeur par défaut (en pixels)"); 
define("_MI_SHOUTBOX_TITLE38", "Hauteur du PoPup"); 
define("_MI_SHOUTBOX_DESC38", "Hauteur par défaut (en pixels)"); 
define("_MI_SHOUTBOX_TITLE40", "Cellule de saisie des messages"); 
define("_MI_SHOUTBOX_DESC40", "Format de cellule de saisie des messages"); 
define("_MI_SHOUTBOX_OP40_TL", "Une seule ligne de texte");
define("_MI_SHOUTBOX_OP40_TA", "Zone de saisie multi-lignes");
define("_MI_SHOUTBOX_TITLE41", "Hauteur de la zone de texte"); 
define("_MI_SHOUTBOX_DESC41", "Hauteur de la zone de saisie<br />Appliquable seulement lorsque la zone de saisie est multi-lignes"); 
define("_MI_SHOUTBOX_TITLE42", "Largeur de la zone de texte"); 
define("_MI_SHOUTBOX_DESC42", "Largeur de la zone de saisie<br />Appliquable seulement lorsque la zone de saisie est multi-lignes"); 
define("_MI_SHOUTBOX_TITLE43", "Longueur d'une ligne de texte"); 
define("_MI_SHOUTBOX_DESC43", "En nombre de caractères"); 
define("_MI_SHOUTBOX_TITLE44", "Longueur maximum du texte"); 
define("_MI_SHOUTBOX_DESC44", "Longueur maximum du texte saisi en une seule fois"); 
define("_MI_SHOUTBOX_TITLE45", "Alerte du dépassement du nombre de caractères"); 
define("_MI_SHOUTBOX_DESC45", "Afficher une alerte lorsque la limite du nombre de caractères pour un message est atteinte "); 
define("_MI_SHOUTBOX_TITLE46", "Fonction Captcha"); 
define("_MI_SHOUTBOX_DESC46", "Activer la protection captcha (mesure anti-spam)"); 
define("_MI_SHOUTBOX_OP46_A", "Désactivé - Frameworks/captcha non trouvé");
define("_MI_SHOUTBOX_OP46_B", "Désactiver captcha");
define("_MI_SHOUTBOX_OP46_C", "Activer captcha (Frameworks)");
define("_MI_SHOUTBOX_OP46_D", "Activer captcha (Core)");
define('_MI_SHOUTBOX_EMPTY', '');
?>