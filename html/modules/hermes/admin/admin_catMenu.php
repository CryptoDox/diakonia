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

include_once ("admin_header.php");

//-----------------------------------------------------------------------------------
global $xoopsModule;
//include_once (dirname(__FILE__)."../include/hermes_constantes.php");
include_once (XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------

//define ('_HER_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/hermes/');
/************************************************************************
 *
 ************************************************************************/

function admin_adminMenu2 ($currentoption = 0, $breadcrumb = '' ) {

	include_once XOOPS_ROOT_PATH . '/class/template.php';

	// global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig;
	global $xoopsModule, $xoopsConfig;
/*
*/
	if (file_exists( _HER_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/modinfo.php')) {
		include_once  _HER_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/modinfo.php';
	} else {
		include_once  _HER_ROOT_PATH . 'language/english/modinfo.php';
	}
	if (file_exists( _HER_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/admin.php')) {
		include_once  _HER_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/admin.php';
	} else {
		include_once  _HER_ROOT_PATH . 'language/english/admin.php';
	}
	

 $configModule =  "<p>-&nbsp;<A HREF=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&op=showmod&mod=".$xoopsModule->getVar('mid')."\">"._AD_HER_CONFIGURATION_MODULE."</a><br></p>";	
	//-------------------------------------------------------------------------
	include 'menu.php';
	//-------------------------------------------------------------------------
	
	$tpl =& new XoopsTpl();
	$tpl->assign( 'configModule',$configModule);	
	
	$headermenu =array();
	
	$tpl->assign( array(	
	'headermenu'	=> $headermenu,
	'adminmenu'		=> $adminmenu,
	'current'		=> $currentoption,
	'breadcrumb'	=> $breadcrumb,
	'headermenucount' => count($headermenu)
	) );
	$tpl->display( 'db:hermes_catMenu.html' );
	//echo "<br />\n";
}

/************************************************************************
 *
 ************************************************************************/
function admin_xoops_cp_header2($onglet = 1)
{
	xoops_cp_header();

	?>
	<script type='text/javascript' src='funcs.js'></script>
	<script type='text/javascript' src='cookies.js'></script>
	<?php
	
	$link = "<a href='".XOOPS_URL."'>"._MI_HER_HOMEPAGE."</a>";
  admin_adminMenu2($onglet, $link);	

}

/************************************************************************
 *
 ************************************************************************/
function admin_xoops_cp_footer2()
{
  echo "</table>";  
  echo "</div></div>";


	xoops_cp_footer();	

}

?>
