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
defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Class to facilitate navigation in a multi page document/list
 *
 * @package kernel
 * @subpackage util
 * @author Kazumi Ono <onokazu@xoops.org>
 * @author John Neill <catzwolf@xoops.org>
 * @copyright (c) 2000-2003 The Xoops Project - www.xoops.org
 */
class tdmspotPageNav
{
    /**
     * *#@+
     *
     * @access private
     */
    var $total;
    var $perpage;
    var $current;
    var $url;
    /**
     * *#@-
     */
    
    /**
     * Constructor
     *
     * @param int $total_items Total number of items
     * @param int $items_perpage Number of items per page
     * @param int $current_start First item on the current page
     * @param string $start_name Name for "start" or "offset"
     * @param string $extra_arg Additional arguments to pass in the URL
     */
    function tdmspotPageNav($total_items, $items_perpage, $current_start, $start_name = "start", $extra_arg = "")
    {
	global $cat, $xoopsModuleConfig, $tris;
        $this->total = intval($total_items);
        $this->perpage = intval($items_perpage);
        $this->current = intval($current_start);
        $this->extra = $extra_arg;
        if ($extra_arg != '' && (substr($extra_arg, - 5) != '&amp;' || substr($extra_arg, - 1) != '&')) {
            $this->extra = '&amp;' . $extra_arg;
        }
        //$this->url = $_SERVER['PHP_SELF'] . '?' . trim($start_name) . '=';
		$this->url = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $cat->getVar('id'), $cat->getVar('title'), $current_start, $items_perpage, $tris );
    }
    
    /**
     * Create text navigation
     *
     * @param integer $offset
     * @return string
     */
    function renderNav($offset = 4)
    {
	global $cat, $xoopsModuleConfig, $tris;
        $ret = '';
        if ($this->total <= $this->perpage) {
            return $ret;
        }
        $total_pages = ceil($this->total / $this->perpage);
        if ($total_pages > 1) {
            $ret .= '<div id="xo-pagenav">';
            $prev = $this->current - $this->perpage;
            if ($prev >= 0) {
                $ret .= '<a class="xo-pagarrow" href="' . tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $cat->getVar('id'), $cat->getVar('title'), $prev, $this->perpage, $tris ) . '"><u>&laquo;</u></a> ';
            }
            $counter = 1;
            $current_page = intval(floor(($this->current + $this->perpage) / $this->perpage));
            while ($counter <= $total_pages) {
                if ($counter == $current_page) {
                    $ret .= '<strong class="xo-pagact" >(' . $counter . ')</strong> ';
                } elseif (($counter > $current_page - $offset && $counter < $current_page + $offset) || $counter == 1 || $counter == $total_pages) {
                    if ($counter == $total_pages && $current_page < $total_pages - $offset) {
                        $ret .= '... ';
                    }
                    $ret .= '<a class="xo-counterpage" href="' . tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $cat->getVar('id'), $cat->getVar('title'), (($counter - 1) * $this->perpage), $this->perpage, $tris ) . '">' . $counter . '</a> ';
                    if ($counter == 1 && $current_page > 1 + $offset) {
                        $ret .= '... ';
                    }
                }
                $counter ++;
            }
            $next = $this->current + $this->perpage;
            if ($this->total > $next) {
                $ret .= '<a class="xo-pagarrow" href="' . tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $cat->getVar('id'), $cat->getVar('title'), $next, $this->perpage, $tris )  . '"><u>&raquo;</u></a> ';
            }
            $ret .= '</div> ';
        }
        return $ret;
    }

 
}

?>
