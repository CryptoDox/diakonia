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

// General settings
$op   = ((isset($_GET['op']))   ? $_GET['op']   : '');
$code = ((isset($_GET['code'])) ? $_GET['code'] : '');

$gif = (($op == 'ucs') | ($op == 'ucs_img' ));
//$gif = true;

if ($gif) header("Content-type: image/gif");
//header("Content-type: image/gif");

include_once ("header.php");
include_once ('class/cls_hermes_sondage.php');
//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/').
             "modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------
//include_once (_HER_JJD_PATH.'include/constantes.php');
include_once (_HER_JJD_PATH.'include/functions.php');
include_once (_HER_ROOT_PATH."include/hermes_data.php");


//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => ''),
              array('name' =>'idSondage', 'default' => 0),              
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");

//-------------------------------------------------------------

//-------------------------------------------------------------
/*

$vars = array(array('name' =>'op',        'default' => ''),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
*/
//-------------------------------------------------------------

function addVote($p, &$idSondage){

  $adoSondage = new cls_hermes_sondage;
  $params = $adoSondage->parseLinkParams($_GET['code']);
  //her_displayArray($params,"----- addVote -----"); 
  
  $adoSondage->addVote($params);
  
  $sondage = $adoSondage->getArray($params['idSondage']);
  //her_displayArray($sondage,"----- addVote -----");  
  
  $lib = "Vous venez de participer au sondage:<br><font color='#0000FF'>%1s</font><br><br>Nous vous remercions de votre confiance";
  $msg =sprintf($lib, $sondage['description']);
  
  $idSondage = $params['idSondage'];
  return $msg;
  
}

/********************************************************
 *
 ********************************************************/
function listSondage($p){
global $xoopsTpl,$xoopsUser,$xoopsDB,$xoopsModuleConfig;

  $myts =& MyTextSanitizer::getInstance();
include_once (_HER_ROOT_PATH.'class/cls_hermes_sondage.php');
$adoSondage = new cls_hermes_sondage();

    $filter = buildFilterGroupes();
    $sqlquery = $adoSondage->getArrays('categorie,nom', $filter);
    
    //$sqlquery = $adoSondage->getArrays('categorie,nom', "{grp} in (groupes)");
    //her_displayArray($sqlquery,"----- listSondage -----");
	//-----------------------------------------------------------------
	$xoopsTpl->assign('textintro', "texte d'inro des sondages");	
  $xoopsTpl->assign('urlSondage', _HER_URL.'sondage.php?op=show&idSondage=');	
  $xoopsTpl->assign('listSondages', $sqlquery); 
	

}

/********************************************************
 *
 ********************************************************/

function showSondage($idSondage){
global $xoopsTpl,$xoopsUser,$xoopsDB,$xoopsModuleConfig;

  $myts =& MyTextSanitizer::getInstance();
include_once (_HER_ROOT_PATH.'class/cls_hermes_sondage.php');
$adoSondage = new cls_hermes_sondage();

    $tSondage = $adoSondage->getArray($idSondage);
    $tReponse = $adoSondage->getResultats($idSondage, $totSomme, $totPourcentage);
    //her_displayArray($sqlquery,"----- listSondage -----");
	//-----------------------------------------------------------------
	$xoopsTpl->assign('textintro',   $tSondage['nom']);	
	$xoopsTpl->assign('description', $tSondage['description']);	
	
  //$xoopsTpl->assign('urlSondage', _HER_URL.'sondage.php?op=list');	
  $xoopsTpl->assign('listReponses', $tReponse); 
	
  $xoopsTpl->assign('totSomme', $totSomme);
  $xoopsTpl->assign('totPourcentage', $totPourcentage);
  
}

/**********************************************************
 *controleur
 **********************************************************/
$bolOk = ($op == 'list' OR $op == 'show');
//$bolOk = true;
if($bolOk){include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')."header.php");}
//----------------------------------------------------------

switch ($op){
 //---------------------------------------------------------------  
case 'list':
  $xoopsOption['template_main'] = 'hermes_listSondage.html';
  listSondage($gepeto);
  break;  

 //---------------------------------------------------------------
case 'show':
  $xoopsOption['template_main'] = 'hermes_showSondage.html';
  showSondage($idSondage);
  break;  
  
 //---------------------------------------------------------------
case 'vote':
  $msg = addVote($_GET, $idSondage);
 //---------------------------------------------------------------  
default:
  if ($idSondage <> 0){
    $source = _HER_URL."sondage.php?op=show&idSondage={$idSondage}";  
  }else{
    $source = XOOPS_URL."/index.php";  
  }
  

 $delai = 3;
 redirectTo($source, $msg, $delai);

  break;
}

//$bolOk=false;
//-------------------------------------------------------------  
if($bolOk){include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                          ."footer.php");}
//-------------------------------------------------------------

?>

