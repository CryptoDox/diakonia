<?php
function findEnr($papa, &$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  $myts =& MyTextSanitizer::getInstance();
  
  $tInfo = $papa->getRecorSet($params, $tProperty, $tInfo ,$colName);
  
  
      
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
   
  return count($tInfo);   
  

   
}

?>



