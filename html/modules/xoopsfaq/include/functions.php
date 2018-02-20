<?php
/**
 * Name: functions.php
 * Description: Module specific Functions for Xoops FAQ
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
 * @package : XOOPS
 * @Module : Xoops FAQ
 * @subpackage : Functions
 * @since 2.3.0
 * @author John Neill
 * @version $Id: functions.php 0000 10/04/2009 09:03:22 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * loadModuleAdminMenu()
 *
 * @param mixed $currentoption
 * @param string $breadcrumb
 * @return
 */
function xoopsFaq_AdminMenu( $currentoption, $breadcrumb = '' ) {
	if ( !$adminmenu = $GLOBALS["xoopsModule"]->getAdminMenu() ) {
		return false;
	}

	$breadcrumb = empty( $breadcrumb ) ? $adminmenu[$currentoption]["title"] : $breadcrumb;
	$module_link = XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/';
	$image_link = XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/images';

	$adminmenu_text = '
    <style type="text/css">
    <!--
    #buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0;}
    #buttonbar { float:left; width:100%; background: #e7e7e7 url("' . $image_link . '/modadminbg.gif") repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px;}
    #buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
    #buttonbar li { display:inline; margin:0; padding:0; }
    #buttonbar a { float:left; background:url("' . $image_link . '/left_both.gif") no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
    #buttonbar a span { float:left; display:block; background:url("' . $image_link . '/right_both.gif") no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
    /* Commented Backslash Hack hides rule from IE5-Mac \*/
    #buttonbar a span {float:none;}
    /* End IE5-Mac hack */
    #buttonbar a:hover span { color:#333; }
    #buttonbar .current a { background-position:0 -150px; border-width:0; }
    #buttonbar .current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
    #buttonbar a:hover { background-position:0% -150px; }
    #buttonbar a:hover span { background-position:100% -150px; }
    //-->
    </style>
    <div id="buttontop">
     <table style="width: 100%; padding: 0; " cellspacing="0">
         <tr>
             <td style="width: 70%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;">
                 <a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&op=showmod&mod=' . $GLOBALS["xoopsModule"]->getVar( "mid" ) . '">' . _PREFERENCES . '</a> |
				 <a href="../index.php">' . _XO_MI_MENU_MODULEHOME . '</a> |
				 <a href="../index.php">' . _XO_MI_MENU_MODULEBLOCKS . '</a> |
				 <a href="../index.php">' . _XO_MI_MENU_MODULETEMPLATES . '</a> |
				 <a href="../index.php">' . _XO_MI_MENU_MODULECOMMENTS . '</a>
             </td>
             <td style="width: 30%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;">
                 <strong>' . $GLOBALS["xoopsModule"]->getVar( "name" ) . '</strong>&nbsp;' . $breadcrumb . '
             </td>
         </tr>
     </table>
    </div>
    <div id="buttonbar">
     <ul>';
	foreach ( array_keys( $adminmenu ) as $key ) {
		$adminmenu_text .= ( ( $currentoption == $key ) ? '<li class="current">' : '<li>' ) . '<a href="' . $module_link . $adminmenu[$key]["link"] . '"><span>' . $adminmenu[$key]["title"] . '</span></a></li>';
	}
	$adminmenu_text .= '
     </ul>
    </div><br style="clear:both;" />';
	echo $adminmenu_text;
}

/**
 * xoopsFaq_CleanVars()
 *
 * @return
 */
function xoopsFaq_CleanVars( &$global, $key, $default = '', $type = 'int' ) {
	switch ( $type ) {
		case 'string':
			$ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_MAGIC_QUOTES ) : $default;
			break;
		case 'int':
		default:
			$ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_NUMBER_INT ) : $default;
			break;
	}
	if ( $ret === false ) {
		return $default;
	}
	return $ret;
}

/**
 * xoopsFaq_displayHeading()
 *
 * @param mixed $value
 * @return
 */
