<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_bandeau extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_bandeau(){
    $this->name = 'bandeau';
    $this->version = '1.1';     
    $this->description = 'modèle de bandeau';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  $sql = "('{$decomodele}', 'width','text',0,10,'','100%'),  
          ('{$decomodele}', 'height','spin',0,11,'0|200','0'),        
          ('{$decomodele}', 'alignement','list',0,12,'left|center|right','left'),        
          ('{$decomodele}', 'bgColor','color',0,13,'',''),
          ('{$decomodele}', 'image','image',0,14,'',''),        
          ('{$decomodele}', 'borderColorLight','color',0,20,'',''), 
          ('{$decomodele}', 'borderColorDark','color',0,20,'',''),               
          ('{$decomodele}', 'borderWidth','spin',0,30,'0|16','0'), 
          ('{$decomodele}', 'fontAlignement','list',0,60,'left|center|right','left'),               
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
  
  $lib = $options['caption'];
  //-------------------------------------------------------------
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  //her_displayArray($tDeco,"----- format_bandeau -----");
  if  ($tDeco['fontBold']   == 1) $lib = "<strong>{$lib}</strong>";
  if  ($tDeco['fontItalic'] == 1) $lib = "<i>{$lib}</i>";  
  
  $fStyle = array();
  $fs = $tDeco['fontSize']-2;
  if ($tDeco['fontName'] <> '') $fStyle[] = "face='{$tDeco['fontName']}'";
  if ($tDeco['fontSize'] <> 0)  $fStyle[] = "size='{$fs}'";  
  if ($tDeco['fontColor'] <> '') $fStyle[] = "color='#{$tDeco['fontColor']}'";
  
  $text = '<font '.implode(' ', $fStyle).">{$lib}</font>";   
  //if  ($tDeco['fontBold']   == 1) $text = "<b>{$text}</b>";
  //if  ($tDeco['fontItalic'] == 1) $text = "<i>{$text}</i>";  
  //----------------------------------------------------
  $t = array();
  $t[] = '';  
  //$t [] = "<table height='{$tDeco['height']}px' width='{$tDeco['width']}' align='{$tDeco['alignement']}'><tr>";  
  if ($tDeco['image'] == ''){
      $t [] = "<table width='{$tDeco['width']}' "
                     .(($tDeco['width'] > 0) ? "height='{$tDeco['height']}' " : '')
                     //."align='{$tDeco['alignement']}' "
                     ."border='{$tDeco['borderWidth']}px' "
                     ."bordercolorlight='#{$tDeco['borderColorLight']}' "
                     ."bordercolordark='#{$tDeco['borderColorDark']}' "
                     ."><tr>";
      //$t [] = "<td align='{$tDeco['fontAlignement']}'>{$text}</td>";  
      $t[] = "<td  "
                  ."bgcolor = '#{$tDeco['bgColor']}' "
                  ."align='{$tDeco['fontAlignement']}' "
                  ."valign='middle' "
                  .">{$text}</td>";  
      $t [] = "</tr></table>";  
  
  }else{
      $f = _HER_URL_IMG.$tDeco['image'];
      //echo "<hr>{$f}<hr>";
      $t [] = "<table width='{$tDeco['width']}' "
                     .(($tDeco['width'] > 0) ? " height='{$tDeco['height']}' " : '')
                     //."align='{$tDeco['alignement']}' "
                     ."border='{$tDeco['borderWidth']}px' "
                     ."bordercolorlight='#{$tDeco['borderColorLight']}' "
                     ."bordercolordark='#{$tDeco['borderColorDark']}' "
                     ." background='{$f}' "
                     ."><tr>";
    //$t [] = "<td align='{$tDeco['fontAlignement']}'>{$text}</td>";  
        $t[] = "<td  "
                    ."align='{$tDeco['fontAlignement']}' "
                    ."valign='middle' "
                    .">{$text}</td>";  
        $t [] = "</tr></table>";  
  
  }
  
                   
    /*
<font size="-2">aaaaaaaaaaa</font>
<br /><font size="-1">aaaaaaaaaaa</font>
<br /><font size="-0">aaaaaaaaaaa</font>
<br /><font size="+1">aaaaaaaaaaa</font>
<br /><font size="+2">aaaaaaaaaaa</font>
<br /><font size="+4">aaaaaaaaaaa</font>
<br /><font face="Verdana, Geneva, Arial, Helvetica, sans-serif"><em><strong><font color="#ff0000">aaaaaaaaaaa</font>
</strong>
</em>
</font>
<br />aaaaaaaaaaa<br />aaaaaaaaaaa<br />aaaaaaaaaaa<br />

*/  

  //$t[] = '<br><br><br><br>';
  //$t[] = '</p>'; 
  $t[] = '';  
   
  $r = implode ("\n", $t);
  
  //$r = "<pre>{$r}</pre>\n{$r}";
  return $r;
  
  


}







}// fin de la classe

?>