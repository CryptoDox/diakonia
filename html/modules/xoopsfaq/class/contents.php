<?php
/**
 * Name: contents.php
 * Description: Xoops FAQ Contents Class
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
 * @subpackage : Contents Class
 * @since 2.3.0
 * @author John Neill
 * @version $Id: contents.php 0000 10/04/2009 09:01:12 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * XoopsfaqContents
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class XoopsfaqContents extends XoopsObject {
	/**
	 * XoopsfaqContents::__construct()
	 */
	function __construct() {
		$this->XoopsObject();
		$this->initVar( 'contents_id', XOBJ_DTYPE_INT, null, false );
		$this->initVar( 'contents_cid', XOBJ_DTYPE_INT, 0, false );
		$this->initVar( 'contents_title', XOBJ_DTYPE_TXTBOX, null, true, 255 );
		$this->initVar( 'contents_contents', XOBJ_DTYPE_TXTAREA, null, false );
		$this->initVar( 'contents_publish', XOBJ_DTYPE_INT, time(), false );
		$this->initVar( 'contents_weight', XOBJ_DTYPE_INT, 0, false );
		$this->initVar( 'contents_active', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'dohtml', XOBJ_DTYPE_INT, 0, false );
		$this->initVar( 'doxcode', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'dosmiley', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'doimage', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'dobr', XOBJ_DTYPE_INT, 1, false );
	}

	/**
	 * XoopsfaqContents::XoopsfaqContents()
	 */
	function XoopsfaqContents() {
		$this->__construct();
	}

	/**
	 * XoopsfaqContents::displayForm()
	 *
	 * @return
	 */
	function displayForm() {
		global $xoopsModuleConfig;

		$category_handler = &xoops_getModuleHandler( 'category' );
		if ( !$category_handler->getCount() ) {
			xoops_error( _XO_LA_ERRORNOCAT, $title = '' );
			xoops_cp_footer();
			exit();
		}

		include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

		$caption = ( $this->isNew() ) ? _XO_LA_CREATENEW: sprintf( _XO_LA_MODIFYITEM, $this->getVar( 'contents_title' ) );
		$form = new XoopsThemeForm( $caption, 'content', $_SERVER['REQUEST_URI'] );
		$form->addElement( new XoopsFormHiddenToken() );
		$form->addElement( new xoopsFormHidden( 'op', 'save' ) );
		$form->addElement( new xoopsFormHidden( 'contents_id', $this->getVar( 'contents_id', 'e' ) ) );
		// title
		$category_handler = &xoops_getModuleHandler( 'category' );
		$objects = $category_handler->getList(); ;
		$contents_cid = new XoopsFormSelect( _XO_LAE_CONTENTS_CATEGORY, 'contents_cid', $this->getVar( 'contents_cid', 'e' ), 1, false );
		$contents_cid->setDescription( _XO_LAE_CONTENTS_CATEGORY_DSC );
		$contents_cid->addOptionArray( $objects );
		$form->addElement( $contents_cid );

		$contents_title = new XoopsFormText( _XO_LAE_CONTENTS_TITLE, 'contents_title', 50, 150, $this->getVar( 'contents_title', 'e' ) );
		$contents_title->setDescription( _XO_LAE_CONTENTS_TITLE_DSC );
		$form->addElement( $contents_title, true );
		/**
		 */
		$options_tray = new XoopsFormElementTray( _XO_LAE_CONTENTS_CONTENT, '<br />' );
		if ( class_exists( 'XoopsFormEditor' ) ) {
			$options['name'] = 'contents_contents';
			$options['value'] = $this->getVar( 'contents_contents', 'e' );
			$options['rows'] = 25;
			$options['cols'] = '100%';
			$options['width'] = '100%';
			$options['height'] = '600px';
			$contents_contents = new XoopsFormEditor( '', $xoopsModuleConfig['use_wysiwyg'], $options, $nohtml = false, $onfailure = 'textarea' );
			$options_tray->addElement( $contents_contents );
		} else {
			$contents_contents = new XoopsFormDhtmlTextArea( '', 'contents_contents', $this->getVar( 'contents_contents', 'e' ), '100%', '100%' );
			$options_tray->addElement( $contents_contents );
		}
		$options_tray->setDescription( _XO_LAE_CONTENTS_CONTENT_DSC );
		if ( false == xoopsFaq_isEditorHTML() ) {
			if ( $this->isNew() ) {
				$this->setVar( 'dohtml', 0 );
				$this->setVar( 'dobr', 1 );
			}
			/**
			 */
			$html_checkbox = new XoopsFormCheckBox( '', 'dohtml', $this->getVar( 'dohtml', 'e' ) );
			$html_checkbox->addOption( 1, _XO_LAE_DOHTML );
			$options_tray->addElement( $html_checkbox );
			/**
			 */
			$breaks_checkbox = new XoopsFormCheckBox( '', 'dobr', $this->getVar( 'dobr', 'e' ) );
			$breaks_checkbox->addOption( 1, _XO_LAE_BREAKS );
			$options_tray->addElement( $breaks_checkbox );
		} else {
			$form->addElement( new xoopsFormHidden( 'dohtml', 1 ) );
			$form->addElement( new xoopsFormHidden( 'dobr', 0 ) );
		}

		/**
		 */
		$doimage_checkbox = new XoopsFormCheckBox( '', 'doimage', $this->getVar( 'doimage', 'e' ) );
		$doimage_checkbox->addOption( 1, _XO_LAE_DOIMAGE );
		$options_tray->addElement( $doimage_checkbox );
		/**
		 */
		$xcodes_checkbox = new XoopsFormCheckBox( '', 'doxcode', $this->getVar( 'doxcode', 'e' ) );
		$xcodes_checkbox->addOption( 1, _XO_LAE_DOXCODE );
		$options_tray->addElement( $xcodes_checkbox );
		/**
		 */
		$smiley_checkbox = new XoopsFormCheckBox( '', 'dosmiley', $this->getVar( 'dosmiley', 'e' ) );
		$smiley_checkbox->addOption( 1, _XO_LAE_DOSMILEY );
		$options_tray->addElement( $smiley_checkbox );
		$form->addElement( $options_tray );

		$contents_publish = new XoopsFormTextDateSelect( _XO_LAE_CONTENTS_PUBLISH, 'contents_publish', 20, $this->getVar( 'contents_publish' ), $this->isNew() );
		$contents_publish->setDescription( _XO_LAE_CONTENTS_PUBLISH_DSC );
		$form->addElement( $contents_publish );

		$contents_weight = new XoopsFormText( _XO_LAE_CONTENTS_WEIGHT, 'contents_weight', 5, 5, $this->getVar( 'contents_weight', 'e' ) );
		$contents_weight->setDescription( _XO_LAE_CONTENTS_WEIGHT_DSC );
		$form->addElement( $contents_weight, false );

		$contents_active = new XoopsFormRadioYN( _XO_LAE_CONTENTS_ACTIVE, 'contents_active', $this->getVar( 'contents_active', 'e' ), ' ' . _YES . '', ' ' . _NO . '' );
		$contents_active->setDescription( _XO_LAE_CONTENTS_AVTIVE_DSC );
		$form->addElement( $contents_active );
		$form->addElement( new XoopsFormButton( '', 'submit', _SUBMIT, 'submit' ) );
		$form->display();
	}

	/**
	 * XoopsfaqContents::getActive()
	 *
	 * @return
	 */
	function getActive() {
		return $this->getVar( 'contents_active' ) ? _YES : _NO;
	}

	function getPublished( $timestamp = '' ) {
		if ( !$this->getVar( 'contents_publish' ) ) {
			return '';
		}
		return formatTimestamp( $this->getVar( 'contents_publish' ), $timestamp );
	}
}

