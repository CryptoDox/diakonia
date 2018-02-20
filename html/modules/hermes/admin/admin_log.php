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
include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php');


//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."/modules/".$xoopsModule->getVar('dirname')
                               ."/include/hermes_constantes.php");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idLibelle',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function showTable ($table, $colId, $colonnes = '*', $where = '', $orderBy = '') {
global $xoopsModule, $xoopsDB;
 
  $myts =& MyTextSanitizer::getInstance();    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
    
    $sql = "SELECT {$colonnes} FROM {$table}"
        .(($where == '') ? '' : " WHERE {$where}")
        .(($orderBy == '') ? '' : " ORDER BY {$orderBy}");  
    $sqlquery = $xoopsDB->queryF ($sql);
    //echo "<hr>{$sql}<hr>";
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_LIBELLES."</b><br>";    

    echo "<FORM ACTION='admin_log.php?op=deleteSelection' METHOD=POST>";
    echo "<table ".getTblStyle().">";  
              
    $oldRupture = -1;    
    $h = 0;  
    $alpha = '';
    $hv0 = '<td> |</td>';
     
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $bg = getRowStyle($row,'',0, _HER_TR_BASE); 
      $hv1 = "<td {$bg}> |</td>";      
      $colEmpty = "<TD {$bg} align='center'></td>";
      $h++;
      $id = $sqlfetch[$colId];      
      echo "<INPUT TYPE=\"hidden\" id='txtId_{$h}'  NAME='txtId_{$h}'  size='1%' VALUE='{$id}'>";
          
      //---------------------------------
      if ($h == 1){  
        echo "<tr><td>#</td><td>|</td>";        
        while (list($key, $val) = each($sqlfetch)){
          echo "<td>{$key}</td>{$hv0}";
        }
        echo "<td> </td><td> </td></tr>";            
      }          

      if ($alpha <> substr($sqlfetch[$orderBy],0,1)){
        $alpha = substr($sqlfetch[$orderBy],0,1);
        echo buildHR (1, _HER_HR_COLOR1, (count($sqlfetch)*2) + 2 ) ;     
      }
      //---------------------------------      
      
      echo '<tr>';
         echo "<tr><td{$bg}>{$h}</td>{$hv1}";         
          reset($sqlfetch);
          while (list($key, $val) = each($sqlfetch)){
            echo "<td {$bg}>{$val}</td>{$hv1}";         
          }
        //-----------------------------------------------------------------------

        //suppression de la ligne    
    	  $link = "admin_log.php?op=remove"
              ."&table={$table}"
              ."&colId={$colId}"
              ."&id={$id}"
              ."&newOp=userStatus";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);
      
      
      //$c = ($sqlfetch['actif']==1)?"checked":"";
      $c = '';
      echo "<TD align='center' {$bg} ><input type='checkbox' "
           ."ID='txtActif_{$id}' NAME='txtAction_{$h}' size='5%' "
           ."value='1' ".$c."></td>\n";
       
      
      //-----------------------------------    
      echo '</tr>';
      
    }

    
    
    echo "</table>";    

    echo buildHR (1, _HER_HR_COLOR1, 0) ;
    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

    <td align='right'>
    <input type='button' name='refresh' value='"._AD_HER_REFRESH_PAGE."' onclick='".buildUrlJava("admin_log.php?op=userStatus",false)."'>    
    <input type='submit' name='deleteSelection' value='"._AD_HER_DEL_SELECTION."' > 
    </td>   

        
  </tr>
  </form>";

  //  <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_libelle.php?op=new",false)."'>    
	CloseTable();
	//xoops_cp_footer();

}

/************************************************************************
 *
 ************************************************************************/
function removeIdFromTable($table, $colId, $id){
global $xoopsModule, $xoopsDB;
 
    $sql = "DELETE FROM {$table}"
         ." WHERE {$colId} = {$id}";  
    $sqlquery = $xoopsDB->queryF ($sql);
    //echo "<hr>removeIdFromTable<br>{$sql}<hr>"; exit;
}



/****************************************************************
 *
 ****************************************************************/
function deleteSelection($table, $colId, $p){ 
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  //displayArray($p,"----- saveEventActifChange -----");
  $lstPrefixe = "txtId;txtAction";  
 
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  
  //displayArray($t,"----- saveEventActifChange -----");
  
  while (list($key,$item) = each($t)){      
    if (isset($item['txtAction'])) {
      $id = $item['txtId'];
      $sql = "DELETE FROM {$table} WHERE {$colId} = {$id}";  
      //echo "<hr>$sql<hr>";
      $xoopsDB->query($sql);    
    }
  } 
  
  
//exit;   
}  
/****************************************************************
 *
 ****************************************************************/
function deleteSelectionList($table, $colId, $lstId){ 
	Global $xoopsDB ;


  $sql = "DELETE FROM {$table} WHERE {$colId} IN ({$lstId})";
  $xoopsDB->query($sql);    
  //echo "<hr>$sql<hr>"; 
  
//exit;   
}  

/****************************************************************
 *
 ****************************************************************/
function getSelectionID($table, $colId, $p){ 
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  //displayArray($p,"----- saveEventActifChange -----");
  $lstPrefixe = "txtId;txtAction";  
 
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  $tId = array();
  //displayArray($t,"----- saveEventActifChange -----");
  
  while (list($key,$item) = each($t)){      
    if (isset($item['txtAction'])) {
      $tId[] = $item['txtId'];
    }
  } 
  
  return implode(',',$tId ) ; 
//exit;   
}  

/************************************************************************
 *
 ************************************************************************/
 
  admin_xoops_cp_header(_HER_ONGLET_USERSTATUS, $xoopsModule); 

  switch($op) {
		
  case "userStatus":
		showTable (_HER_TFN_USERS, 'idUsers','idUsers, email, idLettre, state, idUser, dateMaj', '', 'email');
		break;
		
  case "remove":
		removeIdFromTable($gepeto['table'], $gepeto['colId'], $gepeto['id']); 
    redirect_header("admin_log.php?op={$gepeto['newOp']}",0,'');		
		break;


  case "deleteSelection":
    $listId = getSelectionID( _HER_TFN_USERS, 'idUsers', $gepeto);
    $msg = sprintf(_AD_HER_CONFIRM_DEL_SELECTION, $listId);
    //$msg = sprintf(_AD_HER_CONFIRM_DEL_SELECTION ."-". $listId);    
    xoops_confirm(array('op'         => 'deleteSelection_ok', 
                        'listId'     => $listId,
                        'ok'         => 1),
                        "admin_log.php", $msg );
    break;    
    
  case "deleteSelection_ok":
		//deleteSelection($gepeto['table'], $gepeto['colId'], $gepeto['id']); 
		
		deleteSelectionList(_HER_TFN_USERS, 'idUsers', $gepeto['listId']);    
    redirect_header("admin_log.php?op=userStatus",0,'');		
    break;


  case "removeOk":
		//saveLettre ($_POST);
    //deleteLettre ($id);
    deleteLettre ($_POST['idLettre']);    
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_DELOK);    
		break;













  
		
	default:
    redirect_header("index.php",0,'');
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
