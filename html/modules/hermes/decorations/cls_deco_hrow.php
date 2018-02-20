<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_hrow extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_hrow(){
    $this->name = 'hRow';
    $this->version = '1.1';     
    $this->description = 'modèle de ligne horizontale';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  
  $sql = "('{$decomodele}', 'color','color',0,10,'',''),
          ('{$decomodele}', 'drawWidth','spin',0,20,'0|16','0'),
          ('{$decomodele}', 'imgFrise','image',0,30,'frise','');";


   cls_decoration:: createModele($decomodele, $sql);
  //--------------------------------------------------  


}


/**************************************************************************
 *
 **************************************************************************/
function getTexte ($tDeco, $options){

  //her_displayArray($tDeco,"----- format_hRow -----");
  
  if ($tDeco['imgFrise'] == ''){
      $r = buildHr($tDeco['drawWidth'], $tDeco['color'], 0);  
  }else{
      $f = _HER_URL."images/".$tDeco['imgFrise'];
      //if ($tDeco['params'] <> '') $f .= $tDeco['params'].'/'; 
      
      //echo "<hr>{$f}<hr>";
      
      $t   = array();
      
      $t[] = "<table border='0'><tr><td align='center'>";
      $t[] = "<img src='{$f}'";      
      $t[] = "</td></tr></table>";   
      //$t[] = "<hr>";      
      
      $r   = implode ("\n", $t);     
  }

  return $r;


}






}// fin de la classe

?>