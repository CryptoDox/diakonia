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


include_once ("admin_header.php");


//define ('_HER_COEF_LIST', 100);



//define ("_br", "<br>");

$sep = ":";

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idLettre',  'default' => 0),
              array('name' =>'idCession', 'default' => 0),              
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");

 
/****************************************************************************
 *
 ****************************************************************************/
 // sendAllLettersFromTemp ($idLettre, $idCessionTemp, $options)
//displayArray($p,"***************************");

//--------------------------------------------------------------------   
   
 
//$sParam = implode('|', $option);
//---------------------------------------------------------------------


/**************************************************************************
 *
 **************************************************************************/

function readNewLetter($fullName){
  
  //echo "<hr>readNewLetter<br>$fullName<hr>";
  //$fullName = getFulNameArchive($fileName,  $path);   

  $fp = fopen ($fullName, "r");  
  $contents = fread ($fp, filesize ($fullName));  
  fclose ($fp);
  //echo "<hr>readNewLetter<hr>$fullName<hr>$contents<hr>";
  return $contents;

}
/****************************************************************************
 *
 ****************************************************************************/
function addUser2temp ($idCessionTemp, $tUser){
global $xoopsModuleConfig, $xoopsDB;
  
  if ($tUser['name']  == '') $tUser['name']  = $tUser['email'];
  if ($tUser['uname'] == '') $tUser['uname'] = $tUser['email'];  
  
  
   $sql = 'INSERT INTO '._HER_TFN_TEMP
         .'(idCession,idUser,name,pseudo,email,format,flag)'
         .' VALUES ('
         .$idCessionTemp.','
         .$tUser['uid'].','
         .string2sql($tUser['name'], true).','               
         .string2sql($tUser['uname'], true).','
         .string2sql($tUser['email'], true).','
         .$tUser['state'].','
         .'1)';
    $xoopsDB->queryF ($sql);      
    //echo "<hr>{$sql}<hr>";//exit;         


}


/****************************************************************************
 *
 ****************************************************************************/
function initCession ($idLettre){
    $params = array();
    $texteHTML = buildLetter ($idLettre, $params, _HER_SEND);
    //displayArray($params,"----- initCession -----");
    $idCession = getNewCessionTemp($idLettre, 
                                   $params['idArchive'], 
                                   $params['libelle'], 
                                   $params['fullNameArchive'],
                                   $params['emailSender'],                                   
                                   $params['personnalisable'],
                                   $params['idListe']);

  //db_getUsers($idCession, $idLettre, 2, $params['idArchive'], true);
  //sendAllLettersFromTemp($idCession);
  //---------------------
  return $idCession;
}
/****************************************************************************
 *
 ****************************************************************************/
function buildList222 ($idCession){
    buildUsersListComplementaire($idCession, 30);
}

/****************************************************************************
 *
 ****************************************************************************/
function sendLot ($idCession, $first){
  //if ($idCesion == 0) $idCession = getLastCession();
  //echo "cession = {$idCession}<hr>";
  $done = sendAllLettersFromTemp($idCession, $first);
  //$reste = countMailForCession($idCession);  
  //if ($reste == 0){
    //razCession(idCession);
  //}
  //---------------------
  return $done;
  
}
 /*********************************************************************

**********************************************************************/

function getUserRegistry($idLettre){
	global $xoopsModuleConfig, $xoopsDB;

    $sqlUser  = "SELECT DISTINCT user.uid as uid, user.email, user.uname, user.name, 1 as state FROM "
              ._HER_TFN_GROUPE.'  as groupe ,'
              .$xoopsDB->prefix('groups_users_link').' as gl ,'  
              .$xoopsDB->prefix('users').'             as user '
              ." WHERE groupe.idGroupe = gl.groupid "
              ."   AND gl.uid = user.uid "
              ."   AND groupe.idLettre = {$idLettre}";
              
    $sqlquery = $xoopsDB->query ($sqlUser);            
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    return $nbEnr;
}

 /*********************************************************************

**********************************************************************/

