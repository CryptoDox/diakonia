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


//include_once ("admin/admin_header.php");
//---------------------------------------------------------------
/*
*/
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."class/xoopsformloader.php");
                               
require_once ("hermes_constantes.php");
require_once ("hermes_stat.php");
include_once ("hermes_generique.php");
include_once (_HER_JJD_PATH."/include/functions.php");

//---------------------------------------------------------------/
global $toto;


/*********************************************************************

**********************************************************************/
 function db_getLettreId($idLettre = 0, $returnArray = false){
  include_once (_HER_ROOT_PATH.'class/cls_hermes_lettre.php');

  $adoLettre = new cls_hermes_lettre();
  if ($returnArray){
    return $adoLettre->getArray($idLettre);  
  }else{
    return $adoLettre->getRowId($idLettre);  
  }

 }
 
/*********************************************************************

**********************************************************************/

 function db_getLettres($idLettre = 0, $clauseOrderBy = '', $clauseWhere = ''){
	global $xoopsModuleConfig, $xoopsDB;
	
    if ($idLettre > 0 ){
      $where = " WHERE idLettre = {$idLettre} ";
    }elseif ($clauseWhere<> ''){
      $where = " WHERE {$clauseWhere} ";    
    }else{
      $where = '';    
    }
    
    $sqlDateFormat = ((defined("_MI_HER_DATE_FORMAT_SQL_VIEW")) ? _MI_HER_DATE_FORMAT_SQL_VIEW : _AD_HER_DATE_FORMAT_SQL_VIEW);
    $sql = "SELECT *, date_format(prochaineParution,'".$sqlDateFormat."') as dateCourte FROM "
          ._HER_TFN_LETTRE
          .$where
          .(($clauseOrderBy == "" )?'':" ORDER BY {$clauseOrderBy}");
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->queryF ($sql);  
    
    

    return $sqlquery;
                
      
 }


/*********************************************************************
obsolette ???
**********************************************************************/

 function db_getGroupeLettre($idLettre){
	global $xoopsModuleConfig, $xoopsDB;
	   
    $sql = "SELECT idGroupe FROM "._HER_TFN_GROUPE
          ." WHERE idLettre = {$idLettre}";
     
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->queryF ($sql);  
   $t = array();
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $t[] = $sqlfetch ['idGroupe'];
    }
    

    return implode(',',$t);
                
      
 }

/*********************************************************************

**********************************************************************/

 function db_getArchives($idArchive = 0, $clauseOrderBy = '', $clauseWhere = ''){
	global $xoopsModuleConfig, $xoopsDB;
	
    if ($idArchive > 0 ){
      $where = " WHERE idArchive = {$idArchive} ";
    }elseif ($clauseWhere<> ''){
      $where = " WHERE {$clauseWhere} ";    
    }else{
      $where = ' WHERE test = 0';    
    }
    
    $sql = "SELECT * FROM "
          ._HER_TFN_ARCHIVE
          .$where
          .(($clauseOrderBy == "" )?'':" ORDER BY {$clauseOrderBy}");
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->queryF ($sql);  
    
    

    return $sqlquery;
                
      
 }
 /*********************************************************************

**********************************************************************/

function db_getUsers($idLettre, $format = 2){
// format = 2 : html
// format = 1 : texte

	global $xoopsModuleConfig, $xoopsDB;


    //---------------------------------------------------------------------  
    //premiere sous requete pour selectioner tous les user appartenant au groupe
    //affiliié a la lettre
    //---------------------------------------------------------------------
    $sqlUser  = "SELECT DISTINCT user.uid as uid, user.email, user.uname, user.name, 1 as state FROM "
              ._HER_TFN_GROUPE.'  as groupe ,'
              .$xoopsDB->prefix('groups_users_link').' as gl ,'  
              .$xoopsDB->prefix('users').'             as user '
              ." WHERE groupe.idGroupe = gl.groupid "
              ."   AND gl.uid = user.uid "
              ."   AND groupe.idLettre = {$idLettre}";
    $sqlqueryUser = $xoopsDB->queryF ($sqlUser);            
    //---------------------------------------------------------------------
    //deuxieme requtee pour selectionner les user qui ont revoquer la lettre
    // ou toute les lettres ou les demande au format texte
    //---------------------------------------------------------------------
    
    $sqlRevoked = "SELECT idUser, email, state FROM "._HER_TFN_USERS
                 ." WHERE idLettre in (0,{$idLettre})";
    $sqlqueryRevoked = $xoopsDB->queryF ($sqlRevoked);
    $tr = array();
      
   while ($sqlfetch = $xoopsDB->fetchArray($sqlqueryRevoked)) {
      $tr [$sqlfetch ['email']] = $sqlfetch; //array($sqlfetch ['idUser'],$sqlfetch ['state']);
    }
    //-------------------------------------------------
    $tUsers = array();
    while ($sqlfetch = $xoopsDB->fetchArray($sqlqueryUser)) {
      $k = $sqlfetch ['email'];
      if (isset($tr [$k])) {
          if ($tr[$k]['state'] > 0){
            $sqlfetch['state'] = $tr [$k]['state'];
            $tUsers [] = $sqlfetch ;            
          }
      }else{
        $tUsers [] = $sqlfetch ;      
      }


    }

 
    return $tUsers;
                
      
 }

 
/*********************************************************************
Je met ca en commentaire, car ca ne fonctionne pas en mysql 4.???
mais je garde quand meme

**********************************************************************/

function updateArchiveEnvois($idArchive, $envois){
	global $xoopsModuleConfig, $xoopsDB;
    
    $sql  = "UPDATE "._HER_TFN_ARCHIVE
           ." SET envois = envois + {$envois}"
           ." WHERE idArchive = {$idArchive}";

    $xoopsDB->queryF ($sql);        

}



 
 

 /****************************************************************************
 *
 ****************************************************************************/
 function db_getUrlList(){
	global $xoopsModuleConfig, $xoopsDB;
	

    $sql = "SELECT * FROM "._HER_TFN_URL
          ." ORDER BY url";
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);  
    
    

    return $sqlquery;
      
 }
 
 /****************************************************************************
 *
 ****************************************************************************/
 function db_getLetterSyndication($idLettre){
	global $xoopsModuleConfig, $xoopsDB;
	

    $sql = "SELECT url.* FROM "._HER_TFN_URL." AS url ,"
          ._HER_TFN_SYNDICATION." AS syndication "
          ." WHERE url.idUrl = syndication.idUrl "
          ."   AND syndication.idLettre = {$idLettre}"
          ." ORDER BY url.url";
          
    //echo "<hr>{db_getLetterSyndication}<br>{$sql}<hr>";          
    $sqlquery = $xoopsDB->query ($sql);  
    
    

    return $sqlquery;
      
 }
 
 /****************************************************************************
 *
 ****************************************************************************/
 function db_getSyndication($idLettre){
	global $xoopsModuleConfig, $xoopsDB;

	
    $url = db_getUrlList();
    
    $sql = "SELECT * FROM "._HER_TFN_SYNDICATION
          ." WHERE idLettre = {$idLettre}"
          ." ORDER BY url";
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);  
    
    $t = array();
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $t["k-{$sqlfetch['idUrl']}"] = 1;
    }
    
    $tUrl = array();
    while ($sqlfetch = $xoopsDB->fetchArray($url)) {
      //echo "{$sqlfetch['description']}<br>";
      $k = "k-{$sqlfetch['idUrl']}";
      $ok = isset($t[$k]);
      $sqlfetch ['ok'] = $ok;
      $tUrl[] = $sqlfetch;
    }


    return $tUrl;
      
 }


/*********************************************************************

**********************************************************************/

 function db_getIdPluginsByName($name){
	global $xoopsModuleConfig, $xoopsDB;
	
    
    $sql = "SELECT idPlugin FROM "._HER_TFN_PLUGIN
          ." WHERE nomFichier = '{$name}' ";
    $sqlquery = $xoopsDB->queryF ($sql);  
    
    
    list($idPlugin) = $xoopsDB->fetchRow($sqlquery);
    return $idPlugin;
                
      
 }

/*********************************************************************

**********************************************************************/

 function db_getPlugins($idPlugin = 0, $clauseOrderBy = 'module,nom', $filtre = ''){
	global $xoopsModuleConfig, $xoopsDB;
	
    $tClauseWhere = array();
    if ($idPlugin <> 0)   $tClauseWhere [] = "idPlugin = {$idPlugin}";    
    if ($filtre <> '')    $tClauseWhere [] = $filtre ;    
    $clauseWhere = implode(" AND ", $tClauseWhere);
    if ($clauseWhere <> '') $clauseWhere = " WHERE ".$clauseWhere;
    
    //$sql = "SELECT * FROM "._HER_TFN_PLUGIN.$clauseWhere
    //      .(($clauseOrderBy == "" )?'module,nom':" ORDER BY {$clauseOrderBy}");
    
    $sql = "SELECT * FROM "._HER_TFN_PLUGIN.$clauseWhere
          .' ORDER BY '.(($clauseOrderBy == '' )? 'module,nom': $clauseOrderBy);

/*

    $sql = "SELECT * FROM "
          ._HER_TFN_PLUGIN
          .(($idPlugin > 0)?" WHERE idPlugin = {$idPlugin}":'')
          .(($clauseOrderBy == "" )?'':" ORDER BY {$clauseOrderBy}");
*/
          
    //echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->queryF ($sql);  
    
    

    return $sqlquery;
                
      
 }
 
/*********************************************************************

**********************************************************************/

 function db_getPieces($idLettre = 0, $clauseOrderBy = '', $filtre = ''){
	global $xoopsModuleConfig, $xoopsDB;
	
    $tClauseWhere = array();
    if ($idLettre <> 0)   $tClauseWhere [] = "idLettre = {$idLettre}";    
    if ($filtre <> '')    $tClauseWhere [] = $filtre ;    
    $clauseWhere = implode(" AND ", $tClauseWhere);
    if ($clauseWhere <> '') $clauseWhere = " WHERE ".$clauseWhere;
    
    $sql = "SELECT * FROM "._HER_TFN_PIECE.$clauseWhere
          .(($clauseOrderBy == "" )?'':" ORDER BY {$clauseOrderBy}");

          
    //echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->queryF ($sql);  
    
    

    return $sqlquery;
                
      
 }

/*********************************************************************

**********************************************************************/

 function db_getPluginParams($idPlugin, &$nbParams, $idStructure){
	global $xoopsModuleConfig, $xoopsDB;
         
            
    $sqlquery =  db_getParamsPI ($idPlugin, $idStructure);
    $nbParams = $xoopsDB->getrowsNum($sqlquery);
    //echo "<hr>db_getPluginParams {$nbRows} enr-> {$sql}<hr>";
    
    return $sqlquery;
                
      
 }
/*********************************************************************

**********************************************************************/
function db_getParamsPI ($idPlugin, $idStructure = 0){
	global $xoopsModuleConfig, $xoopsDB;

///if ($idPlugin == '') $idPlugin = 'zzzzzzzzzzzzzzzzzzz';    	
    $sql = "SELECT  * FROM "._HER_TFN_PARAMS
          ." WHERE idPlugin = {$idPlugin}"
          ."   AND idStructure = {$idStructure}"
          ." ORDER BY nom";
  
          
    $sqlquery = $xoopsDB->query($sql);
    $nbEnr    = $xoopsDB->getRowsNum($sqlquery);
        
    if ($nbEnr == 0 AND $idStructure <> 0){
        $sql = "SELECT  * FROM "._HER_TFN_PARAMS
              ." WHERE idPlugin = {$idPlugin}"
              ."   AND idStructure = 0"
              ."  ORDER BY nom";
        $sqlquery=$xoopsDB->query($sql);    
        //echo "<hr>db_getParamsPI<br>$sql<hr>";        
    }
  
  //echo "<hr>idPlugin - idStructure : {$idPlugin}-{$idStructure}<br>{$sql}<hr>";  
  return $sqlquery;
}
/*********************************************************************

**********************************************************************/
function clearParams ($idPlugin, $idStructure = 0){
	global $xoopsModuleConfig, $xoopsDB;

    	
    $sql = "DELETE FROM "._HER_TFN_PARAMS
          ." WHERE idPlugin = {$idPlugin}"
          ."   AND idStructure = {$idStructure}";
  
    //echo "<hr>clearParams<br>{$sql}<hr>";          
    $sqlquery=$xoopsDB->queryF($sql);
    
  return $sqlquery;
}

/*********************************************************************

**********************************************************************/

 function db_getFulParams($idPlugin, &$nbParams, $idStructure = 0){
	global $xoopsModuleConfig, $xoopsDB;
	
    $sql = "SELECT * FROM "._HER_TFN_PLUGIN
          ." WHERE idPlugin = {$idPlugin}";
    $sqlquery = $xoopsDB->query ($sql);
    $rstPlugin  = $xoopsDB->fetchArray($sqlquery);   
    
    $folder = _HER_ROOT_PATH."plugins/";
    $fileName = $rstPlugin['nomFichier'];
    //echo 'idPlugin -> '.$idPlugin.'<br>'; 
    //echo "plugin include --{$idPlugin}----> ".$fileName.'***'.$rstPlugin['nomFichier'].'<br>';
    $fulName = $folder.$fileName;
    if (!is_readable($fulName)){ return'';}
    //echo "plugin include --{$idPlugin}----> ".$fulName.'<br>'.$rstPlugin['nomFichier'].'<br>';
      
    include_Once ($fulName);
    $langFile = getLanguageFile($fulName);
    $nomClasse = 'cls_'.extractFileNameFromFullName($fileName);
    //echo "nom de la classe : {$nomClasse}<hr>";  
    $mode = 0;//pas utiliser pour le moment
    $ob = new $nomClasse(array('lang' => $langFile, 'jjd' => 'JÝJÝD'), $mode);
    //echo 'nom de la classe : '.get_class($ob).'<hr>';    


    $ob->getInfoPluggin($tProperty, $tParams);
    //displayArray($tParams,"----- getInfoPluggin -----");
    //---------------------------------------------------------------------
          
    $sqlquery = db_getParamsPI ($idPlugin, $idStructure);
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $tParams[$sqlfetch['nom']]['value'] = $sqlfetch['valeur'];
    }

    
    //-----------------------------------------------------------------
    $nbParams = count($tParams);
    return $tParams;
                
      
 }
