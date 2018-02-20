<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************

Module HERMES version 1.1.1pour XOOPS- Gestion de lettre de diffusion 
Copyright (C) 2007 Jean-Jacques DELALANDRE 
Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique Générale GNU publiée par la Free Software Foundation (version 2 ou bien toute autre version ultérieure choisie par vous). 

Ce programme est distribué car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but spécifique. Reportez-vous à la Licence Publique Générale GNU pour plus de détails. 

Vous devez avoir reçu une copie de la Licence Publique Générale GNU en même temps que ce programme ; si ce n'est pas le cas, écrivez à la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, +tats-Unis. 

Créeation juin 2007
Dernière modification : septembre 2007 
******************************************************************************/



// Nav box admin Menu
$i=0;

$adminmenu[++$i]['title'] = _MI_HER_MANAGEMENT;
$adminmenu[$i]['link'] = "admin/index.php?onglet=0&op=";


$adminmenu[++$i]['title'] = _MI_HER_LETTERS;
$adminmenu[$i]['link'] = "admin/admin_lettre.php";

$adminmenu[++$i]['title'] = _MI_HER_STATISTIQUES;
$adminmenu[$i]['link'] = "admin/admin_stat.php?op=editAllStatistiques";

$adminmenu[++$i]['title'] = _MI_HER_TEXTES;
$adminmenu[$i]['link'] = "admin/admin_texte.php";

$adminmenu[++$i]['title'] = _MI_HER_SONDAGES;
$adminmenu[$i]['link'] = "admin/admin_sondage.php";

$adminmenu[++$i]['title'] = _MI_HER_DECOS;
$adminmenu[$i]['link'] = "admin/admin_deco.php";

$adminmenu[++$i]['title'] = _MI_HER_LIBELLES;
$adminmenu[$i]['link'] = "admin/admin_libelle.php";

$adminmenu[++$i]['title'] = _MI_HER_PLUGINS;
$adminmenu[$i]['link'] = "admin/admin_plugin.php";

$adminmenu[++$i]['title'] = _MI_HER_FILES;
$adminmenu[$i]['link'] = "admin/admin_fichier.php";

$adminmenu[++$i]['title'] = _MI_HER_MAILING_LISTE;
$adminmenu[$i]['link'] = "admin/admin_email.php";

/*
$adminmenu[++$i]['title'] = _MI_HER_FLUXRSS;
$adminmenu[$i]['link'] = "admin/admin_fluxrss.php";



$adminmenu[++$i]['title'] = _MI_HER_SYNDICATION;
$adminmenu[$i]['link'] = "admin/admin_syndication.php";


*/

$adminmenu[++$i]['title'] = _MI_HER_USERSTATUS;
$adminmenu[$i]['link'] = "admin/admin_log.php?op=userStatus";

$adminmenu[++$i]['title'] = _MI_HER_DOCUMENTATION;
$adminmenu[$i]['link'] = "admin/admin_doc.php?op=readDoc&numDoc=0";

$adminmenu[++$i]['title'] = _MI_HER_DEVELOPPEUR;
$adminmenu[$i]['link'] = "admin/admin_doc.php?op=readDoc&numDoc=3";

$adminmenu[++$i]['title'] = _MI_HER_LICENCE;
$adminmenu[$i]['link'] = "admin/admin_doc.php?op=readDoc&numDoc=1";

$adminmenu[++$i]['title'] = _MI_HER_HISTO;
$adminmenu[$i]['link'] = "admin/admin_doc.php?op=readDoc&numDoc=2";



/*

$adminmenu[++$i]['title'] = _MI_XOOPSOTRON_SETTINGS;
$adminmenu[$i]['link'] = "admin/settings.php";
*/


?>
