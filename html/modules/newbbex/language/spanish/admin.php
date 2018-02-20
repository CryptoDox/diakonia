<?php
//========================================================================================
//Traducción al Español (es-ar) realizada por Magno Laguna [laguna_virtual@yahoo.com.ar]
//Buenos Aires - Argentina
//========================================================================================
// $Id: admin.php,v 1.7 2003/03/05 05:56:22 w4z004 Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MDEX_A_FORUMCONF","Configuraci&oacute;n del foro");
define("_MDEX_A_ADDAFORUM","Agregar un foro");
define("_MDEX_A_LINK2ADDFORUM","Este enlace te enviar&aacute; a una p&aacute;gina en la cual vas a poder agregar un foro a la base de datos.");
define("_MDEX_A_EDITAFORUM","Editar un foro");
define("_MDEX_A_LINK2EDITFORUM","Este enlace te permitir&aacute; editar un foro existente.");
define("_MDEX_A_SETPRIVFORUM","Editar permisos de los foros privados");
define("_MDEX_A_LINK2SETPRIV","Este enlace te permitir&aacute; editar los permisos de acceso para un foro privado existente.");
define("_MDEX_A_SYNCFORUM","Sincronizar indice Foro/Tema");
define("_MDEX_A_LINK2SYNC","Este enlace te permitir&aacute; sincronizar foro y tema indexados para arreglar cualquier diferencia que podr&iacute;a existir.");
define("_MDEX_A_ADDACAT","Agregar una categor&iacute;a");
define("_MDEX_A_LINK2ADDCAT","Este enlace te permitir&aacute; crear una nueva categor&iacute;a en la que podr&aacute;s agregar foros.");
define("_MDEX_A_EDITCATTTL","Editar t&iacute;tulo de una categor&iacute;a");
define("_MDEX_A_LINK2EDITCAT","Este enlace te permitir&aacute; editar el t&iacute;tulo de una categor&iacute;a.");
define("_MDEX_A_RMVACAT","Borrar una categor&iacute;a");
define("_MDEX_A_LINK2RMVCAT","Este enlace te permitir&aacute; eliminar cualquier categor&iacute;a de la base de datos.");
define("_MDEX_A_REORDERCAT","Re-ordenar categor&iacute;as");
define("_MDEX_A_LINK2ORDERCAT","Este enlace te permitir&aacute; cambiar el orden en que se muestran las categor&iacute;as en la p&aacute;gina principal.");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MDEX_A_FORUMUPDATED","Foro actualizado");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF","El(Los) moderador(es)seleccionados no han sido eliminados porque si as&iacute; hubiera ocurrido no habr&iacute;a moderador(es) en este Foro.");
define("_MDEX_A_FORUMREMOVED","Foro eliminado");
define("_MDEX_A_FRFDAWAIP","El Foro fue eliminado de la base de datos junto a todos sus env&iacute;os.");
define("_MDEX_A_NOSUCHFORUM","No existe tal Foro");
define("_MDEX_A_EDITTHISFORUM","Editar este Foro");
define("_MDEX_A_DTFTWARAPITF","Borrar este Foro (&iexcl;Esto tambi&eacute;n borrar&aacute; los env&iacute;os realizados en &eacute;l!)");
define("_MDEX_A_FORUMNAME","Nombre del foro:");
define("_MDEX_A_FORUMDESCRIPTION","Descripci&oacute;n del foro:");
define("_MDEX_A_MODERATOR","Moderador(es):");
define("_MDEX_A_REMOVE","Borrar");
define("_MDEX_A_NOMODERATORASSIGNED","No hay moderadores asignados");
define("_MDEX_A_NONE","Ninguno");
define("_MDEX_A_CATEGORY","Categor&iacute;a:");
define("_MDEX_A_ANONYMOUSPOST","Usuarios an&oacute;nimos");
define("_MDEX_A_REGISTERUSERONLY","S&oacute;lo usuarios registrados");
define("_MDEX_A_MODERATORANDADMINONLY","S&oacute;lo Moderadores &oacute; Administradores");
define("_MDEX_A_TYPE","Tipo:");
define("_MDEX_A_PUBLIC","P&uacute;blico");
define("_MDEX_A_PRIVATE","Privado");
define("_MDEX_A_SELECTFORUMEDIT","Seleccionar el foro a editar");
define("_MDEX_A_NOFORUMINDATABASE","No hay foros en la base de datos");
define("_MDEX_A_DATABASEERROR","Error en la base de datos");
define("_MDEX_A_EDIT","Editar");
define("_MDEX_A_CATEGORYUPDATED","Categor&iacute;a actualizada");
define("_MDEX_A_EDITCATEGORY","Editando categor&iacute;a:");
define("_MDEX_A_CATEGORYTITLE","T&iacute;tulo de la categor&iacute;a:");
define("_MDEX_A_SELECTACATEGORYEDIT","Seleccionar una categor&iacute;a a editar");
define("_MDEX_A_CATEGORYCREATED","Categor&iacute;a creada");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS","NOTA: Al presionar el bot&oacute;n s&oacute;lo se eliminar&aacute; la categor&iacute;a seleccionada. Esto no quitar&aacute; los foros que se encuentran bajo dicha categor&iacute;a. Para eliminar los foros, dirigite a la secci&oacute;n 'Editar un foro' en la p&aacute;gina principal del panel de administraci&oacute;n.");
define("_MDEX_A_REMOVECATEGORY","Borrar categor&iacute;a");
define("_MDEX_A_CREATENEWCATEGORY","Crear una nueva categor&iacute;a");
define("_MDEX_A_YDNFOATPOTFDYAA","ERROR: No completaste todos los campos del formulario.<br>&iquest;Asignaste al menos, un moderador para el foro? Por favor, volv&eacute; atr&aacute;s y correg&iacute; esto.");
define("_MDEX_A_FORUMCREATED","Foro creado");
define("_MDEX_A_VTFYJC","Ver el Foro creado");
define("_MDEX_A_EYMAACBYAF","ERROR: Es preciso crear una categor&iacute;a antes de agregar un foro.");
define("_MDEX_A_CREATENEWFORUM","Crear un nuevo foro");
define("_MDEX_A_ACCESSLEVEL","Nivel de acceso:");
define("_MDEX_A_CATEGORYMOVEUP","La categor&iacute;a fue ubicada en un nivel superior");
define("_MDEX_A_TCIATHU","Esta ya es la categor&iacute;a m&aacute;s alta.");
define("_MDEX_A_CATEGORYMOVEDOWN","La categor&iacute;a fue ubicada en un nivel inferior");
define("_MDEX_A_TCIATLD","Esta ya es la categor&iacute;a m&aacute;s baja.");
define("_MDEX_A_SETCATEGORYORDER","Administrando orden de las categor&iacute;as");
define("_MDEX_A_TODHITOTCWDOTIP","El orden desplegado aqu&iacute; es el orden en que se muestran las categorías en la p&aacute;gina principal. Para ubicar una categor&iacute;a en un nivel superior, presion&aacute; 'Mover arriba'; para ubicarla en un nivel inferior, presion&aacute; 'Mover abajo'.");
define("_MDEX_A_ECWMTCPUODITO","Por cada click, se mover&aacute; un lugar.");
define("_MDEX_A_CATEGORY1","Categor&iacute;a");
define("_MDEX_A_MOVEUP","Mover arriba");
define("_MDEX_A_MOVEDOWN","Mover abajo");