/****************************************************************
 *
 ****************************************************************/
 function saveParams ($p) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  $lstPrefixe = "txtParamNom;txtHParamNom;txtTypeParam";  
  $idPlugin = $p['idPlugin'];  
  $idStructure = (isset($p['txtIdStructure']) ? $p['txtIdStructure'] : 0);  
 
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  
  //displayArray($t, "******saveParams*************");
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------

$h=0;
  while (list($key, $item) = each ($t)){      
  //for ($h = 0; $h < count($t); $h++){
    //$item = $t[$h] ; 
    if (isset($item['txtTypeParam'])) {
    

    switch ($item['txtTypeParam']){
      //-----------------------------------------------------------    
      case 3:
        //-----------------------------------------------------------   
        $lstPrefixe = "txtFile";
        $tFiles =  getArrayOnPrefixArray ($p, $lstPrefixe);  
        //displayArray($tFiles, "****** fchiers*************");        
        $template = $tFiles[$item['txtParamNom']]['txtFile'];
        $v = string2sql($template);
        //echo "<hr>{$template}-{$item['txtParamNom']}<hr>";
        //-----------------------------------------------------------   
        break;
      //-----------------------------------------------------------        
      case 4:        
       $v = checkBoxToBin($p, "txtOptionsAffichage", $def);
       $item['txtHParamNom'] = 'optionsAffichage';
        break;
        
  
      //-----------------------------------------------------------            
      default:
        //if (!isset($item['txtParamNom'])){displayArray($item,"----- saveParams {$h}-----");}
        $v = string2sql($item['txtParamNom']);      
        break;
    }
    
    //-------------------------------------------
    updateParam ($idPlugin, $idStructure, $item['txtHParamNom'], $v);    
    //-------------------------------------------  
    /*
  
    $filter = " WHERE idPlugin = {$idPlugin} " 
             ."   AND idStructure = {$idStructure}"
             ." AND nom = '{$item['txtHParamNom']}'";
    $sql = "SELECT count(idPlugin) as nbEnr FROM "._HER_TFN_PARAMS.$filter; 
    $sqlQuery = $xoopsDB->query($sql);     
    list($nbEnr) = $xoopsDB->fetchRow($sqlQuery);    
    
    //----------------------------------------------
    if ($nbEnr == 0 ){
        $sql = "INSERT INTO "._HER_TFN_PARAMS
              ." (idPlugin,idStructure,nom,valeur)"  
              ." VALUES ({$idPlugin},{$idStructure},'{$item['txtHParamNom']}','{$v}')";
    
    }else{
        $sql = "UPDATE "._HER_TFN_PARAMS  
              ." SET  valeur = '{$v}' "
              .$filter;
    }
    //-------------------------------------------

      $xoopsDB->query($sql);    
      //echo "<hr>saveParams {$item['txtTypeParam']} -> {$sql}<br>"; //exit;  
    */ 
    }
    $h++;  
  } 
  
  
  /*****************************************************
   * sauvegarde de la liste des identifiants de categories, news et autre
   * module qdont le plugin permet de delestinner des identifiants     
   *****************************************************/  
  $lstPrefixe = "chkIdCat";
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  $tId = array();
  //displayArray($t,"***** chkIdItem *****");
  while (list($key, $item) = each ($t)){   
    //$tId = $item['chkIdItem'];
    $tId[] = $key;    
  }
  $v = implode(',', $tId);
  //echo "<hr>sauvegarde de la liste des identifiants<br>{$v}<hrh>";
  updateParam ($idPlugin, $idStructure, _HER_LIST_ID_CAT, $v);  
  
  /*****************************************************
   * sauvegarde de la liste des identifiants d'article, news et autre
   * module qdont le plugin permet de delestinner des identifiants     
   *****************************************************/  
  $lstPrefixe = "chkIdItem";
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  $tId = array();
  //displayArray($t,"***** chkIdItem *****");
  while (list($key, $item) = each ($t)){   
    //$tId = $item['chkIdItem'];
    $tId[] = $key;    
  }
  $v = implode(',', $tId);
  //echo "<hr>sauvegarde de la liste des identifiants<br>{$v}<hrh>";
  updateParam ($idPlugin, $idStructure, _HER_LIST_ID_ITEM, $v);  
  
  
    
//echo "<hr>"; exit;   
}  

/****************************************************************
 *
 ****************************************************************/
 function updateParam ($idPlugin, $idStructure, $name, $v) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

    
    //-------------------------------------------
    $filter = " WHERE idPlugin = {$idPlugin} " 
             ."   AND idStructure = {$idStructure}"
             ." AND nom = '{$name}'";
    $sql = "SELECT count(idPlugin) as nbEnr FROM "._HER_TFN_PARAMS.$filter; 
    $sqlQuery = $xoopsDB->query($sql);     
    list($nbEnr) = $xoopsDB->fetchRow($sqlQuery);    
    
    
    //----------------------------------------------
    if ($nbEnr == 0 ){
        $sql = "INSERT INTO "._HER_TFN_PARAMS
              ." (idPlugin,idStructure,nom,valeur)"  
              ." VALUES ({$idPlugin},{$idStructure},'{$name}','{$v}')";
    
    }else{
        $sql = "UPDATE "._HER_TFN_PARAMS  
              ." SET  valeur = '{$v}' "
              .$filter;
    }
    //-------------------------------------------

      $xoopsDB->query($sql);    
      //echo "<hr>saveParams {$name} -> {$sql}<br>"; //exit;  
 
   
//echo "<hr>"; exit;   
}  


/****************************************************************************
 * retoutne tous les groupes d'utilisateurs avec et l'acces à la lettre
 ****************************************************************************/
function getListGroupesLettre($idLettre){
	global $xoopsModuleConfig, $xoopsDB;
	
  $groups = getListGroupes();
  //displayArray($groups,"-----------getListGroupesLettre--------------");
  //on fait le ménage
  $sql = "DELETE FROM "._HER_TFN_GROUPE
        ." WHERE idGroupe = 0";
    $sqlquery = $xoopsDB->queryF ($sql);  
  
  $sql = "SELECT * FROM "
        ._HER_TFN_GROUPE
        ." WHERE idLettre = {$idLettre}";
    $sqlquery = $xoopsDB->queryF ($sql);
    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $groups["k-{$sqlfetch['idGroupe']}"]['value'] = 1;
       //$groups["k-{$sqlfetch['groupid']}"]['name'] = 'zzzzzzzz';       
    }
    
    return $groups;
}

/****************************************************************************
 * retoutne tous les groupes d'utilisateurs autorisé a voir les sondages
 ****************************************************************************/
function getListGroupesSondages($grp){
	global $xoopsModuleConfig, $xoopsDB;
	
  $groups = getListGroupes();
  $t = explode(',', $grp);
  
  for ($h = 0; $h< count($t); $h++){
      if ($t[$h] <>'' AND $t[$h]<>'0') $groups["k-{$t[$h]}"]['value'] = 1; 
  }    
    
  return $groups;
}
/*********************************************************************

**********************************************************************/
 function buildGroupes2StrList($prefix, $t, $addLimiteurZero = true, $sep = ','){
   
  $list = htmlArrayOnPrefix($t, array($prefix), '_');
  //displayArray ($list, "=================");
  $tGroups = array();
  if (is_array($list)){
    for ($h = 0; $h < count($list); $h++){
      if (isset($list[$h][$prefix])){
        if ($list[$h][$prefix] == 'on') {
          $tGroups[] = $h; 
        }
      }
    }
    if ($addLimiteurZero) {
      $lstGroupes = '0'.$sep. implode($sep, $tGroups).$sep.'0';    
    }else{
      $lstGroupes = implode($sep, $tGroups);    
    }
    
  }else{
    $lstGroupes = '';  
  }
  
  //-------------------------------------------------
  return $lstGroupes;
}
 


/*********************************************************************

**********************************************************************/

 function db_getStructure($idLettre, $clauseWhere = ''){
	global $xoopsModuleConfig, $xoopsDB;
	

    $sql = "SELECT * FROM "._HER_TFN_STRUCTURE
          ." WHERE idLettre = {$idLettre}"
          .(($clauseWhere == '')?'':" AND {$clauseWhere} ")
          ." ORDER BY blockSmarty, ordre,idElement,idItem";
          
    //echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->queryF ($sql);  
    
    

    return $sqlquery;
                
      
 }
 
/*********************************************************************

**********************************************************************/

 function getNbParams($idPlugin, $idStructure){
	global $xoopsModuleConfig, $xoopsDB;
	

    $sql = "SELECT count(idPlugin) AS nbEnr FROM "._HER_TFN_PARAMS
          ." WHERE idPlugin = {$idPlugin}"
          ."   AND idStructure = {$idStructure}";
          
    //echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);  
    list($nbEnr) = $xoopsDB->fetchRow($sqlquery);
    //echo "<hr>getNbParams<br>$sql<hr>";

    return $nbEnr;
                
      
 }
 
/*********************************************************************

**********************************************************************/

 function db_getTexte2Edit($idLettre){
	global $xoopsModuleConfig, $xoopsDB;
	

    $sql = "SELECT DISTINCT tblTexte.* FROM "._HER_TFN_TEXTE." as tblTexte, "
                           ._HER_TFN_STRUCTURE." as tblStructure "   
          ." WHERE tblStructure.idElement = 2 "                            
          ."   AND tblTexte.idTexte = tblStructure.idItem "
          ."   AND tblStructure.idLettre = {$idLettre}"     
          ."   AND( tblStructure.editBeforeSend > 0 OR tblTexte.editBeforeSend > 0 )"           
          ." ORDER BY tblStructure.ordre, tblStructure.nom, tblStructure.idElement, tblStructure.idItem";
          
    //echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->queryF ($sql);  
    
    

    return $sqlquery;
                
      
 }

/****************************************************************************
 * actualistion de la liste des plugins
 * cette action n'est pas obligatoire elle permet de parametrer individuellement chaque plugin
 * sinon les valeur par defaut du module sont utilisées  
 ****************************************************************************/
function buildListElement(){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  

  $t = array();
  $h = 0;
  
  $bgNone = 'FFFFFF';
  $bg  = array('FFFF66','CCFF66','99FFFA','CC99FF','FFCC66','FFCCFF','CCCCFF');
  $bg2 = array('FFFF66','CCFF66','0099FF','CC99FF','888888','FFCCFF','CCFFCC');  
  //--------------------------------------------------------  
    
    //pour lidentifiant on prend celui de la table que l'on multiplie par 100 auquel
    //on ajoute un code pour pour le type d'element 1pour plugin 2 pour texte
    //ca lise 99 code pour es futur evolution , 9 aurait peut etre suffit ???

    $h = 0;

    //---------------------------------------------------------------------    
    // element systeme dont "aucun"
    //---------------------------------------------------------------------    
    
    
    $codeElement = _HER_EL_SYSTEM;  
    $item = 0;  
    $t[] = array ('lib' => "{$h} : "._AD_HER_NONE." -({$codeElement}.$item)",
                  'id' => ($item * 100 ) + $codeElement,
                  'bgColor' => $bgNone);
    $h++;
    //----------------------------------------------------------------
    $item++ ;    
    $t[] = array ('lib' => "{$h} : "._AD_HER_BANNERS_RANDOM." -({$codeElement}.$item)",
                  'id' => ($item * 100 ) + $codeElement,
                  'bgColor' => $bg[$codeElement]);
    $h++;
    //----------------------------------------------------------------

    $item++ ;    
    $t[] = array ('lib' => "{$h} : "._AD_HER_LINE_SEPARATOR." -({$codeElement}.$item)",
                  'id' => ($item * 100 ) + $codeElement,
                  'bgColor' => $bg[$codeElement]);
    $h++;

    //----------------------------------------------------------------

    $item++ ;    
    $t[] = array ('lib' => "{$h} : "._AD_HER_FILES_LINKED." -({$codeElement}.$item)",
                  'id' => ($item * 100 ) + $codeElement,
                  'bgColor' => $bg[$codeElement]);
    $h++;

    //---------------------------------------------------------------------
    // liste des plugins
    //---------------------------------------------------------------------    
    $sqlquery = db_getPlugins(0, 'module, nom', "state = 3");
    /*

    $sql = "SELECT * FROM "._HER_TFN_PLUGIN
          ." ORDER BY nom";
      $sqlquery = $xoopsDB->queryF ($sql);
    */    
    
    
    $codeElement = _HER_EL_PLUGIN;    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $t[] = array ('lib' => "{$h} : plugin-{$sqlfetch['module']} : {$sqlfetch['nom']}-({$codeElement}.{$sqlfetch['idPlugin']})",
                     'id' => ($sqlfetch['idPlugin'] * 100 ) + $codeElement,
                     'bgColor' => $bg[$codeElement]);
       $h++;       
    }
    
    //---------------------------------------------------------------------
    // liste des textes
    //---------------------------------------------------------------------    
   $sql = "SELECT * FROM "._HER_TFN_TEXTE
        ." ORDER BY categorie,nom";
    $sqlquery = $xoopsDB->queryF ($sql);
    $codeElement = _HER_EL_TEXTE;    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $t[] = array ('lib' => "{$h} : texte-{$sqlfetch['categorie']}:{$sqlfetch['nom']}-({$codeElement}.{$sqlfetch['idTexte']})",
                      'id' => ($sqlfetch['idTexte'] * 100 ) + $codeElement,
                      'bgColor' => ($sqlfetch['editBeforeSend'] == 0)?$bg[$codeElement]:$bg2[$codeElement]);
       $h++;              
    }
    
    
    //---------------------------------------------------------------------
    // liste des bannieres
    //---------------------------------------------------------------------    
   $sql = "SELECT banner.*,  client.name as name, client.contact as contact FROM "
          .$xoopsDB->prefix('banner').' as banner, '
          .$xoopsDB->prefix('bannerclient').' as client '
          ." WHERE banner.cid = client.cid "   
          ." ORDER BY client.name, client.contact, bid";
    //echo "<hr>{$sql}<hr>";
          
    $sqlquery = $xoopsDB->queryF ($sql);
    $codeElement = _HER_EL_BANNIERE;
    define('',   0);
        
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $t[] = array ('lib' => "{$h} : banner-{$sqlfetch['name']} {$sqlfetch['contact']}-({$codeElement}.{$sqlfetch['bid']})",
                      'id' => ($sqlfetch['bid'] * 100 ) + $codeElement,
                      'bgColor' => $bg[$codeElement]);
       $h++;              
    }

