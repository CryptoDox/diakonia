<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_frame extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_frame(){
    $this->name = 'frame';
    $this->version = '1.3';     
    $this->description = 'modèle de frame';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  $sql = "('{$decomodele}', 'bgColor','color',0,10,'',''),
          ('{$decomodele}', 'borderWidth','spin',0,20,'0|16','1'),
          ('{$decomodele}', 'borderColorDark','color',0,30,'',''),
          ('{$decomodele}', 'borderColorLight','color',0,40,'',''),
          ('{$decomodele}', 'alignement','list',0,50,'left|center|right',''),
          ('{$decomodele}', 'width','text',0,60,'',''),      
          ('{$decomodele}', 'incrustation','spin',0,70,'0|16','0');";

   cls_decoration:: createModele($decomodele, $sql);
  //--------------------------------------------------  


}

/**************************************************************************
 *
 **************************************************************************/
function getTexte ($tDeco, $options){
    $caption    = 'caption';
    $nom        = 'nom';
    $content    = 'content';
    $affichage  = 255;
    $tStyle = $tDeco;



return format_texte ($caption, $nom, $content, $affichage, $tStyle);
}



}// fin de la classe

?>