function buildUsersRegistry($idCessionTemp, $idLettre, $first= 0, $lot = 0){
// format = 2 : html
// format = 1 : texte
$tEMails = array();
	global $xoopsModuleConfig, $xoopsDB;
	global $xoopsModule, $xoopsConfig;
	
    $lot = $xoopsModuleConfig['lotUserRegistry']-1;


    //---------------------------------------------------------------------  
    //premiere sous requete pour selectioner tous les user appartenant au groupe
    //affiliiéla lettre
    //---------------------------------------------------------------------
    $sqlUser  = "SELECT DISTINCT user.uid as uid, user.email, user.uname, user.name, 1 as state FROM "
              ._HER_TFN_GROUPE.'  as groupe ,'
              .$xoopsDB->prefix('groups_users_link').' as gl ,'  
              .$xoopsDB->prefix('users').'             as user '
              ." WHERE groupe.idGroupe = gl.groupid "
              ."   AND gl.uid = user.uid "
              ."   AND groupe.idLettre = {$idLettre} "
              ." LIMIT {$first},{$lot}";
              
              
//echo "<hr>buildUsersRegistry<br>$sqlUser<hr>";              
              /*

    if ($lot == 0){
        $sqlqueryUser = $xoopsDB->query ($sqlUser);    
    }else{
        $sqlqueryUser = $xoopsDB->query ($sqlUser, $first, $lot);    
    }
              */    
        $sqlqueryUser = $xoopsDB->queryF ($sqlUser);            
    //---------------------------------------------------------------------
    //deuxieme requtee pour selectionner les user qui ont revoquer la lettre
    // ou toute les lettres ou les demande au format texte
    //---------------------------------------------------------------------
    $tr = getUserRevoked($idLettre);

    //-------------------------------------------------
    $h = 0;
    while ($sqlfetch = $xoopsDB->fetchArray($sqlqueryUser)) {
      $h++;
      $k = $sqlfetch ['email'];
      if (isset($tr [$k])) {
          if ($tr [$k]['state'] > 0){
            $sqlfetch['state'] = $tr [$k]['state'];

            //$tEMails[$sqlfetch['email']] = true; 
            //---------------------------------------------     
            addUser2temp($idCessionTemp, $sqlfetch);                  
 
          }
      }else{
  
         //$tEMails[$sqlfetch['email']] = true;  
         addUser2temp($idCessionTemp, $sqlfetch);     
      }

    }
    //---------------------------------
// exit;
    //-------------------------------------------------    
    //echo "<hr>resultat : {$first}-{$h}<hr>";
    return $first + $h ;    
                
      
 }
/*********************************************************************

**********************************************************************/

function addAuthor($idCession){
global $xoopsModuleConfig, $xoopsModule;

   //$t = explode('|', $xoopsModuleConfig['']) 

   $newMail = array('uid'   => 0,
                    'name'  => 'JÝJÝD',
                    'uname' => 'JJDAI',
                    'email' => 'jjd@kiolo.com',
                    'state' => 0);
  
//  displayArray($newMail,"---  addAuthor---") ; 
  
/*

    echo "<hr>name : {$newMail['name']}<br>"
         ."uname : {$newMail['uname']}<br>"
         ."email : {$newMail['email']}<hr>";    
*/         
                        
    addUser2temp($idCession, $newMail);      



}
 
/*********************************************************************

**********************************************************************/

function getUserRevoked($idLettre){
	global $xoopsModuleConfig, $xoopsDB;
    //---------------------------------------------------------------------
    //Renvoi un tableau des utilisateru qui ont révoké la lttre passé en parametre
    //---------------------------------------------------------------------
    
    $sqlRevoked = "SELECT email, state FROM "._HER_TFN_USERS
                 ." WHERE idLettre in (0,{$idLettre})";
    $sqlqueryRevoked = $xoopsDB->queryF ($sqlRevoked);
    $tr = array();
    
    //$idCessionTemp = getNewCessionTemp();
    //echo "idCessionTemp = {$idCessionTemp}";
      
   while ($sqlfetch = $xoopsDB->fetchArray($sqlqueryRevoked)) {
      $tr [$sqlfetch ['email']] = $sqlfetch; //array($sqlfetch ['idUser'],$sqlfetch ['state']);
    }
  
  return $tr;
}


