<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************

Module HERMES version 1.1.1pour XOOPS- Gestion de lettre de diffusion 
Copyright (C) 2007 Jean-Jacques DELALANDRE 
Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique G�n�rale GNU publi�e par la Free Software Foundation (version 2 ou bien toute autre version ult�rieure choisie par vous). 

Ce programme est distribu� car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but sp�cifique. Reportez-vous � la Licence Publique G�n�rale GNU pour plus de d�tails. 

Vous devez avoir re�u une copie de la Licence Publique G�n�rale GNU en m�me temps que ce programme ; si ce n'est pas le cas, �crivez � la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, +tats-Unis. 

Cr�eation juin 2007
Derni�re modification : septembre 2007 
******************************************************************************/

include_once ('../../../include/cp_header.php');
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."include/xoopscodes.php");
include_once ("../include/hermes_constantes.php");

if ( $xoopsUser ) {
	$xoopsModule = XoopsModule::getByDirname(_HER_DIR_NAME);
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
		redirect_header(XOOPS_URL."/",3,_AD_HER_NOPERM);
    exit();
	}
} else {
	redirect_header(XOOPS_URL."/",3,_AD_HER_NOPERM);
	exit();
}

//---------------------------------------------------------------------
include_once ('../include/hermes_constantes.php');
//echo "<hr>"._HER_JJD_PATH."<hr>";


include_once (_HER_JJD_PATH.'include/version.php');
include_once (_HER_JJD_PATH.'include/constantes.php');
include_once (_HER_JJD_PATH.'include/functions.php');
include_once (_HER_JJD_PATH.'include/html_functions.php');
include_once (_HER_JJD_PATH.'include/editor_functions.php');
include_once (_HER_JJD_PATH.'include/commonList.php');

include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php');
include_once (_HER_JJD_PATH.'include/spin/spin.php');

include_once (_HER_ROOT_PATH."include/hermes_data.php");
include_once (_HER_ROOT_PATH."include/hermes_buildLetter.php");




//include_once ("admin_doc.php");
include_once ('../include/hermes_data.php');





?> 
