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

// General settings
include_once ("header.php");




//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/').
             "modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------
include_once (_HER_JJD_PATH.'include/constantes.php');
include_once (_HER_JJD_PATH.'include/functions.php');
include_once (_HER_ROOT_PATH."include/hermes_data.php");
include_once (_HER_ROOT_PATH."include/hermes_buildLetter.php");



//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => ''),
              array('name' =>'idLettre',  'default' => 0),
              array('name' =>'idArchive', 'default' => 0),              
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------
$delai = 3;

//-------------------------------------------------------------




function changeUserStatus($t, &$msg){

global $xoopsUser, $xoopsModule, $xoopsDB;   
    changeStatusUserNotRegistry($t, $msg);
    $msg = "Operation effectuee pour {$t['email']}";    
}

/*****************************************************************
 
 *****************************************************************/
function changeStatusUserNotRegistry($t, &$msg){
global $xoopsUser, $xoopsModule, $xoopsDB;   
    $dateMaj = date(_HER_DATE_SQL);
    
    //----------------------------------------------------------
    $sql = "SELECT count(idUsers) AS nbenr FROM "._HER_TFN_USERS
          ." WHERE  email = '{$t['email']}'"
          ." AND idLettre = 0 "
          ." AND state = 0";
    $sqlquery = $xoopsDB->query($sql);
    //echo "{$sql}<br>";          
    list($nbenr) = $xoopsDB->fetchRow($sqlquery);
    //echo "{$sql}<br>nbenr = {$nbenr}<<<-------------<br>";   
    //si il y a 1 enregistremetn avec idLettre a 0 il n'y a rein a faire 
    if ($nbenr > 0) return;
    //---------------------------------------------------------
    if ($t['perimetre'] == 0){
      $sql = "DELETE FROM "._HER_TFN_USERS
            ." WHERE email = '{$t['email']}'";
    
    }else{
      //on supprime au cas ou il aurait un state a 1 (inscription))
      $sql = "DELETE FROM "._HER_TFN_USERS
            ." WHERE email = '{$t['email']}'"
            ." AND idLettre = {$t['idLettre']}";
    
    }
    
          
    $xoopsDB->queryF ($sql);   
    //echo "<hr>{$sql}<hr>";   
         
    //--------------------------------------------------------------
    $sql = "INSERT INTO "._HER_TFN_USERS." (email, idLettre, state, dateMaj) "
          ." VALUES ('{$t['email']}', {$t['perimetre']}, {$t['newState']}, '{$dateMaj}')";
    $xoopsDB->queryF ($sql); 
    //echo "<hr>changeUserStatus<br>{$sql}<hr>";   
    //--------------------------------------------------------------    
    $msg = "Opération effectu‚e pour {$t['email']}";    
    
    

}
/*****************************************************************
 
 *****************************************************************/

function updateUserStatus($t, $fullParams){
global $xoopsUser, $xoopsModule, $xoopsDB;   
global $delai;

  //echo "<hr>{$fullParams}<hr>";
  //displayArray($t, "------------------------------------------");
  
  
  //------------------------------------------------------------
  //est-ce qu'un user est connect‚
  if ( $xoopsUser ) { 

    //verification du user connect‚ si ce c'est pas lob on deconnecte  
	  if ( $xoopsUser->isAdmin($xoopsModule->mid()) 
       || $xoopsUser->email() == $t['email']){  
//echo "admin<br>";        
       //operation accept‚  
       changeUserStatus($t, $msg);
       $msg = _MD_HER_REQURED_IS_OK;  
       $source = _HER_URL;  
       redirectTo($source, $msg, $delai);  
     
    }else{
//echo "refuse<br>";    
       //operation refusee,  
       $msg = _MD_HER_USER_STILL_CONNECTED;
       $source = _HER_URL;  
       redirectTo($source, $msg, $delai);  

    }
  
  }else { 
//echo "est-ce que le  user existe<br>";
    //est-ce que le  user existe
    $sql = "SELECT count(uid) AS nbenr FROM ".$xoopsDB->prefix("users")
          ." WHERE  email = '{$t['email']}'";
    $sqlquery = $xoopsDB->query($sql);
    //echo "{$sql}<br>";          
    list($nbenr) = $xoopsDB->fetchRow($sqlquery);
    //echo "{$sql}<br>nbenr = {$nbenr}<<<-------------<br>";    
    //---------------------------------------------------------
    //verifie si il exsite un user avec cet email
    if ($nbenr == 0){
//echo "probablement un email de liste complementaire<br>";    
      //probablement un email de liste complementaire
      changeStatusUserNotRegistry($t, $msg);
      $source = _HER_URL;  
      redirectTo($source, $msg, $delai);  

    //---------------------------------------------------------      
    }else{
//echo "le user doit etre connecte pour valider le changement de status<br>";
        //le user doit etre connecte pour valider le changement de status
        $link = XOOPS_URL.'/user.php'
             .'?xoops_redirect=/modules/hermes/souscription.php?op='
             .$fullParams;
        $msg = "Connexion requise";
        redirectTo($link, $msg, $delai);    
    }
  } 


  return true;
   
}

