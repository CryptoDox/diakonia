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
 if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

function tdmspot_search($queryarray, $andor, $limit, $offset, $userid){
	global $xoopsDB;
	
//load class
$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
	
	$ret = array();
	//cherche le fichier
	$criteria = new CriteriaCompo();
	$criteria->setSort('title');
	$criteria->setOrder('ASC');
	$criteria->add(new Criteria('display', 1));
	$criteria->add(new Criteria('indate', time(), '<'));
	$criteria->add(new Criteria('title', '%'.$queryarray[0].'%', 'LIKE'));
	$criteria->setStart($offset);
	$criteria->setLimit($limit);
	$item_arr = $item_handler->getObjects($criteria);

	$i = 0;
 	//while($myrow = $xoopsDB->fetchArray($result)){
	foreach (array_keys($item_arr) as $f) {
		$ret[$i]['image'] = "images/search_file.gif";
		$ret[$i]['link'] = "item.php?itemid=".$item_arr[$f]->getVar('id');
		$ret[$i]['title'] = $item_arr[$f]->getVar('title');
		$ret[$i]['time'] = $item_arr[$f]->getVar('indate');
		$ret[$i]['uid'] = $item_arr[$f]->getVar('poster');
		$i++;
	}
	
	return $ret;
}
?>