function xoopsFaq_DisplayHeading( $heading = '', $subheading = '', $showbutton = true ) {
	$ret = '';

	if ( !empty( $heading ) ) {
		$ret .= '<h4>' . $heading . '</h4>';
	}

	if ( !empty( $subheading ) ) {
		$ret .= '<div style="text-align: left; margin-bottom: 5px; margin-left: 5px;">' . $subheading . '</div><br />';
	}
	if ( $showbutton ) {
		$ret .= '<div style="text-align: right; margin-bottom: 10px;"><input type="button" name="button" onclick=\'location="' . basename( $_SERVER['SCRIPT_FILENAME'] ) . '?op=edit"\' value="' . _XO_LA_CREATENEW . '" /></div>';
	}
	echo $ret;
}

/**
 * xoopsFaq_cp_footer()
 *
 * @return
 */
function xoopsFaq_cp_footer() {
	global $xoopsModule;

	echo '<div style="padding-top: 16px; padding-bottom: 10px; text-align: center;">
		<a href="' . $xoopsModule->getInfo( 'website_url' ) . '" target="_blank">' . xoopsFaq_showImage( 'microbutton', '', '', 'gif' ) . '
		</a>
	</div>';
	xoops_cp_footer();
}

/**
 * xoopsFaq_showImage()
 *
 * @param string $name
 * @param string $title
 * @param string $align
 * @param string $ext
 * @param string $path
 * @param string $size
 * @return
 */
function xoopsFaq_showImage( $name = '', $title = '', $align = 'middle', $ext = 'png', $path = '', $size = '' ) {
	if ( empty( $path ) ) {
		$path = 'modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/images';
	}
	if ( !empty( $name ) ) {
		$fullpath = XOOPS_URL . '/' . $path . '/' . $name . '.' . $ext;
		$ret = '<img src="' . $fullpath . '" ';
		if ( !empty( $size ) ) {
			$ret = '<img src="' . $fullpath . '" ' . $size;
		}
		$ret .= ' title = "' . htmlspecialchars( $title ) . '"';
		$ret .= ' alt = "' . htmlspecialchars( $title ) . '"';
		if ( !empty( $align ) ) {
			$ret .= ' style="vertical-align: ' . $align . '; border: 0px;"';
		}
		$ret .= ' />';
		return $ret;
	} else {
		return '';
	}
}

/**
 * xoopsFaq_getIcons()
 *
 * @param array $_icon_array
 * @param mixed $key
 * @param mixed $value
 * @param mixed $extra
 * @return
 */
function xoopsFaq_getIcons( $_icon_array = array(), $key, $value = null, $extra = null ) {
	$ret = '';
	if ( $value ) {
		foreach( $_icon_array as $_op => $icon ) {
			$url = ( !is_numeric( $_op ) ) ? $_op . "?{$key}=" . $value : xoops_getenv( 'PHP_SELF' ) . "?op={$icon}&amp;{$key}=" . $value;
			if ( $extra != null ) {
				$url .= $extra;
			}
			$ret .= '<a href="' . $url . '">' . xoopsFaq_showImage( $icon, xoopsFaq_getConstants( '_XO_LA_' . $icon ), null, 'png' ) . '</a>';
		}
	}
	return $ret;
}

/**
 * xoopsFaq_getConstants()
 *
 * @param mixed $_title
 * @param string $prefix
 * @param string $suffix
 * @return
 */
function xoopsFaq_getConstants( $_title, $prefix = '', $suffix = '' ) {
	$prefix = ( $prefix != '' || $_title != 'action' ) ? trim( $prefix ) : '';
	$suffix = trim( $suffix );
	return constant( strtoupper( "$prefix$_title$suffix" ) );
}

/**
 * wfp_isEditorHTML()
 *
 * @return
 */
function xoopsFaq_isEditorHTML() {
	if ( isset( $GLOBALS['xoopsModuleConfig']['use_wysiwyg'] ) && in_array( $GLOBALS['xoopsModuleConfig']['use_wysiwyg'], array( 'tinymce', 'fckeditor', 'koivi', 'inbetween', 'spaw' ) ) ) {
		return true;
	}
	return false;
}

?>