/*****************************************************************
 
 *****************************************************************/

function confirmletter($t, $fullParams){
    sendConfirmLetter ($t, $msg);
    $source = _HER_URL;
    redirectTo($source, $msg, $delai); 
    return true; 

}

/****************************************************************************
 *
 ****************************************************************************/
function sendConfirmLetter ($p, &$msg){
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
    $rstLettre = db_getLettreId($idLettre, true);
    
    $idLettreConfirmation = $rstLettre['idLettreConfirmation'];
    $params = array();    
    $texteHTML = buildLetter ($idLettreConfirmation, $params, $mode);
    $texteTEXT = strip_tags($texteHTML);   
    $headersHTML  = getHeader(1, $rstLettre['emailSender']);  
    $headersTEXT  = getHeader(2, $rstLettre['emailSender']); 
    $d = date("d-m-Y h:m:h" , time());    
    $subject = $params['libelle']." --- r‚siliation lettre {$idLettre}:{$idLettreConfirmation}";   //'nom'
$state = 1; //provisoire, rechercher les infos du user
    $idArchive = 2;
    
    $paramsPerso = array(_HER_CODE_USER.'idUser'   => $p['idUser'],
                         _HER_CODE_USER.'pseudo'   => $p['login'],      
                         _HER_CODE_USER.'name'     => $p['login'],
                         _HER_CODE_USER.'email'    => $p['email'],    
                         _HER_CODE_USER.'mail'     => $p['email'],
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
    
    //$bolOk = mail($p['email'], $subject, $texte, $headers);   
    //$r= (($bolOk) ? "Succés" : "Echec");    
    //echo "==> <b>{$r}</b> de l'envoi du mail a: ==> {$p['email']} ==> {$subject}<br>" ;    
    
    hermesMail($p['email'],$rstLettre['emailSender'],$subject,$texte,true,1);




       

      

    if ($p['newState'] == 0){
      
    }

//=====================================================================
  $msg = _MD_HER_SEND_CONFIRMATION;
  return true;
  
}


/*****************************************************************
 
 *****************************************************************/
 
function parseParamsForUpdate($p){
  if (is_array($p['op'])) {
    $tVal = explode('|', $p['op']);    
  }else{
    $tVal = explode('|', $p);  
  }
//echo "<hr>parseParamsForUpdate : {}<hr>";
//displayArray($p,"------parseParamsForUpdate--------");

  $tKey = explode('|', 'op|action|newState|perimetre|idLettre|idUser|login|email');
  $t = arrayCombine($tKey, $tVal);
  
  switch ($t['action']){
  
  case 'revoke':  
  case 'confirmRevokeAllLetters':  
  case 'confirmRevokeThisLetter':
    $t['codeAction']=1;
    break;
    
  case 'consultArchive':  
    $t['codeAction']=2;
    break;
    
  case 'revokeAllLetters':  
  case 'revokeThisLetter':
  default:  
    $t['codeAction']=0;
    break;
       
  }
  

  
  
  return $t;
}
/**********************************************************
 *controleur
 **********************************************************/
  
  $fullParams = $op;
  $t = parseParamsForUpdate($op);
  $op = $t['op'];

switch ($op){

case 'updateUserStatus':
  switch ($t['codeAction']){
    case 1:
      confirmletter($t, $fullParams);    
      break;    
    
    case 2:
      //$idArchive=$idLettre;
      //viewArchive($idLettre) ;
      $source = _HER_URL."index.php?op=viewArchive&idArchive={$t['idLettre']}";
      redirectTo($source, '', 0);      
      break;    
      
    default:
      updateUserStatus($t, $fullParams);    
      break;    
    
  }
  break;

case 'subscription':
    $source = $_SERVER['HTTP_REFERER'];
    $f = _HER_PROOT . "class/xoopsform/securityimage.php";
    //echo "<hr>{$f}-{$_POST['isCapcha']}<hr>";
    if (is_readable($f)) include_once($f);
  //--------------------------------------------------------------------
  //CAPCHA - sucurityimage de dugris / CONTROL DE A SAISIE
  //--------------------------------------------------------------------  
  if ( defined('SECURITYIMAGE_INCLUDED') 
      && ($_POST['isCapcha'] == 1)) {
      //echo "<hr>ok<hr>";
      if (!SecurityImage::CheckSecurityImage()){
         redirect_header( $source, 1, _MD_HER_CAPCHA_INVALIDE) ;
         //redirect_header("index.php?idLexique={$idLexique}",2, _SECURITYIMAGE_ERROR);
         exit();
      
      }      
  }else{
    //echo "<hr>non<hr>";
  }
  //--------------------------------------------------------------------
		

    $source = $_SERVER['HTTP_REFERER'];
    $msg = saveNewSubscription($gepeto);
    $alert = "<font color='#FF0000' size='5'><b>{$msg}</b></font>";
    redirectTo($source, $alert, $delai);    
		break;

default:
  $source = _HER_URL; 
  $msg = '';
  redirectTo($source, $msg, $delai);
  break;
}



?>

