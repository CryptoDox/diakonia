<?php
//  ------------------------------------------------------------------------ //
// ���Ҳե� tad �s�@
// �s�@����G2008-03-23
// $Id: tadgallery_jquery.php,v 1.2 2008/05/05 03:21:42 tad Exp $
// ------------------------------------------------------------------------- //

define("INCLUDE_TAD_GALLERY_JQUERY",true);

//�϶��D�禡
function tadgallery_jquery_show($options){
	$block="<script type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/jquery.js'></script>";
	return $block;
}

//�϶��s��禡
function tadgallery_jquery_edit($options){
	$form=_MB_TADGAL_TADGALLERY_JQUERY_TEXT;
	return $form;
}

?>