/*
    
    //---------------------------------------------------------------------
    // liste des FLUX RSS
    //---------------------------------------------------------------------    
   $sql = "SELECT * FROM "._HER_TFN_FLUXRSS
        ." ORDER BY nom";
    $sqlquery = $xoopsDB->query ($sql);
    $codeElement = _HER_EL_FLUXRSS;    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $t[] = array ('lib' => "{$h} : flux_RSS-{$sqlfetch['nom']}-({$codeElement}.{$sqlfetch['idFluxrss']})",
                      'id' => ($sqlfetch['idFluxrss'] * 100 ) + $codeElement,
                      'bgColor' => $bg[$codeElement]);
       $h++;              
    }
*/    

/*


    //---------------------------------------------------------------------
    // liste des styles
    //---------------------------------------------------------------------    
   $sql = "SELECT * FROM "._HER_TFN_STYLE
        ." ORDER BY nom";
    $sqlquery = $xoopsDB->queryF ($sql);
    $codeElement = _HER_EL_STYLE;    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $t[] = array ('lib' => "{$h} : style-{$sqlfetch['nom']}-({$codeElement}.{$sqlfetch['idStyle']})",
                      'id' => ($sqlfetch['idStyle'] * 100 ) + $codeElement,
                      'bgColor' => $bg[$codeElement]);
       $h++;              
    }
*/

    //---------------------------------------------------------------------
    // liste des decorations
    //---------------------------------------------------------------------
    $codeElement = _HER_EL_DECO;        
   $sql = "SELECT * FROM "._HER_TFN_DECO
        ." ORDER BY decoModele,name";
    $sqlquery = $xoopsDB->queryF ($sql);
    
    $decoModele= '' ;
    $bgColor = $bg[$codeElement];
        
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       if ($decoModele <> $sqlfetch['decoModele'] ){
          $decoModele = $sqlfetch['decoModele']; 
          $bgColor =(($bgColor == $bg[$codeElement]) ? $bg2[$codeElement] : $bg[$codeElement]) ;
       }
       
       $t[] = array ('lib' => "{$h} : deco-{$decoModele}:{$sqlfetch['name']}-({$codeElement}.{$sqlfetch['idDeco']})",
                      'id' => ($sqlfetch['idDeco'] * 100 ) + $codeElement,
                      'bgColor' => $bgColor);
       $h++;              
    }
    
  //--------------------------------------------------------

  //--------------------------------------------------------
  return $t;
    
}

/****************************************************************************
 * actualistion de la liste des plugins
 * cette action n'est pas obligatoire elle permet de parametrer individuellement chaque plugin
 * sinon les valeur par defaut du module sont utilisées  
 ****************************************************************************/
function updatePluginsList(){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
	$prefixeClasse = 'cls_';
	
	
	//-----------------------------------------------------------	
	//flag tous le plugin à 0 ceux trouve seront mis a 1
	// les autres seont supprime en fin de procedure
	$sql = "UPDATE "._HER_TFN_PLUGIN." SET flag = 0";
  $xoopsDB->queryF($sql);	
	//-----------------------------------------------------------
	
	
  //recherche dans le repertoire pluggin de la liste des pluggin
  $folder = _HER_ROOT_PATH."plugins/";  
  $t = getFileListH($folder,  ".php");
  $tf = array();
  $lg = strlen($folder);
  for ($h = 0; $h < count($t); $h++){
    $t[$h] = substr($t[$h], $lg);
  }
  

  for ($h = 0 ; $h < count($t); $h++){  
    $fileName = $t[$h];
    include_once($folder.$fileName);

    
    $langFile = getLanguageFile($folder.$fileName);
    $nomClasse = 'cls_'.extractFileNameFromFullName($fileName);
    $ob = new $nomClasse(array('lang' => $langFile, 'xxx' => 'xxx'));
    //$pluginIsOk = ($ob->isOk())?1:0;
    $moduleStatus = $ob->getModuleStatus();

    //------------------------------------------------------------
    //echo "<hr>fichier : {$fileName}<hr>";    
    //$nomClasse = 'cls_'.extractFileNameFromFullName($t[$h]);
    
    //$ob = new $nomClasse();
    //$ob = getPluginObject($t[$h]);
    //echo 'nom de la classe : '.get_class($ob).'<hr>';
    
    
    $ob->getInfoPluggin($tProperty, $params);
    $sName        = string2sql($tProperty['name']);
    $sDescription = string2sql($tProperty['description']);
    $sModule      = string2sql($tProperty['module']);
    $sVersion     = string2sql($tProperty['version']);
    $idPlugin     = string2sql($tProperty['identifiant']);    
    
//    echo "sName        = {$sName}<br>";    
//    echo "sDescription = {$sDescription}<br>";    
//    echo "sModule      = {$sModule}<br>";  
 
    
    $sql = "SELECT * FROM "._HER_TFN_PLUGIN
          ." WHERE nomFichier = '{$fileName}'";
    $sqlquery = $xoopsDB->queryF ($sql);
    //echo "<hr>updatePluginsList : {$nbEnr} enregistrements <br>$sql<hr>" ;      
      
   
   
   if ($xoopsDB->getRowsNum($sqlquery) == 0 ){
    $sql = "INSERT INTO "._HER_TFN_PLUGIN
          ." (nom, description, nomFichier, module, version, compteur, state, flag)"
          ." VALUES ('{$sName}','{$sDescription}','{$fileName}','{$sModule}','{$sVersion}', 0, {$moduleStatus}, 1)";
      $xoopsDB->queryF($sql);
     //echo "<hr>updatePluginsList : {$nbEnr} enregistrements <br>$sql<hr>" ;   
   }else{
    $sql = "UPDATE "._HER_TFN_PLUGIN.' SET '
          ."nom          = '{$sName}', "    
          ."description  = '{$sDescription}', "          
          ."nomFichier   = '{$fileName}', "          
          ."module       = '{$sModule}', " 
          ."version      = '{$sVersion}', "
          ."state        = {$moduleStatus} ," 
          ."flag         = 1 "          
          ." WHERE nomFichier = '{$fileName}'";
          
      $xoopsDB->queryF($sql);
     //$nbEnr =$xoopsDB->getRowsNum($sqlquery);              
    //echo "<hr>updatePluginsList : {$nbEnr} enregistrements <br>$sql<hr>" ;   
   
   }
   
   //---------------------------------------------------------
   // mise à jour des paramètre du plugin
   //---------------------------------------------------------   
    $sql = "SELECT idPlugin FROM "._HER_TFN_PLUGIN
          ." WHERE nomFichier = '{$fileName}'"; 
    $result = $xoopsDB->query($sql);    
    list ($idPlugin) = $xoopsDB->fetchRow($result);    
   // echo "<hr>updatePluginsList idPlugin = {$idPlugin} -> {$sql}<hr>" ;  
        
   //displayArray ($params,"------updatePluginsList-------------------");
   updatePluginParams ($idPlugin, $params);
   //---------------------------------------------------------  
    
  }
  

	
	//-----------------------------------------------------------	
	//pour finir comme dit au debut on vire les plugins obsoletes
  //----------------------------------------------------------	
	$sql = "SELECT idPlugin FROM "._HER_TFN_PLUGIN." WHERE flag = 0";	
  $sqlquery = $xoopsDB->queryF ($sql);  
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $idPlugin = $sqlfetch['idPlugin'];
      $sql = "DELETE FROM "._HER_TFN_PARAMS." WHERE idPlugin = {$idPlugin}";
      $xoopsDB->queryF($sql);	
  }	
	
	$sql = "DELETE FROM "._HER_TFN_PLUGIN." WHERE flag = 0";
  $xoopsDB->queryF($sql);	
	//-----------------------------------------------------------
  
    
}



/****************************************************************************
 *
 ****************************************************************************/
function updatePluginParams ($idPlugin, $params, $idStructure = 0){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
  //displayArray2($params, "----- updatePluginParams ------");	
	//-------------------------------------------------------
	//Flag tous le enregistrement pour detet ceux qui n'existe plus a la fin
  $filter = " WHERE idPlugin = {$idPlugin}"
           ."   AND idStructure = {$idStructure}";
	
  $sql = "UPDATE "._HER_TFN_PARAMS
        ." SET flag = 0".$filter;	
  $xoopsDB->queryF ($sql);	
  //echo "<hr>updatePluginParams<br>{$sqlDeleteAllparams}<hr>";  
	//-------------------------------------------------------	
  while (list($key, $item) = each($params)){
      $sql = "SELECT count(idPlugin) as nbEnr FROM "._HER_TFN_PARAMS
      .$filter." AND nom = '{$key}'"; 
      //echo "<hr>updatePluginParams<br>{$sql}<hr>";      
      $sqlQuery = $xoopsDB->query ($sql);      
      list($nbEnr) = $xoopsDB->fetchRow($sqlQuery);
      
      if ($nbEnr == 0){
        $sql0 = "INSERT "._HER_TFN_PARAMS
              ." (idPlugin, nom, valeur, description, idStructure, flag)"
              ." VALUES ({$idPlugin}, '%s', '%s', '%s', {$idStructure}, 1)";  
          $sql = sprintf ($sql0, $key, $item['value'],  '');
          $xoopsDB->queryF ($sql);                
      }else{
        //on e fait rien
      }
      //mettre le falg a 1 quelque soit  l'idStructure
      $sql = "UPDATE "._HER_TFN_PARAMS
            ." SET flag = 1 "
            ." WHERE idPlugin ={$idPlugin}"
            ." AND nom = '{$key}'";  
      $xoopsDB->queryF ($sql);      
  }	
  
  
  
	//-------------------------------------------------------	
  //suppression de tus les parametres non mis a jour, il n'existe plus
  $sql = "DELETE FROM "._HER_TFN_PARAMS
        ." WHERE idPlugin = {$idPlugin}"
        ." ANd flag = 0";
  $xoopsDB->queryF ($sql);        	
	//-------------------------------------------------------	
	
	

  
}

/****************************************************************************
 *
 ****************************************************************************/
function updatePluginParams_old ($idPlugin, $params, $idStructure = 0){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
	
	$filter = " WHERE idPlugin = {$idPlugin}"
           ."   AND idStructure = {$idStructure}";
	
  $sqlDeleteAllparams = "DELETE FROM "._HER_TFN_PARAMS.$filter;
  $xoopsDB->queryF ($sqlDeleteAllparams);  
  
  $paramOk = array();
  //echo "<hr>updatePluginParams<br>{$sqlDeleteAllparams}<hr>";
  
  if (count ($params) == 0 ){
      /* pour l(instant  pas de suppression a etudier de plus pres)*/ 
      $xoopsDB->queryF($sqlDeleteAllparams);
           
            
  }else{
      $sql = "SELECT * FROM "._HER_TFN_PARAMS.$filter;  
      $sqlquery = $xoopsDB->queryF ($sql);

      while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
        $nom = $sqlfetch['nom'];
        if (isset($params[$nom])){
            $paramOk[$nom] = true;
          
        }else{
           //le parametre n'existe pas on le vire quelque soit  idStructure
           $sql0 = "DELETE FROM "._HER_TFN_PARAMS
                ." WHERE idPlugin = {$idPlugin}"
                ."   AND nom = '{$nom}'";
           $xoopsDB->queryF ($sql); 
       
        }
      }
      
      
      $sql0 = "INSERT "._HER_TFN_PARAMS
            ." (idPlugin, nom, valeur, description, idStructure)"
            ." VALUES ({$idPlugin}, '%s', '%s', '%s', %s)";  

      reset($params);
      while (list($key, $item) = each($params)) {
          if (isset($paramOk['$key'])) continue;
            if (!isset($item['description'])) $item['description'] = '';
            if (is_array($item)){
              $sql = sprintf ($sql0, $key, $item['value'], 
                              sqlQuoteString($item['description'],false),
                              $idStructure );            
           
            }else{
              $sql = sprintf ($sql0, $key, $item, '', $idStructure);            
            }
            //-------------------------------------------------
            $xoopsDB->queryF ($sql);       
      }  

  } //fin du else
  
  
}

/****************************************************************************
 *
 ****************************************************************************/
function noteNewLetter($idArchive, $note){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  

  
  //--------------------------------------------------------  
  $sql = "UPDATE "._HER_TFN_ARCHIVE
        ." SET noteCumulee = noteCumulee + {$note}, "
        ." noteNombre = noteNombre + 1, "
        ." noteMoyenne = round(noteCumulee / noteNombre,2)" 
        ." WHERE idArchive = {$idArchive}";
        
        //." noteMoyenne = (noteCumulee + {$note}) / (noteNombre + 1)"
                
    $sqlquery = $xoopsDB->queryF ($sql);
}

/****************************************************************************
 *
 ****************************************************************************/
function saveArchive($idLettre, $nomFichier, $timeStamp, $mode){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
    
  //--------------------------------------------------------
 
  $parution = date("Y-m-d h:m:s", $timeStamp);
  //echo 'parution = '.$parution.'<hr>';
  
  $rstLettre = $xoopsDB->fetchArray(db_getLettres($idLettre)) ;
  //displayArray($rstLettre,"-----------saveArchive---------------");
  //$nom = $xoopsDB->QuoteString($rstLettre['nom']);
  //$lib = $xoopsDB->QuoteString($rstLettre['libelle']);
  
  $nom = sqlQuoteString($rstLettre['nom']);
  $lib = sqlQuoteString($rstLettre['libelle']);
  $chronoArchive = $rstLettre['chronoArchive'] + 1 ;
  $test = (($mode == _HER_SEND) ? 0 : 1 );              
  //$groupes = "0,{$groupes},0";
  
  //--------------------------------------------------------  
  $sql = "INSERT INTO  "._HER_TFN_ARCHIVE
        ." (idLettre, chronoArchive, test, nomFichier, dateParution, mode, nom, libelle,"
        ." cheminArchivage, delaiArchivage, groupes)"
        ." VALUES({$idLettre}," 
                ."{$chronoArchive},"  
                ."{$test},"                      
                ."'{$nomFichier}'," 
                ."'{$parution}'," 
                ."{$mode},"
                ."{$nom},"
                ."{$lib},"
                ."'{$rstLettre['cheminArchivage']}',"
                ."{$rstLettre['delaiArchivage']},"
                ."'{$rstLettre['groupes']}'"
                .")";

  $sqlquery = $xoopsDB->queryF ($sql);
  $idArchive = $xoopsDB->getInsertId() ;
  
  //--------------------------------------------------------  
  if ($mode == _HER_SEND){
    $sql = "UPDATE "._HER_TFN_LETTRE
          ." SET chronoArchive = {$chronoArchive}"
          ." WHERE idLettre = {$idLettre}";
  
    $sqlquery = $xoopsDB->queryF ($sql);
    //echo "<hr>$sql<hr>";
  
  }
  //--------------------------------------------------------  
  
  //echo "<hr>saveArchive<hr>$sql<hr>";exit;
  //----------------------------------------------------------
  //dans le cas d'un envoi il faut actualiser la prochaine parution
  //----------------------------------------------------------  
  if ($mode == _HER_SEND ){
    computeNewParution($idLettre);  
  }

  //----------------------------------------------------------
  
  return $idArchive;
}



