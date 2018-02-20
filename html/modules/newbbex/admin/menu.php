<?php
// $Id: menu.php,v 1.5 2003/02/12 11:37:26 okazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

$adminmenu[0]['title'] = _MI_NEWBBEX_ADMENU1;
$adminmenu[0]['link'] = "admin/admin_forums.php?mode=addforum";
$adminmenu[1]['title'] = _MI_NEWBBEX_ADMENU2;
$adminmenu[1]['link'] = "admin/admin_forums.php?mode=editforum";
$adminmenu[2]['title'] = _MI_NEWBBEX_ADMENU3;
$adminmenu[2]['link'] = "admin/admin_priv_forums.php?mode=editforum";
$adminmenu[3]['title'] = _MI_NEWBBEX_ADMENU4;
$adminmenu[3]['link'] = "admin/admin_forums.php?mode=sync";
$adminmenu[4]['title'] = _MI_NEWBBEX_ADMENU5;
$adminmenu[4]['link'] = "admin/admin_forums.php?mode=addcat";
$adminmenu[5]['title'] = _MI_NEWBBEX_ADMENU6;
$adminmenu[5]['link'] = "admin/admin_forums.php?mode=editcat";
$adminmenu[6]['title'] = _MI_NEWBBEX_ADMENU7;
$adminmenu[6]['link'] = "admin/admin_forums.php?mode=remcat";
$adminmenu[7]['title'] = _MI_NEWBBEX_ADMENU8;
$adminmenu[7]['link'] = "admin/admin_forums.php?mode=catorder";
?>
