<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_flagh extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_flagh(){
    $this->name = 'flagH';
    $this->version = '1.1';     
    $this->description = 'Frapeaud horizontal';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  $sql = "('{$decomodele}', 'width','text',0,08,'','650px'),  
          ('{$decomodele}', 'alignement','list',0,09,'left|center|right','center'),        
          ('{$decomodele}', 'height1','spin',0,10,'0|16','1'),
          ('{$decomodele}', 'bgColor1','color',0,11,'',''),
          ('{$decomodele}', 'height2','spin',0,20,'0|16','1'),
          ('{$decomodele}', 'bgColor2','color',0,21,'',''),
          ('{$decomodele}', 'height3','spin',0,30,'0|16','1'),
          ('{$decomodele}', 'bgColor3','color',0,31,'',''),
          ('{$decomodele}', 'height4','spin',0,40,'0|16','1'),
          ('{$decomodele}', 'bgColor4','color',0,41,'',''),
          ('{$decomodele}', 'height5','spin',0,50,'0|16','1'),
          ('{$decomodele}', 'bgColor5','color',0,51,'','');";

          
  //--------------------------------------------------
   cls_decoration:: createModele($decomodele, $sql);
  //--------------------------------------------------  


}


/**************************************************************************
 *
 **************************************************************************/
function getTexte ($tDeco, $options){

  //her_displayArray($tDeco, "----- format_flagH -----");
  $t = array();
  //----------------------------------------- 
  $t [] = "<table  width='{$tDeco['width']}' align='{$tDeco['alignement']}'"
         ." border='0' cellspacing='0' cellpadding='0'>";

  
  for ($h = 1; $h <= 5; $h++){
    $lh = "height".$h;
    $lc = "bgColor".$h;
    if ($tDeco[$lh] > 0){
      $t[] = "<tr><td height='{$tDeco[$lh]}' border='0' bgcolor = '#{$tDeco[$lc]}'></td></tr>";
    }
  }
  
  $t [] = "</table>";   
  //-----------------------------------------
  $r = implode("\n", $t);
  return $r;

}







}// fin de la classe

?>