define("_MDEX_A_FORUMUPDATE","Configuraci&oacute;n del Foro actualizada");
define("_MDEX_A_RETURNTOADMINPANEL","Volver al panel de administraci&oacute;n");
define("_MDEX_A_RETURNTOFORUMINDEX","Volver al &iacute;ndice del Foro");
define("_MDEX_A_ALLOWHTML","Permitir HTML:");
define("_MDEX_A_YES"," Si ");
define("_MDEX_A_NO"," No");
define("_MDEX_A_ALLOWSIGNATURES","Permitir firma:");
define("_MDEX_A_HOTTOPICTHRESHOLD","N&uacute;mero de env&iacute;os para se considerado Popular:");
define("_MDEX_A_POSTPERPAGE","Env&iacute;os por p&aacute;gina:");
define("_MDEX_A_TITNOPPTTWBDPPOT","(N&uacute;mero de env&iacute;os a mostrar en cada p&aacute;gina de un tema)");
define("_MDEX_A_TOPICPERFORUM","Temas por Foro:");
define("_MDEX_A_TITNOTPFTWBDPPOAF","(N&uacute;mero de temas a mostrar en la p&aacute;gina principal de cada foro)");
define("_MDEX_A_SAVECHANGES","Guardar cambios");
define("_MDEX_A_CLEAR","Limpiar");
define("_MDEX_A_CLICKBELOWSYNC","Al presionar el botón el bot&oacute;n se sincronizar&aacute;n los Foros y las p&aacute;ginas de los temas con los datos correctos de la base de datos. Usar esta secci&oacute;n siempre que existan fallas en los temas y las listas de foros.");
define("_MDEX_A_SYNCHING","Sincronizando Foros y temas (Esto puede demorar unos minutos)");
define("_MDEX_A_DONESYNC","&iexcl;Listo!");
define("_MDEX_A_CATEGORYDELETED","Categor&iacute;a borrada");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MDEX_A_SAFTE","Seleccionar el foro a editar");
define("_MDEX_A_NFID","No hay foros en la base de datos");
define("_MDEX_A_EFPF","Editando permisos para el Foro: <b>%s</b>");
define("_MDEX_A_UWA","Usuarios con acceso:");
define("_MDEX_A_UWOA","Usuarios sin acceso:");
define("_MDEX_A_ADDUSERS","Agregar usuarios -->");
define("_MDEX_A_CLEARALLUSERS","Quitar todos los usuarios");
define("_MDEX_A_REVOKEPOSTING","No permitir env&iacute;o");
define("_MDEX_A_GRANTPOSTING","Permitir env&iacute;o");

// Ajouts Hervé
define("_MDEX_A_SHOWNAME","Cambiar el nombre de usuario por el nombre real");
define("_MDEX_A_SHOWICONSPANEL","Mostrar panel de &iacute;conos");
define("_MDEX_A_SHOWSMILIESPANEL","Mostrar panel de caritas");
define("_MDEX_A_EDITPERMS","Permisos");
define("_MDEX_A_CURRENT","Actual");
define("_MDEX_A_ADD","Agregar");
define("_MDEX_A_SHOWMSGPAGINATION","muestrar la paginaci&oacute;n de los mensajes en los bloques");
define("_MDEX_A_CANPOST","Puede enviar");
define("_MDEX_A_CANTPOST","No puede enviar");

// Ajout 1.5
define("_MDEX_A_ALLOW_UPLOAD", "Allow files to be uploaded");
?>