/*********************************************************************

**********************************************************************/

function buildUsersListComplementaire($idCession, &$total){
	global $xoopsModuleConfig, $xoopsDB;
$tEMails = array();
$sepUser = '|';
$sepItem = ';';

$lot = $xoopsModuleConfig['lotUserNotRegistry'];
    //-------------------------------------------------
    // ajout de la liste complementaire 
    //------------------------------------------------- 
    $sql = "SELECT listeComplementaire, countListeComplementaire "
          ."  FROM "._HER_TFN_CESSION
          ." WHERE idCession = {$idCession}";
    //echo "<hr>{buildUsersListComplementaire}<br>{$sql}<hr>";exit;
    $sqlquery = $xoopsDB->queryF ($sql);     
    list ($listEmails, $total) = $xoopsDB->fetchRow($sqlquery);
    //echo "total = {$total}<hr>";
    //---------------------------------------------------------
    if ($listEmails == ''){
      //$message = "0;{$total}";
      $total = 0;
      return '';
    }
    //---------------------------------------------------------    
    $t = explode($sepUser, $listEmails);
    
    //displayArray($t,"--- liste complementaire ---");    
    $max = (( count($t) <= $lot | $lot == 0) ?  count($t): $lot ); 

    for ($h = 0; $h < $max; $h++){
      $user =  array_shift($t);
      $user .=  "{$sepItem}{$sepItem}{$sepItem}";      
      $item = explode($sepItem, $user);
         if (trim($item[0] == '')) $item[0] = '???';         
         if (trim($item[1] == '')) $item[1] = $item[0];
         if (trim($item[2] == '')) $item[2] = $item[0];        
          
         $newMail = array('uid'   => 0,
                          'name'  => $item[1],
                          'uname' => trim($item[1]) ,
                          'email' => $item[0],
                          'state' => 0);
                          
        addUser2temp($idCession, $newMail);      
    }
    
    $liste = implode(";", $t);
    $sql = "UPDATE "._HER_TFN_CESSION
          ."   SET listeComplementaire = '".$liste."'"
          ." WHERE idCession = {$idCession}";
    $xoopsDB->queryF ($sql);    
    $reste = count($t);
    
    
   //$message = "{$reste}{$sep}{$total}";
   //return $message;
   
   
   return $reste;   
   
    //displayArray($tEMails,"--- liste des adresse ok ---");    
    //-----------------------------------
    //saveListeTo($idArchive, $tEMails);
    //---------------------------------
                
      
 }


/****************************************************************************
 *
 ****************************************************************************/
