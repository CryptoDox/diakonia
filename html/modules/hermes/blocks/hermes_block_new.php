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

//-----------------------------------------------------------------------------------
global $xoopsModule;

$f= dirname(dirname(__FILE__));
include_once ($f."/include/hermes_constantes.php");

//-----------------------------------------------------------------------------------

function hermes_show_new($options) {
	global $xoopsDB;
	$block = array();
	$numDef = $options[0];

	$sql = "SELECT idArchive, nom "
        ." FROM "._HER_TFN_ARCHIVE 
        ." WHERE test = 0"
        ." ORDER BY dateParution DESC LIMIT 0, {$options[0]}";
	$result = $xoopsDB->query($sql);
  // echo "<hr>{$sql}<hr>";
                            
	while($dic_def = $xoopsDB->fetcharray($result)) {
	 //echo "<hr>{$dic_def['idArchive']}-{$dic_def['nom']}<hr>";
		$def = array();
		$def['id'] = $dic_def['idArchive'];
		$def['name'] = $dic_def['nom'];
		
		$block['def'][] = $def;
	}
  return $block;
}


/************************************************************************
 *
 ************************************************************************/
 
function hermes_numDef_edit($options) {
	$form  = "";
/*
*/
	$form  = "<table border='0'>";
	$form .= "<tr><td>"._MB_HER_LAST_ARCHIVES."</td><td>";
	$form .= "<input type='text' name='options[0]' size='16' value='".$options[0]."'></td></tr>";
	$form .= "</td></tr>";
	$form .= "</table>";

	return $form;
}

?>
