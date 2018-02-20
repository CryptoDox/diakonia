<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_hardtext extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_hardtext(){
    $this->name = 'hardtext';
    $this->version = '1.1';     
    $this->description = 'modèle de texte brut';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  $sql = "('{$decomodele}', 'content','multiline',0,01,'12',''),
          ('{$decomodele}', 'type','list',0,02,'|css|html|text','');";

          
  //--------------------------------------------------
   cls_decoration:: createModele($decomodele, $sql);
  //--------------------------------------------------  


}


/**************************************************************************
 *
 **************************************************************************/
function getTexte ($tDeco, $options){
  
  $t = array();
  
  switch ($tDeco['type']){
    case 'css':
      //break;
    
    case 'html':
      //break;
    
    default:
      $t[] = $tDeco['content'];    
      break;
    
  }

  //-----------------------------------------
  $r = implode("\n", $t);
  return $r;

}







}// fin de la classe

?>