function sendAllLettersFromTemp ($idCessionTemp, $first){
//mode = _HER_TEST, _HER_PREVIEW  ou _HER_SEND
global $xoopsModuleConfig, $xoopsDB;
//echo "<hr>sendAllLetters<hr>";

//$lot = $xoopsModuleConfig['lotMail'] - (($first==0)?1:0); 
$lot = $xoopsModuleConfig['lotMail'] - 1;
//$lot = $cession['lot'];

  $sql ="SELECT * FROM "._HER_TFN_CESSION." WHERE idCession = {$idCessionTemp} ";
  $queryCession = $xoopsDB->queryF ($sql);
  $cession = $xoopsDB->fetchArray($queryCession);
  //displayArray($cession,"----- sendAllLettersFromTemp -----");   
    $texteHTML =  readNewLetter($cession['fullNameArchive']);
  //echo "<hr>$idCessionTemp-Texte HTML<hr>{$cession['fullName']}<hr>{$texteHTML}<hr>";

    $texteTEXT = strip_tags($texteHTML);   
    //-------------------------------------------------------------
    $headersHTML  = getHeader(1, $cession['emailSender']);    
    $headersTEXT  = getHeader(2, $cession['emailSender']); 
    $d = date("d-m-Y h:m:h" , time());    
    $subject = $cession['libelle'];   //'nom'
     
    //--------------------------------------------------
    //$idCession = db_getUsers($idLettre, 2, $idArchive, true);
    
    $sql = 'SELECT * FROM '._HER_TFN_TEMP
          ." WHERE idCession = {$idCessionTemp}"
          ." LIMIT {$first},{$lot}";
          
    $sqlquery = $xoopsDB->queryF ($sql);    
    //$sqlquery = $xoopsDB->queryF ($sql, $first, $lot);
    //--------------------------------------------------
    $personnalisable = ($cession['personnalisable'] == 1); 
    $idArchive = $cession['$idArchive'] ;    
    $hMails = 0;
    
      //echo "<hr>";    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {

      //jjd sendAll
      //echo "<hr>envoi des mails <hr>";
      //displayArray($sqlfetch, "--- sendAllLetters --- params user ----");      
      
      //$personnalisable = ($params['personnalisable'] == 1);

      
      if ($personnalisable){      
        $paramsPerso = array(_HER_CODE_USER.'idUser'   => $sqlfetch['idUser'],
                             _HER_CODE_USER.'pseudo'   => $sqlfetch['pseudo'],      
                             _HER_CODE_USER.'name'     => $sqlfetch['name'],
                             _HER_CODE_USER.'email'    => $sqlfetch['email'],    
                             _HER_CODE_USER.'mail'     => $sqlfetch['email'],
                             _HER_CODE_USER.'login'    => $sqlfetch['uname'],                      
                             'idLettre' => $cession['idLettre'],
                             'idArchive'=> $cession['idArchive']);      
        

      
   
        //if ($sqlfetch['state'] == 2){
        //    $texte = replaceCodePersonalise ($texteTEXT, $paramsPerso);
        //    $headers = $headersTEXT;      
        //}else{
            $texte = replaceCodePersonalise ($texteHTML, $paramsPerso);
            $headers = $headersHTML;      
        //}
            
      } else{
        //if ($sqlfetch['state'] == 2){
        //    $texte   = $texteTEXT;
        //    $headers = $headersTEXT;      
        //}else{
            $texte   = $texteHTML;
            $headers = $headersHTML;      
        //}
      
      }                               



      

      //echo "envoi mail  ===> {$sqlfetch['email']} - {$sqlfetch['email']}<hr>";
      //-----------------------------------------------------------  
      //$bolOk = mail($sqlfetch['email'] , $subject, $texte, $headers);  
      hermesMail($sqlfetch['email'],$cession['emailSender'],$subject,$texte,false,1);      
      
      $hMails++;    
      //$r= (($bolOk) ? "Succés" : "Echec");
      //echo "==> <b>{$r}</b> de l'envoi du mail a: ==> {$sqlfetch['email']} ==> {$subject}<br>" ;      
      //echo "<hr><b>{$r}</b> de l'envoi du mail a:<br>{$sqlfetch['email']}<br>{$subject}<br>{$headers}<hr>" ;               
      //-----------------------------------------------------------
      //$tEMails [$sqlfetch['email']] = $sqlfetch['uid'];
    
    }
    

    if ($idArchive > 0){
        updateArchiveEnvois ($idArchive , $bolOk);    
    }
    

  return $first + $lot  ;
//exit;      

  
}


 
 /*********************************************************************

**********************************************************************/

