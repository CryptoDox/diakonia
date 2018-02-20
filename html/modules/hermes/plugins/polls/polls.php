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

class cls_polls extends cls_hermes_plugin {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_polls($options){
    cls_hermes_plugin::cls_hermes_plugin($options);
     
  $options = array ('moduleName'  => 'xoopspoll',
                    'version'     => '1.02.01',
                    'pluginName'  => _POLLS_NAME,
                    'description' => _POLLS_MODULE_DSC,
                    'header'      => _POLLS_HEADER,
                    'footer'      => _NEWS_ALL_POLLS,
                    'identifiant' => 200);                                              
    
  $tColDef = array (array('ordreQuestion',      _POLLS_QUESTION),
                    array('ordreDescription',   _POLLS_DESCRIPTION),
                    array('ordreDateDebut',     _POLLS_STARTTIME),
                    array('ordreDateFin',       _POLLS_ENDTIME) ,
                    array('ordreVotes',         _POLLS_VOTES));

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
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;


  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  $this->getProperty($tProperty);
  $tProperty['header'] = _POLLS_HEADER;
  $tProperty['footer'] = "<a href='".XOOPS_URL."/modules/xoopspoll'>"._NEWS_ALL_POLLS."</a>";
      
  
    $colName = array (_POLLS_QUESTION,
                      _POLLS_DESCRIPTION,                    
                      _POLLS_STARTTIME,                    
                      _POLLS_ENDTIME,                     
                      _POLLS_VOTES);  
  
  $myts =& MyTextSanitizer::getInstance();
  
  
    //---------------------------------------
  $nbEnr = $this->getRecordSet($params, $rst);
    $col = $this->setShowOrder($params);  
    //-------------------------------------------------------
    $tInfo = array();   
    $idCat = 0 ;
   $ok=true;
    
   //while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
  while (list ($key, $item) = each ($rst)) {
      $rupture = 0;
      $tt = array_merge($col);
      //------------------------------------------------------------------
      
      
      $tt['ordreQuestion']['value']     = $item['link'];
      $tt['ordreDescription']['value']  = $item['description'];
      $tt['ordreDateDebut']['value']    = $item['start_time'];
      $tt['ordreDateFin']['value']      = $item['end_time'];
      $tt['ordreVotes']['value']        = $item['votes'];
      //------------------------------------------------------------------
      $tt[_HER_CODE_RUPTURE]['value'] = "";
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      

      $tInfo[] = $tt ;
   
   }
   //------------------------------------------------------------
    
