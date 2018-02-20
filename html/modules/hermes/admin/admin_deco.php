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
include_once ('admin_interface.php');

//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."/modules/".$xoopsModule->getVar('dirname')
                               ."/include/hermes_constantes.php");
//------------------------------------------------------------------------------



//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idDeco',    'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listDeco () {
global $xoopsModule, $xoopsDB, $adoDeco;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
  $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 5);
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_FRAMES."</b><br>";    

    $sqlquery = $adoDeco->getRows('decoModele,name');
    
    
    echo "<table ".getTblStyle().">";  
     $decoModele='';    
          
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
       if ($decoModele == '' | $decoModele <> $sqlfetch['decoModele']){
          $decoModele = $sqlfetch['decoModele'];
          echo $ligneDeSeparation;
          echo "<tr><td colspan='5' align='center'><strong>{$decoModele}</strong></td><tr>";
        }else{
       
        }
        
        $bg = getRowStyle($row,'',0,3);
 
      
      echo '<tr>';
      
      //echo "<td {$bg}>{$sqlfetch['decoModele']} -> {$sqlfetch['name']}</td>";
      echo "<td {$bg}>-> {$sqlfetch['name']}</td>";      
      
      //echo "<td>{$sqlfetch['description']}</td>";            
        $idDeco = $sqlfetch['idDeco'];
        
      //echo "<td{$bg}>[{$sqlfetch['editBeforeSend']}]</td>";        
        //-----------------------------------------------------------------------   	   
        $link = "admin_deco.php?op=edit&idDeco=".$idDeco;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);
        //-----------------------------------------------------------------------
        //Dupliquer la lettre
    	  $link = "admin_deco.php?op=duplicate&idDeco=".$idDeco;
        echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_HER_DUPLICATE, '', '', $bg);        
        //-----------------------------------------------------------------------
        //suppression du Deco        
    	  $link = "admin_deco.php?op=remove&idDeco={$idDeco}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);
        //-----------------------------------------------------------------------
        //previsualisation du Deco
    	  $link = "admin_deco.php?op=previewDeco&idDeco={$idDeco}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_VIEW, _AD_HER_VIEWTEXT, '', '', $bg); 
       //-----------------------------------------------------------------------  
      
      
      
      
      
      echo '</tr>';       
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>
    
    <td align='right'>
    <input type='button' name='update_plugins' value='"._AD_HER_UPDATE_PLUGINS."' onclick='".buildUrlJava("admin_deco.php?op=update",false)."'>
    </td>  
      
    <td align='right'>
    <input type='button' name='update' value='"._AD_HER_UPDATE."' onclick='".buildUrlJava("admin_deco.php?op=update",false)."'>
    </td>    

    <td align='right'>
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_deco.php?op=new",false)."'>
    </td>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editDeco($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $adoDeco;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    $listYesNo = aList_noYes();    
        
 
    //------------------------------------------------    
    
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_DECO_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_deco.php?op=save' METHOD=POST>";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>";
    echo "<TD align='left' >".""."</TD>";
    echo "<TD align='right' >".$p['idDeco']." <INPUT TYPE=\"hidden\" id='idDeco'  NAME='idDeco'  size='1%'"." VALUE='".$p['idDeco']."'></TD>";
    echo "</TR>";    



    //---Name
    echo buildInput(_AD_HER_NOM, '', 'txtName', $myts->makeTboxData4Show($p['name'], "1", "1", "1"), '60%');    
    
    
    //---Modele    
    if ($p['idDeco'] == 0){
      $list = $adoDeco->getModeleList();
      $listCode = buildHtmlListString ("txtDecoModele", $list, $p['decoModele'], false);
      echo "<td>"._AD_HER_MODELE."</td><td{$bg}>$listCode</td>";      
    }else{
      echo "<td>"._AD_HER_MODELE."</td><td>{$p['decoModele']}"
           ."<INPUT TYPE=\"hidden\" id='txtDecoModele'  NAME='txtDecoModele'  size='1%' VALUE='{$p['decoModele']}'"      
           ."</td>";   
      //echo $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);           
      //********************************************************************  
      echo "</table>";      
      CloseTable();
      OpenTable();    
      echo "<table width='80%'>";    
      //********************************************************************
      echo "<tr><td>";      
      $tpp =  $adoDeco->getProperties($p['idDeco']);

      //her_displayArray($tpp,"------------------------------------");
      echo "</td><tr>";             
    
     $h = 0;
     $rupture = 0;
      while(list($key,$item) = each($tpp)){
        if ($rupture <> $item['rupture']){
          echo buildHR (1, '839D2D', 2);
          $rupture = $item['rupture'];          
        }
        //------------------------------------------------------------
        $txtName =  "txtValue_{$h}";
        $cst = '_AD_HER_'.strtoupper($item['property']);
        $lib = (defined($cst) ? constant($cst) : $item['property']);
        
        echo "<tr>"
            ."<INPUT TYPE=\"hidden\" id='txtProperty_{$h}'  NAME='txtProperty_{$h}'  size='1%' VALUE='{$item['property']}'"
            ."<INPUT TYPE=\"hidden\" id='txtTypeName_{$h}'  NAME='txtTypeName_{$h}'  size='1%' VALUE='{$item['typeName']}'"            
            ."";
        //her_displayArray($item,"***** editDeco *****");
        //-------------------------------------------------            
        switch ($item['typeName']){
          //-----------------------------------------------------   
          case 'spin':
            $params = explode('|', $item['params']);
            echo buildSpin($lib, '', 
                           $txtName, $item['ppValue'], 
                           $params[1], 
                           $params[0],
                           1, 10);
                  

          
            break;
          //-----------------------------------------------------  
          case 'color':    
              //---bgColor   
              echo buildColorSelecteur($lib, '', $txtName, $item['ppValue']);
             
            break;
          //-----------------------------------------------------  
          case 'image': //---image
            $f = _HER_ROOT_PATH."images/";
            //if ($item['params'] <>'') $f .= $item['params'];
            
            echo buildListFromFolder($lib, 
                                     '', 
                                     $item['ppValue'],                             
                                     $txtName,
                                     $f, 
                                     '.gif;.png;.jpg;.bmp', 
                                     0,
                                     $AddBlanck = true);
              
            break;            
          //-----------------------------------------------------------                    
          case 'list': //c'est une liste de libele dont le numéro d'ordre est atomatique 
                  $list = explode('|', $item['params']);
                  $obList = buildHtmlListString ($txtName, $list, $item['ppValue'], false);
                  echo "<td>{$lib}</td><td>{$obList}</td>";
                break; 
                
          //-----------------------------------------------------------                    
          case 'enum': //c'est une liste de libele dont le numéro d'ordre est atomatique 
                  $list = explode('|', $item['params']);
                  $obList = getlistSearch ($txtName, $list, 0, $item['ppValue'], 1);
                  
                  echo "<td>{$lib}</td><td>{$obList}</td>";
                break; 
                
          //-----------------------------------------------------------                    
          
          case 'yesno': //c'est une liste de libele dont le numéro d'ordre est atomatique 
                $list = aList ('noYes');
                echo buildList($lib, '', $txtName, $list, $item['ppValue']);
                break; 
          //-----------------------------------------------------------                    
          
          case 'fontSize':  
                $list = aList('fontSize', true);
                echo buildList($lib, '', $txtName, $list, $item['ppValue']);
                break; 

          //----------------------------------------------------- 
          case 'frame'://---modele de cadre
 
                $selected = buildHtmlListFromTable ($txtName, 
                                             _HER_TAB_DECO,
                                             'name', 
                                             'idDeco', 
                                             'name', 
                                             $item['ppValue'],
                                             '',
                                             "decoModele = 'frame'",
                                             '150','',true);
             
                echo buildSelecteur(_AD_HER_FRAME,_AD_HER_FRAME_DSC , $selected );

          
                break;          
          //----------------------------------------------------- 
          case 'multiline'://---zone de texte multiline

    $desc1 = getEditorHTML(_EDITOR_TEXTAREA, 
                       $item['ppValue'], 
                       $txtName, $item['type'], '600px', '600px', 32, 120 );
   	

    echo "<TD align='center'  width='80px'><B>"._AD_HER_zzz."</B</TD>\n";    
    echo "<TD align='left'  width='500px'>";
    echo $desc1->render();
    //echo "<div  width='600px'><textarea rows='54' name='txtCss' cols='120'>{$p['css']}</textarea></div>";

    echo "</TD>"._br;

    
    

          
            break;          
          
          
          //-----------------------------------------------------------                    
          case 'text': //---texte                     
          default:
                    
            echo buildInput($lib, '', $txtName, $myts->makeTboxData4Show($item['ppValue'], "1", "1", "1"), '60%');          
            break;
            
        }
        
        echo "</tr>";
        $h++; 
      }    
    
    
    }
    

        
    

 //*********


/*



   //---alignement
   $listAlign = array(_AD_HER_LEFT,
                      _AD_HER_RIGHT,
                      _AD_HER_CENTER);

    echo buildList(_AD_HER_ALIGNEMENT, '', 'txtAlignement', $listAlign, $p['alignement']);
    
    //---largeur du tableau
    //echo buildSpin(_AD_HER_WIDTH.' (%)', '', 'txtWidth', $p['Width'], 100, 0, 100, 10);
    echo buildInput(_AD_HER_WIDTH, '', 'txtWidth', $myts->makeTboxData4Show($p['width'], "1", "1", "1"), '20%');    

      //echo "<td align='left' width = '20'>{$listCadres}<td>";
    //---borderWidth
    echo buildSpin(_AD_HER_BORDERWIDTH, '', 'txtBorderWidth', $p['borderWidth'], 25, 0, 1, 10);

    //---borderColorLight   
    echo buildColorSelecteur(_AD_HER_BORDERCOLORLIGHT, '', 'txtBorderColorLight', $p['borderColorLight']);

    //---borderColorDark   
    echo buildColorSelecteur(_AD_HER_BORDERCOLORDARK, '', 'txtBorderColorDark', $p['borderColorDark']);

    //---bgColor   
    echo buildColorSelecteur(_AD_HER_BGCOLOR, '', 'txtBgColor', $p['bgColor']);
      


    //---incrustation
    echo buildSpin(_AD_HER_INCRUSTATION, _AD_HER_INCRUSTATION_DSC, 'txtIncrustation', $p['incrustation'], 8, -8, 0, 10);

*/
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_deco.php",false)."'></td>
        <td align='left' width='200'></td>
    
        <td align='right'>
        <input type='submit' name='submit' value='"._AD_HER_VALIDER."' )'>    
        </td>    
      </tr>
      </table>
      </form>";
    
        
    	CloseTable();
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    


}