function getNewCessionTemp($idLettre, $idArchive, $libelle, $fullNameArchive, 
                          $emailSender, $personnalisable = 1, $idListe = 0){
	global $xoopsModuleConfig, $xoopsDB;
    
    //-------------------------------------------------------------------
    //recupe de la liste complementaire
    //-------------------------------------------------------------------
    //$sql = "SELECT idListe FROM "._HER_TFN_LETTRE." WHERE idLettre =  {$idLettre}"; 
    //$sqlquery = $xoopsDB->queryF ($sql);    
    //list ($idListe) = $xoopsDB->fetchRow($sqlquery); 
    //echo "<hr>idListe = {$idListe}<br>$sql<hr>";
    //$idListe = 2;
    if ($idListe > 0) {
      $sql = "SELECT liste FROM "._HER_TFN_BONUS." WHERE idListe =  {$idListe}"; 
      $sqlquery = $xoopsDB->queryF ($sql);      
      list ($listeComplementaire) = $xoopsDB->fetchRow($sqlquery); 
      //$listeComplementaire = str_replace ("\r",";",$listeComplementaire);
      //$listeComplementaire = str_replace ("\n",";",$listeComplementaire);    
      //$listeComplementaire = str_replace (";;",";",$listeComplementaire);
      //$t=explode(";", $listeComplementaire);
      //$countListeComplementaire = count($t);
      
      // la valeur modifie est passe en reference : $listeComplementaire
      $t = prepareListComplementaire($listeComplementaire, $countListeComplementaire);
      
    }else {
      $listeComplementaire = '';
      $countListeComplementaire = 0;    
    }

   
    
    //---------------------------------------------------------------------
    //Calcul dun numero de cession au cas ou plusieurs lettres 
    //seraient lancees sur plusieurs postes
    //en mode batch
    //----------------------------------------------------------------------
    $libelle = string2sql($libelle);
    if ($personnalisable == '')  $personnalisable = 0;
    $sql = "INSERT INTO "._HER_TFN_CESSION
          ."(idLettre,idArchive,libelle,personnalisable,fullNameArchive,"
          ."emailSender,"
          ."nbDestinataire,listeComplementaire,listeComplementaire2,"
          ."countListeComplementaire)"    
          ." VALUES ("
          ."$idLettre, $idArchive, '$libelle', $personnalisable, '$fullNameArchive', "
          ."'{$emailSender}',"
          ."0,'{$listeComplementaire}','{$listeComplementaire}',"
          ."{$countListeComplementaire}"
          .")" ;   
    $xoopsDB->queryF ($sql);        
    $idCession = $xoopsDB->getInsertId() ;
    //cho "<hr>getNewCessionTemp<br>{$sql}<hr>";exit;


    return $idCession;                
      
 }

  /*********************************************************************

**********************************************************************/

function getLastCession(){
	global $xoopsModuleConfig, $xoopsDB;

    //---------------------------------------------------------------------
    //Recupe du dernier numero de cession pour les tests 
    //----------------------------------------------------------------------
    $sql = "SELECT MAX(idCession) as lastIdCession FROM "._HER_TFN_CESSION;
    $sqlquery = $xoopsDB->queryF($sql);  
    list ($lastIdCession) = $xoopsDB->fetchRow($sqlquery); 
    if (is_null($lastIdCession)) $lastIdCession = 0;    

    return $lastIdCession;                
      
 }

 /*********************************************************************

**********************************************************************/

function countMailForCession($idCession){
	global $xoopsModuleConfig, $xoopsDB;

    //---------------------------------------------------------------------
    //Calcul dun numero de cession aus ou pplusieurs lettres 
    //seraient lancer sur plusieurs poste
    //en mode batch
    //----------------------------------------------------------------------
    $sql = "SELECT count(idCession) as nbMail FROM "._HER_TFN_TEMP
          ." WHERE idCession = {$idCession}";
    $sqlquery = $xoopsDB->queryF ($sql);  
    list ($nbMail) = $xoopsDB->fetchRow($sqlquery); 
    if (is_null($nbMail)) $nbMail = 0;    

    return $nbMail;                
      
 }
 
 
 /*********************************************************************

**********************************************************************/

function razCessionTemp($idCession){
	global $xoopsModuleConfig, $xoopsDB;

    //Mise a jour du nombre d'envoi
    //idArchive est recuperer dans le tableau passer par rereference
    //displayArray($params, "------ params ------");
    
    /*

    if ($idArchive > 0){
        //updateArchiveEnvois ($idArchive , 0);    
    }
    */
    //---------------------------------------------------------------------
    //Vidage de la tale temp pur la cession
    //----------------------------------------------------------------------
    $sql = "DELETE FROM "._HER_TFN_TEMP
          ." WHERE idCession = {$idCession}";
    $xoopsDB->queryF ($sql);  
      
 }
 /*********************************************************************

**********************************************************************/