/**********************************************************************
 * renvoi le nom du dossier de langue


/****************************************************************************
 *
 ****************************************************************************/
function computeNewParution($idLettre){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;
/*

0_AD_HER_PERIODE_ANNUELLE,
1_AD_HER_PERIODE_SEMESTRIELLE,
2_AD_HER_PERIODE_TRIMESTRIELLE,
3_AD_HER_PERIODE_BIMENSUELLE,
4_AD_HER_PERIODE_MENSUELLE,
5_AD_HER_PERIODE_HEBDOMADAIRE,
6_AD_HER_PERIODE_JOURNALIERE);
*/


      $sql = "SELECT dateParution,prochaineParution,periodicite,jour FROM "._HER_TFN_LETTRE
            ." WHERE idLettre = {$idLettre}";
           
      $sqlquery = $xoopsDB->queryF ($sql);
      list($dateParution, $prochaineParution, $periodicite, $jour) = mysql_fetch_array($sqlquery);            
      
      //if ($dateParution == ''){$dateParution = date("Y-m-d") ;}
      
      //$dateParution = date("Y-m-d");
      //$dateParution = date("Y-m-d",time()) ;
      //$dateParution = time();      
      //$newDate = time() ;      
        

      
      // $newDate = MyGetDate(1,2,2, true);     
      //$fNewDate = date("Y-m-d",$newDate) ;
      $dateParution = date("Y-m-d h:m:s", time());
      $newDate = computeNewDateByPPeriode($dateParution,$periodicite,$jour); 
           
//      echo "<hr>test de date : {$dateParution} - {$newDate} - {$fNewDate}<hr>";
      $sql = "UPDATE "._HER_TFN_LETTRE
             ." SET dateParution = '{$dateParution}',"      
             ."     prochaineParution = '{$newDate}'"
            ." WHERE idLettre = {$idLettre}";
           
      $xoopsDB->queryF ($sql);
      
      

  

}

/****************************************************************************
 *
 ****************************************************************************/
function computeNewDateByPPeriode($dateReference,$periode,$offset, $mysql=true){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;
/*

0_AD_HER_PERIODE_ANNUELLE,
1_AD_HER_PERIODE_SEMESTRIELLE,
2_AD_HER_PERIODE_TRIMESTRIELLE,
3_AD_HER_PERIODE_BIMENSUELLE,
4_AD_HER_PERIODE_MENSUELLE,
5_AD_HER_PERIODE_HEBDOMADAIRE,
6_AD_HER_PERIODE_JOURNALIERE);
*/



  $ts = strtotime($dateReference);
  $p = getdate($ts);
//displayArray($p,"-------avant----------------");  
  switch ($periode){
  case 0:
      $p['year'] = $p['year'] + 1;
      $p['mday'] = $offset;      
    break;
    
  case 1:
      $p['mon'] = $p['mon'] + 6;
      $p['mday'] = $offset;
    break;
    
  case 2:
      $p['mon'] = $p['mon'] + 3;  
      $p['mday'] = $offset;
    break;
    
  case 3:
      $p['mon'] = $p['mon'] + 2;  
      $p['mday'] = $offset;
    break;
    
  case 4:
      $p['mon'] = $p['mon'] + 1;  
      $p['mday'] = $offset;
    break;
    
  case 5:
      $p['mday'] = $p['mday'] + 7;
    break;
    
  case 6:
      $p['mday'] = $p['mday'] + 1;  
    break;
    
     
  }
//displayArray($p,"-------apres----------------");    
    $newDate = mktime(0,0,0,$p['mon'], $p['mday'], $p['year']);
    
    $mysql ? $format = "Y-m-d h:m:s" : $format = "d/m/Y h:m:s";    
    return date($format,$newDate);    
    //return $newDate; 
  

}

/****************************************************************
 *
 ****************************************************************/

function getLettersForUser(){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
  
  //recherche des groupe de l'utilisateur connecter
  //si pas connecter groupe defaut de hermes
  $listGroupes = getListGroupesID(_HER_DIR_NAME);
  if ($listGroupes == '') {$listGroupes = $xoopsModuleConfig['groupHermesAnonyme'];}
  
  //recherche des letres destinées aux groupes trouvés
  $sql = "SELECT DISTINCT lettre.*, DATE_FORMAT(lettre.prochaineParution,'%d-%m-%Y')as dateCourte  FROM "
    ._HER_TFN_LETTRE." as lettre, "
    ._HER_TFN_GROUPE." as groupe " 
    ." WHERE lettre.idLettre = groupe.idLettre "
    ." AND idGroupe in ({$listGroupes}) "
    ." ORDER BY lettre.prochaineParution DESC";
       
    $sqlquery = $xoopsDB->queryF ($sql);    
    //$lettres = fetch2array ($sqlquery );
    //echo "<hr>{$sql}<hr>"   ; 
     $lettres = array();
     //coche toutes lettres sytématiquement
     //elle seront décoche eventuellement un peu plus bas selon les préferences de l'utilisateur
     while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       $sqlfetch['state'] = 2;       
       $lettres [] = $sqlfetch;
     }
  
  //displayArray($lettres,"-------------------------------");
    
  //connecte recherche de préférence de l'utilisateur pour decocher les letres
  //auquxquelles il n'a pas souscrit
  if (is_object($xoopsUser)){
    
    //par defaut si auncun enregistrement dans la table users de hermes
    //l'utilisateur est souscrit a toutes les lettres
    // recherche des enregistrement taguer 0
    //les 1 c'est pour lettre au format testxe et 2 au format HTML
    $sql = "SELECT * FROM "._HER_TFN_USERS
    ." WHERE email = ".$xoopsUser->email();
    
    $sqlquery = $xoopsDB->queryF ($sql); 
       
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      for ($h = 0; $h < count($lettres); $h++){
        if ($lettres[$h]['idLettre'] == $sqlfetch['idLettre'] ){
          //decoche les lettre qu'il na pas souscrite
          $lettres[$h]['state'] = $sqlfetch['state'];   
        }
      }
        
    }

  }  

  return $lettres;
}

/****************************************************************
 *
 ****************************************************************/

function isArchiveAllowed($idArchive, $idLettre, $searchMode){
//global $xoopsModuleConfig;
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;  
  
//  echo "<hr>isArchiveAllowed ... {$idArchive}|{$idLettre}|{$searchMode}{$searchMode}<hr>";	
  $lstGroupe = getListGroupesID('hermes');
  
  
  if ($searchMode == 0 ){
    $sql = "SELECT groupes FROM "._HER_TFN_LETTRE." WHERE idLettre = {$idLettre}";    

  }else{
    $sql = "SELECT groupes FROM "._HER_TFN_ARCHIVE." WHERE idArchive = {$idArchive}";  
  }
  $sqlquery = $xoopsDB->queryF ($sql);
  list($g) = $xoopsDB->fetchRow($sqlquery); 
  
  $tgUser = explode (",", $lstGroupe);
  $tgLettre = explode (",", $g);  
  
  $t = array_intersect ($tgUser,$tgLettre);
  //displayArray($t, "***** isArchiveAllowed *****");
  
  if (count($t) > 0){
    return true;
  }else{
    return false;
  }  
}

/****************************************************************
 *
 ****************************************************************/

function getArchivesForUser($idLettre = 0 ,$mode = 0, $searchMode = 0){
//global $xoopsModuleConfig;
  //echo "<hr>getArchivesForUser ... {$searchMode}<hr>";
  if ($searchMode == 0 ){
    return getArchivesForUser_byGroupesLetter($idLettre, $mode);
  }else{
    return getArchivesForUser_byGroupesArchive($idLettre, $mode);  
  }
  
}
/****************************************************************
 *
 ****************************************************************/

function getArchivesForUser_byGroupesLetter($idLettre = 0, $mode = 0){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
  
  //recherche des groupe de l'utilisateur connecter
  //si pas connecter groupe defaut de hermes
  $listGroupes = getListGroupesID(_HER_DIR_NAME);
  if ($listGroupes == '') {$listGroupes = $xoopsModuleConfig['groupHermesAnonyme'];}
  
  //recherche des letres destiné aux groupes trouvés
  $sql = "SELECT DISTINCT archive.*,  "
         ."DATE_FORMAT(archive.dateParution,'%d-%m-%Y') as dateCourte, "
         ."FORMAT(archive.noteMoyenne,1) as moyenne FROM "
        ._HER_TFN_ARCHIVE." as archive, "
        ._HER_TFN_GROUPE." as groupe " 
        ." WHERE archive.idLettre = groupe.idLettre "
        .(($idLettre==0)?'':" AND archive.idLettre={$idLettre} ")
        ." AND idGroupe in ({$listGroupes}) "
        ." ORDER BY archive.dateParution DESC,idArchive DESC";
       
    $sqlquery = $xoopsDB->queryF ($sql);    
    //$lettres = fetch2array ($sqlquery );
    //echo "<hr>sql -> {$sql}<hr>"   ; 
     $lettres = array();
     //coche toutes lettres sytématiquement
     //elle seront décoche eventuellement un peu plus bas selon les prérence de l'utilisateur
     while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    	 if ($mode == 0){
         $link = "index.php?op=viewArchive&idArchive={$sqlfetch['idArchive']}";
         $sqlfetch['link'] = "<A href='".$link."' target=blank>{$sqlfetch['nom']}</A>";  
         $sqlfetch['lib'] = "{$sqlfetch['dateCourte']} - {$sqlfetch['nom']} - {$sqlfetch['libelle']}";
                
       }else{
         $link = "index.php?op=viewArchiveInCurrentPage&idArchive={$sqlfetch['idArchive']}";
         $sqlfetch['link'] = "<A href='".$link."'>{$sqlfetch['nom']}</A>";  
         $sqlfetch['lib'] = "{$sqlfetch['idLettre']}/{$sqlfetch['idArchive']} - {$sqlfetch['dateCourte']} - {$sqlfetch['nom']} - {$sqlfetch['libelle']}"; 
       
       }
       
    
       $lettres [] = $sqlfetch;
     }
  
 
  return $lettres;
}
/****************************************************************
 *
 ****************************************************************/

function getArchivesForUser_byGroupesArchive($idLettre = 0, $mode = 0){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
  //echo "<hr>getArchivesForUser_byGroupesArchive<hr>";
  //recherche des groupe de l'utilisateur connecter
  //si pas connecter groupe defaut de hermes
  $filterGroupes = buildFilterGroupes ();
  
  //recherche des letres destiné aux groupes trouvés
  $sql = "SELECT DISTINCT archive.*,  "
         ."DATE_FORMAT(archive.dateParution,'%d-%m-%Y') as dateCourte, "
         ."FORMAT(archive.noteMoyenne,1) as moyenne FROM "
        ._HER_TFN_ARCHIVE." as archive "
        ." WHERE test = 0 AND {$filterGroupes} " 
        .(($idLettre==0)?'':" AND archive.idLettre={$idLettre} ")
        ." ORDER BY archive.dateParution DESC,idArchive DESC";
       
    $sqlquery = $xoopsDB->queryF ($sql);    
    //$lettres = fetch2array ($sqlquery );
    //echo "<hr>sql -> {$sql}<hr>"   ; 
     $lettres = array();
     //coche toutes lettres sytématiquement
     //elle seront décoche eventuellement un peu plus bas selon les prérence de l'utilisateur
     while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    	 if ($mode == 0){
         $link = "index.php?op=viewArchive&idArchive={$sqlfetch['idArchive']}";
         $sqlfetch['link'] = "<A href='".$link."' target=blank>{$sqlfetch['nom']}</A>";  
         $sqlfetch['lib'] = "{$sqlfetch['dateCourte']} - {$sqlfetch['nom']} - {$sqlfetch['libelle']}";
                
       }else{
         $link = "index.php?op=viewArchiveInCurrentPage&idArchive={$sqlfetch['idArchive']}";
         $sqlfetch['link'] = "<A href='".$link."'>{$sqlfetch['nom']}</A>";  
         $sqlfetch['lib'] = "{$sqlfetch['idLettre']}/{$sqlfetch['idArchive']} - {$sqlfetch['dateCourte']} - {$sqlfetch['nom']} - {$sqlfetch['libelle']}"; 
       
       }
       
    
       $lettres [] = $sqlfetch;
     }
  
 
  return $lettres;
}

/****************************************************************
 * recherche des lettres selon le mode, pour affichage dans
 * les lsites d‚roulantes. La liste des archive en dcoulera 
 ****************************************************************/
function getDistinctArchivesForUser($searchMode = 0){
  if ($searchMode == 0){
    return getDistinctArchivesForUser_byGroupesLettre();
  }else{
    return getDistinctArchivesForUser_byGroupesArchive();  
  }
  
}
/****************************************************************
 *
 ****************************************************************/

function getDistinctArchivesForUser_byGroupesLettre(){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
  
  //recherche des groupe de l'utilisateur connecter
  //si pas connecter groupe defaut de hermes
  $listGroupes = getListGroupesID(_HER_DIR_NAME);
  if ($listGroupes == '') {$listGroupes = $xoopsModuleConfig['groupHermesAnonyme'];}
  
  //recherche des lettres destiné aux groupes trouvés
  $sql = "SELECT DISTINCT archive.idLettre, archive.nom as nom FROM "
        ._HER_TFN_ARCHIVE." as archive, "
        ._HER_TFN_GROUPE." as groupe " 
        ." WHERE archive.idLettre = groupe.idLettre "
        ." AND idGroupe in ({$listGroupes}) "
        ." AND test = 0"
        ." ORDER BY archive.nom";
       
    $sqlquery = $xoopsDB->queryF ($sql);    

     $lettres = array();
     //coche toutes lettres sytématiquement
     //elle seront décoche eventuellement un peu plus bas selon les prérence de l'utilisateur
     while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
        $lettres[] = array( 'id'  => $sqlfetch['idLettre'],
                            'lib' => $sqlfetch['nom']);
      }
  
 
  return $lettres;
}
/****************************************************************
 *
 ****************************************************************/

