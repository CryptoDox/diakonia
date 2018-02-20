<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_decoration.php");

class cls_deco_image extends cls_decoration  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_deco_image(){
    $this->name = 'image';
    $this->version = '1.1';     
    $this->description = 'modèle de image';

}

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  create(){
   // cls_hermes_plugin::cls_hermes_plugin($options); 
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $decomodele = $this->name;
  $t = array();
  
  for ($h = 1; $h <= 5; $h++){
    $i = $h * 10;
    $g = $h;
    $t[] = "('{$decomodele}', 'image{$h}',     'image', {$g}, {$i}0, 'frise',''),"; 
    $t[] = "('{$decomodele}', 'alerte{$h}',    'text',  {$g}, {$i}1, '',''),";     
    $t[] = "('{$decomodele}', 'repetition{$h}','spin',  {$g}, {$i}2, '1|16','1'),";    
    $t[] = "('{$decomodele}', 'link{$h}',      'text',  {$g}, {$i}3, '',''),"; 
    $t[] = "('{$decomodele}', 'title{$h}',     'text',  {$g}, {$i}4, '',''),";
    $t[] = "('{$decomodele}', 'position{$h}',  'enum',  {$g}, {$i}5, 'top|bottom','0'),";            
  }
  
  //$t[] = "('{$decomodele}', 'bgColor','color',99,900,'',''),";
  $t[] = "('{$decomodele}', 'frame','frame',99,999,'','0'),";
  $t[] = "('{$decomodele}', 'intervale','enum',99,910,'Images horizontales jointes|Images horizontales disjointes|Images verticales jointes|Images verticales disjointes','0') ;";    
  
  //----------------------------------------------------------------  
  $sql = implode ("\n", $t); 
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------
   cls_decoration:: createModele($decomodele, $sql);
  //--------------------------------------------------  


}




/**************************************************************************
 *
 **************************************************************************/
function getTexte ($tDeco, $options){

  //her_displayArray($tDeco,"----- format_image -----");
  
    $t   = array();  
    $t[] = "<table border='0' align='center'><tr><td align='center'>"; 
    
    $tImg = array(); 
    for ($h = 1; $h <= 5; $h++){
      $key = "image{$h}";
      $alerte = "alerte{$h}";
      $title = "title{$h}";
      $position = "position{$h}";
            
      if ($tDeco[$key] =='' ) continue;
      
      
      $f = _HER_URL."images/".$tDeco[$key];  
      //$img = "<img src='{$f}' alert='{$tDeco['alert{$h}']}' border='0' align='center'>";   
      $img = "<img src='{$f}' alerte='{$tDeco[$alerte]}' title='{$tDeco[$alerte]}' border='0' align='center'>";  
      if ($tDeco[$title] <> ''){
        if ($tDeco[$position] == 0){      
            $img = $tDeco[$title].'<br>'.$img;
        }else{
            $img = $img.'<br>'.$tDeco[$title];        
        }
      }

          
      if ($tDeco["link{$h}"] <> ''){
        $link = $tDeco["link{$h}"];
        for ($i = 1; $i <= $tDeco["repetition{$h}"] ; $i++){
          $tImg[] = "<A href='{$link}' target='blank'>{$img}</A>";        
        }
      }else{
        for ($i = 1; $i <= $tDeco["repetition{$h}"] ; $i++){
          $tImg[] = $img;
        }
      }
    }
    //----------------------------------------
    switch ($tDeco['intervale']){
      case 1:
        $t[] = implode("</td><td align='center'>", $tImg);      
        break;
      
      case 2:
        $t[] = implode("<br>", $tImg);      
        break;
      
      case 3:
        $t[] = implode("</td><tr></tr><td align='center'>", $tImg);      
        break;
        
      default:
        $t[] = implode('', $tImg);      
        break;
    }
  
    //----------------------------------------      
    $t[] = "</td></tr></table>";   
    //$t[] = "<hr>";      
    
    $r   = implode ("\n", $t);     
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