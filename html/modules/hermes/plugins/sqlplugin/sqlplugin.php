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
class cls_sqlplugin extends cls_hermes_plugin {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/
  
  
/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_sqlplugin($options){

    cls_hermes_plugin::cls_hermes_plugin($options); 
    
  $options = array ('moduleName'  => 'hermes',
                    'version'     => '1.02.01',
                    'pluginName'  => _HERSQL_NAME,
                    'description' => _HERSQL_PLUGIN_DSC,
                    'header'      => '',
                    'footer'      => '',
                    'identifiant' => 0);                                              
  
/*
  
  $tColDef = array (array('col_title',          _HERRSS_TITLE),
                    array('col_author',         _HERRSS_AUTHOR),
                    array('col_pubDate',        _HERRSS_PUBDATE),
                    array('col_description',    _HERRSS_DESCRIPTION),
                    array('col_img',            _HERRSS_IMAGE),
                    array('col_guid',           _HERRSS_GUID)                    
                    );
*/ 
  $tColDef = array ();

  $this->init($options, $tColDef);    
  return $this->isOk();
    
  
}
  

/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------         



  $params = array ('header' =>        array('name'  => _HERSQL_HEADER, 
                                      'value'       => '', 
                                      'description' => _HERSQL_HEADER_DSC,
                                      'type'        => _HER_TYPE_PARAMS_VARCHAR),
                                      
                  'footer' => array('name'        => _HERSQL_FOOTER, 
                                      'value'       => '', 
                                      'description' => _HERSQL_FOOTER_DSC,
                                      'type'        => _HER_TYPE_PARAMS_VARCHAR),
                                      
                  'query' => array('name'        => _HERSQL_QUERY, 
                                      'value'       => '', 
                                      'description' => _HERSQL_QUERY_DSC,
                                      'type'        => _HER_TYPE_PARAMS_TEXT),
                                      
                  'hasRupture' => array('name'        => _HERSQL_RUPTURE, 
                                      'value'       => '', 
                                      'description' => _HERSQL_RUPTURE_DSC,
                                      'type'        => _HER_TYPE_PARAMS_LIST,
                                      'list'        => _AD_HER_NOYES)
                                      
                );
/*

define('_HER_TYPE_PARAMS_BALISE',     -1);
define('_HER_TYPE_PARAMS_VARCHAR',    0);//---nom - valeur en direct du plugin
define('_HER_TYPE_PARAMS_SPIN',       1);//c'est un spin
define('_HER_TYPE_PARAMS_LIST',       2 );//c'est une liste de libele dont le numéro d'ordre est atomatique 
define('_HER_TYPE_PARAMS_TEMPLATE',   3);//c'est un template affiche la lsite des template du module + les g‚n‚riques
define('_HER_TYPE_PARAMS_AFFICHAGE',  4);//options d'affichage
define('_HER_TYPE_PARAMS_TEXT',       5);//zone de texte
define('_HER_TYPE_PARAMS_TITLE',      10);//c'est un titre    

*/
/* requete de test

SELECT mid AS identifiant, name AS nom ,version,last_update AS `mise a jour`, 
if(isactive=1,'module actif','module inactif') AS etat ,dirname as dossier
FROM @.modules
ORDER BY name

*/






  //-------------------------------------------------------------
  cls_hermes_plugin::buildInfoPluggin($tProperty, $params, $this->tColDef);
  return $this->isOk();                  
}

/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  $myts =& MyTextSanitizer::getInstance();  
  //displayArray($params,"-----  -----");
  if (!$this->isOk()) return 0;	
  //----------------------------------------------
	$tProperty['header'] = $params['header'];  
  $tProperty['footer']     = $params['footer'];  
  
  
  $colName = '';
  $sql = str_replace('@.', $xoopsDB->prefix('').'_', $params['query']);
  
  
  //recherhe de la colonne de rupture pour categorie si elle existe
  $bRupture =($params['hasRupture'] == 1) ;  
  //echo "<hr>sql : <br>hasRupture = {$params['hasRupture']}<br>{$sql}<hr>";
  
  if ($bRupture){
    //$clause = ' ORDER BY ';
    $clause = 'ORDER BY';    
    
    $h = strpos($sql, $clause);  
    //echo "position = {$h}<br>{$sql}<br>{$clause}<br>";
    if ($h === false){
      $bRupture = false ;     
    }else{
      $h += strlen($clause)+1;
      $cols = substr($sql, $h);
      //echo "col = {$cols}<br>";
      
      $t = explode(',', $cols);
      $colRupture = trim($t[0]);
      $params['ruptureMaitre'] = 1;
    }
  }
  
/*
  
  $colRupture = trim($params['rupture']);  
  $bRupture =($colRupture <> '' ) ;  
  if ($bRupture){
    $h = strpos($sql, $colRupture);
    if ($h === false){
      //ajout de la rupture dans le 'order by'
      $sql = str_replace('ORDER BY ', "ORDER BY {$colRupture},", $sql);    
    }
  }
*/  
 
    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    //echo "<hr>nbenr = {$nbEnr}<br>{$sql}<br>$ts<hr>";
    $tInfo = array();
    $level = 3;
    $rupture = 0;
    $oldRupture = '';
    $catid = 1;
    $property['show_categorie'] = 1;
    //-------------------------------------------------------
   
   //complete les enregsitre pardesinfoc constuite, lien notamment  
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $tt = array();      
      if ($bRupture){
        if ($oldRupture <> $sqlfetch[$colRupture]){
          $oldRupture = $sqlfetch[$colRupture];
          //echo "<hr>{$colRupture} ---> rupture = {$oldRupture}<br>";
          $rupture = $catid++; 
        }else{
          //rupture = 0;        
        }      
      }

            
      while (list($key, $item) = each($sqlfetch) ) {
          if ($bRupture & $key==$colRupture) continue;
          $enr = array();
          $enr['name']   = $key;    
          $enr['value']  = $item;     
          $enr['type']   = 1;
          $enr['min']    = 0;      
          $enr['max']    = 999;
          $enr['order']    = 1;         
          $enr['level']  = $level;
          //------------------------------------------------------------------      
          $tt[$key] = $enr;                 
      }  
      //-------------------------------------------     
      /*

          $enr = array();
          $enr['name']   = 'rupture';    
          $enr['value']  = $rupture.'-'.$oldRupture;     
          $enr['type']   = 1;
          $enr['min']    = 0;      
          $enr['max']    = 999;
          $enr['order']    = 1;         
          $enr['level']  = $level;
          //------------------------------------------------------------------      
          $tt[$key] = $enr;                 
      */      
       
      //-------------------------------------------      
      $tt[_HER_CODE_RUPTURE]['value']   = $oldRupture;
      $tt[_HER_CODE_RUPTURE]['order']   = 0;      
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;
            
      $tInfo[] = $tt;      
   
   }

   
  //---------------------------------------
  



  //------------------------------------------- 
  return count($tInfo);   
  

   
}




//---------------------------------------------------------------------------
} // fin de la classe


//****************************************************************************/

?>