function razCession($idCession = 0){
	global $xoopsModuleConfig, $xoopsDB;
	 
	 if ($idCession > 0){
      //---------------------------------------------------------------------
      //Vidage de la table temp pur la cession
      //----------------------------------------------------------------------
      $sql = "DELETE FROM "._HER_TFN_TEMP
            ." WHERE idCession = {$idCession}";
      $xoopsDB->queryF ($sql);  
  
      //---------------------------------------------------------------------
      //Vidage de la table cession
      //----------------------------------------------------------------------
      $sql = "DELETE FROM "._HER_TFN_CESSION
            ." WHERE idCession = {$idCession}";
      $xoopsDB->queryF ($sql);  
   
   }else{
      //---------------------------------------------------------------------
      //Vidage de la table temp pur la cession
      //----------------------------------------------------------------------
      $sql = "DELETE FROM "._HER_TFN_TEMP;
      $xoopsDB->queryF ($sql);  
  
      //---------------------------------------------------------------------
      //Vidage de la table cession
      //----------------------------------------------------------------------
      $sql = "DELETE FROM "._HER_TFN_CESSION;
      $xoopsDB->queryF ($sql);  
   
   }
   
      
 }

/****************************************************************************
 *
 ****************************************************************************/
function sendAllInOneTime2($p){
global $xoopsModuleConfig, $xoopsDB;

echo "<hr>sendAllInOneTime<hr>";

$message = '0;nondefini';
$t= array();

  $idLettre = $p['idLettre'];

  //-----------------------------------------------------------------------
  //case etape_initCession:      
  //case 'initCession':
    $idCession = initCession ($idLettre);
    $nbMails   = countMailForCession($idCession);
    $t[] = _AD_HER_ETAPE_INITCESSION;    
    $t[] = $idCession;
    $t[] = $nbMails;
    $t[] = "initCession";
  //-----------------------------------------------------------------------
  //case etape_registry_info:
  //case 'getInfoEtape_userRegistry':
    razCessionTemp($idCession);    
    $t[] = _AD_HER_ETAPE_REGISTRY;
    $t[] = getUserRegistry($idLettre);
    $t[] = "getInfoEtape_userRegistry";
  //-----------------------------------------------------------------------
  // case etape_registry:
  //case 'build_userRegistry':
      $first = (isset($p['first']) ? $p['first'] : 0) ;
      $lot   = (isset($p['lot']) ? $p['lot'] : 0) ;      
      $count = buildUsersRegistry($idCession, $idLettre, $first, $lot);
      
      $t[] = $idCession;
      $t[] = $count;
      $t[] = "build_userRegistry";
      
  //-----------------------------------------------------------------------
  //case etape_complementaire:
  //case 'buildList2':
   // if ($xoopsModuleConfig['allowSend2Author']) addAuthor($idCession);  
    //buildList2 ($idCession);
    //if ($idCesion == 0) $idCession = getLastCession();    
    $t[] = _AD_HER_ETAPE_LISTEBONUS;    
    $t[] = buildUsersListComplementaire($idCession, $total);
    $t[] = $total;    
    $t[] = "buildUsersListComplementaire";
  //-----------------------------------------------------------------------
  //case etape_send_info:
  //case 'totalMails':
    $totalMails   = countMailForCession($idCession);
    $t[] = _AD_HER_ETAPE_SENDLETTER;    
    $t[] = $idCession;
    $t[] = $totalMails;
    $t[] = "totalMails";
  //-----------------------------------------------------------------------
  //case etape_send:
  //case 'sendLot':
    //if ($idCesion == 0) $idCession = getLastCession();  
      $first = (isset($p['first']) ? $p['first'] : 0) ;    
    $done      = sendLot($idCession, $first);  
    //$nbMails   = countMailForCession($idCession);    
    $t[] = $idCession;
    $t[] = $done;    
    //$t[] = $nbMails;
    $t[] = "sendLot";
  //-----------------------------------------------------------------------
  //case etape_end:
  //case 'getInfoEtape_end':
    $t[] = _AD_HER_ETAPE_END;
    //$t[] = getUserRegistry($idLettre);
    $t[] = "getInfoEtape_end";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 


  //-----------------------------------------------------------------------
  //case etape_endBatch:
  //case 'Etape_endBatch':
    //razCession($idCession);
    $t[] = _AD_HER_ETAPE_ENDBATCH;
    $t[] = "Etape_end";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 



  //-------------------------------------------
  //razCessionTemp($idCession);
}


