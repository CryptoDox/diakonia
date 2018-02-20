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


//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idPlugin',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listPlugin () {
global $xoopsModule, $xoopsDB,$xoopsModuleConfig;


  //----------------------------------------------------------- 
  updatePluginsList() ;
  //-----------------------------------------------------------  
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_PLUGINS."</b><br>";    
    
    $filter = (($xoopsModuleConfig['showAllPlugins'] == 0) ? 'state = 3' : '');    
    $sqlquery = db_getPlugins (0, '', $filter);
    
    
    echo "<table".getTblStyle().">";  
    
          
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $bg = getRowStyle($row,'',0, _HER_TR_BASE); 
      $colEmpty = "<TD {$bg} align='center'></td>";
      echo '<tr>';
      
      echo "<td{$bg}>({$sqlfetch['idPlugin']})</td>";  
      echo "<td{$bg}>-</td>";      
      echo "<td{$bg}>{$sqlfetch['module']}</td>";      
      echo "<td{$bg}>-</td>";       
      echo "<td{$bg}>{$sqlfetch['nom']}</td>";         
      echo "<td{$bg}>{$sqlfetch['nomFichier']}</td>";      

      
      echo "<td{$bg}>{$sqlfetch['version']}</td>";
            
      //echo "<td>{$sqlfetch['description']}</td>";            
        $idPlugin = $sqlfetch['idPlugin'];
        //-----------------------------------------------------------------------   	
        //if ($sqlfetch['state'] == 1){
          switch($sqlfetch['state']){
            case 0:
              $link = "";        
              echo build_icoOption($link, _JJDICO_FORBID, _AD_HER_PLUGIN_NOMODULE, '', '', $bg);        
              //echo build_icoOption($link, _JJDICO_TOOLS, _AD_HER_PLUGIN_NOMODULE, '', '', $bg);              
              break ;
          
            case 1:
              $link = "";        
              echo build_icoOption($link, _JJDICO_COMMENT1, _AD_HER_MODULE_UNINSTALLED, '', '', $bg);
              //echo build_icoOption($link, _JJDICO_TOOLS, _AD_HER_PLUGIN_NOMODULE, '', '', $bg);                      
              break ;
          
            case 2:
              $link = "";        
              echo build_icoOption($link, _JJDICO_VERROU, _AD_HER_MODULE_DESACTIVATE, '', '', $bg);
              //echo build_icoOption($link, _JJDICO_TOOLS, _AD_HER_PLUGIN_NOMODULE, '', '', $bg);                      
              break ;

            case 3:
              $link = "admin_plugin.php?op=edit&idPlugin={$idPlugin}&showBalise=0";        
              echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_PLUGIN_EDIT, '', '', $bg);        
              //echo build_icoOption($link, _JJDICO_TOOLS, _AD_HER_PLUGIN_NOMODULE, '', '', $bg);              
              break ;

              
            default: //3
              echo $colEmpty;;
              //echo $colEmpty;;              
              break;
 
          }
        //-----------------------------------------------------------------------
        $link = "admin_plugin.php?op=edit&idPlugin={$idPlugin}&showBalise=1";        
        echo build_icoOption($link, _JJDICO_TOOLS, _AD_HER_PLUGIN_BALISES_SMARTY, '', '', $bg);        
        
        
        /*

    	  $link = "admin_structure.php?op=list&idPlugin=".$idPlugin;
        echo "<TD align='center'>";        
    	  echo "<A href='".$link."'><img src='"._JJDICO_TOOLS."' border=0 Alt='"._AD_HER_STRUCTURE."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";    
        //-----------------------------------------------------------------------
        echo "<TD align='center'>";        

    	  $link = "admin_plugin.php?op=remove&idPlugin={$idPlugin}&name={$sqlquery['nom']}";
    	  echo "<A href='".$link."'><img src='"._JJDICO_REMOVE."' border=0 Alt='"."_AD_HER_DELETE"."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";            
        */ 
        //-----------------------------------------------------------------------      
      echo '</tr>';       
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editPlugin($p, $showBalise = 0){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
//displayArray($p, "----- editPlugin -----");
    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);  
    $listYesNo = aList_noYes();    
    $listPeriodicite = aList_periodicite();
        
 
    //------------------------------------------------    
  
  //echo versionJS();


	  //xoops_cp_header();
    OpenTable();  
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;
      
    //********************************************************************
	  //echo "<div align='center'>";
    ////echo "<B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_PLUGIN_MANAGEMENT."</B>";
    //echo "</div>";
    
 		echo "<FORM ACTION='admin_plugin.php?op=save' METHOD=POST>";
    if ($showBalise == 1){
    echo "<table width='80%'>";    
      echo buildTitleOption(_AD_HER_SMARTY_HLP, '');  
    echo "</table>";          
    }    
    //********************************************************************
