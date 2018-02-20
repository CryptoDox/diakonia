<?php
/**
 * Name: category.php
 * Description: Category Admin file
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
 * @subpackage : Xoops FAQ ADmin
 * @since 2.3.0
 * @author John Neill
 * @version $Id: category.php 0000 10/04/2009 08:57:46 John Neill $
 */
include 'admin_header.php';

$category_handler = &xoops_getModuleHandler( 'category' );

$op = xoopsFaq_CleanVars( $_REQUEST, 'op', 'default', 'string' );
switch ( $op ) {
	case 'edit':
		xoops_cp_header();
		xoopsFaq_AdminMenu( 1 );
		xoopsFaq_DisplayHeading( _XO_LA_CATEGORY_HEADER, _XO_LA_CATEGORY_EDIT_DSC, false );
		$category_id = xoopsFaq_CleanVars( $_REQUEST, 'category_id', 0, 'int' );
		$obj = ( $category_id == 0 ) ? $category_handler->create() : $category_handler->get( $category_id );
		if ( is_object( $obj ) ) {
			$obj->displayForm();
		} else {
			$category_handler->displayError( _XO_LA_ERRORCOULDNOTEDITCAT );
		}
		break;

	case 'delete':
		$ok = xoopsFaq_CleanVars( $_REQUEST, 'ok', 0, 'int' );
		$category_id = xoopsFaq_CleanVars( $_REQUEST, 'category_id', 0, 'int' );
		if ( $ok == 1 ) {
			$obj = $category_handler->get( $category_id );
			if ( is_object( $obj ) ) {
				if ( $category_handler->delete( $obj ) ) {
					$sql = sprintf( 'DELETE FROM %s WHERE category_id = %u', $xoopsDB->prefix( 'xoopsfaq_contents' ), $category_id );
					$xoopsDB->query( $sql );
					// delete comments
					xoops_comment_delete( $xoopsModule->getVar( 'mid' ), $category_id );
					redirect_header( 'category.php', 1, _XO_LA_DBSUCCESS );
				}
			}
			$category_handler->displayError( _XO_LA_ERRORCOULDNOTDELCAT );
		} else {
			xoops_cp_header();
			xoopsFaq_AdminMenu( 1 );
			xoopsFaq_DisplayHeading( _XO_LA_CATEGORY_HEADER, _XO_LA_CATEGORY_DELETE_DSC, false );
			xoops_confirm( array( 'op' => 'delete', 'category_id' => $category_id, 'ok' => 1 ), 'category.php', _XO_LA_RUSURECAT );
		}
		break;

	case 'save':
		if ( !$GLOBALS['xoopsSecurity']->check() ) {
			redirect_header( $this->url, 0, $GLOBALS['xoopsSecurity']->getErrors( true ) );
		}
		$category_id = xoopsFaq_CleanVars( $_REQUEST, 'category_id', 0, 'int' );
		$obj = ( $category_id == 0 ) ? $category_handler->create() : $category_handler->get( $category_id );
		if ( is_object( $obj ) ) {
			$obj->setVar( 'category_title', xoopsFaq_CleanVars( $_REQUEST, 'category_title', '', 'string' ) );
			$obj->setVar( 'category_order', xoopsFaq_CleanVars( $_REQUEST, 'category_order', 0, 'int' ) );
			if ( $category_handler->insert( $obj, true ) ) {
				redirect_header( 'category.php', 1, _XO_LA_DBSUCCESS );
			}
		}
		$category_handler->displayError( _XO_LA_ERRORCOULDNOTADDCAT );
		break;

	case 'default':
	default:
		xoops_cp_header();
		xoopsFaq_AdminMenu( 1 );
		xoopsFaq_DisplayHeading( _XO_LA_CATEGORY_HEADER, _XO_LA_CATEGORY_LIST_DSC );
		$category_handler->displayAdminListing();
		break;
}
xoopsFaq_cp_footer();

?>