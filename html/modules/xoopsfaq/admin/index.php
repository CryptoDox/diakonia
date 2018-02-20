<?php
/**
 * Name: index.php
 * Description: Admin Index File for Xoops FAQ Admin
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : Xoops
 * @Module : Xoops FAQ
 * @subpackage : Xoops FAQ Admin
 * @since 2.3.0
 * @author John Neill
 * @version $Id: index.php 0000 10/04/2009 08:56:26 John Neill $
 */
include 'admin_header.php';

$contents_handler = &xoops_getModuleHandler( 'contents' );

$op = xoopsFaq_CleanVars( $_REQUEST, 'op', 'default', 'string' );
switch ( $op ) {
	case 'edit':
		$contents_id = xoopsFaq_CleanVars( $_REQUEST, 'contents_id', 0, 'int' );
		$obj = ( $contents_id == 0 ) ? $contents_handler->create() : $contents_handler->get( $contents_id );
		if ( is_object( $obj ) ) {
			xoops_cp_header();
			xoopsFaq_AdminMenu( 0 );
			xoopsFaq_DisplayHeading( _XO_LA_CONTENTS_HEADER, _XO_LA_CATEGORY_EDIT_DSC, false );
			$obj->displayForm();
		} else {
			$contents_handler->displayError( _XO_LA_ERRORCOULDNOTEDITCAT );
		}
		break;

	case 'delete':
		$ok = xoopsFaq_CleanVars( $_REQUEST, 'ok', 0, 'int' );
		$contents_id = xoopsFaq_CleanVars( $_REQUEST, 'contents_id', 0, 'int' );
		if ( $ok == 1 ) {
			$obj = $contents_handler->get( $contents_id );
			if ( is_object( $obj ) ) {
				if ( $contents_handler->delete( $obj ) ) {
					$sql = sprintf( 'DELETE FROM %s WHERE contents_id = %u', $xoopsDB->prefix( 'xoopsfaq_contents' ), $contents_id );
					$xoopsDB->query( $sql );
					// delete comments
					xoops_comment_delete( $xoopsModule->getVar( 'mid' ), $contents_id );
					redirect_header( 'index.php', 1, _XO_LA_DBSUCCESS );
				}
			}
			$contents_handler->displayError( _XO_LA_ERRORCOULDNOTDELCAT );
		} else {
			xoops_cp_header();
			xoopsFaq_AdminMenu( 0 );
			xoopsFaq_DisplayHeading( _XO_LA_CONTENTS_HEADER, _XO_LA_CATEGORY_DELETE_DSC, false );
			xoops_confirm( array( 'op' => 'delete', 'contents_id' => $contents_id, 'ok' => 1 ), 'index.php', _XO_LA_RUSURECAT );
		}
		break;

	case 'save':
		if ( !$GLOBALS['xoopsSecurity']->check() ) {
			redirect_header( 'index.php', 0, $GLOBALS['xoopsSecurity']->getErrors( true ) );
		}
		$contents_id = xoopsFaq_CleanVars( $_REQUEST, 'contents_id', 0, 'int' );
		$obj = ( $contents_id == 0 ) ? $contents_handler->create() : $contents_handler->get( $contents_id );
		if ( is_object( $obj ) ) {
			$obj->setVars( $_REQUEST );
			$obj->setVar( 'contents_publish', strtotime( $_REQUEST['contents_publish'] ) );
			$obj->setVar( 'dohtml', isset( $_REQUEST['dohtml'] ) ? 1 : 0 );
			$obj->setVar( 'dosmiley', isset( $_REQUEST['dosmiley'] ) ? 1 : 0 );
			$obj->setVar( 'doxcode', isset( $_REQUEST['doxcode'] ) ? 1 : 0 );
			$obj->setVar( 'doimage', isset( $_REQUEST['doimage'] ) ? 1 : 0 );
			$obj->setVar( 'dobr', isset( $_REQUEST['dobr'] ) ? 1 : 0 );
			$ret = $contents_handler->insert( $obj, true );
			if ( $ret ) {
				redirect_header( 'index.php', 1, _XO_LA_DBSUCCESS );
			}
		}
		$contents_handler->displayError( $ret );
		break;

	case 'default':
	default:
		xoops_cp_header();
		xoopsFaq_AdminMenu( 0 );
		xoopsFaq_DisplayHeading( _XO_LA_CONTENTS_HEADER, _XO_LA_CONTENTS_LIST_DSC );
		$contents_handler->displayAdminListing();
		break;
}
xoopsFaq_cp_footer();

?>