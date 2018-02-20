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
include_once ("header.php");
//-----------------------------------------------------------------------------------
global $xoopsModule;

$f= dirname(dirname(__FILE__));
include_once ($f."/include/hermes_constantes.php");
include_once (XOOPS_ROOT_PATH."/modules/jjd_tools/_common/include/functions.php");
include_once (XOOPS_ROOT_PATH."/class/xoopsformloader.php");
//--------------------------------------------------------------------
//CAPCHA - sucurityimage de dugris / INSERTION DE LA CLASSE
//--------------------------------------------------------------------  

$f = _HER_PROOT . "class/xoopsform/securityimage.php";
//echo "<hr>{$f}<hr>";
if (is_readable($f)) include_once($f);


//-----------------------------------------------------------------------------------

function hermes_show_subscription($options) {
	global $xoopsDB,$xoopsTpl,$xoopsModuleConfig,$xoopsUser;
	
	//juste pour forcer les nouveaux paamètre de ce bloc 
    //qui ne sont pas mis à jour lors d'une mise à jour du module
    //if ( $options[0] > 1) $options = explode('|', _HER_BLOCK_PARAM_SUB);
    if ( count($options) < 5)  $options = explode('|', _HER_BLOCK_PARAM_SUB);    
	//displayArray($options, "-----------------hermes_show_subscription-----------------------");
	
    $block = array();
	//if ($xoopsUser)$block['isOk']=1;
	$block['isOk'] =  ($xoopsUser) ? 1 : 0;
	$block['userName'] =  $options[0];	
	
  //--------------------------------------------------------------------
  //CAPCHA - sucurityimage de dugris / AFFICHAGE
  //--------------------------------------------------------------------  
  $tCapcha = array();
  $tCapcha['ok'] = $options[1];
  //$tCapcha['ok'] = 1; //juste pour test

  if (defined('SECURITYIMAGE_INCLUDED') AND ($tCapcha['ok'] == 1)) {
    //function securityImage( $Caption = '', $ForMembers = 1, $NumChars = 6, $MinFontSize = 12, $MaxFontSize = 16, $BackgroundType=0, $NumBackground = 50, $SessionName = 'securityimage', $SensitiveCase = 1 ) {
  	//$security_image = new SecurityImage( _SECURITYIMAGE_GETCODE ,1,3);
  	$h = 2;
  	$security_image = new SecurityImage($options[$h + 0], 
                                        $options[$h + 1], 
                                        $options[$h + 2], 
                                        $options[$h + 3], 
                                        $options[$h + 4], 
                                        $options[$h + 5], 
                                        $options[$h + 6], 
                                        "securityimage",
                                        $options[$h + 8]);	
  	
  	
    $tCapcha['capcha'] = $security_image->render(); 
    $tCapcha['libelle'] = _SECURITYIMAGE_GETCODE;
    
  }else{
    //$xoopsTpl->assign('capchaLib',    "bin non");
    $tCapcha['libelle'] = "??????";    
  }
  $block['capcha'] = $tCapcha;		
  //$block['def']['capcha'] = $tCapcha;
  
	$numDef = $options[0];

		$def = array();
		$block['def'][] = $def;

  return $block;
}

/************************************************************************
 *
 ************************************************************************/
 