//    CloseTable();
//    OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>";
    echo "<TD align='left' >".""."</TD>";
    echo "<TD align='right' >".$p['idPlugin']." <INPUT TYPE=\"hidden\" id='idPlugin'  NAME='idPlugin'  size='1%'"." VALUE='".$p['idPlugin']."'></TD>";
    echo "</TR>";    

    //---Fichier
    echo buildLibInfo(_AD_HER_FILENAME, '', $p['nomFichier']);

    echo buildLibInfo(_AD_HER_SELECT_ITEM_FROMMODULE, '', $p['nomFichier']);

    //---Name
    echo buildLibInfo(_AD_HER_NOM, '', $myts->makeTboxData4Show($p['nom']));

    //---description
    echo buildLibInfo(_AD_HER_DESCRIPTION, '', $myts->makeTboxData4Show($p['description']));

    //---version
    echo buildLibInfo(_AD_HER_VERSION, '', $p['version']);

    //---module
    echo buildLibInfo(_AD_HER_MODULE, '', $p['module']);
    
    if ($showBalise == 0){        
      //---compteur
      echo buildInput(_AD_HER_COMPTEUR, '', 'txtCompteur', $myts->makeTboxData4Show($p['compteur'], "1", "1", "1"), '10%');    
    }

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    
    
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************
    if ($showBalise == 1){
    
      editSmartyBalises($p['idPlugin']);    
      
    }else{
        editParamsPlugins($p['idPlugin'], (($showBalise == 1) ? -1 : 0) , $params);   
        //********************************************************************  
        
        echo "</table>";      
        CloseTable();
        OpenTable();    
        echo "<table width='80%'>";    
         //********************************************************************
    
        
     
        echo "<table width='80%'>";     
        echo buildLibInfo(_AD_HER_SELECT_CAT_FROMMODULE, '', $p['module']);   
        echo "</table>";    
        
        echo "<table width='80%'>";    
        //affichage des catégories du module
        editParamsPluginsCat($p['idPlugin'], (($showBalise == 1) ? -1 : 0) , $params);   
        
         
         //********************************************************************    
         
         
         
        echo "<table width='80%'>";     
        echo buildLibInfo(_AD_HER_SELECT_ITEM_FROMMODULE, '', $p['module']);   
        echo "</table>";    
        
        echo "<table width='80%'>";    
        //affichage des derniers articles ou items du module        
        editParamsPluginsItem($p['idPlugin'], (($showBalise == 1) ? -1 : 0) , $params);   
    }    
     //********************************************************************
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************
    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_plugin.php",false)."'></td>
        <td align='left' width='200'></td>
        <td align='right'>";
        
    if ($showBalise == 0){        
      echo "<input type='submit' name='submit' value='"._AD_HER_VALIDER."' )'>";    
    }    
   
   echo "</td>    
      </tr>
      </table>
      </form>";    
        
    	CloseTable();
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    


}

/*******************************************************************
 *
 *******************************************************************/
function savePlugin ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  $idPlugin = $t['idPlugin'];
  //-----------------------------------------------------------
  $bAffichage = checkBoxToBin($t, 'txtAffichage', $def);
  //-----------------------------------------------------------

  //-----------------------------------------------------------   
   
    
  if ($idPlugin == 0){
  /*
  il n'y a pa de création pour le moment

  */    
  }else{
      $sql = "UPDATE "._HER_TFN_PLUGIN." SET "
           ."compteur  = {$t['txtCompteur']},"
           ."affichage = {$bAffichage} "
           ." WHERE idPlugin = ".$idPlugin;
           
      $xoopsDB->query($sql);            
  }
   
   /**********************************
    *  Sauvegarde des parametres   
    **********************************/   
    saveParams ($t);
   //------------------------------   
           
//echo "<hr>{$sql}<hr>";
}



/****************************************************************
 *
 ****************************************************************/

function deletePlugin ($idPlugin) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM "._HER_TFN_PLUGIN." "
	      ."WHERE idPlugin = ".$idPlugin;
	
       $xoopsDB->query($sql);	

 
}



 
/****************************************************************************
 *
 ****************************************************************************/
function getPlugin ($idPlugin){
	global $xoopsModuleConfig, $xoopsDB;

  if ($idPlugin == 0) {
      $p = array ('idPlugin'      => 0, 
                  'nom'           => '',
                  'description'   => '', 
                  'MaxItem'       => 0,
                  'periode'       => 0,
                  'compteur'      => 0, 
                  'module'        => '', 
                  'version'       => '');

  }
  else {
    	
    $sql = "SELECT  * FROM "._HER_TFN_PLUGIN." "
          ."WHERE idPlugin = {$idPlugin}";
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);    
    if ($nbEnr == 0 AND $idStructure > 0){
        $sql = "SELECT  * FROM "._HER_TFN_PLUGIN." "
              ."WHERE idPlugin = {$idPlugin}";
        $sqlquery=$xoopsDB->query($sql);    
    }
    
    
    
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;

   $p['nom']      = sql2string ($p['nom']);
   $p['description'] = sql2string ($p['description']);



    
  }
  return $p;
}

//---------------------------------------------------------------------
    
/****************************************************************************
 *
 ****************************************************************************/


admin_xoops_cp_header(_HER_ONGLET_PLUGIN, $xoopsModule);


switch($op) {
  case "list":
		listPlugin ();
		break;
		
  case "saveList":
		saveListPlugin ($_POST);
    redirect_header("admin_plugin.php?op=list",1,_AD_HER_ADDOK);		
		break;

  case "new":
		//savePlugin ($_POST);
    $p = getPlugin (0);
    
    editPlugin ($p);
    //redirect_header("admin_Plugin.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "edit":
		//savePlugin ($_POST);
		$p = getPlugin ($idPlugin);
    editPlugin ($p, $gepeto['showBalise']);
    //redirect_header("admin_Plugin.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		savePlugin ($_POST);
    redirect_header("admin_plugin.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idPlugin})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idPlugin' => $_GET['idPlugin'] ,
                        'ok'         => 1),
                        "admin_plugin.php", $msg );
//    xoops_cp_footer();
    
    break;


  case "removeOk":
		//savePlugin ($_POST);
    //deletePlugin ($id);
    deletePlugin ($_POST['idPlugin']);    
    redirect_header("admin_plugin.php?op=list",1,_AD_HER_ADDOK);    
		break;

  case "clear":
		//savePlugin ($_POST);
    clearPlugin ($id);
    redirect_header("admin_plugin.php?op=edit",1,_AD_HER_ADDOK);    
		break;


		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_plugin.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();



?>
