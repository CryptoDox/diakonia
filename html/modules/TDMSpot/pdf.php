<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
include_once '../../mainfile.php';
require(XOOPS_ROOT_PATH.'/header.php');
require './fpdf/fpdf.php';

global $xoopsDB, $xoopsConfig, $xoopsModuleConfig;


$myts = & MyTextSanitizer :: getInstance(); // MyTextSanitizer object

$option = !empty($_REQUEST['option']) ? $_REQUEST['option'] : 'default';

	if (!isset($_REQUEST['itemid'])) {
	redirect_header('index.php', 2, _MD_SPOT_NOPERM);
	exit();
    }	

		
switch( $option )
{

 case "default":
 default:
//load class
$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
//perm
$gperm_handler =& xoops_gethandler('groupperm');

if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$user_uid = $xoopsUser->getVar('uid');
	$user_name = $xoopsUser->getVar('name');
	$user_uname = $xoopsUser->getVar('uname');
	$user_email = $xoopsUser->getVar('email');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$user_uid = 0;
	$user_name = XOOPS_GROUP_ANONYMOUS;
	$user_uname = XOOPS_GROUP_ANONYMOUS;
	$user_email = XOOPS_GROUP_ANONYMOUS;
}

//si pas le droit d'exporter	
if (!$gperm_handler->checkRight('spot_view', 16, $groups, $xoopsModule->getVar('mid'))) {
redirect_header('index.php', 2,_MD_TDMPICTURE_NOPERM);
exit();
}	

$file =& $item_handler->get($_REQUEST['itemid']);

$newsletter_title = utf8_decode(Chars($file->getVar('title')));
	//text
	$body = str_replace("{X_BREAK}", "<br />", $file->getVar('text'));
	$body = str_replace("{X_NAME}", $user_name, $body);
	$body = str_replace("{X_UNAME}", $user_uname, $body);
	$body = str_replace("{X_UEMAIL}", $user_email, $body);
	$body = str_replace("{X_ADMINMAIL}", $xoopsConfig['adminmail'], $body);
	$body = str_replace("{X_SITENAME}", $xoopsConfig['sitename'], $body);
	$body = str_replace("{X_SITEURL}", XOOPS_URL, $body);

	$newsletter_text = utf8_decode(Chars($body));
	$newsletter_indate = formatTimeStamp($file->getVar("indate"),"m");
	$color = '#CCCCCC';
	$pdf=new FPDF();
	$pdf->AddPage();
//titre
			$pdf->SetFont('Arial','B',15);
			$w=$pdf->GetStringWidth($xoopsConfig['sitename'])+6;
			$pdf->SetX((210-$w)/2);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell($w,8,Chars($xoopsConfig['sitename']),0,1,'C',true);
			$pdf->Ln(1);
			$pdf->SetFont('Arial','B',10);
			$w=$pdf->GetStringWidth($xoopsConfig['slogan'])+6;
			$pdf->SetX((210-$w)/2);
			$pdf->SetLineWidth(0.2);
			$pdf->Cell($w,8,Chars($xoopsConfig['slogan']),0,1,'C',true);
			$pdf->Ln(6);
			
			$pdf->SetFont('Arial','B',15);
			$w=$pdf->GetStringWidth($newsletter_title)+6;
			$pdf->SetX((210-$w)/2);
			$pdf->SetDrawColor(204,204,204);
			$pdf->SetFillColor($color['r'],$color['v'],$color['b']);
			$pdf->SetLineWidth(0.2);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell($w,8,Chars($newsletter_title),1,1,'C',true);
			$pdf->Ln(6);
			//Sauvegarde de l'ordonnée
	
	// date
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFillColor(255,255,255);
	$pdf->MultiCell(50,8, $newsletter_indate,1,1,'L',true);
	$pdf->Ln(6);
	
	//content
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(239,239,239);
$pdf->MultiCell(190,10,$newsletter_text,1,1, 'C', true);
$pdf->Ln(4);
$pdf->SetFont('Arial','B',10);
$w=$pdf->GetStringWidth(XOOPS_URL)+6;
$pdf->Cell($w,8,Chars(XOOPS_URL),0,0,'C',true);
$pdf->Output();

  	break;	
}
//



    function Chars($text)
    {
	$myts = & MyTextSanitizer :: getInstance(); 
        return preg_replace(
                            array( "/&#039;/i", "/&#233;/i", "/&#232;/i", "/&#224;/i", "/&quot;/i", '/<br \/>/i', "/&agrave;/i", "/&#8364;/i"),
                            array( "'", "é", "è", "à", '"', "\n", "à", "€"),
                           $text);
    }


?>