/****************************************************************************
 *
 ****************************************************************************/
function sendAllInOneTime($p){
global $xoopsModuleConfig, $xoopsDB;

echo "<hr>sendAllInOneTime<hr>";

$message = '0;nondefini';
$t= array();

  $idLettre = $p['idLettre'];

  //-----------------------------------------------------------------------
  //case etape_initCession:      
  //case 'initCession':
    $idCession = initCession ($idLettre);
    $nbMails   = countMailForCession($idCession);
    $t[] = _AD_HER_ETAPE_INITCESSION;    
    $t[] = $idCession;
    $t[] = $nbMails;
    $t[] = "initCession";
  //-----------------------------------------------------------------------
  //case etape_registry_info:
  //case 'getInfoEtape_userRegistry':
    razCessionTemp($idCession);    
    $t[] = _AD_HER_ETAPE_REGISTRY;
    $t[] = getUserRegistry($idLettre);
    $t[] = "getInfoEtape_userRegistry";
  //-----------------------------------------------------------------------
  // case etape_registry:
  //case 'build_userRegistry':
      $first = (isset($p['first']) ? $p['first'] : 0) ;
      $lot   = (isset($p['lot']) ? $p['lot'] : 0) ;      
      $count = buildUsersRegistry($idCession, $idLettre, $first, $lot);
      
      $t[] = $idCession;
      $t[] = $count;
      $t[] = "build_userRegistry";
      
  //-----------------------------------------------------------------------
  //case etape_complementaire:
  //case 'buildList2':
   // if ($xoopsModuleConfig['allowSend2Author']) addAuthor($idCession);  
    //buildList2 ($idCession);
    //if ($idCesion == 0) $idCession = getLastCession();    
    $t[] = _AD_HER_ETAPE_LISTEBONUS;    
    $t[] = buildUsersListComplementaire($idCession, $total);
    $t[] = $total;    
    $t[] = "buildUsersListComplementaire";
  //-----------------------------------------------------------------------
  //case etape_send_info:
  //case 'totalMails':
    $totalMails   = countMailForCession($idCession);
    $t[] = _AD_HER_ETAPE_SENDLETTER;    
    $t[] = $idCession;
    $t[] = $totalMails;
    $t[] = "totalMails";
  //-----------------------------------------------------------------------
  //case etape_send:
  //case 'sendLot':
    //if ($idCesion == 0) $idCession = getLastCession();  
      $first = (isset($p['first']) ? $p['first'] : 0) ;    
    $done      = sendLot($idCession, $first);  
    //$nbMails   = countMailForCession($idCession);    
    $t[] = $idCession;
    $t[] = $done;    
    //$t[] = $nbMails;
    $t[] = "sendLot";
  //-----------------------------------------------------------------------
  //case etape_end:
  //case 'getInfoEtape_end':
    $t[] = _AD_HER_ETAPE_END;
    //$t[] = getUserRegistry($idLettre);
    $t[] = "getInfoEtape_end";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 


  //-----------------------------------------------------------------------
  //case etape_endBatch:
  //case 'Etape_endBatch':
    //razCession($idCession);
    $t[] = _AD_HER_ETAPE_ENDBATCH;
    $t[] = "Etape_end";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 



  //-------------------------------------------
  //razCessionTemp($idCession);
}