/****************************************************************************
 *
 ****************************************************************************/
function previewDeco ($idDeco){
global $xoopsUser,$adoDeco;

    //**********************************************************************                 
    $texte = 'Test de modèle de cadre';
    
    $rst = $adoDeco->getArray($idDeco);
    $tpp = $adoDeco->getPPValues($idDeco);
    
    //her_displayArray($tpp,"---- previewDeco {$idDeco}-----");
    $params = array('caption' => 'Modèle de texte');
    $texte = buildLetter_deco ($idDeco, $params);
    

    echo $texte;



    //**********************************************************************
    $link = "<a href='javascript:window.close();'>Close</a>";
    
		echo "<FORM ACTION='admin_deco.php?op=list' METHOD=POST>";
    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
        <tr valign='top'>
        <td align='center' ><input type='submit' name='cancel' value='"._CLOSE."' ></td>
        <td align='left' width='200'></td>
        </tr>";
        //<td align='center' ><input type='button' name='cancel' value='"._CLOSE."' onclick='javascript:window.close();'></td>

   echo "</form>";
/*    
    //**********************************************************************    
	CloseTable();
	xoops_cp_footer();
*/ 
  
  
  
  
}



 

/************************************************************************
 *
 ************************************************************************/
include_once (_HER_ROOT_PATH.'class/cls_hermes_deco.php');
$adoDeco = new cls_hermes_deco();

   
  admin_xoops_cp_header(_HER_ONGLET_DECO, $xoopsModule); 

  switch($op) {
  
  case "update_plugins": 
    updateDecorations();
    redirect_header("admin_deco.php?op=list",1,_AD_HER_ADDOK);
		break;  
		
  case "list":
		listDeco ();
		break;
		
  case "new":
    $p = $adoDeco->getArray (0);

    editDeco ($p);
    //redirect_header("admin_deco.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "edit":
		$p = $adoDeco->getArray  ($idDeco);
		
    editDeco ($p);
    //redirect_header("admin_deco.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		$id = $adoDeco->saveRequest ($_POST);
		if ($idDeco == 0){
      redirect_header("admin_deco.php?op=edit&idDeco={$id}",1,_AD_HER_ADDOK);    
    }else{
      redirect_header("admin_deco.php?op=list",1,_AD_HER_ADDOK);    
    }
		
		break;

  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idDeco})</b>" , _AD_HER_MODELES);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idDeco'    => $_GET['idDeco'] ,
                        'ok'         => 1),
                        "admin_deco.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "removeOk":
    $adoDeco->deleteId ($_POST['idDeco'], _HER_TFN_DECOPP);    
    redirect_header("admin_deco.php?op=list",1,_AD_HER_DELETEOK);    
		break;

  case "duplicate":
		$p = $adoDeco->newClone($idDeco, true, 'name');    
    editDeco ($p);    
  	break;

  case "previewDeco":
    previewDeco ($idDeco);
		break;

  case "update":
    updateDecorations();
    redirect_header("admin_deco.php?op=list",1,_AD_HER_ADDOK);      
		break;
		
	default:
	  $state = _HER_STATE_WAIT;
    redirect_header("admin_deco.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
