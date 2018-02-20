<?php
// $Id: localsupport.php 3928 2009-11-25 22:02:34Z kris_fr $

$menu = array();

/*$menu[] = array(
    'link'      => 'http://www.afux.org',
    'title'     => 'AFUX',
    'absolute'  => 1,
    'icon'      => XOOPS_URL . '/modules/system/class/gui/paradigme/icons/xoops.png'
);

$menu[] = array(
    'link'      => 'http://www.afux.org/modules/xdonations/',
    'title'     => _AD_XDONATIONS,
    'absolute'  => 1
);*/

$menu[] = array(
    'link'      => 'http://www.frxoops.org',
    'title'     => 'Xoops France',
    'absolute'  => 1,
    'icon'      => XOOPS_URL . '/modules/system/class/gui/paradigme/icons/xoops.png'
);

$menu[] = array(
    'link'      => 'http://www.frxoops.org/modules/TDMPicture/',
    'title'     => _AD_XOOPSTHEMES,
    'absolute'  => 1,
    'icon'      => XOOPS_URL . '/modules/system/class/gui/paradigme/icons/tweb.png'
);

$menu[] = array(
    'link'      => 'http://www.frxoops.org/modules/TDMDownloads/',
    'title'     => _AD_XOOPSMODULES,
    'absolute'  => 1,
    'icon'      => XOOPS_URL . '/modules/system/class/gui/paradigme/icons/xoops.png'
);

$menu[] = array(
    'link'      => 'http://www.frxoops.org/modules/newbb/',
    'title'     => _FORUM,
    'absolute'  => 1
);

$menu[] = array(
    'link'      => 'http://www.frxoops.org/modules/mytube/',
    'title'     => _TUTOS,
    'absolute'  => 1
);

$menu[] = array(
    'link'      => 'http://www.facebook.com/pages/frxoops/103411163044171',
    'title'     => _FACEBOOK,
    'absolute'  => 1
);

$menu[] = array(
    'link'      => 'http://sourceforge.net/projects/xoopsfrance/',
    'title'     => _SOURCEFORGE,
    'absolute'  => 1
);

return $menu;

?>