function getDistinctArchivesForUser_byGroupesArchive(){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
  
  //recherche des groupe de l'utilisateur connecter
  //si pas connecter groupe defaut de hermes

  $filterGroupes = buildFilterGroupes ();
  
  //recherche des lettres destiné aux groupes trouvés
  $sql = "SELECT DISTINCT archive.idLettre, archive.nom as nom FROM "
        ._HER_TFN_ARCHIVE." as archive "
        ." WHERE test = 0 AND {$filterGroupes} "
        ." ORDER BY archive.nom";
       
    $sqlquery = $xoopsDB->queryF ($sql);    

     $lettres = array();
     //coche toutes lettres sytématiquement
     //elle seront décoche eventuellement un peu plus bas selon les prérence de l'utilisateur
     while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
        $lettres[] = array( 'id'  => $sqlfetch['idLettre'],
                            'lib' => $sqlfetch['nom']);
      }
  
 
  return $lettres;
}
/****************************************************************
 * construit unclause du style  groupe LIKE "%,X,%"
 * pour rcharcher les archives auquels l'utilisateur a droit 
 ****************************************************************/

function buildFilterGroupes(){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
  
  //recherche des groupe de l'utilisateur connecter
  //si pas connecter groupe defaut de hermes
  $listGroupes = getListGroupesID(_HER_DIR_NAME);
  if ($listGroupes == '') {$listGroupes = $xoopsModuleConfig['groupHermesAnonyme'];}
  
  $t = explode (',', $listGroupes);
  for ($h = 0; $h < count($t); $h++ ){
    $t[$h] = "groupes LIKE '%,{$t[$h]},%' ";
  }
  $filterGroupes = '(' . implode (' OR ', $t ) . ')';
  return $filterGroupes;
}
  



/**********************************************************************
 *
 **********************************************************************/ 

function saveNewListLetterForUser($p) {
	global $xoopsModuleConfig, $xoopsDB,$xoopsGroup, $xoopsUser;
    
  $uid = $xoopsUser->uid();
  $email = $xoopsUser->email(); 
  //$uid = 5;
    $sql = "DELETE FROM "._HER_TFN_USERS     
    ." WHERE email = {$email}";
    $xoopsDB->queryF ($sql);    
    
    //echo "<hr>{$sql}<hr>";   
    //displayArray($p,"---  ppppppppppppppppppppppppppp ---");    
    $dateMaj = date(_HER_DATE_SQL);       
          
  for ($h = 0; $h<count($p); $h++){
    $item = $p[$h];
    if (!isset($item['idLettre'])){continue;}

    //displayArray($item,"--- {item} ---");
    $v = (isset($item['lstState']))?$item['lstState']:0;
    //$v = $item['lstState'];
    
    $sql = "INSERT INTO "._HER_TFN_USERS
          ."(idUser, email, idLettre, state, dateMaj )"
          ." VALUES ({$uid},'{$email}',{$item['idLettre']},{$v}, '{$dateMaj}')";
    $sqlquery = $xoopsDB->queryF ($sql);
    //echo "<hr>{$sql}<hr>";
  
  }
  
  //$idUser = $uid;// $p['idUser'];
  //redirect_header(XOOPS_URL."/register.php",1,"");	
  //$list = htmlArrayOnPrefix($p, array('chkLettre'), '_');
  
  //displayArray($p,"--- lettres post ---");  
  //displayArray($list,"--- lettres cochées ---");

  
}

/**************************************************************************
 *
 **************************************************************************/

function getFulNameArchive($fileName,  $path = ''){

  if ($path == '') {
    $folder = _HER_ROOT_PATH."archives/";
  }else{
    $folder = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/').$path."/";  
  }
 
  $fullName = str_replace ('\\', '/', $folder.$fileName);
  $fullName = str_replace ('//', '/', $fullName);
  
  //echo "<hr>getFulNameArchive : <hr>{$fullName}<hr>"; 
   
  return $fullName;

}
/**************************************************************************
 *
 **************************************************************************/

function getUrlArchive($fileName, $path = ''){
  
  $f =  getFulNameArchive($fileName, $path );
  $f = XOOPS_URL . '/'. substr($f, strlen(XOOPS_ROOT_PATH));
   
  return $f;

}

/**********************************************************************
 *
 **********************************************************************/ 

function getBannerRandom() {
	global $xoopsModuleConfig, $xoopsDB,$xoopsGroup, $xoopsUser;

include_once XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               .'include/functions.php';

$bannerobject = '';

//nombre de bannieres en cours
$bresult = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("banner"));
list ($numrows) = $xoopsDB->fetchRow($bresult);

//selection d'un banniere aléatoire
if ( $numrows > 1 ) {
	$numrows = $numrows-1;
	mt_srand((double)microtime()*1000000);
	$bannum = mt_rand(0, $numrows);
} else {
	$bannum = 0;
}

//elle est selectionnee
if ( $numrows > 0 ) {
    $sql = "SELECT bid FROM ".$xoopsDB->prefix("banner");
    $bresult = $xoopsDB->query($sql, 1, $bannum);
    list ($bid) = $xoopsDB->fetchRow($bresult);
    return getBannerCode($bid); 
}

}

/**********************************************************************
 *
 **********************************************************************/ 

function getBannerCode($idBanner, $Incrementer_impmade = true) {
	global $xoopsConfig, $xoopsModuleConfig, $xoopsDB,$xoopsGroup, $xoopsUser;
  $myts =& MyTextSanitizer::getInstance();

    //recupe des infos de la banniere
    $sql = "SELECT * FROM ".$xoopsDB->prefix("banner")
          ." WHERE bid = {$idBanner}";
    $bresult = $xoopsDB->query($sql);
    
    list ($bid, $cid, $imptotal, $impmade, $clicks, $imageurl, $clickurl, $date, $htmlbanner, $htmlcode) = $xoopsDB->fetchRow($bresult);
    if ($xoopsConfig['my_ip'] == xoops_getenv('REMOTE_ADDR')) {
    		// EMPTY
    	} else {
    		$xoopsDB->queryF(sprintf("UPDATE %s SET impmade = impmade+1 WHERE bid = %u", $xoopsDB->prefix("banner"), $bid));
    }
    	/* Check if this impression is the last one and print the banner */
    	if ( $imptotal == $impmade ) {
    		$newid = $xoopsDB->genId($xoopsDB->prefix("bannerfinish")."_bid_seq");
    		$sql = sprintf("INSERT INTO %s (bid, cid, impressions, clicks, datestart, dateend) VALUES (%u, %u, %u, %u, %u, %u)", $xoopsDB->prefix("bannerfinish"), $newid, $cid, $impmade, $clicks, $date, time());
    		$xoopsDB->queryF($sql);
    		$xoopsDB->queryF(sprintf("DELETE FROM %s WHERE bid = %u", $xoopsDB->prefix("banner"), $bid));
    	}
    	if ($htmlbanner){
    		//$bannerobject = $myts->sanitizeForDisplay( $htmlcode,1,0,0,0,0); 
    		//$bannerobject = $myts->makeTareaData4Show( $htmlcode);    	
        $bannerobject = $myts->displayTarea($htmlcode,1);	
        $bannerobject = str_replace('<br />',"\n",$bannerobject);        
    	}else{
    	$center = '';     //'<center>'
    	$bannerobject = $center.'<a href="'.XOOPS_URL.'/banners.php?op=click&bid='.$bid.'" target="_blank">';
    		if (stristr($imageurl, '.swf')) {
    			$bannerobject = $bannerobject
    				.'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="468" height="60">'
    				.'<param name=movie value="'.$imageurl.'">'
    				.'<param name=quality value=high>'
    				.'<embed src="'.$imageurl.'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"; type="application/x-shockwave-flash" width="468" height="60">'
    				.'</embed>'
    				.'</object>';
    		} else {
    			$bannerobject = $bannerobject.'<img src="'.$imageurl.'" alt="" />';
    		}
    
    		$bannerobject = $bannerobject.'</a>'.$center;
    }
    //echo "<table><tr><td>{$bannerobject}</td></tr></table>";
    //echo "<table><tr><td>togodo</td></tr></table>";
    
    //$style = "style='border:1; cellspacing:0; cellpadding:0; align:center;'";
        
    return "<div align='center'><table><tr><td  align='center'>{$bannerobject}</td></tr></table></div>";
}
/****************************************************************
 *
 ****************************************************************/

function countArchives($idLettre = 0, $bAll = false){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
	
  $sql = "SELECT idLettre, Count(idLettre) AS nbArchives "
        ." FROM "._HER_TFN_ARCHIVE
        ." WHERE test = 0"
        ." GROUP BY idLettre";
  $sqlquery = $xoopsDB->queryF ($sql);  
  
  $t = array();
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    $t["k-{$sqlfetch['idLettre']}"] = $sqlfetch['nbArchives'];
  }
  
  //echo "<hr>countArchives<br>$sql<hr>";
  //displayArray($t,"----- countArchives -----");
  return $t;
}

/****************************************************************
 *
 ****************************************************************/

function purgerArchive($idLettre = 0, $bAll = false, $test = 0){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
  $td = array() ; //pour stocker les id des archive a virer
  
  $currentTM = time();
  
  //$clauseWhere = (($idLettre <> 0 ) ? " WHERE idLettre = {$idLettre}" : "");
  $clauseWhere = " WHERE test = {$test} "
                .(($idLettre <> 0 ) ? " AND idLettre = {$idLettre}" : "");  
  
  $sql = "SELECT * FROM "._HER_TFN_ARCHIVE.$clauseWhere;
  $sqlquery = $xoopsDB->queryF ($sql);         
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    $d = strtotime(dateAdd2DateTime($sqlfetch['dateParution'], 0, $sqlfetch['delaiArchivage'], 0));
    $atm = strtotime ($d);
    
    $b = ($d < $currentTM)?true:false;
    //echo "<hr>purgerArchive - > d: {$d} curent -> {$currentTM} - {$b}<hr>";
    if ($b OR $bAll){
        $td[] = $sqlfetch['idArchive'];
        $f = getFulNameArchive($sqlfetch['nomFichier'],$sqlfetch['cheminArchivage']);
        $dir = substr($f,0,-5);
        //echo "<hr>purgerArchive<hr>{$dir}<hr>";
        removeFolder ($dir);
        unlink($f);
        
        $f = substr($f, 0, -4).'.txt';
        if (is_readable($f)) unlink($f); 
    }
  

  //-----------------------------------------------------------------
  
  }
  
  //if(true) return;
  $list = implode (',', $td);
  if ($bAll){
    $sql = "DELETE FROM "._HER_TFN_ARCHIVE.$clauseWhere;  
    $xoopsDB->queryF ($sql);    
  }elseif ($list <> '' ){
    $sql = "DELETE FROM "._HER_TFN_ARCHIVE 
          .$clauseWhere 
          .(($clauseWhere == "") ? " WHERE " : " AND ")." idArchive in ({$list})";
    $xoopsDB->queryF ($sql);    
  }else{$sql = '';}

  
  //echo "<hr>purgerArchive -> {$sql}<hr>";
    
}

/****************************************************************
 *
 ****************************************************************/

function purgerStat(){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;
	
	$sql = "UPDATE "._HER_TFN_LECTURE
	      ." SET flag = 0";
   $xoopsDB->queryF ($sql);	
  //-------------------------------------------------------
	$sql = "UPDATE "._HER_TFN_LECTURE.' AS stat, '
	      ._HER_TFN_ARCHIVE." AS archive "
	      ." SET flag = 1"	      
	      ." WHERE stat.idArchive = archive.idArchive";
   $xoopsDB->queryF ($sql);	
  //-------------------------------------------------------
	$sql = "DELETE FROM "._HER_TFN_LECTURE
	      ." WHERE flag = 0";
   $xoopsDB->queryF ($sql);	

//-------------------------------------------------------

    
}


/****************************************************************
 *
 ****************************************************************/
function updateSuscribe($p, &$msg){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;  

$newStatus = $p['$newStatus'];
$idLettre  = $p['$idLettre'];
$idUser    = $p['$idUser'];
$login     = $p['$login'];
$email     = $p['$email'];
$perimetre = $p['perimetre'];
//---------------------------------------------------------------
  //verifiaction des tous les éléments du user pour eviter les menteurs
  /*

  $sql = "SELECT * FROM ".$xoopsDB->prefix("users")
        ." WHERE  uid  = {$idUser} "
        ."   AND name  = '{$login}'"
        ."   AND email = '$email'";
  */

  $sql = "SELECT * FROM ".$xoopsDB->prefix("users")
        ." WHERE  email = '{$email}'";

  //echo "<hr>updateSuscribe -> {$sql}<hr>";
  
  $sqlquery = $xoopsDB->queryF ($sql);  
  if ($xoopsDB->getRowsNum($sqlquery)  == 0){
    $msg = _MD_HER_MSG_IDENTIFICATION_CORRUPTED;
    return false;
  }  
  //-------------------------------------------------------------
  $sql = "SELECT * FROM "._HER_TFN_USERS
        ." WHERE email = {$email}"
        ."   AND idLettre = {$perimetre}";
  $sqlquery = $xoopsDB->queryF ($sql);  
    $dateMaj = date(_HER_DATE_SQL);          

  if ($xoopsDB->getRowsNum($sqlquery)  == 0){
    $sql ="INSERT INTO "._HER_TFN_USERS
    ." (email, idLettre, state, dateMaj)"
    ." VALUES ('$email',$perimetre,$newStatus), '{$dateMaj}'";
  }else{
    $sql ="UPDATE "._HER_TFN_USERS
    ." SET state = {$newStatus}"
    ." WHERE email = '{$email}'"
    ." AND idLettre = {$perimetre}";
  }  
  $xoopsDB->queryF ($sql);  

  $msg = _MD_HER_MSG_PROFILE_MODIFIED;
  return true;

}
/****************************************************************************
 *
 ****************************************************************************/
