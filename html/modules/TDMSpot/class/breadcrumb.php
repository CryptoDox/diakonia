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
class SystemBreadcrumb {
    /* Variables */
    var $_bread = array();
    var $_tips;

    function __construct () {
    }    

    
    /**
     * Add Tips
     *
     */              
    function addTips( $value ) {
        $this->_tips = $value;
    }
    
    /**
     * Render System BreadCrumb
     *
     */              
    function render(){
        global $xoopsModuleConfig;

            $out = '<style type="text/css">
    <!--
.tips{
    color:#000000;
    border:1px solid #00cc00;
    padding:8px 8px 8px 35px;
    background:#f8fff8 url("../images/decos/idea.png") no-repeat 5px 4px;
}
    //-->
    </style>';

            if ( $this->_tips ) {
                $out .= '<div class="tips">' . $this->_tips . '</div><br />';
            }
            echo $out;
        
    }

}

?>