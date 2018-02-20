<?php
/**
 * Name: search.inc.php
 * Description: Search function for Xoops FAQ Module
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
 * @subpackage : Search Functions
 * @since 2.3.0
 * @author John Neill
 * @version $Id: search.inc.php 0000 10/04/2009 09:04:24 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * xoopsfaq_search()
 *
 * @param mixed $queryarray
 * @param mixed $andor
 * @param mixed $limit
 * @param mixed $offset
 * @param mixed $userid
 * @return
 */
function xoopsfaq_search( $queryarray, $andor, $limit, $offset, $userid ) {
	global $xoopsDB;
	$ret = array();
	if ( $userid != 0 ) {
		return $ret;
	}
	$sql = "SELECT contents_id, category_id, contents_title, contents_contents, contents_time FROM " . $xoopsDB->prefix( "xoopsfaq_contents" ) . " WHERE contents_visible=1 ";
	// because count() returns 1 even if a supplied variable
	// is not an array, we must check if $querryarray is really an array
	$count = count( $queryarray );
	if ( $count > 0 && is_array( $queryarray ) ) {
		$sql .= "AND ((contents_title LIKE '%$queryarray[0]%' OR contents_contents LIKE '%$queryarray[0]%')";
		for ( $i = 1; $i < $count; $i++ ) {
			$sql .= " $andor ";
			$sql .= "(contents_title LIKE '%$queryarray[$i]%' OR contents_contents LIKE '%$queryarray[$i]%')";
		}
		$sql .= ") ";
	}
	$sql .= "ORDER BY contents_id DESC";
	$result = $xoopsDB->query( $sql, $limit, $offset );
	$i = 0;
	while ( $myrow = $xoopsDB->fetchArray( $result ) ) {
		$ret[$i]['image'] = "images/question2.gif";
		$ret[$i]['link'] = "index.php?cat_id=" . $myrow['category_id'] . "#" . $myrow['contents_id'];
		$ret[$i]['title'] = $myrow['contents_title'];
		$ret[$i]['time'] = $myrow['contents_time'];
		$i++;
	}
	return $ret;
}

?>