/****************************************************************************
 *
 ****************************************************************************/




/****************************************************************************
 *
 ****************************************************************************/
global $xoopsModuleConfig, $xoopsDB;
//displayArray ($_POST, "******zzz*********");
$message = '0;nondefini';
$t= array();

switch ($op){

  case 'razCessionTemp':
    razCessionTemp($idCession);
    break;    
    
  case 'getInfoEtape_userRegistry':
    //razCession($idCession);
    razCessionTemp($idCession);    
    $t[] = _AD_HER_ETAPE_REGISTRY;
    $t[] = getUserRegistry($idLettre);
    $t[] = "getInfoEtape_userRegistry";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 
    break;  
           
  case 'build_userRegistry':
      //$first = (isset($gepeto['first']) ? $gepeto['first'] : 0) ;
      //$lot   = (isset($gepeto['lot']) ? $gepeto['lot'] : 0) ;      

      $first = $gepeto['first'];
      $count = buildUsersRegistry($idCession, $idLettre, $first, $lot);
      $t[] = $idCession;
      $t[] = $count;
      $t[] = "build_userRegistry";
      
    break;
/*
          
  case 'getInfoEtape_userRegistry':
    $t[] = etape_registry;
    $t[] = getUserRegistry();
    $t[] = "getInfoEtape_userRegistry";

    break;
*/    
  case 'addAuthor':
    $idCession = 99;
    //if ($xoopsModuleConfig['allowSend2Author']) addAuthor($idCession);  
    break;  
    
  case 'buildList2':
    //if ($xoopsModuleConfig['allowSend2Author']) addAuthor($idCession);  
    //buildList2 ($idCession);
    //if ($idCesion == 0) $idCession = getLastCession();    
    $t[] = _AD_HER_ETAPE_LISTEBONUS;    
    $t[] = buildUsersListComplementaire($idCession, $total);
    $t[] = $total;    
    $t[] = "buildUsersListComplementaire";

  
    //$message   = "{$idCession};{0};buildList2";  
    //echo "<br>{$message}<hr>";  
    break;  
      
  case 'initCession':
    $idCession = initCession ($gepeto['idLettre']);
    //$idCession = getLastCession();
    $nbMails   = countMailForCession($idCession);
    $t[] = _AD_HER_ETAPE_INITCESSION;    
    $t[] = $idCession;
    $t[] = $nbMails;
    $t[] = "initCession";
    
    break;
    
  case 'totalMails':
    $totalMails   = countMailForCession($idCession);
    $t[] = _AD_HER_ETAPE_SENDLETTER;    
    $t[] = $idCession;
    $t[] = $totalMails;
    $t[] = "totalMails";
    break;

  case 'sendLot':
    //if ($idCesion == 0) $idCession = getLastCession();  
    $done      = sendLot($idCession, $gepeto['first']);  
    //$nbMails   = countMailForCession($idCession);    
    $t[] = $idCession;
    $t[] = $done;    
    //$t[] = $nbMails;
    $t[] = "sendLot";
    break;

  case 'getInfoEtape_end':
    $t[] = _AD_HER_ETAPE_END;
    //$t[] = getUserRegistry($idLettre);
    $t[] = "getInfoEtape_end";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 
    break;  
    
  case 'Etape_endBatch':
    //razCession($idCession);
    $t[] = _AD_HER_ETAPE_ENDBATCH;
    $t[] = "Etape_end";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 
    break;  
    
  case 'initLog':
    //razCession($idCession);
    $t[] = "debut du log";
    $t[] = "------------";
    
    //$message = _AD_HER_ETAPE_REGISTRY."ppp;99"; 
    break;  
    
    
  case 'sendAllInOneTime':   
    sendAllInOneTime($gepeto);
    break;
     
}  
//-----------------------------------------
$p = implode($sep, $t);
$f = XOOPS_ROOT_PATH."modules/hermes/log/test.log";
//$nbo = file_put_contents ( $f, $p, FILE_APPEND  );

echo "|{$p}|";


?>
