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

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_hermes_plugin.php");

class cls_Lex_Termes extends cls_hermes_plugin {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_Lex_Termes($options){

  cls_hermes_plugin::cls_hermes_plugin($options); 
    
  $options = array ('moduleName'  => 'lexique',
                    'version'     => '1.02.01',
                    'pluginName'  => _LEXIQUE_NEWENTRY,
                    'description' => _LEXIQUE_LASTTERMES,
                    'header'      => '',
                    'footer'      => '',
                    'identifiant' => 200);                                              
    
  $tColDef = array (array('ordreTerme',             _LEXIQUE_TERME),
                    array('ordreShortDef',          _LEXIQUE_SHORTDEF),
                    array('ordreDefinition1',       _LEXIQUE_DEFNITION1),                    
                    array('ordreLexique',           _LEXIQUE_LEXIQUE),
                    array('ordreDateModification',  _LEXIQUE_DATEMODIFICATION));
  

  $this->init($options, $tColDef);                                              
  return $this->isOk();


  }
  
  
/*************************************************************************
 *
 *************************************************************************/
function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------
  $params = array ();
                  
                 
  //-------------------------------------------------------------
  cls_hermes_plugin::buildInfoPluggin($tProperty, $params, $this->tColDef);
    return $this->isOk();                  

}

/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){
	global $xoopsModuleConfig, $xoopsDB;
	
  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  $this->getProperty($tProperty);
  $tProperty['header'] = _LEXIQUE_LASTTERMES;
  $tProperty['footer'] = 'Créer par JJD';  
  
    
  $colName = array ();
  $nbEnr = $this->getRecordSet($params, $rst);
  $col = $this->setShowOrder($params);  
    //-------------------------------------------------------
    $tInfo = array();   
    $idCat = 0 ;
   $ok=true;
    $rupture = 0;
   //while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
  while (list ($key, $item) = each ($rst)) {


      //----------------------------------------------------
      $tt = array_merge($col);
      //echo "<hr>";
      //displayArray2($tt, "----- avant -----");      
      //----------------------------------------------------      
      
      //$tt = array($col);
      //displayArray($tt, "----- setOrder -----");      
                                              
      $tt['ordreTerme']['value']            = $item['linkTerme'];
      $tt['ordreShortDef']['value']         = $item['shortDef'];
      $tt['ordreDefinition1']['value']      = $item['definition1'];      
      $tt['ordreLexique']['value']          = $item['linkLexique'];
      $tt['ordreDateModification']['value'] = $item['dateModification'];
      //------------------------------------------------------------------
      $tt[_HER_CODE_RUPTURE]['value'] = "<b><font size='{$params['catSize']}'>{$item['linkLexique']}</font></b>";
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      

      //---------------------------------------------------------------
      $tInfo[] = $tt;   
      //**************************************************************   
   
   }
   //-------------------------------------------------------------
  return count($tInfo);   
  
}
/*************************************************************************
 *permet de flaguer les enregistrement déjà utiliser dans les lettres de diffusion
 *************************************************************************/
function flagLastInfo($mode = 2,$oldValue = 0, $newValue = 1){
	global $xoopsModuleConfig, $xoopsDB;


   
   //-------------------------------------------------------------
   //echo "<hr>mode ========> {$mode}<hr>";
   if ($mode == 2){
      $sql = "UPDATE ".$xoopsDB->prefix('lex_terme')
            ." SET dateState = {$value}' "
            ." WHERE dateState = {$oldValue} " ;	 
     
      $xoopsDB->queryF($sql);   
   
   }
    
  //------------------------------------------- 
  return 0;   
   
}//fin flagLastInfo
/******************************************************
 *
 ******************************************************/

function getRecordSet(&$params, &$tInfo){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  $myts =& MyTextSanitizer::getInstance();
  


  //---------------------------------------
  //  calcul de la date de référence
  //---------------------------------------                    
  $ts = dateAdd(time() , 0, -$params['periode'], 0, true, true);
  
  //---------------------------------------
    $sql = "SELECT terme.*, lexique.name as nomLexique FROM "
          .$xoopsDB->prefix('lex_terme')." as terme "
          ."INNER JOIN ".$xoopsDB->prefix('lex_lexique')." as lexique "
          ." ON terme.idLexique = lexique.idLexique "
          ." WHERE  terme.dateCreation >= '{$ts}'  "
          ." ORDER BY lexique.name, terme.name ";

    //-------------------------------------------------------
    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $numEnr = $xoopsDB->getRowsNum($sqlquery);


    //-------------------------------------------------------
    $tInfo = array();   
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {

      $idTerme = $sqlfetch['idTerme'];
      
      $linkTerme = XOOPS_URL."/modules/lexique/detail.php?id=".$idTerme;
      $sqlfetch['linkTerme'] = "<A href={$linkTerme} target=blank>{$sqlfetch['name']}</A>";
      
      $linkLexique = XOOPS_URL."/modules/lexique/lexique.php?idLexique=".$sqlfetch['idLexique'];
      $sqlfetch['linkLexique'] = "<A href={$linkLexique} target=blank>{$sqlfetch['nomLexique']}</A>";
   
      $sqlfetch['definition1']  = $myts->previewTarea($sqlfetch['definition1'],1,0,0,0,0);   
      $sqlfetch['dateCreation'] = date(_AD_HER_SQL_DATE, $sqlfetch['dateCreation']) ; 
      $sqlfetch['dateModification'] = date(_AD_HER_SQL_DATE, $sqlfetch['dateModification']) ;
                 
      
      $tInfo[] = $sqlfetch; 
   }
   //------------------------------------------------------------
    
  //------------------------------------------- 
  return count($tInfo);   
  

}


} //fin de la classe

?>