function confirmSuscribe ($p, &$msg){
//mode = _HER_TEST, _HER_PREVIEW  ou _HER_SEND
global $xoopsModuleConfig, $xoopsDB;
/*

    $p['newState'], 
    $p['idLettre'], 
    $p['idUser'], 
    $p['login'], 
    $p['mail'], $msg);
*/
    $idLettre = $p['idLettre'];
    $mode = _HER_SEND;
    $sqlQuery = db_getLettres($idLettre);
    $rstLettre = $xoopsDB->fetchArray($sqlQuery);
    $idLettreConfirmation = $rstLettre['idLettreConfirmation'];
    $params = array();    
    $texteHTML = buildLetter ($idLettreConfirmation, $params, $mode);
    $texteTEXT = strip_tags($texteHTML);   
    $headersHTML  = getHeader(1, $rstLettre['emailSender']);  
    $headersTEXT  = getHeader(2, $rstLettre['emailSender']); 
    $d = date("d-m-Y h:m:h" , time());    
    $subject = $params['libelle']." --- r‚siliation lettre {$idLettre}:{$idLettreConfirmation}";   //'nom'
$state = 1; //provisoire, rechercher les infos du user
    $idArchive = 0;
    
    $paramsPerso = array(_HER_CODE_USER.'idUser'   => $p['idUser'],
                         _HER_CODE_USER.'pseudo'   => $p['login'],      
                         _HER_CODE_USER.'name'     => $p['login'],
                         _HER_CODE_USER.'email'    => $p['mail'],    
                         _HER_CODE_USER.'mail'     => $p['mail'],
                         _HER_CODE_USER.'login'    => $p['login'],                      
                         'idLettre' => $idLettre,
                         'idArchive'=> $idArchive);      
    if ($state == 2){
        $texte = replaceCodePersonalise ($texteTEXT, $paramsPerso);
        $headers = $headersTEXT;      
    }else{
        $texte = replaceCodePersonalise ($texteHTML, $paramsPerso);
        $headers = $headersHTML;      
    }
    
    $bolOk = mail($p['mail'], $subject, $texte, $headers);      
    $r= (($bolOk) ? "Succés" : "Echec");
    echo "==> <b>{$r}</b> de l'envoi du mail a: ==> {$sqlfetch['email']} ==> {$subject}<br>" ;      
    hermesMail($p['email'],$rstLettre['emailSender'],$subject,$texte,true,1);
    
    if ($p['newState'] == 0){
      
    }

//=====================================================================
  $msg = _MI_HER_SEND_CONFIRMATION;
  return true;
  
}

/****************************************************************
 *
 ****************************************************************/
function getPieces($idLettre){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;  
  
  //$f = _HER_ROOT_PATH."pieces/";
  $f = _HER_ROOT_PIECES;
    
  $list = getFileListH($f);
  $t = array();
  
  for ($h = 0; $h < count($list); $h++){
    $item = array();
    $item['fullName'] = $list[$h];
    $item['name'] = basename($list[$h]);
    
    $fn = string2sql($list[$h]);    
    $sql = "SELECT state, libelle FROM "._HER_TFN_PIECE
          ." WHERE idLettre = {$idLettre} "
          . "  AND nomFichier = '{$fn}'";
    $sqlquery = $xoopsDB->queryF ($sql);  
    if ($xoopsDB->getRowsNum($sqlquery)  == 0){
      $item['ok'] = 0;  
    }else{
      list ($state, $libelle) = $xoopsDB->fetchRow($sqlquery);
      $item['ok'] = $state;      
      $item['libelle'] = $libelle;      
    }
    $t[] = $item;
  }    
      
  return $t;
}



/***********************************************************************
 *
 ***********************************************************************/
 function setFolderForUpload($subFolder, $mode = '0777', $msg = ''){
  
  $dir = _HER_ROOT_PATH.$subFolder;
  if (is_dir($dir)) {
      $msg = "le répertoire existe déjà";
      //chmod($dir, $mode);   
   }else{

      mkDir ($dir, $mode);
      $msg = "le répertoire a été dréé";      
  }
  
 }

/****************************************************************************
 * 
 ****************************************************************************/
function getHeader ($mode, $emailSender){
//mode = 0 pas d'entete
//mode = 1: format html
//mode = 2 format text
global $xoopsModuleConfig;


      if ($mode == 0 ) return '';
      //------------------------------------------------------
      $d = date("d-m-Y h:m:h" , time());
      if ($emailSender == ''){
        if ($xoopsModuleConfig['emailSender'] == ''){
          $emailSender = "webmaster@{$_SERVER['SERVER_NAME']}";        
        }else{
          $emailSender = $xoopsModuleConfig['emailSender'];        
        }

      }
      
      $header = array();
      $header[] = "From: {$emailSender}";
      $header[] = "Reply-To: {$emailSender}";
      $header[] = "X-Mailer: PHP/" . phpversion();
      
      if ($mode == 2){
        //bin rien a prori
      }else{
        $header[] = "MIME-Version: 1.0";       
        $header[] = "Content-type: text/html; charset=iso-8859-1";
      
      }
      $header[] = "";
      
      //$sHeader = implode("\r\n", $header);
      $sHeader = implode("\r\n", $header);

  return $sHeader;



}

/**********************************************************************
 *
 **********************************************************************/ 
function saveNewSubscription($p){
global $xoopsDB, $xoopsModuleConfig;

  $email = $p['txtEmail'];
  //---------------------------------------------------------
  //Validation de l'adresse mail
  //---------------------------------------------------------    
  if (!valider_email($email))  return _MD_HER_MSG_EMAIL_NOTVALID;
  //---------------------------------------------------------    
  //displayArray($p,"--------saveNewSubscription--------");  
    
  if ($p['txtName'] == '' | $p['txtName'] == 'unknow' ){
    $name  = $email;  
    //$idGroupe = 3;
  }else{
    $name  = $p['txtName'];
    //$idGroupe = 2;      
  }
  
  //controle de sécurité su le groupes des nscrit anonyme
  $idGroupe = $xoopsModuleConfig['groupeAnonyme'];
  if ($idGroupe < 3) $idGroupe = 3;
  //-----------------------------------------------
  if ($email == ''){
    return _MD_HER_MSG_EMAIL_REQUIRED;
  }

    //---------------------------------------------------------
    //verifie qu'il n'y a pas deje un utilisateur avec cet email et ce pdeudo
    //---------------------------------------------------------    
    $sqlUserS = "SELECT count(uname) as nbEnr, max(uid) as uid FROM "._HER_TFN_XUSER
               ." WHERE email = '{$email}' AND uname = '{$name}'";
    $sqlquery = $xoopsDB->query($sqlUserS);
    //echo "<hr>Select : <br>{$sql}<hr>";
    list ($numrows, $uid) = $xoopsDB->fetchRow($sqlquery);
    if ($numrows > 0 ){
        return _MD_HER_MSG_STILLREGISTRY;
    }
  
    //---------------------------------------------------------
    //verifie qu'il n'y a pas deje un utilisateur avec cet email uniquement
    //---------------------------------------------------------    
    $sqlUserS = "SELECT count(uname) as nbEnr, max(uid) as uid FROM "._HER_TFN_XUSER
               ." WHERE email = '{$email}'";
    $sqlquery = $xoopsDB->query($sqlUserS);
    //echo "<hr>Select : <br>{$sql}<hr>";
    list ($numrows, $uid) = $xoopsDB->fetchRow($sqlquery);
    if ($numrows > 0 ){
        return _MD_HER_MSG_STILLEXIST;
    }
  
    //---------------------------------------------------------
    //l'utilisateur existe pas on le cre
    //---------------------------------------------------------    
    mdpAleatoire($mdpEnClair,$mdpCripte);    
    $sqlUserI = "INSERT INTO "._HER_TFN_XUSER
               ." (uname,name,email,pass) "
               ." VALUES ('{$name}', '{$name}', '{$email}', '{$mdpCripte}')";
  
    $xoopsDB->query($sqlUserI);  
    $uid = $xoopsDB->getInsertId();    
    //---------------------------------------------------------
    //et on l'associe au grpue registry ou anonymous selon q'il a mis un pseudo ou non
    //---------------------------------------------------------    
    $sqlUGI = "INSERT INTO "._HER_TFN_XGUID
               ."(uid,groupid) "
               ." VALUES ({$uid}, {$idGroupe})";
    $xoopsDB->query($sqlUGI);               
    sendMail_Subscribtion($name, $email,  $mdpEnClair);

  //-------------------------------------------------------------
//exit;  
  return _MD_HER_MSG_SUBSCRIPTION_OK;
  

}


/**************************************************************************
 *
 **************************************************************************/
function sendMail_Subscribtion($name, $email,  &$mdpEnClair){
global $xoopsConfig, $xoopsModuleConfig;

  //$email = 'jjd@kiolo.com'; //pour les tests
  $title = "Subscription to HERMES";
  $subject =  str_replace("%0%", $xoopsConfig['sitename'], _MD_HER_SUBJECT_SUBSCRIPTION);
  $link = "<A href='".XOOPS_URL."'>{$xoopsConfig['sitename']}</A>";

  $texte1 = str_replace("%0%", $link, _MD_HER_MAIL_FOR_SUBSCRIPTION1);
  $texte1 = str_replace("%1%", $name, $texte1);
  
  $texte2 = str_replace("%1%", $name, _MD_HER_MAIL_FOR_SUBSCRIPTION2);  
  $texte2 = str_replace("%2%", $mdpEnClair, $texte2);  
  $texte2 = str_replace("%3%", $email, $texte2);  

  $st2 = "style='width:80%;padding:0'";    

  
  $t=array();
  $t[] = "<html>";
  $t[] = "<head>";
  $t[] = "<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>";
  $t[] = "<title>{$title}</title>";  
  
  $fds = XOOPS_URL."/themes/{$xoopsConfig['theme_set']}/style.css";  
  $t[] = "<link rel='stylesheet' type='text/css' media='all' href='{$fds}' />"; 
  $t[] = "</head>";  
  $t[] = "<body>";
  
  //$t[] = "<table><tr><td>";  
  $t[] = "<table class='outer' cellspacing='1'  {$st2}>";
  $t[] = "<tr><th class='head'>";
  $t[] = $link;  
  $t[] = "</th></tr>";
  
        
  $t[] = "<tr class='even'><td>";  
  $t[] = $texte1;  
  $t[] = "</td></tr>";  
  
  $t[] = "<tr class='even'><td>{$texte2}</td></tr>";  
  
  //$t[] = "</td></tr></table>";  
  $t[] = "</table></body></html>";  





  
/*
  
      $style1 = ;
      $style3 = $xoopsModuleConfig[''];
      $style4 = $xoopsModuleConfig['style_pluginLastColone'];    
      $style5 = $xoopsModuleConfig['style_pluginOtherColones'];
*/  
    
  $texte = implode ("\n", $t);
  //echo "<hr>{$texte}<hr>";
  
  $header =  getHeader (1, $email);
  $d = date("d-m-Y h:m:h" , time());    
   
  //--------------------------------------------------------------
  //$bolOk = mail($email, $subject, $texte, $header);      
  hermesMail('',$email,$subject,$texte,true,1);
  
}



/*********************************************************************
mets la liste en remplacant les \r\n, \r et \n par des '|' et le ',' par ';'
$listeComplementaire: liste passe en référence modifiée
retour de cette meme lise mais sous forme de tableau
**********************************************************************/
function prepareListComplementaire(&$listeComplementaire, &$nbItem){
  $sep1 = "|";
  $sep2 = $sep1.$sep1;

    $listeComplementaire = str_replace ("\r",  $sep1, $listeComplementaire);
    $listeComplementaire = str_replace ("\n",  $sep1, $listeComplementaire);    
    $listeComplementaire = str_replace ($sep2, $sep1, $listeComplementaire);
    $listeComplementaire = str_replace (',',   ';',   $listeComplementaire);    
    $t=explode("|", $listeComplementaire);
    $nbItem= count($t);
    return $t;

}

/*******************************************************************
 *
 *******************************************************************/
function editBaliseSmarty($name, $list, $all = false){
  
  $t = array();         
  $tk = explode('|', $list);
  
  for ($h = 0; $h < count($tk); $h++){
    $k = $tk[$h];
    $cstName = '_AD_HER_BALISE_'.strtoupper($k);
    $b = defined($cstName);
    if (!($b | $all)) continue;
    
    $cst = ( $b ? constant($cstName): $cstName);
    $t[] = array('name'        => $k,
                 'balise'      => $name.'.'.$k,
                 'description' =>  $cst);   
          
  
  }
         
         

  //-------------------------------
  return $t;
  
}
/***********************************************************************
 * construit la ligne de titre de la section d'option du lexique
 ***********************************************************************/
function buildTitleArray($title, 
                         $description = '', 
                         $colSpan = 0, 
                         $bLine = false,
                         $border = 0){
  //$border=2;
    $t = array();
    //-------------------------------------------
    $cs = (($colSpan > 0) ? " colspan='{$colSpan}'" : '' );
    //$cb = (($border  > 0) ? " bordercolor='{$border}px' color='#FFFFFF'" : '' );
    $cb = (($border  > 0) ? " style='border: {$border}px solid #000000; padding: 0;'": '' );    
    //------------------------------------------- 
//echo "<hr>buildTitleArray<br>{$cb}<hr>";

       
    $t[] = "<TR>";
    $t[] = "<TD align='left' {$cs} {$cb}><B><font color='#0000FF'>";
    $t[] = $title;
    $t[] = "</font></B>";    
   
    
    if ($description <> ''){
      $t[] = "<BR>";  
      $t[] = "<i><font color='#0000FF'>{$description}</font></i>";    
    }
    
    $t[] = "</TR>";    
    
    if ($bLine) $t[] = buildHR(1, _HER_HR_COLOR1, $colSpan); 

    //-------------------------------------------
    return implode(_br, $t)._br;

}

/***********************************************************************
 * construit la ligne de titre de la section d'option du lexique
 ***********************************************************************/
