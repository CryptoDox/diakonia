<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_flagv extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_flagv(){
    $this->name = 'flagV';
    $this->version = '1.1';     
    $this->description = 'modèle de drapeaud vertcal';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  $sql = "('{$decomodele}', 'height','spin',0,01,'0|255','32'),
          ('{$decomodele}', 'width','text',0,02,'','100%'),
          ('{$decomodele}', 'alignement','list',0,03,'left|center|right','center'),                
          ('{$decomodele}', 'bgColor1','color',0,11,'',''),
          ('{$decomodele}', 'bgColor2','color',0,21,'',''),
          ('{$decomodele}', 'bgColor3','color',0,31,'',''),
          ('{$decomodele}', 'bgColor4','color',0,41,'',''),
          ('{$decomodele}', 'bgColor5','color',0,51,'',''),
          ('{$decomodele}', 'fontName','text',0,60,'',''),  
          ('{$decomodele}', 'fontSize','fontSize',0,70,'',''),    
          ('{$decomodele}', 'fontColor','color',0,80,'',''),             
          ('{$decomodele}', 'fontBold','yesno',0,90,'','1'),
          ('{$decomodele}', 'fontItalic','yesno',0,100,'','0');";

          
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
  //$t[] = "<div width='{$tDeco['width']}'>";
  $t [] = "<table height='{$tDeco['height']}px' width='{$tDeco['width']}' align='{$tDeco['alignement']}'><tr>";
  
  for ($h = 1; $h <= 5; $h++){

    $lc = "bgColor".$h;
    if ($tDeco[$lc] <> '' & strtolower($tDeco[$lc]) <> 'color'){
      $t[] = "<td  height='{$tDeco['height']}px' border='0' bgcolor = '#{$tDeco[$lc]}'></td>";
    }
  }
  
  $t [] = "</tr></table>";   
  //$t [] = "</div>";  
  //-----------------------------------------
  $r = implode("\n", $t);
  return $r;

}







}// fin de la classe

?>