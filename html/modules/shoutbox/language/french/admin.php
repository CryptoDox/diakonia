<?php
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
//  Original Author: Alphalogic <alphafake@hotmail.com>					     //
//  Original Author Website: http://www.alphalogic-network.de		         //
//  ------------------------------------------------------------------------ //
//  XOOPS Version made by: (XOOPS 1.3.x and 2.0.x version)			         //
//  Jan304 <http://www.jan304.org>									         //
//  ------------------------------------------------------------------------ //
//  Author:     tank                                                         //
//  Website:    http://www.customvirtualdesigns.com                          //
//  E-Mail:     tanksplace@comcast.net                                       //
//  Date:       10/05/2008                                                   //
//  Module:     Shoutbox                                                     //
//  File:       language/english/admin.php                                   //
//  Version:    4.01                                                         //
//  ------------------------------------------------------------------------ //
//  Change Log                                                               //
//  ***                                                                      //
//  Version 4.01 Initial CVD Release 10/05/2008                              //
//  ***                                                                      //

// General usage
define('_AM_SH_CONFIG','Administration de Shoutbox');
define('_AM_SH_POSTER','Auteur');
define('_AM_SH_MESSAGE','Message');
define('_AM_SH_INVALID_ID','ID ne renvoie aucun message');

// index.php
define('_AM_SH_CHOOSE','Que souhaitez-vous faire ?');
define('_AM_SH_EDIT_DB','Editer un message dans la base de données');
define('_AM_SH_EDIT_FILE','Editer un message dans le fichier');
define('_AM_SH_EDIT_INUSE',"En cours d'utilisation");
define('_AM_SH_STATUSOF','Informations sur shoutbox');

// shoutboxEdit.php
define('_AM_SH_EDIT_TITLE','Edition du message [Posté le %s]');
define('_AM_SH_EDIT_FROM','From'); // Ex: "From: 127.0.0.1"

// shoutboxList.php
define('_AM_SH_LIST_TIME','Date/Heure');
define('_AM_SH_LIST_ACTION','Action');
define('_AM_SH_LIST_NOSHOUTS','Pas de message');

// shoutboxRemove.php
define('_AM_SH_REMOVE_TITLE','Supprimer le message [Posté le %s]');
define('_AM_SH_REMOVE_SUCCES','Message supprimé !');
define('_AM_SH_REMOVE_FAILURE',"Erreur - Impossible d'exécuter la requête...");
define('_AM_SH_REMOVE_FROM','From');

// shoutboxStatus.php
define('_AM_SH_STATUS_TITLE','Informations shoutox');
define('_AM_SH_STATUS_STORAGETYPE','Type de stockage');
define('_AM_SH_STATUS_INDB','Message(s) dans la base de données');
define('_AM_SH_STATUS_INFILE','Message(s) dans le fichier');
define('_AM_SH_STATUS_SIZEDB','Taille de la base dans la base de données');
define('_AM_SH_STATUS_SIZEFILE','Taille du fichier');

// shoutboxFile.php
define('_AM_SH_FILE_TITLE','Edition du fichier shout.cvs');
define('_AM_SH_FILE_SOURCE','Contenu de shout.cvs');
define('_AM_SH_FILE_SOURCED','Vous pouvez supprimer/éditer des lignes du fichier shout.cvs. Mais être sûr de ne pas casser la structure (Ligne par ligne).');
define('_AM_SH_FILE_HASH','Forcer la mise à jour');
define('_AM_SH_FILE_HASHD',"Ignorer le test d'intégrité pour forcer la mise à jour."); // Hash fail: file has been updated (read: shout added) during editing
define('_AM_SH_FILE_HASH_FAILED',"La vérification de l'intégrité du fichier a échoué !");
define('_AM_SH_FILE_UPDATED','Fichier mis à jour');
define('_AM_SH_FILE_FAILED',"Impossible d'ouvrir le fichier !");

?>