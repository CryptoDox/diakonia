<?php



class cls_decoration  {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/
var $version = '';
var $name = '';
var $description = '';

/************************************************************
 * sql de creation du modele:
 ************************************************************/
function  getVersion(){
     
  return $this->version;

}

/*************************************************************************
 *
 *************************************************************************/

function createModele($decomodele, $ppData){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_decomodele');  
  $sql0 = "INSERT INTO `{$table}` 
         (`decoModele`,`property`,`typeName`,`rupture`,`ordre`,`params`,`defaut`) 
         VALUES ";
  $col = "";
  //--------------------------------------------------  
  $sql = "DELETE FROM {$table} WHERE decoModele = '{$decomodele}'";
  $xoopsDB->queryF ($sql);  
  
  $sql = "{$sql0} {$ppData}"; 
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  

}



//-------------------------------------------------------
}// fin de la classe
//-------------------------------------------------------
?>