<?php
//------------------------------------------------
//declaration des templates du modules
//------------------------------------------------
$i = 0;
$i++;
$modversion['templates'][$i]['file'] = 'hermes_archive.html';
$modversion['templates'][$i]['description']  = '';
//------------------------------------------------
$i++;
$modversion['templates'][$i]['file'] = 'hermes_archiveDetail.html';
$modversion['templates'][$i]['description']  = '';
//------------------------------------------------
$i++;
$modversion['templates'][$i]['file'] = 'hermes_archiveIn.html';
$modversion['templates'][$i]['description']  = '<{$smarty.const._MD_HER_LETTER}> : <{$lettre.libelle}>';
//------------------------------------------------
$i++;
$modversion['templates'][$i]['file'] = 'hermes_lettre.html';
$modversion['templates'][$i]['description']  = ' =============================================================== ';
//------------------------------------------------
$i++;
$modversion['templates'][$i]['file'] = 'hermes_lettreDetail.html';
$modversion['templates'][$i]['description']  = ' 
    <td width="20px"  class="even" style="text-align:right"  ></td>    
     
    <input type="checkbox" name="chkLettre_<{$lettre.idLettre}> " <{$lettre.checked}> value="ON">    
    ';
//------------------------------------------------
$i++;
$modversion['templates'][$i]['file'] = 'hermes_listSondage.html';
$modversion['templates'][$i]['description']  = '
idSondage
nom
categorie
description
dateDebut
dateFin
disposition

';
//------------------------------------------------
$i++;
$modversion['templates'][$i]['file'] = 'hermes_showSondage.html';
$modversion['templates'][$i]['description']  = '
idSondage
idReponse
ordre
nom
sommeDeReponse

';
//------------------------------------------------
$i++;
$modversion['templates'][$i]['file'] = 'index.html';
$modversion['templates'][$i]['description']  = '';
//------------------------------------------------
?>