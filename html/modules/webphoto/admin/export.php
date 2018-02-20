<?php
// $Id: export.php,v 1.1.1.1 2008/06/21 12:22:15 ohwada Exp $

//=========================================================
// webphoto module
// 2008-04-02 K.OHWADA
//=========================================================

if( ! defined( 'WEBPHOTO_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webphoto files
//---------------------------------------------------------
webphoto_include_once( 'admin/header.php' );
webphoto_include_once( 'class/xoops/groupperm.php' );
webphoto_include_once( 'class/handler/xoops_image_handler.php' );
webphoto_include_once( 'class/webphoto/cat_selbox.php' );
webphoto_include_once( 'class/admin/export_form.php' );
webphoto_include_once( 'class/admin/export.php' );

//=========================================================
// main
//=========================================================
$manager =& webphoto_admin_export::getInstance( WEBPHOTO_DIRNAME , WEBPHOTO_TRUST_DIRNAME );
$manager->main();
exit();

?>