  //------------------------------------------- 
  return count($tInfo);   
  

}


/*************************************************************************
 *
 *************************************************************************/
function isHTML(){
  return method_exists(this, 'getLastInfoHTML');
}
/*************************************************************************
 *
 *************************************************************************/
function getLastInfoHTML(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){
  

     global $xoopsConfig, $xoopsDB;
    
  if (!$this->isOk()) return '';
  //-------------------------------------------------
  $tProperty['version'] = 1;  
  $tProperty['header'] = _POLLS_HEADER;
  $tProperty['footer'] = "<a href='".XOOPS_URL."/modules/xoopspoll'>"._NEWS_ALL_POLLS."</a>";
  
    $maxItem = $params['maxItem'];
    $t = array();
    
  if($maxItem > 1){$s_js ="s";}else{$s_js = "";}
  
  if($maxItem == 0){
       $t[] = "<center><br><br>"._POLLS_AUCUN." "._POLLS_DERNIERSS."</center><br><br>";
  }else{


    $t[] = "<table width='100%'><tr><td colspan='2'><p align='center'><b><font size='2'>"._LES.$maxItem." "._DERNIERSS."</font></b></td></tr><tr>\n";
    $t[] = "<td NOWRAP><font size='2' color='$textcolor1'><b>"._NUMTITRE."</b></font></td>\n";
    $t[] = "<td align='center' NOWRAP><font size='2' color='$textcolor1'><b>"._VOTES."</b></font></td>\n";
    $t[] = "</tr>\n";
    $textbody2_txt  .= _LES._DERNIERSS.":\r\n".$lig;
    $resultw2 = $xoopsDB->query("SELECT poll_id, question, start_time, votes FROM ".$xoopsDB->prefix("xoopspoll_desc")." ORDER BY start_time desc",$maxItem,0);
    $p=1;
    
    while(list($id, $title, $time, $hits)=$xoopsDB->fetchRow($resultw2)) {
        $couleur = ($p % 2) ? $coll = "$bgcolor1" : $coll = "$bgcolor2";
        
        $textbody2      .= "<tr bgcolor='".$coll."'><td NOWRAP><font size='2'>".$p." - <a style='color:".$textcolor2."' href=\"".XOOPS_URL."/modules/xoopspoll/pollresults.php?poll_id=".$id."\">".$title."</a></font></td><td align='center' NOWRAP><font size='2' color='$textcolor1'>".$hits."</font></td>\n</tr>\n";
        $t2[] = $title." - "._VOTES.": ".$hits."\r\n";
        $t2[] = "  ("._PPNEWS_URL.XOOPS_URL."/modules/xoopspoll/pollresults.php?poll_id=".$id." )\r\n\r\n";
        $p++;
    }
    $t[] = "<tr><td align='center' bgcolor='$bgcolor2' colspan='2'><font size='1'>- <a style='color:".$textcolor2."' href=\"".XOOPS_URL."/modules/xoopspoll/index.php\">"._TOUSLESSONDAGE."</a></font></td></tr>\n";
    $t[] = "</table><br><br>";

}
//-------------------------------------------------
     return implode ("", $t);

}//fin function


/*************************************************************************
 *
 *************************************************************************/

function getLastInfoTEXT(&$sHead, &$sFooter, &$tInfo, &$colName, $mode = 0 , $params = ''){
     global $xoopsConfig, $xoopsDB, $format_mail, $lig, $bgcolor2, $bgcolor1, $textcolor1,$textcolor2, $prefix;

  if (!$this->isOk()) return '';    
  //--------------------------------------------
    $maxItem = $params['maxItem'];
    $t1 = array();
    $t2 = array();    
    
if($maxItem > 1){$s_js ="s";}else{$s_js = "";}

if($maxItem == 0){
     $t[] = "\r\n\r\n"._AUCUN." "._DERNIERSS." \r\n\r\n";
}else{

    
    $t[] = _LES._DERNIERSS.":\r\n".$lig;
    $resultw2 = $xoopsDB->query("SELECT poll_id, question, start_time, votes FROM ".$xoopsDB->prefix("xoopspoll_desc")." ORDER BY start_time desc",$maxItem,0);
    $p=1;
    while(list($id, $title, $time, $hits)=$xoopsDB->fetchRow($resultw2)) {
        $t[] = $title." - "._VOTES.": ".$hits."\r\n";
        $t[] = "  ("._PPNEWS_URL.XOOPS_URL."/modules/xoopspoll/pollresults.php?poll_id=".$id." )\r\n\r\n";
        $p++;
    }
        $t[] = "\r\n\r\n";
    
}
//-------------------------------------------------
     return implode("", $t);
}//fin function




/******************************************************
 *
 ******************************************************/

function getRecordSet(&$params, &$tInfo){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  $myts =& MyTextSanitizer::getInstance();
  

    //---------------------------------------
    $sql = "SELECT poll_id, question, description, start_time, end_time, votes FROM "
          .$xoopsDB->prefix("xoopspoll_desc")
          ." ORDER BY weight, start_time desc";

    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $numEnr = $xoopsDB->getRowsNum($sqlquery);


    //-------------------------------------------------------
    $tInfo = array();   
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $title = $myts->makeTareaData4Show($sqlfetch['question']);
      $sqlfetch ['link'] = "<a href=\"".XOOPS_URL."/modules/xoopspoll/pollresults.php?poll_id={poll_id}\">{$title}</a>";
      $sqlfetch ['description'] = $myts->makeTareaData4Show($sqlfetch['description']) ;                      
      $sqlfetch ['start_time'] = date(_POLLS_DATE, $sqlfetch['start_time']) ;                      
      $sqlfetch ['end_time'] = date(_POLLS_DATE, $sqlfetch['end_time']);                      
      
      $tInfo[] = $sqlfetch; 
   }
   //------------------------------------------------------------
    
  //------------------------------------------- 
  return count($tInfo);   
  

}

//----------------------------------------

} // fin de la classe

?>