/**
 * XoopsfaqContentsHandler
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class XoopsfaqContentsHandler extends XoopsPersistableObjectHandler {
	/**
	 * XoopsfaqContentsHandler::__construct()
	 *
	 * @param mixed $db
	 */
	function __construct( &$db ) {
		parent::__construct( $db, 'xoopsfaq_contents', 'XoopsfaqContents', 'contents_id', 'contents_title' );
	}

	/**
	 * XoopsfaqContentsHandler::XoopsfaqContentsHandler()
	 *
	 * @param mixed $db
	 */
	function XoopsfaqContentsHandler( &$db ) {
		$this->__construct( $db );
	}

	/**
	 * XoopsfaqContentsHandler::getObj()
	 *
	 * @return
	 */
	function &getObj() {
		$obj = false;
		$criteria = new CriteriaCompo();
		$obj['count'] = $this->getCount( $criteria );
		if ( !empty( $args[0] ) ) {
			$criteria->setSort( 'ASC' );
			$criteria->setOrder( 'contents_id' );
			$criteria->setStart( 0 );
			$criteria->setLimit( 0 );
		}
		$obj['list'] = &$this->getObjects( $criteria, false );
		return $obj;
	}

	/**
	 * XoopsfaqContentsHandler::getObj()
	 *
	 * @return
	 */
	function &getPublished( $id = '' ) {
		$obj = false;
		$criteria = new CriteriaCompo();
		if ( !empty( $id ) ) {
			$criteria->add( new Criteria( 'contents_cid', $id, '=' ) );
		}
		$criteria->add( new Criteria( 'contents_active', 1, '=' ) );
		$criteriaPublished = new CriteriaCompo();
		$criteriaPublished->add( new Criteria( 'contents_publish', 0, '>' ) );
		$criteriaPublished->add( new Criteria( 'contents_publish', time(), '<=' ) );
		$criteria->add( $criteriaPublished );

		$obj['count'] = $this->getCount( $criteria );
		if ( !empty( $args[0] ) ) {
			$criteria->setSort( 'ASC' );
			$criteria->setOrder( 'contents_title' );
			$criteria->setStart( 0 );
			$criteria->setLimit( 0 );
		}
		$obj['list'] = &$this->getObjects( $criteria, false );
		return $obj;
	}

	/**
	 * XoopsfaqContentsHandler::displayAdminListing()
	 *
	 * @return
	 */
	function displayAdminListing() {
		$objects = $this->getObj();

		$buttons = array( 'edit', 'delete' );

		$ret = "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='outer'>
		 <tr class='xoopsCenter'>
		 	<th style='width: 5%;'>" . _XO_LA_CONTENTS_ID . "</th>
		 	<th style='text-align: left;'>" . _XO_LA_CONTENTS_TITLE . "</th>
		 	<th>" . _XO_LA_CONTENTS_ACTIVE . "</th>
		 	<th>" . _XO_LA_CONTENTS_PUBLISH . "</th>
		 	<th style='width: 5%;'>" . _XO_LA_CONTENTS_WEIGHT . "</th>
		 	<th style='width: 20%;'>" . _XO_LA_ACTIONS . "</th>
		 </tr>";
		if ( $objects['count'] > 0 ) {
			foreach( $objects['list'] as $object ) {
				$ret .= "<tr class='xoopsCenter'>
					<td class='even'>" . $object->getVar( 'contents_id' ) . "</td>
					<td style='text-align: left;' class='even'>" . $object->getVar( 'contents_title' ) . "</td>
					<td class='even'>" . $object->getActive() . "</td>
					<td class='even'>" . $object->getPublished() . "</td>
					<td class='even'>" . $object->getVar( 'contents_weight' ) . "</td>
					<td class='even'>";
				$ret .= xoopsFaq_getIcons( $buttons, 'contents_id', $object->getVar( 'contents_id' ), $extra = null );
				$ret .= "</tr>";
			}
		} else {
			$ret .= "<tr style='text-align: center;'><td colspan='6' class='even'>" . _XO_LA_NOLISTING . "</td></tr>";
		}
		$ret .= "<tr style='text-align: center;'><td colspan='6' class='head'>&nbsp;</td></tr>";
		$ret .= "</table>";
		echo $ret;
	}

	/**
	 * XoopsfaqContentsHandler::DisplayError()
	 *
	 * @return
	 */
	function displayError( $errorString = '' ) {
		xoops_cp_header();
		xoopsFaq_AdminMenu( 0 );
		xoopsFaq_DisplayHeading( _XO_LA_CONTENTS_HEADER, '', false );
		xoops_error( $errorString, _XO_LA_FAQ_SUBERROR );
		xoops_cp_footer();
		exit();
	}
}

?>