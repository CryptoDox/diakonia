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

class cls_mydownloads extends cls_hermes_plugin {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/


/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_mydownloads($options){

  cls_hermes_plugin::cls_hermes_plugin($options);
    
  $options = array ('moduleName'  => 'mydownloads',
                     'version'     => '1.02.01',
                     'pluginName'  => _MYDOWNLOADS_NAME,
                     'description' => _MYDOWNLOADS_MODULE_DESCRIPTION,
                     'header'      => _MYDOWNLOADS_HEADER,
                     'footer'      => _MYDOWNLOADS_ALL_DOWNLOAD,
                     'identifiant' => 160);
    
  $tColDef = array (array('ordreTitle',       _MYDOWNLOADS_TITLE),
                    array('ordreHomepage',    _MYDOWNLOADS_HOMEPAGE),
                    array('ordreVersion',     _MYDOWNLOADS_VERSION ),
                    array('ordreDate',        _MYDOWNLOADS_DATE) ,
                    array('ordreDescription', _MYDOWNLOADS_DESCRIPTION));

    
     
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
  	//---------------------------------------
  $this->getProperty($tProperty);
  $tProperty['header'] = _MYDOWNLOADS_HEADER;
  $tProperty['footer'] = "<a href=\"".XOOPS_URL."/modules/mydownloads/index.php\">"._MYDOWNLOADS_ALL_DOWNLOAD."</a>";

  $colName = '';
  
  $myts =& MyTextSanitizer::getInstance();
  
    
      //---------------------------------------
      $sql = "SELECT d.lid, d.cid, d.title, d.url, d.homepage, "
            ."d.version, d.size, d.platform, d.logourl, d.status, "
            ."d.date, d.hits, d.rating, d.votes, d.comments, t.description FROM "
            .$xoopsDB->prefix("mydownloads_downloads")." d, "
            .$xoopsDB->prefix("mydownloads_text")." t "
            ." WHERE d.status>0 AND d.lid=t.lid ORDER BY date DESC";
  
      $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
      $numEnr = $xoopsDB->getRowsNum($sqlquery);
      $col = $this->setShowOrder($params); 
  
      //-------------------------------------------------------
      $tInfo = array();   
     while ($sqlFetch = $xoopsDB->fetchArray($sqlquery)) {
        $title = $myts->makeTareaData4Show($sqlFetch['question']);
        $link = "<a href=\"".XOOPS_URL."/modules/mydownloads/singlefile.php?lid={$sqlFetch['lid']}\">{$sqlFetch['title']}</a>";
        $description = $myts->makeTareaData4Show($sqlFetch['description']);  
       //------------------------------------------------------------
         //----------------------------------------------------
        $tt = array_merge($col);
        //------------------------------------------------------------------
        $tt['ordreTitle']['value']        =  $link;
        $tt['ordreHomepage']['value']     =  $description;
        $tt['ordreVersion']['value']      =  date(_MYDOWNLOADS_FORMATDATE, $sqlFetch['date']);
        $tt['ordreDate']['value']         =  $sqlFetch['version'];
        $tt['ordreDescription']['value']  =  $sqlFetch['homepage'];
        //------------------------------------------------------------------
        $tt[_HER_CODE_RUPTURE]['value'] = "<b><font size='{$params['catSize']}'>{$item['linkTopic']}</font></b>";
        $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      
  
        //---------------------------------------------------------------
        $tInfo[] = $tt;   
        //**************************************************************   
    }    
      
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
  global $xoopsConfig, $xoopsDB, $format_mail, $lig, $bgcolor2, $bgcolor1, $textcolor1,$textcolor2, $prefix;  

  if (!$this->isOk()) return false;
  //---------------------------------------------------------
  $tProperty['version'] = 1;  
  $tProperty['header'] = _MYDOWNLOADS_HEADER;
  $tProperty['footer'] = "<a href=\"".XOOPS_URL."/modules/mydownloads/index.php\">"._MYDOWNLOADS_ALL_DOWNLOAD."</a>";
      
  $maxItem   = $params['maxItem'];  
  if($maxItem > 1){$s_php ="s";}else{$s_php = "";}
  
  if($maxItem == 0){
       $t[] = "<center><br><br>"._AUCUN." "._DERNIERSS."</center><br><br>";
  }else{
  
  
      //--------------------------------------------------------------------
      //JJD - la ca devrait etre un bon exemple
      //--------------------------------------------------------------------
      $t[] = "<table width='100%'><tr><td colspan='3'><p align='center'><b><font size='2'>"._LES.$n_php." "._DERNIERTT."</font></b></td></tr><tr bgcolor='".$coll."'>\n";
      $t[] = "<td NOWRAP><font size='2' color='$textcolor1'><b>"._NUMTITRE."</b></font></td>\n";
      $t[] = "<td NOWRAP align='right'><font size='2' color='$textcolor1'><b>"._DATEAJOUT."</b></font></td>\n";
      $t[] = "<td align='center' NOWRAP><font size='2' color='$textcolor1'><b>"._HITS."</b></font></td>\n";
      $t[] = "</tr>\n";
      $resultw1 = $xoopsDB->query("SELECT d.lid, d.cid, d.title, d.url, d.homepage, d.version, d.size, d.platform, d.logourl, d.status, d.date, d.hits, d.rating, d.votes, d.comments, t.description FROM ".$xoopsDB->prefix("mydownloads_downloads")." d, ".$xoopsDB->prefix("mydownloads_text")." t WHERE d.status>0 AND d.lid=t.lid ORDER BY date DESC",$n_php,0);
      
      $a=1;
      //while(list($lid, $cid, $sid, $title, $description, $time, $hits)=$xoopsDB->fetchRow($resultw1)) {
      while(list($lid, $cid, $dtitle, $url, $homepage, $version, 
                 $size, $platform, $logourl, $status, $time, $hits, 
                 $rating, $votes, $comments, $description)
                 =$xoopsDB->fetchRow($resultw1)) {
  
          $datetime = formatTimestamp($time,"s");
          $couleur = ($a % 2) ? $coll = "$bgcolor1" : $coll = "$bgcolor2";
          $t[] = "<tr bgcolor='".$coll."'><td NOWRAP><font size='2'>".$a." - <a style='color:".$textcolor2."' href=\"".XOOPS_URL."/modules/mydownloads/singlefile.php?lid=".$lid."\">".$dtitle."</a></font></td><td NOWRAP align='right'><font size='2' color='$textcolor1'>".$datetime."</font></td><td align='center' NOWRAP><font size='2' color='$textcolor1'>".$hits."</font></td>\n</tr>\n";
          $a++;
      }
      $t[] = "<tr><td align='center' bgcolor='$bgcolor2' colspan='3'><font size='1'>- <a style='color:".$textcolor2."' href=\"".XOOPS_URL."/modules/mydownloads/index.php\">"._TOUSTELECHARGEMENTS."</a></font></td></tr>\n";
      $t[] = "</table><br><br>";
      }
  
       return implode ("", $t);
  
  //-------------------------------------------------
  
  
}//fin function


/*************************************************************************
 *
 *************************************************************************/

function getLastInfoTEXT(&$sHead, &$sFooter, &$tInfo, &$colName, $mode = 0 , $params = ''){
     global $xoopsConfig, $xoopsDB, $format_mail, $lig, $bgcolor2, $bgcolor1, $textcolor1,$textcolor2, $prefix;
    
return $this->isOk();
   
$maxItem = $params['maxItem'];
$t1 = array();
if($maxItem > 1){$s_js ="s";}else{$s_js = "";}    
    
if($maxItem > 1){$s_php ="s";}else{$s_php = "";}

if($maxItem == 0){
     $t[] = "\r\n\r\n"._AUCUN." "._DERNIERTT." \r\n\r\n";
}else{

    //--------------------------------------------------------------------
    //JJD - la ca devrait etre un bon exemple
    //--------------------------------------------------------------------
    $t[] = _LES._DERNIERTT.":\r\n".$lig;
    $resultw1 = $xoopsDB->query("SELECT d.lid, d.cid, d.title, d.url, d.homepage, d.version, d.size, d.platform, d.logourl, d.status, d.date, d.hits, d.rating, d.votes, d.comments, t.description FROM ".$xoopsDB->prefix("mydownloads_downloads")." d, ".$xoopsDB->prefix("mydownloads_text")." t WHERE d.status>0 AND d.lid=t.lid ORDER BY date DESC",$n_php,0);
    
    $a=1;
    //while(list($lid, $cid, $sid, $title, $description, $time, $hits)=$xoopsDB->fetchRow($resultw1)) {
    while(list($lid, $cid, $dtitle, $url, $homepage, $version, 
               $size, $platform, $logourl, $status, $time, $hits, 
               $rating, $votes, $comments, $description)
               =$xoopsDB->fetchRow($resultw1)) {

        $datetime = formatTimestamp($time,"s");
        $couleur = ($a % 2) ? $coll = "$bgcolor1" : $coll = "$bgcolor2";

        $t[] = $datetime." - ".$title." - "._HITS.": ".$hits."\r\n";
        $t[] = "  ("._PPNEWS_URL.XOOPS_URL."/modules/mydownloads/singlefile.php?lid=".$lid." )\r\n\r\n";
        $a++;
    }
    $t[] = "\r\n\r\n";
    }
   
//-------------------------------------------------    
    return implode("", $t);    

//-------------------------------------------------

}//fin function



/*************************************************************************
 *
 *************************************************************************/
function getRecordSet(&$params, &$tInfo){
  	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
    //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;
  
    if (!$this->isOk()) return 0;  
  	//---------------------------------------
  
  $myts =& MyTextSanitizer::getInstance();
  
    
      //---------------------------------------
      $sql = "SELECT d.lid, d.cid, d.title, d.url, d.homepage, "
            ."d.version, d.size, d.platform, d.logourl, d.status, "
            ."d.date, d.hits, d.rating, d.votes, d.comments, t.description FROM "
            .$xoopsDB->prefix("mydownloads_downloads")." d, "
            .$xoopsDB->prefix("mydownloads_text")." t "
            ." WHERE d.status>0 AND d.lid=t.lid ORDER BY date DESC";
  
      $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
      $numEnr = $xoopsDB->getRowsNum($sqlquery);
  
  
      //-------------------------------------------------------
      $tInfo = array();   
     while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
        $title = $myts->makeTareaData4Show($sqlfetch['question']);
        $link = "<a href=\"".XOOPS_URL."/modules/mydownloads/singlefile.php?lid={$sqlfetch['lid']}\">{$sqlfetch['title']}</a>";
        $sqlfetch['link'] = $link;
        $sqlfetch['date'] = date(_MYDOWNLOADS_FORMATDATE, $sqlfetch['date']);        
        $sqlfetch['description'] = $myts->makeTareaData4Show($sqlfetch['description']);        
        
        
        $tInfo[] = $sqlfetch;                       
     
     }
     //------------------------------------------------------------
      
    //------------------------------------------- 
    return count($tInfo);   
    
  
  }
  



} // fin de la classe

?>