function hermes_edit_subscription($options) {
//function securityImage( $Caption = '', $ForMembers = 1, $NumChars = 6, $MinFontSize = 12, $MaxFontSize = 16, $BackgroundType=0, $NumBackground = 50, $SessionName = 'securityimage', $SensitiveCase = 1 )
//'1|hermes|1|5|12|16|0|50|securityimage|1');
    //if ( $options[0] > 1) $options = explode('|', _HER_BLOCK_PARAM_SUB);    
    
    //juste pour forcer les nouveaux paamètre de ce bloc 
    //qui ne sont pas mis à jour lors d'une mise à jour du module
    if ( count($options) < 5) $options = explode('|', _HER_BLOCK_PARAM_SUB);  
      
    $tyn  = array(0 =>  _MB_HER_NO, 1 => _MB_HER_YES);  
    $tnum = array(0,1,2,3,4,5,6);    
    $prefixeCapcha = 'capcha - ';
    //-------------------------------------------- 
 $form = new XoopsThemeForm(_MB_HER_BLOCK_PERSONNALISATION, 'myform', 'xxx.php');	


//displayArray($options, "----------------------------");


    $gender0 = new XoopsFormSelect(_MB_HER_SHOW_USER_NAME, "options[]", $options[0]);
    //$gender0 = new XoopsFormRadio(_MB_HER_SHOW_USER_NAME, "options[]", $options[0]);
    $gender0->addOptionArray($tyn);
    $form->addElement($gender0, false);    

    
    // afficher le capcha---------------------------------------------
    $gender1 = new XoopsFormSelect($prefixeCapcha._MB_HER_SHOW_CAPCHA_SUB, "options[]", $options[1]);    
    //$gender1 = new XoopsFormRadio(_MB_HER_SHOW_CAPCHA_SUB, "options[]", $options[1]);
    //$options = array('No' => 0, 'Yes' => 1);
    $choix = array(0 =>  _MB_HER_NO, 1 => _MB_HER_YES);    
    $gender1->addOptionArray($choix);
    $form->addElement($gender1, false);
    //$t[] = $$obName->render();
 
    // titre du capcha---------------------------------------------
    $gender2 = new XoopsFormText($prefixeCapcha._MB_HER_CAPTION, 'options[]', 50, 100, $options[2]);
    $form->addElement($gender2, false);    
    //$t[] = $gender1->render();

    // formember---------------------------------------------
    $gender3 = new XoopsFormSelect($prefixeCapcha._MB_HER_FOR_MEMBER, "options[]", $options[3]);
    $gender3->addOptionArray($tyn);
    $form->addElement($gender3, false);



    // $NumChars---------------------------------------------
    $gender4 = new XoopsFormSelect($prefixeCapcha._MB_HER_NB_CARS, "options[]", $options[4]);
    $gender4->addOptionArray($tnum);
    $form->addElement($gender4, false);


    // $MinFontSize---------------------------------------------
    //$choix = array(6,7,8,9,10,11,12,13,14,15,16);    
    $choix = array(6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16);  
      
    $gender5 = new XoopsFormSelect($prefixeCapcha._MB_HER_FONT_SIZE_MIN, "options[]", $options[5]);
    $gender5->addOptionArray($choix);
    $form->addElement($gender5, false);

    // $MaxFontSize---------------------------------------------
    $gender6 = new XoopsFormSelect($prefixeCapcha._MB_HER_FONT_SIZE_MAX, "options[]", $options[6]);
    $gender6->addOptionArray($choix);
    $form->addElement($gender6, false);

    //$BackgroundType ---------------------------------------------
    $gender7 = new xoopsFormHidden ('options[]', $options[7]);
    $form->addElement($gender7, false);    
    
    //$NumBackground ---------------------------------------------
    $gender8 = new xoopsFormHidden ('options[]', $options[8]);
    $form->addElement($gender8, false); 
       
    //$SessionName ---------------------------------------------
    $gender9 = new xoopsFormHidden ('options[]', $options[9]);
    $form->addElement($gender9, false);    

    //$SensitiveCase ---------------------------------------------
    $gender10 = new XoopsFormSelect($prefixeCapcha._MB_HER_CASE_SENSITIVE, "options[]", $options[10]);
    $choix =$tyn;
    $gender10->addOptionArray($choix);
    $form->addElement($gender10, false);



/*
http://localhost/my_web_site/modules/system/admin.php?fct=blocksadmin&op=edit&bid=166
    
	$form = ""._MB_MYLINKS_DISP."&nbsp;";
	$form .= "<input type='hidden' name='options[]' value='";
	if($options[0] == "date"){
		$form .= "date'";
	}else {
		$form .= "hits'";
	}
	$form .= " />";
	$form .= "<input type='text' name='options[]' value='".$options[1]."' />&nbsp;"._MB_MYLINKS_LINKS."";
	$form .= "&nbsp;<br>"._MB_MYLINKS_CHARS."&nbsp;<input type='text' name='options[]' value='".$options[2]."' />&nbsp;"._MB_MYLINKS_LENGTH."";

	return $form;
*/








	//$form  = implode ("<br>\n",$t);
//echo "<pre>{$form}</pre>"	;
//print_r ($form);
	//return $t[0]."<br>".$form->render();
	return $form->render();	
	
}

?>
