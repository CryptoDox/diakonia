<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_marquee extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_marquee(){
    $this->name = 'marquee';
    $this->version = '1.1';     
    $this->description = 'mod�le de marquee';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  $sql = "('{$decomodele}', 'behavior','list',0,10,'slide|alternate','slide'), 
          ('{$decomodele}', 'direction','list',0,20,'right|left|down|up','right'),        
          ('{$decomodele}', 'height','spin',0,30,'0|300',''),        
          ('{$decomodele}', 'loop','spin',0,40,'0|100','0'),        
          ('{$decomodele}', 'scrolldelay','spin',0,50,'0|100','10'),        
          ('{$decomodele}', 'width','spin',0,60,'0|600','0'),  
          ('{$decomodele}', 'bgcolor','color',0,70,'','0'),              
          ('{$decomodele}', 'fontName','text',0,80,'',''),  
          ('{$decomodele}', 'fontSize','fontSize',0,90,'',''),    
          ('{$decomodele}', 'fontColor','color',0,100,'',''),             
          ('{$decomodele}', 'fontBold','yesno',0,100,'','1'),
          ('{$decomodele}', 'fontItalic','yesno',0,120,'','0'),
          ('{$decomodele}', 'frame','frame',0,130,'','0');";
          
  //--------------------------------------------------
   cls_decoration:: createModele($decomodele, $sql);
  //--------------------------------------------------  


}



/**************************************************************************
 *
 **************************************************************************/
function getTexte ($tDeco, $options){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;  
  
  $lib = $options['caption'];
//------------------------------------------------



  $t = array();
  $t[] = "<marquee ";
  $t[] = "behavior='{$tDeco['behavior']}'";
  $t[] = "direction='{$tDeco['direction']}'";  
  if ($tDeco['height'] > 0) $t[] = "height='{$tDeco['height']}'"; 
  if ($tDeco['loop'] > 0) $t[] = "loop='{$tDeco['loop']}'";  
  if ($tDeco['scrolldelay'] > 0) $t[] = "scrolldelay='{$tDeco['scrolldelay']}'";  
  if ($tDeco['width'] > 0) $t[] = "width='{$tDeco['width']}'";  
  if ($tDeco['bgcolor'] <> '') $t[] = "bgcolor='#{$tDeco['bgcolor']}'";  
  //$t[] = ">{$lib}</font></marque>";  
  // $t[] = "bgcolor='#ff0000'";  
   
  $t[] = "><font";  
  if ($tDeco['fontName'] > 0)    $t[] = "name='{$tDeco['fontName']}'";  
  if ($tDeco['fontSize'] > 0)    $t[] = "size='{$tDeco['fontSize']}'";  
  if ($tDeco['fontColor'] <> '') $t[] = "color='#{$tDeco['fontColor']}'";  
  
  if ($tDeco['fontColor'] == 1){
    $b1 = "<b>";
    $b2 = "</b>";
  }else{
    $b1 = "";
    $b2 = "";
  }
  
  if ($tDeco['fontItalic'] == 1){
    $i1 = "<i>";
    $i2 = "</i>";
  }else{
    $i1 = "";
    $i2 = "";
  }
  

  
  $t[] = ">{$b1}{$i1}{$lib}{$i2}{$b2}</font></marquee>";
  
  
  $r = implode (' ', $t);
  //---------------------------------------------------
  if ($tDeco['frame'] <> 0) {
    //her_displayArray($params,"----- buildLetter_deco -----");
    $daoDeco = new cls_hermes_deco();
    $tpp = $daoDeco->getPPValues($tDeco['frame']);
    //her_displayArray($tpp, "----- format_marquee -----");  
    //$r = format_bandeau ($tpp, $r);
    $r = format_texte('', '', $r, 4, $tpp);
  }
  
  return $r;

}






}// fin de la classe

?>