function buildTitleArray2($title, 
                         $description = '', 
                         $colSpan = 0, 
                         $bLine = false,
                         $border = 0){
  //$border=2;
    $t = array();
    //-------------------------------------------
    $cs = (($colSpan > 0) ? " colspan='{$colSpan}'" : '' );
    $cb = (($border  > 0) ? " border='{$border}px' color='#FFFFFF'" : '' );
    //------------------------------------------- 
echo "<hr>buildTitleArray<br>{$cb}<hr>";

       
    $t[] = "<TR>";
    $t[] = "<TD align='left' {$cs} borer='5'><B><font color='#0000FF'>zzzzz{$title}</font></B></TD>";    
    $t[] = "</TR>";    
    
    if ($description <> ''){
      $t[] = "<TR>";  
      $t[] = "<TD align='left' {$cs} {$cb}><i><font color='#0000FF'>{$description}</font></i></TD>";    
      $t[] = "</TR>";      
    }
    
    
    
    if ($bLine) $t[] = buildHR(1, _HER_HR_COLOR1, $colSpan); 

    //-------------------------------------------
    return implode(_br, $t)._br;

}

/*******************************************************************
 *
 *******************************************************************/
function editSmartyBalises($idPlugin){
global $xoopsDB;
	  
	  //echo "<hr>editSmartyBalises<br>{$idPlugin}<hr>";
    $myts =& MyTextSanitizer::getInstance();
      $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 3);    
  	
    $h = 0;   
 
    //$params = db_getPluginParams($p['idPlugin'], $nbParams);
    $plugin = $xoopsDB->fetchArray(db_getPlugins($idPlugin));
    //$params = db_getFulParams($idPlugin, $nbParams, $idStructure );   
    echo "<INPUT TYPE=\"hidden\" id='txtIdStructure'  NAME='txtIdStructure'  size='1%'  VALUE='{$idStructure}'>\n";     
    

      echo buildTitleArray(_AD_HER_PLUGIN_PARAMS_G, "" , 3, true);
    
      $tBalise = editBaliseSmarty('property', _HER_BALISE_PROPERTY);
          while (list ($key, $item) = each ($tBalise)) { 
              echo "<tr>"
                  ."<td><b><font color=red><{\${$item['balise']}}></font></b></td>"
                  ."<td>{$item['name']}</td>"                       
                  ."<td>{$item['description']}</td>"
                  ."</tr>";
          
          
          }     
      echo $ligneDeSeparation;
      //-----------------------------------------------------------
      echo buildTitleArray(_AD_HER_PLUGIN_PARAMS_S, "" , 3, true);
    
      $tBalise = editBaliseSmarty('structure', _HER_BALISE_STRUCTURE);
          while (list ($key, $item) = each ($tBalise)) { 
              echo "<tr>"
                  ."<td><b><font color=red><{\${$item['balise']}}></font></b></td>"
                  ."<td>{$item['name']}</td>"                       
                  ."<td>{$item['description']}</td>"
                  ."</tr>";
          
          
          }     
      echo $ligneDeSeparation;
      
      //-----------------------------------------------------------      
      $obPlugin = getPluginClass($idPlugin);
      $col = $obPlugin->setShowOrder($params);
      while (list ($key, $item) = each ($col)) {  
            echo "<tr>"
                ."<td><b><font color=red><{\$info[h].{$key}.value}></font></b></td>"
                ."<td><b><font color=red><{\$info[h].{$key}.name}></font></b></td>"                
                ."<td>{$item['name']}</td>"                       
                ."<td>{$item['description']}</td>"
                ."</tr>";
      }  


          //---------------------------------------------
          //if ($params[_HER_LIST_ID_ITEM]) echo '';
              

	 
}

/*******************************************************************
 *
 *******************************************************************/
function editParamsPlugins($idPlugin, $idStructure , &$params){
global $xoopsDB;
	  
    $myts =& MyTextSanitizer::getInstance();
      $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 3);    
  	
    $h = 0;   
 
    //$params = db_getPluginParams($p['idPlugin'], $nbParams);
    $plugin = $xoopsDB->fetchArray(db_getPlugins($idPlugin));
    $params = db_getFulParams($idPlugin, $nbParams, $idStructure );   
    echo "<INPUT TYPE=\"hidden\" id='txtIdStructure'  NAME='txtIdStructure'  size='1%'  VALUE='{$idStructure}'>\n";     
    
    if ($idStructure < 0){
      echo buildTitleArray(_AD_HER_PLUGIN_PARAMS_G, "" , 3, true);
    
      $tBalise = editBaliseSmarty('property', _HER_BALISE_PROPERTY);
          while (list ($key, $item) = each ($tBalise)) { 
              echo "<tr>"
                  ."<td><b><font color=red><{\${$item['balise']}}></font></b></td>"
                  ."<td>{$item['name']}</td>"                       
                  ."<td>{$item['description']}</td>"
                  ."</tr>";
          
          
          }     
      echo $ligneDeSeparation;
      //-----------------------------------------------------------
      echo buildTitleArray(_AD_HER_PLUGIN_PARAMS_S, "" , 3, true);
    
      $tBalise = editBaliseSmarty('structure', _HER_BALISE_STRUCTURE);
          while (list ($key, $item) = each ($tBalise)) { 
              echo "<tr>"
                  ."<td><b><font color=red><{\${$item['balise']}}></font></b></td>"
                  ."<td>{$item['name']}</td>"                       
                  ."<td>{$item['description']}</td>"
                  ."</tr>";
          
          
          }     
      echo $ligneDeSeparation;
      
      
      
    }
      
    
    
    
    if ($nbParams > 0){
        echo buildTitleArray(_AD_HER_PLUGIN_PARAMS_MANAGEMENT, "" , 3, false);

        //echo "<div><B>"._AD_HER_PLUGIN_PARAMS_MANAGEMENT." ({$idPlugin}-{$idStructure})</B></div>";    
    
          $level = 0;
          //------------------------------------------------------------------
          while (list ($key, $sqlfetch) = each ($params)) {
            //$bg = getRowStyle($row,'',0, _HER_TR_BASE); 
            if ( $sqlfetch['level'] == 0) continue;
            if ($level <> $sqlfetch['level']){
              echo  $ligneDeSeparation;
              $level = $sqlfetch['level'];              
            }
            //--------------------------------------------------------
             $txtName = "txtParamNom_{$h}";          
             $txtHidenName = "txtHParamNom_{$h}";          
             echo "<INPUT TYPE=\"hidden\" id='{$txtHidenName}'  "
                 ." NAME='{$txtHidenName}'  size='1%'  " 
                 ." VALUE='{$key}'>";
             
             
             $typeParam = (isset($sqlfetch['type'])  ? $sqlfetch['type'] : 0  );     
             echo "<INPUT TYPE=\"hidden\" id='txtTypeParam_{$h}'  "
                 ." NAME='txtTypeParam_{$h}'  size='1%'  " 
                 ." VALUE='{$typeParam}'>";
                 
           //displayArray($sqlfetch,"----- $key -----");
           //while ($sqlfetch = $xoopsDB->fetchArray($params)) {
              if (!isset($sqlfetch['type'])) $sqlfetch['type'] = 0;
              if (!isset($sqlfetch['description'])) $sqlfetch['description'] = '';              
              $name =  "</b><b>{$sqlfetch['name']}</b>(<font color=red>{$key}</font>)";              

              //if ($idStructure < 0 ) $typeParam = -1;
              switch ($typeParam){
              //-----------------------------------------------------------
              case _HER_TYPE_PARAMS_SPIN: //c'est un spin
                    echo buildSpin($name, $sqlfetch['description'], 
                                   $txtName, $sqlfetch['value'], 
                                    $sqlfetch['max'], 
                                    $sqlfetch['min'],
                                    1, 10);
                  
                    break;
              //-----------------------------------------------------------                    
              case _HER_TYPE_PARAMS_LIST: //c'est une liste de libele dont le numéro d'ordre est atomatique 
                      $list = explode('|', $sqlfetch['list']);
                      echo buildList($name, 
                                     $sqlfetch['description'], 
                                     $txtName, 
                                     $list, 
                                     $sqlfetch['value']);
                    break; 
              //-----------------------------------------------------------                                     
              case _HER_TYPE_PARAMS_TEMPLATE: //c'est un template affiche la lsite des template du module + les g‚n‚riques
                   //********************************************************************
                   //---Template   
                    $f = dirname(_HER_ROOT_PLUGINS.$plugin['nomFichier']).'/';
                    
                    $lstFiles = getFileListH($f, '.html', 2);
                    $lstFilesGen = getFileListH(_HER_ROOT_TPL_GEN, '.html', 2);
                
                    $lstFiles = array_merge ($lstFiles, $lstFilesGen);    
                    array_unshift ( $lstFiles, '');    
                    $lg = strlen(_HER_ROOT_PLUGINS);
                    
                    //echo "<hr>{$lg} len_files<br>{$f}<hr>";
                    //displayArray($lstFiles,"----- liste des fichiers -----");
                    $i = 0;
                    for ($j = 0; $j < count($lstFiles); $j++){
                      $lstFiles[$j] = substr($lstFiles[$j], $lg);
                      echo "<INPUT TYPE=\"hidden\" id='txtFile_{$j}'  NAME='txtFile_{$j}'  size='1%'"." VALUE='{$lstFiles[$j]}'>\n";
                      if ($lstFiles[$j] ==  $sqlfetch['value']) $i = $j; 
                      //echo "<hr>{$lstFiles[$j]}-{$sqlfetch['value']}<hr>";
                    }
                
                    //echo buildList(_AD_HER_TEMPLATE, _AD_HER_TEMPLATE_DSC, 'txtTemplate', $lstFiles, $i);      
                      
                      
                      //$list = explode(';', $sqlfetch['list']);
                      echo buildList($name, 
                                     $sqlfetch['description'], 
                                     $txtName, 
                                     $lstFiles, 
                                     $i);
                    break;      
              //-----------------------------------------------------------                                
              case _HER_TYPE_PARAMS_AFFICHAGE: //options d'affichage
                   //********************************************************************
                  //--element a afficher 
              
                  $lib = 'lib';
                  $val = 'val';
                  $id  = 'id';
                  $h=0;
                  $b = $sqlfetch['value'];
              
                  $t = array(array($lib => _AD_HER_STRUCTURE_CAPTION,  $val => isBitOk($h, $b), $id => $h++),
                             array($lib => _AD_HER_NAME,     $val => isBitOk($h, $b), $id => $h++), 
                             array($lib => _AD_HER_HEADER,   $val => isBitOk($h, $b), $id => $h++),  
                             array($lib => _AD_HER_DETAIL,   $val => isBitOk($h, $b), $id => $h++),               
                             array($lib => _AD_HER_FOOTER,   $val => isBitOk($h, $b), $id => $h++),
                             array($lib => _AD_HER_COLTITLE, $val => isBitOk($h, $b), $id => $h++),
                             array($lib => _AD_HER_CATEGORY, $val => isBitOk($h, $b), $id => $h++));
                             
                                                                                       
                  echo "<tr><td><b>{$name}</b><td>"._br;
                  //echo buildCheckedListH ($t, '' , "txtParamNom_{$h}", 0, 1, $lib, $val, $id);
                  echo buildCheckedListH ($t, '' , "txtOptionsAffichage", 0, 1, $lib, $val, $id);                  
                  echo "</td></tr>"._br;
                  echo buildDescription(_AD_HER_AFFICHAGE_DSC,2);
                    
                  break;              
              //-----------------------------------------------------------                                 
              case _HER_TYPE_PARAMS_FRAME: //modele de cadre        
                    //---modele de cadre
                    $defaut = $sqlfetch['value'];
              
                    $selected = buildHtmlListFromTable ($txtName, 
                                                 _HER_TAB_DECO,
                                                 'name', 
                                                 'idDeco', 
                                                 'name', 
                                                 $defaut,
                                                 '',
                                                 "decoModele = 'frame'",
                                                 '150','',true);
                  
                    echo buildSelecteur(_AD_HER_FRAME,_AD_HER_FRAME_DSC , $selected );
                          
                  break;              
              //-----------------------------------------------------------                                 
              case _HER_TYPE_PARAMS_TITLE: //c'est un titre                    
                   echo buildTitleOption3 ($sqlfetch['description']);
                   echo "<INPUT TYPE=\"hidden\" id='$txtName'  "
                       ." NAME='$txtName'" 
                       ." VALUE=''>";
                   
                   break;
              //-----------------------------------------------------------  
              case _HER_TYPE_PARAMS_BALISE:
                  echo "<tr>"
                      ."<td><b><font color=red><{\$info[h].{$key}}></font></b></td>"
                      ."<td>{$sqlfetch['name']}</td>"                       
                      ."<td>{$sqlfetch['description']}</td>"
                      ."</tr>";
                  break; 
                  
                  
              //-----------------------------------------------------------                  
              case _HER_TYPE_PARAMS_TEXT: //zone de texte   
                      $desc1 = getEditorHTML(_EDITOR_TEXTAREA, 
                           $sqlfetch['value'], 
                           $txtName, 'Texte', '600px', '50px', 5, 120 );
                      
                      echo "<tr>";
                      echo "<td>{$name}</td>"; 
                      echo "<td>";                                           
                      echo $desc1->render();
                      echo "</td></tr>";
                      echo buildDescription($sqlfetch['description'],2);                                                  
                  break;                  

              
              //-----------------------------------------------------------                              
              default: //_HER_TYPE_PARAMS_VARCHAR
                //---nom - valeur en direct du plugin          
                echo buildInput($name, 
                                $sqlfetch['description'],
                                $txtName, 
                                $myts->makeTboxData4Show($sqlfetch['value'], "1", "1", "1"),
                                 '60', $sqlfetch['name']);

                break;
              }

            //---------------------------------------------------------------
            $h++;      
          }
          //---------------------------------------------
          //if ($params[_HER_LIST_ID_ITEM]) echo '';
    }          

	 
}
/*******************************************************************
 *
 *******************************************************************/
