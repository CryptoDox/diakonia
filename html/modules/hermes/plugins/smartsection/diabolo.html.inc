<?php

include_once("smartsection.php");

class cls_diabolo extends cls_smartsection{





/**********************************************************************
 *
 **********************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  $myts =& MyTextSanitizer::getInstance();

  $nbEnr = $this->getRecordSet($params, $tInfo);
  
  
      
  $colsName = array('linkArticle'     => _SMARTS_TITLE, 
                    'summary'         => _SMARTS_SUMMARY,
                    'datePublication' => _SMARTS_PUBLISHED,
                    'counter'         => _SMARTS_LECTURE,
                    'dateCreation'    => _SMARTS_CATCREATED,
                    'total'           => _SMARTS_CATLECTURE,
                    'linkCategory'    => _SMARTS_CATEGORIE,
                    );
/*
*/  
   //------------------------------------------------------------
   //displayArray($tInfo,"**************************************"); 
  return count($tInfo);   
  

   
}


} // fin class 
?>