function editParamsPluginsCat($idPlugin, $idStructure , &$params){
global $xoopsDB;

    //echo "<hr>{$params[_HER_LIST_ID_ITEM]['value']}<hr>";
    $tId = explode(',', $params[_HER_LIST_ID_CAT]['value']);
    $tIdCat = array_flip($tId);   
	  $obPlugin = getPluginClass($idPlugin);
    $rst = $obPlugin->getRstCategorieGen($params);
    
    
    if (!($rst === false)) {
      //echo "<table><tr><td>lister les id du module</td></tr></table>";    
      while ($sqlfetch = $xoopsDB->fetchArray($rst)) {
        $ok = (isset($tIdCat["{$sqlfetch['catIdCat']}"]) ) ? 'checked':'' ;
        $chk = "<input type='checkbox' name='chkIdCat_{$sqlfetch['catIdCat']}' value='1' {$ok}>";      
      
        echo "<tr>";
            echo "<td>---></td>"; 
            echo "<td>{$chk}</td>";   
                
            echo "<td>{$sqlfetch['catIdCat']}</td>";   
            echo "<td>{$sqlfetch['catLib']}</td>";  
            echo "<td></td>";   
            echo "<td></td>";  
            
                               
        echo "</tr>";        
      }



      
    }else{
      echo "<tr><td><b>pas de liste</b></td></tr>";    
    }



}

/*******************************************************************
 *
 *******************************************************************/
function editParamsPluginsItem($idPlugin, $idStructure , &$params){
global $xoopsDB;

    //echo "<hr>{$params[_HER_LIST_ID_ITEM]['value']}<hr>";
    $tId = explode(',', $params[_HER_LIST_ID_ITEM]['value']);
    $tIdItem = array_flip($tId);   
	  $obPlugin = getPluginClass($idPlugin);
    $rst = $obPlugin->getRstItemGen($params);
    
    
    if (!($rst === false)) {
      //echo "<table><tr><td>lister les id du module</td></tr></table>";    
      while ($sqlfetch = $xoopsDB->fetchArray($rst)) {
        $ok = (isset($tIdItem["{$sqlfetch['itemIdItem']}"]) ) ? 'checked':'' ;
        $chk = "<input type='checkbox' name='chkIdItem_{$sqlfetch['itemIdItem']}' value='1' {$ok}>";      
      
        echo "<tr>";
            echo "<td>---></td>"; 
            echo "<td>{$chk}</td>";   
                
            echo "<td>{$sqlfetch['itemIdItem']}</td>";
            echo "<td>{$sqlfetch['itemLib']}</td>";            
            echo "<td>{$sqlfetch['catIdCat']}</td>";   
            echo "<td>{$sqlfetch['catLib']}</td>";                     
        echo "</tr>";        
      }



      
    }else{
      echo "<tr><td><b>pas de liste</b></td></tr>";    
    }



}

/**************************************************************************
 *
 **************************************************************************/
 function getPluginClass($idPlugin){
	global $xoopsModuleConfig, $xoopsDB;
	
    $sql = "SELECT * FROM "._HER_TFN_PLUGIN
          ." WHERE idPlugin = {$idPlugin}";
    $sqlquery = $xoopsDB->query ($sql);
    $rstPlugin  = $xoopsDB->fetchArray($sqlquery);   
    
    $folder = _HER_ROOT_PATH."plugins/";
    $fileName = $rstPlugin['nomFichier'];
    //echo 'idPlugin -> '.$idPlugin.'<br>'; 
    //echo "plugin include --{$idPlugin}----> ".$fileName.'***'.$rstPlugin['nomFichier'].'<br>';
    $fulName = $folder.$fileName;
    if (!is_readable($fulName)){ return'';}
    //echo "plugin include --{$idPlugin}----> ".$fulName.'<br>'.$rstPlugin['nomFichier'].'<br>';
      
    include_Once ($fulName);
    $langFile = getLanguageFile($fulName);
    $nomClasse = 'cls_'.extractFileNameFromFullName($fileName);
    //echo "nom de la classe : {$nomClasse}<hr>";  
    $mode = 0;//pas utiliser pour le moment
    $obPlugin = new $nomClasse(array('lang' => $langFile, 'jjd' => 'JJD'), $mode);
    //echo 'nom de la classe : '.get_class($ob).'<hr>';    


    return $obPlugin;
    //displayArray($tParams,"----- getInfoPluggin -----");
    //---------------------------------------------------------------------

 }

/**************************************************************************
 *
 **************************************************************************/
 function db_getItemId($idPlugin, $oldIdList = ''){
	global $xoopsModuleConfig, $xoopsDB;
	 
	 $obPlugin = getPluginClass($idPlugin);
    $rst = $obPlugin->getRstItemGen($params);

                 
      
 }


/*****************************************************************
 
 *****************************************************************/
function getContentTestMail(){
     global  $ModName, $signature, $mail_admin, $xoopsConfig, $xoopsDB, $xoopsModule;
  //echo "<hr>function getContentTestMail<hr>";
  //-----------------------------
  //-----------------------------
  $t=array();
  //$t[] = $header; 
  $t[] = "\n\n";   
  $t[] = "<html>";
  $t[] = "<head>";
  $t[] = "<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>";
  $t[] = "<title>test HERMES</title>";  
  $t[] = "</head><body>";  
  $t[] = "date du ".date("D M j G:i:s T Y")."<br>\n";  
  $t[] = "<br><b>bonne nouvelle</b><br>";  
  $t[] = "<b>Bonjour, ceci est un test d'envoi de mail pour <i>hermes</i></b><br>";
  $t[] = "<b>de la part de <b>{$xoopsConfig['sitename']}</b></b>";   
  $t[] = "</body></html>";

  $mail_body = implode (hermes_crlf, $t);
  return $mail_body;
}
/*****************************************************************
 
 *****************************************************************/
function testMail(){
     global  $ModName, $signature, $mail_admin, $xoopsConfig, $xoopsDB, $xoopsModule;
  //echo "<hr>function testMail<hr>";
  //-----------------------------
  $added = array('jjd@kiolo.com','jjdelalandre@wanadoo.fr','admin@win-trading.com');
  $mail_fromname = "test jjd hermes"; 
  $mail_fromemail = "admin@win-trading.com";  
  $mail_subject = "test hemes";
  $header = getHeader (1, $mail_fromemail);
  //-----------------------------
  $mail_body = getContentTestMail();
  
  
  
  //-----------------------------  
      for ( $i = 0; $i < count($added); $i++) {
        hermesMail($added[$i],$mail_fromemail,$mail_subject,$mail_body,true,1);          
      }
      
  //---------------------------
  exit;

}
/*****************************************************************
 
 *****************************************************************/
function hermesMail($added,
                    $mail_fromemail,
                    $mail_subject,
                    $mail_body,
                    $bEcho = false,
                    $mode = 0, 
                    $sep = '|'){
     global  $ModName, $signature, $mail_admin, $xoopsConfig, $xoopsDB, $xoopsModule;
  
  
  //$bEcho=false;
  //echo "<hr>function hermesMail<hr>";

  // $added = array('jjd@kiolo.com','jjdelalandre@wanadoo.fr','admin@win-trading.com');
  //$mail_fromname = "test jjd hermes";
  $mail_fromname = $mail_fromemail;   
  //$mail_fromemail = "admin@win-trading.com";  
  //$mail_subject = "test hemes";
  //$mail_body = getContentTestMail(); 
  //-----------------------------
  if (!is_array($added)) $added= explode($sep, $added);
  $header = getHeader (1, $mail_fromemail);
  //-----------------------------
      $myts =& MyTextSanitizer::getInstance();
      $xoopsMailer =& getMailer();


          //$xoopsMailer->setToUsers($added[$i]);

      for ( $i = 0; $i < count($added); $i++) {
          //$xoopsMailer->setToUsers($added[$i]);
          $xoopsMailer->setToEmails($added[$i]);          
          //echo "setToUsers : {$added[$i]}<br>";
          
      }
      
      $xoopsMailer->multimailer->IsHTML(true);
      $xoopsMailer->setFromName($myts->oopsStripSlashesGPC($mail_fromname));      
      
      $xoopsMailer->setFromEmail($myts->oopsStripSlashesGPC($mail_fromemail));

      $xoopsMailer->setSubject($myts->oopsStripSlashesGPC($mail_subject));      
      $xoopsMailer->setBody($myts->oopsStripSlashesGPC($mail_body));
      //$xoopsMailer->encodeBody($mail_body);

      
    $xoopsMailer->useMail();
      
      
      $xoopsMailer->send($bEcho);
      if ($bEcho){
        echo $xoopsMailer->getSuccess();
        echo $xoopsMailer->getErrors();
      
      }
/*

 echo "<hr>mail_fromname : {$mail_fromname}<br>"
      ."mail_fromemail : {$mail_fromemail}<br>"
      ."mail_subject : {$mail_subject}<br>"
      ."mail_body : {$mail_body}<br><hr>";     
*/      
//---------------------------
/*

  $adresse = "jjd@kiolo.com"; 
  $bolOk = mail($adresse, "test envoi mail", "test envoi envoi mail via php");  
  $r= (($bolOk) ? " => Succés" : "Echec");
  echo "<hr>==> <b>{$r}</b> de l'envoi du mail a: ==> {$adresse}<br>" ;      
*/
}

/****************************************************************
 *
 ****************************************************************/

function updateQuantiemeLecture(){
	Global $xoopsDB, $xoopsConfig, $xoopsModule;
	
  $sql = "SELECT tl.*, ta.dateParution AS dateParution "
        ."  FROM "._HER_TFN_LECTURE." AS tl, "._HER_TFN_ARCHIVE." AS ta"
        ." WHERE tl.idArchive = ta.idArchive ";
  $sqlquery = $xoopsDB->query ($sql); 
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    $nbJours = difDays (strtotime($sqlfetch['dateParution']) , $sqlfetch['dateLecture']);
    
    $nbJours = difDays ($sqlfetch['dateLecture'], strtotime($sqlfetch['dateParution']));        
    $sql = "UPDATE "._HER_TFN_LECTURE
    ." SET quantieme   = {$nbJours}"
    ." WHERE idLettre  = {$sqlfetch['idLettre']} "
    ." AND idArchive   = {$sqlfetch['idArchive']} "
    ." AND dateLecture = {$sqlfetch['dateLecture']}";
    
    $xoopsDB->queryF ($sql);    
    //echo "<hr>{$sql}<br>";
  }



 
  
}

/*************************************************************************
 *
 *************************************************************************/
function getAllBaliseFromTemplates($template){

  
  if (is_array($template)){
    $t = $template;  
  }else{
    $template .= '|header_standard.htm|footer_standard.htm';  
    $t = explode('|', $template);  
  }
  //her_displayArray($t,"----- getAllBaliseFromTemplates -----");
  $tBalises = array();
  
  for ($h = 0; $h < count($t); $h++){
    $tb = getBaliseFromTemplate($t[$h], 'her_');
    $tBalises = array_merge($tb, $tBalises);
  }
  
  sort ($tBalises);
  return $tBalises;
    
}
/*************************************************************************
 *
 *************************************************************************/
function getBaliseFromTemplate($template, $prefixe2exclude = 'her'){
  

  $f = _HER_ROOT_TEMPLATES."letter/".$template;
  //echo "<hr>getBaliseFromTemplate<br>{$f}<hr>";
  
  $fp = fopen ($f, "r");  
  $contents = fread ($fp, filesize ($f));  
  fclose ($fp);
  //echo "<hr>readNewLetter<hr>$fullName<hr>$contents<hr>";
  
  $r = parceContent($contents, _HER_REGEXP_BALISE_SMARTY, $prefixe2exclude);  

  
  $p = '#<\{[a-z ]*[\$]([a-z0-9_]*)[\} =<>]#isU';  
  return $r;  
  
   
}

/*************************************************************************
 *
 *************************************************************************/
function parceContent($contents, $regExp, $prefixe2exclude = 'her'){
//echo $contents;

  
  $b = preg_match_all($regExp, $contents ,$t );  
  //echo "<hr>getBaliseFromTemplate<br><pre>{$contents}</pre><hr>";  
  //her_displayArray($t);  
  
  $r = array();
  $lg = strlen($prefixe2exclude);
  if ($lg == 0){
        return $t[1];  
  }else{
      for ($h = 0; $h < count($t[1]); $h++){
          if (substr($t[1][$h],0,$lg) <> $prefixe2exclude) $r[] = $t[1][$h];
        }
      
      return $r;
  
  }
    
}

/*************************************************************************
 *
 *************************************************************************/
function testRegexp(){

  $t = "{a}{a}{z}{e}{r}{tt}";
 $t = '<{$ggggg }>oooo<{if $tt==0}>oooo<{if $e>p}>ooo<{a}>ooo<{A}>ooo<{$Aa}>ooo<{$aaaaaA}>';  
  //$p = "(<{)*(>})"; 
  //$p = "^[\{].\}$";  
  //$p = "^[\{].";  
 $p = '#<\{[a-z ]*[\$]([a-z]*)[\} =<>]#isU';  
  
  $b = preg_match_all($p, $t ,$r );  
  //ereg($p, $test ,$r );
  her_displayArray($r);
  
}
//------------------------------------------------------------------------------
 function testExpReg(){ 
 //$p = "<title>(.*)</title>" 
 //$p = '#<\{([a-z $]*)\}>#isU'; 
 $p = '#<\{[a-z ]*[\$]([a-z]*)\}>#isU'; 
 $p = '#<\{[a-z ]*[\$]([a-z]*)[\} =<>]#isU'; 
  
  
 //$p = '#\{#iU'; 
  
 $html = "<b></b><i></i>"; 
// $n=preg_match_all ("|<([^> ]+)[^>]*>[^<]*</\\1>|iU", $html, $r); 
  
  
 $t = '<{$ggggg }>oooo<{if $tt==0}>oooo<{if $e>p}>ooo<{a}>ooo<{A}>ooo<{$Aa}>ooo<{$aaaaaA}>'; 
// $titre = eregi($p,$t,$r); 
 $titre = preg_match_all($p,$t,$r); 
 her_displayArray($r,"--------------------------------"); 
  
 exit; 
  
 } 

/*************************************************************************
 *
 *************************************************************************/
function updateDecorations(){
  
  $folder = _HER_ROOT_PATH.'decorations/';
 // echo "<hr>{$folder}<hr>";
  //$t = getFiles($folder, '.php');
  $t =  getFileListH($folder, $extention = ".php");
  //her_displayArray($t, "----- updateDecorations -----");
  
  for ($h = 0; $h < count($t); $h++){
    $clName = basename($t[$h], '.php');
    include_once($t[$h]);
    
    //echo "<hr>{$clName}<hr>";
    $obDeco = new $clName();
    //echo $obDeco->getVersion();
    $obDeco->create();    
    
  }

}

/*************************************************************************
 *
 *************************************************************************/
function transfertSouscription(){
	Global $xoopsDB, $xoopsConfig, $xoopsModule;  

}

?>
