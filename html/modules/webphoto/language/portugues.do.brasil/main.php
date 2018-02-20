<?php
// $Id: main.php,v 1.1 2008/10/13 10:16:04 ohwada Exp $

//=========================================================
// webphoto module
// 2008-04-02 K.OHWADA
//=========================================================

// === define begin ===
if( !defined("_MB_WEBPHOTO_LANG_LOADED") ) 
{

define("_MB_WEBPHOTO_LANG_LOADED" , 1 ) ;

//=========================================================
// base on myalbum
//=========================================================

define("_WEBPHOTO_CATEGORY","Categoria");
define("_WEBPHOTO_SUBMITTER","Enviar");
define("_WEBPHOTO_NOMATCH_PHOTO","N�o h� imagem correspondente a seu pedido");

define("_WEBPHOTO_ICON_NEW","Novo");
define("_WEBPHOTO_ICON_UPDATE","Atualizado");
define("_WEBPHOTO_ICON_POPULAR","Popular");
define("_WEBPHOTO_ICON_LASTUPDATE","�ltima Atualiza��o");
define("_WEBPHOTO_ICON_HITS","Hits");
define("_WEBPHOTO_ICON_COMMENTS","Coment�rios");

define("_WEBPHOTO_SORT_IDA","Gravar n�mero (ID menor para as maiores)");
define("_WEBPHOTO_SORT_IDD","Gravar n�mero (ID maiorpra as menores)");
define("_WEBPHOTO_SORT_HITSA","Popularidade (Menos para muitos Hits)");
define("_WEBPHOTO_SORT_HITSD","Popularidade (Muitos para menos Hits)");
define("_WEBPHOTO_SORT_TITLEA","T�tulo (A a Z)");
define("_WEBPHOTO_SORT_TITLED","T�tulo (Z a A))");
define("_WEBPHOTO_SORT_DATEA","Data da atualiza��o (Imagens antigas listadas primeiros)");
define("_WEBPHOTO_SORT_DATED","Data da atualiza��o (Imagens recentes listadas primeiro)");
define("_WEBPHOTO_SORT_RATINGA","Avalia��o (Escore mais baixo para escore maior)");
define("_WEBPHOTO_SORT_RATINGD","Avalia��o (Escore mais alto para escore menor)");
define("_WEBPHOTO_SORT_RANDOM","Aleat�rio");

define("_WEBPHOTO_SORT_SORTBY","Classifica��o por:");
define("_WEBPHOTO_SORT_TITLE","T�tulo");
define("_WEBPHOTO_SORT_DATE","Data da atualiza��o");
define("_WEBPHOTO_SORT_HITS","Popularidade");
define("_WEBPHOTO_SORT_RATING","Avalia��o");
define("_WEBPHOTO_SORT_S_CURSORTEDBY","Imagens atualmente classificadas por: %s");

define("_WEBPHOTO_NAVI_PREVIOUS","Anterior");
define("_WEBPHOTO_NAVI_NEXT","Pr�xima");
define("_WEBPHOTO_S_NAVINFO" , "Im�gem n�. %s - %s (fora de %s hit imagens)" ) ;
define("_WEBPHOTO_S_THEREARE","Existe <b>%s</b> Imagens em nosso banco de dados.");
define("_WEBPHOTO_S_MOREPHOTOS","Mais fotos de %s");
define("_WEBPHOTO_ONEVOTE","1 voto");
define("_WEBPHOTO_S_NUMVOTES","%s votos");
define("_WEBPHOTO_ONEPOST","1 post");
define("_WEBPHOTO_S_NUMPOSTS","%s posts");
define("_WEBPHOTO_VOTETHIS","Vote nesta");
define("_WEBPHOTO_TELLAFRIEND","Diga a um amigo");
define("_WEBPHOTO_SUBJECT4TAF","Uma imagem para voc�");


//---------------------------------------------------------
// submit
//---------------------------------------------------------
// only "Y/m/d" , "d M Y" , "M d Y" can be interpreted
define("_WEBPHOTO_DTFMT_YMDHI" , "d M Y H:i" ) ;

define("_WEBPHOTO_TITLE_ADDPHOTO","Adicionar Imagem");
define("_WEBPHOTO_TITLE_PHOTOUPLOAD","Enviar imagem");
define("_WEBPHOTO_CAP_MAXPIXEL","Tamanho m�ximo em pixel");
define("_WEBPHOTO_CAP_MAXSIZE","Tamanho m�ximo do arquivo (byte)");
define("_WEBPHOTO_CAP_VALIDPHOTO","V�lido");
define("_WEBPHOTO_DSC_TITLE_BLANK","Deixe o t�tulo em branco para usar os nomes de arquivo como t�tulo");

define("_WEBPHOTO_RADIO_ROTATETITLE" , "Rota��o da imagem" ) ;
define("_WEBPHOTO_RADIO_ROTATE0" , "n�o girar" ) ;
define("_WEBPHOTO_RADIO_ROTATE90" , "girar a direita" ) ;
define("_WEBPHOTO_RADIO_ROTATE180" , "girar 180 graus" ) ;
define("_WEBPHOTO_RADIO_ROTATE270" , "girar a esquerda" ) ;

define("_WEBPHOTO_SUBMIT_RECEIVED","N�s recebemos sua foto. Obrigado!");
define("_WEBPHOTO_SUBMIT_ALLPENDING","Todas as fotos postadas dependenm de verifica��o.");

define("_WEBPHOTO_ERR_MUSTREGFIRST","Desculpe, voc� n�o tem permiss�o para executar essa a��o. <br />Por favor, registre-se ou fa�a seu login primeiro!");
define("_WEBPHOTO_ERR_MUSTADDCATFIRST","Desculpe, n�o h� categorias ainda para acrescentar.<br />Por favor, crie uma categoria primeiro!");
define("_WEBPHOTO_ERR_NOIMAGESPECIFIED","Nenhuma imagem foi enviada");
define("_WEBPHOTO_ERR_FILE","As imagens s�o grandes demais ou h� um problema com a configrua��o");
define("_WEBPHOTO_ERR_FILEREAD","Imagens est�o sem permiss�o de leitura.");
define("_WEBPHOTO_ERR_TITLE","Voc� de informar 'T�tulo' ");


//---------------------------------------------------------
// edit
//---------------------------------------------------------
define("_WEBPHOTO_TITLE_EDIT","Editar a Imagem");
define("_WEBPHOTO_TITLE_PHOTODEL","Deletar a Imagem");
define("_WEBPHOTO_CONFIRM_PHOTODEL","Deletar a foto?");
define("_WEBPHOTO_DBUPDATED","Banco de dados atualizado com sucesso!");
define("_WEBPHOTO_DELETED","Deletada!");


//---------------------------------------------------------
// rate
//---------------------------------------------------------
define("_WEBPHOTO_RATE_VOTEONCE","Por favor, n�o vote para a mesma imagem mais de uma vez.");
define("_WEBPHOTO_RATE_RATINGSCALE","A escala � de 1 a 10, sendo que 1 � pior e 10 excelente.");
define("_WEBPHOTO_RATE_BEOBJECTIVE","Por favor, seja objetivo. Se todos receberem um 1 ou um 10, as avalia��es n�o ser�o �teis.");
define("_WEBPHOTO_RATE_DONOTVOTE","N�o vote para seu pr�prio recurso.");
define("_WEBPHOTO_RATE_IT","Avaliar a imagem!");
define("_WEBPHOTO_RATE_VOTEAPPRE","Seu voto ser� apreciado.");
define("_WEBPHOTO_RATE_S_THANKURATE","Obrigado por ter tomado seu tempo avaliando uma de nossas imagens %s.");

define("_WEBPHOTO_ERR_NORATING","Nenhuma avalia��o selecionada.");
define("_WEBPHOTO_ERR_CANTVOTEOWN","Voc� n�o pode votar em um recurso enviado por voc�.<br />Todos os votos s�o registrados e revisados.");
define("_WEBPHOTO_ERR_VOTEONCE","Vote para os recursos selecionados apenas uma vez.<br />Todos os votos s�o registrados e revisados.");


//---------------------------------------------------------
// movo to admin.php
//---------------------------------------------------------
// New in myAlbum-P

// only "Y/m/d" , "d M Y" , "M d Y" can be interpreted
//define( "_WEBPHOTO_DTFMT_YMDHI" , "d M Y H:i" ) ;

//define( "_WEBPHOTO_NEXT_BUTTON" , "Next" ) ;
//define( "_WEBPHOTO_REDOLOOPDONE" , "Done." ) ;

//define( "_WEBPHOTO_BTN_SELECTALL" , "Select All" ) ;
//define( "_WEBPHOTO_BTN_SELECTNONE" , "Select None" ) ;
//define( "_WEBPHOTO_BTN_SELECTRVS" , "Select Reverse" ) ;
//define( "_WEBPHOTO_FMT_PHOTONUM" , "%s every page" ) ;

//define( "_WEBPHOTO_AM_ADMISSION" , "Admit Photos" ) ;
//define( "_WEBPHOTO_AM_ADMITTING" , "Admitted photo(s)" ) ;
//define( "_WEBPHOTO_AM_LABEL_ADMIT" , "Admit the photos you checked" ) ;
//define( "_WEBPHOTO_AM_BUTTON_ADMIT" , "Admit" ) ;
//define( "_WEBPHOTO_AM_BUTTON_EXTRACT" , "extract" ) ;

//define( "_WEBPHOTO_AM_PHOTOMANAGER" , "Photo Manager" ) ;
//define( "_WEBPHOTO_AM_PHOTONAVINFO" , "Photo No. %s-%s (out of %s photos hit)" ) ;
//define( "_WEBPHOTO_AM_LABEL_REMOVE" , "Remove the photos checked" ) ;
//define( "_WEBPHOTO_AM_BUTTON_REMOVE" , "Remove!" ) ;
//define( "_WEBPHOTO_AM_JS_REMOVECONFIRM" , "Remove OK?" ) ;
//define( "_WEBPHOTO_AM_LABEL_MOVE" , "Change category of the checked photos" ) ;
//define( "_WEBPHOTO_AM_BUTTON_MOVE" , "Move" ) ;
//define( "_WEBPHOTO_AM_BUTTON_UPDATE" , "Modify" ) ;
//define( "_WEBPHOTO_AM_DEADLINKMAINPHOTO" , "The main image don't exist" ) ;


//---------------------------------------------------------
// not use
//---------------------------------------------------------
// New MyAlbum 1.0.1 (and 1.2.0)
//define("_WEBPHOTO_MOREPHOTOS","More Photos from %s");
//define("_WEBPHOTO_REDOTHUMBS","Redo Thumbnails (<a href='redothumbs.php'>re-start</a>)");
//define("_WEBPHOTO_REDOTHUMBS2","Rebuild Thumbnails");
//define("_WEBPHOTO_REDOTHUMBSINFO","Too large a number may lead to server time out.");
//define("_WEBPHOTO_REDOTHUMBSNUMBER","Number of thumbs at a time");
//define("_WEBPHOTO_REDOING","Redoing: ");
//define("_WEBPHOTO_BACK","Return");
//define("_WEBPHOTO_ADDPHOTO","Add Photo");


//---------------------------------------------------------
// movo to admin.php
//---------------------------------------------------------
// New MyAlbum 1.0.0
//define("_WEBPHOTO_PHOTOBATCHUPLOAD","Register photos uploaded to the server already");
//define("_WEBPHOTO_PHOTOUPLOAD","Photo Upload");
//define("_WEBPHOTO_PHOTOEDITUPLOAD","Photo Edit and Re-upload");
//define("_WEBPHOTO_MAXPIXEL","Max pixel size");
//define("_WEBPHOTO_MAXSIZE","Max file size(byte)");
//define("_WEBPHOTO_PHOTOTITLE","Title");
//define("_WEBPHOTO_PHOTOPATH","Path");
//define("_WEBPHOTO_TEXT_DIRECTORY","Directory");
//define("_WEBPHOTO_DESC_PHOTOPATH","Type the full path of the directory including photos to be registered");
//define("_WEBPHOTO_MES_INVALIDDIRECTORY","Invalid directory is specified.");
//define("_WEBPHOTO_MES_BATCHDONE","%s photo(s) have been registered.");
//define("_WEBPHOTO_MES_BATCHNONE","No photo was detected in the directory.");
//define("_WEBPHOTO_PHOTODESC","Description");
//define("_WEBPHOTO_PHOTOCAT","Category");
//define("_WEBPHOTO_SELECTFILE","Select photo");
//define("_WEBPHOTO_NOIMAGESPECIFIED","Error: No photo was uploaded");
//define("_WEBPHOTO_FILEERROR","Error: Photos are too big or there is a problem with the configuration");
//define("_WEBPHOTO_FILEREADERROR","Error: Photos are not readable.");

//define("_WEBPHOTO_BATCHBLANK","Leave title blank to use file names as title");
//define("_WEBPHOTO_DELETEPHOTO","Delete?");
//define("_WEBPHOTO_VALIDPHOTO","Valid");
//define("_WEBPHOTO_PHOTODEL","Delete photo?");
//define("_WEBPHOTO_DELETINGPHOTO","Deleting photo");
//define("_WEBPHOTO_MOVINGPHOTO","Moving photo");

//define("_WEBPHOTO_STORETIMESTAMP","Don't touch timestamp");

//define("_WEBPHOTO_POSTERC","Poster: ");
//define("_WEBPHOTO_DATEC","Date: ");
//define("_WEBPHOTO_EDITNOTALLOWED","You're not allowed to edit this comment!");
//define("_WEBPHOTO_ANONNOTALLOWED","Anonymous users are not allowed to post.");
//define("_WEBPHOTO_THANKSFORPOST","Thanks for your submission!");
//define("_WEBPHOTO_DELNOTALLOWED","You're not allowed to delete this comment!");
//define("_WEBPHOTO_GOBACK","Go Back");
//define("_WEBPHOTO_AREYOUSURE","Are you sure you want to delete this comment and all comments under it?");
//define("_WEBPHOTO_COMMENTSDEL","Comment(s) Deleted Successfully!");

// End New


//---------------------------------------------------------
// not use
//---------------------------------------------------------
//define("_WEBPHOTO_THANKSFORINFO","Thank you for the information. We'll look into your request shortly.");
//define("_WEBPHOTO_BACKTOTOP","Back to Photo Top");
//define("_WEBPHOTO_THANKSFORHELP","Thank you for helping to maintain this directory's integrity.");
//define("_WEBPHOTO_FORSECURITY","For security reasons your user name and IP address will also be temporarily recorded.");

//define("_WEBPHOTO_MATCH","Match");
//define("_WEBPHOTO_ALL","ALL");
//define("_WEBPHOTO_ANY","ANY");
//define("_WEBPHOTO_NAME","Name");
//define("_WEBPHOTO_DESCRIPTION","Description");

//define("_WEBPHOTO_MAIN","Main");
//define("_WEBPHOTO_NEW","New");
//define("_WEBPHOTO_UPDATED","Updated");
//define("_WEBPHOTO_POPULAR","Popular");
//define("_WEBPHOTO_TOPRATED","Top Rated");

//define("_WEBPHOTO_POPULARITYLTOM","Popularity (Least to Most Hits)");
//define("_WEBPHOTO_POPULARITYMTOL","Popularity (Most to Least Hits)");
//define("_WEBPHOTO_TITLEATOZ","Title (A to Z)");
//define("_WEBPHOTO_TITLEZTOA","Title (Z to A)");
//define("_WEBPHOTO_DATEOLD","Date (Old Photos Listed First)");
//define("_WEBPHOTO_DATENEW","Date (New Photos Listed First)");
//define("_WEBPHOTO_RATINGLTOH","Rating (Lowest Score to Highest Score)");
//define("_WEBPHOTO_RATINGHTOL","Rating (Highest Score to Lowest Score)");
//define("_WEBPHOTO_LIDASC","Record Number (Smaller to Bigger)");
//define("_WEBPHOTO_LIDDESC","Record Number (Smaller is latter)");

//define("_WEBPHOTO_NOSHOTS","No Screenshots Available");
//define("_WEBPHOTO_EDITTHISPHOTO","Edit This Photo");

//define("_WEBPHOTO_DESCRIPTIONC","Description");
//define("_WEBPHOTO_EMAILC","Email");
//define("_WEBPHOTO_CATEGORYC","Category");
//define("_WEBPHOTO_SUBCATEGORY","Sub-category");
//define("_WEBPHOTO_LASTUPDATEC","Last Update");

//define("_WEBPHOTO_HITSC","Hits");
//define("_WEBPHOTO_RATINGC","Rating");
//define("_WEBPHOTO_NUMVOTES","%s votes");
//define("_WEBPHOTO_NUMPOSTS","%s posts");
//define("_WEBPHOTO_COMMENTSC","Comments");
//define("_WEBPHOTO_RATETHISPHOTO","Rate it");
//define("_WEBPHOTO_MODIFY","Modify");
//define("_WEBPHOTO_VSCOMMENTS","View/Send Comments");

//define("_WEBPHOTO_DIRECTCATSEL","SELECT A CATEGORY");
//define("_WEBPHOTO_THEREARE","There are <b>%s</b> Images in our Database.");
//define("_WEBPHOTO_LATESTLIST","Latest Listings");

//define("_WEBPHOTO_VOTEAPPRE","Your vote is appreciated.");
//define("_WEBPHOTO_THANKURATE","Thank you for taking the time to rate a photo here at %s.");
//define("_WEBPHOTO_VOTEONCE","Please do not vote for the same resource more than once.");
//define("_WEBPHOTO_RATINGSCALE","The scale is 1 - 10, with 1 being poor and 10 being excellent.");
//define("_WEBPHOTO_BEOBJECTIVE","Please be objective, if everyone receives a 1 or a 10, the ratings aren't very useful.");
//define("_WEBPHOTO_DONOTVOTE","Do not vote for your own resource.");
//define("_WEBPHOTO_RATEIT","Rate It!");

//define("_WEBPHOTO_RECEIVED","We received your Photo. Thank you!");
//define("_WEBPHOTO_ALLPENDING","All photos are posted pending verification.");

//define("_WEBPHOTO_RANK","Rank");
//define("_WEBPHOTO_SUBCATEGORY","Sub-category");
//define("_WEBPHOTO_HITS","Hits");
//define("_WEBPHOTO_RATING","Rating");
//define("_WEBPHOTO_VOTE","Vote");
//define("_WEBPHOTO_TOP10","%s Top 10"); // %s is a photo category title

//define("_WEBPHOTO_SORTBY","Sort by:");
//define("_WEBPHOTO_TITLE","Title");
//define("_WEBPHOTO_DATE","Date");
//define("_WEBPHOTO_POPULARITY","Popularity");
//define("_WEBPHOTO_CURSORTEDBY","Photos currently sorted by: %s");
//define("_WEBPHOTO_FOUNDIN","Found in:");
//define("_WEBPHOTO_PREVIOUS","Previous");
//define("_WEBPHOTO_NEXT","Next");
//define("_WEBPHOTO_NOMATCH","No photo matches your request");

//define("_WEBPHOTO_CATEGORIES","Categories");
//define("_WEBPHOTO_SUBMIT","Submit");
//define("_WEBPHOTO_CANCEL","Cancel");

//define("_WEBPHOTO_MUSTREGFIRST","Sorry, you don't have permission to perform this action.<br>Please register or login first!");
//define("_WEBPHOTO_MUSTADDCATFIRST","Sorry, there are no categories to add to yet.<br>Please create a category first!");
//define("_WEBPHOTO_NORATING","No rating selected.");
//define("_WEBPHOTO_CANTVOTEOWN","You cannot vote on the resource you submitted.<br>All votes are logged and reviewed.");
//define("_WEBPHOTO_VOTEONCE2","Vote for the selected resource only once.<br>All votes are logged and reviewed.");


//---------------------------------------------------------
// move to admin.php
//---------------------------------------------------------
//%%%%%%	Module Name 'MyAlbum' (Admin)	  %%%%%
//define("_WEBPHOTO_PHOTOSWAITING","Photos Waiting for Validation");
//define("_WEBPHOTO_PHOTOMANAGER","Photo Management");
//define("_WEBPHOTO_CATEDIT","Add, Modify, and Delete Categories");
//define("_WEBPHOTO_GROUPPERM_GLOBAL","Global Permissions");
//define("_WEBPHOTO_CHECKCONFIGS","Check Configs & Environment");
//define("_WEBPHOTO_BATCHUPLOAD","Batch Register");
//define("_WEBPHOTO_GENERALSET","Preferences");
//define("_WEBPHOTO_REDOTHUMBS2","Rebuild Thumbnails");

//define("_WEBPHOTO_DELETE","Delete");
//define("_WEBPHOTO_NOSUBMITTED","No New Submitted Photos.");
//define("_WEBPHOTO_ADDMAIN","Add a MAIN Category");
//define("_WEBPHOTO_IMGURL","Image URL (OPTIONAL Image height will be resized to 50): ");
//define("_WEBPHOTO_ADD","Add");
//define("_WEBPHOTO_ADDSUB","Add a SUB-Category");
//define("_WEBPHOTO_IN","in");
//define("_WEBPHOTO_MODCAT","Modify Category");

//define("_WEBPHOTO_MODREQDELETED","Modification Request Deleted.");
//define("_WEBPHOTO_IMGURLMAIN","Image URL (OPTIONAL and Only valid for main categories. Image height will be resized to 50): ");
//define("_WEBPHOTO_PARENT","Parent Category:");
//define("_WEBPHOTO_SAVE","Save Changes");
//define("_WEBPHOTO_CATDELETED","Category Deleted.");
//define("_WEBPHOTO_CATDEL_WARNING","WARNING: Are you sure you want to delete this Category and ALL its Photos and Comments?");
//define("_WEBPHOTO_YES","Yes");
//define("_WEBPHOTO_NO","No");
//define("_WEBPHOTO_NEWCATADDED","New Category Added Successfully!");
//define("_WEBPHOTO_ERROREXIST","ERROR: The Photo you provided is already in the database!");
//define("_WEBPHOTO_ERRORTITLE","ERROR: You need to enter a TITLE!");
//define("_WEBPHOTO_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
//define("_WEBPHOTO_WEAPPROVED","We approved your link submission to the photo database.");
//define("_WEBPHOTO_THANKSSUBMIT","Thank you for your submission!");
//define("_WEBPHOTO_CONFUPDATED","Configuration Updated Successfully!");


//---------------------------------------------------------
// move from myalbum_constants.php
//---------------------------------------------------------
// Caption
define("_WEBPHOTO_CAPTION_TOTAL" , "Total:" ) ;
define("_WEBPHOTO_CAPTION_GUESTNAME" , "Convidado" ) ;
define("_WEBPHOTO_CAPTION_REFRESH" , "Atualizar" ) ;
define("_WEBPHOTO_CAPTION_IMAGEXYT" , "Tamanho(Tipo)" ) ;
define("_WEBPHOTO_CAPTION_CATEGORY" , "Categoria" ) ;


//=========================================================
// add for webphoto
//=========================================================

//---------------------------------------------------------
// database table items
//---------------------------------------------------------

// photo table
define("_WEBPHOTO_PHOTO_TABLE" , "Tabela da Imagem" ) ;
define("_WEBPHOTO_PHOTO_ID" , "ID da Imagem" ) ;
define("_WEBPHOTO_PHOTO_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_PHOTO_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_PHOTO_CAT_ID" ,  "ID da categoria" ) ;
define("_WEBPHOTO_PHOTO_GICON_ID" , "ID do icone" ) ;
define("_WEBPHOTO_PHOTO_UID" ,   "ID do usu�rio" ) ;
define("_WEBPHOTO_PHOTO_DATETIME" ,  "Data da imagem" ) ;
define("_WEBPHOTO_PHOTO_TITLE" , "T�tulo da Imagem" ) ;
define("_WEBPHOTO_PHOTO_PLACE" , "Lugar" ) ;
define("_WEBPHOTO_PHOTO_EQUIPMENT" , "Equipamento" ) ;
define("_WEBPHOTO_PHOTO_FILE_URL" ,  "URL do arquivo" ) ;
define("_WEBPHOTO_PHOTO_FILE_PATH" , "Percurso do arquivo" ) ;
define("_WEBPHOTO_PHOTO_FILE_NAME" , "Nome do Arquivo" ) ;
define("_WEBPHOTO_PHOTO_FILE_EXT" ,  "Extens�o do arquivo" ) ;
define("_WEBPHOTO_PHOTO_FILE_MIME" ,  "MIME tipo do arquivo" ) ;
define("_WEBPHOTO_PHOTO_FILE_MEDIUM" ,  "Tipo do arquivo m�dio" ) ;
define("_WEBPHOTO_PHOTO_FILE_SIZE" , "Tamanho do arquivo" ) ;
define("_WEBPHOTO_PHOTO_CONT_URL" ,    "URL da Imagem" ) ;
define("_WEBPHOTO_PHOTO_CONT_PATH" ,   "Percurso da imagem" ) ;
define("_WEBPHOTO_PHOTO_CONT_NAME" ,   "Nome da imagem" ) ;
define("_WEBPHOTO_PHOTO_CONT_EXT" ,    "Extens�o da Imagem" ) ;
define("_WEBPHOTO_PHOTO_CONT_MIME" ,   "MIME tipo da imagem" ) ;
define("_WEBPHOTO_PHOTO_CONT_MEDIUM" , "Imagem tipo m�dia" ) ;
define("_WEBPHOTO_PHOTO_CONT_SIZE" ,   "Tamanho do arquivo da foto" ) ;
define("_WEBPHOTO_PHOTO_CONT_WIDTH" ,  "Largura da imagem" ) ;
define("_WEBPHOTO_PHOTO_CONT_HEIGHT" , "Altura da imagem" ) ;
define("_WEBPHOTO_PHOTO_CONT_DURATION" , "Tempo de dura��o do v�deo" ) ;
define("_WEBPHOTO_PHOTO_CONT_EXIF" , "Informa��o Exif" ) ;
define("_WEBPHOTO_PHOTO_MIDDLE_WIDTH" ,  "Largura da imagem m�dia" ) ;
define("_WEBPHOTO_PHOTO_MIDDLE_HEIGHT" , "Altura da imagem m�dia" ) ;
define("_WEBPHOTO_PHOTO_THUMB_URL" ,    "URL da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_PATH" ,   "Percurso da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_NAME" ,   "Nome da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_EXT" ,    "Extens�o da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_MIME" ,   "MIME tipo da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_MEDIUM" , "Tipo m�dio da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_SIZE" ,   "Tamanho do arquivo da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_WIDTH" ,  "Largura da miniatura" ) ;
define("_WEBPHOTO_PHOTO_THUMB_HEIGHT" , "Altura da miniatura" ) ;
define("_WEBPHOTO_PHOTO_GMAP_LATITUDE" ,  "Latitude no GoogleMap" ) ;
define("_WEBPHOTO_PHOTO_GMAP_LONGITUDE" , "Longitude no GoogleMap" ) ;
define("_WEBPHOTO_PHOTO_GMAP_ZOOM" ,      "Zoom do GoogleMap" ) ;
define("_WEBPHOTO_PHOTO_GMAP_TYPE" ,      "Tipo de GoogleMap" ) ;
define("_WEBPHOTO_PHOTO_PERM_READ" , "Permiss�o de leitura" ) ;
define("_WEBPHOTO_PHOTO_STATUS" ,   "Situa��o" ) ;
define("_WEBPHOTO_PHOTO_HITS" ,     "Hits" ) ;
define("_WEBPHOTO_PHOTO_RATING" ,   "Avalia��o" ) ;
define("_WEBPHOTO_PHOTO_VOTES" ,    "Votos" ) ;
define("_WEBPHOTO_PHOTO_COMMENTS" , "Coment�rio" ) ;
define("_WEBPHOTO_PHOTO_TEXT1" ,  "text1" ) ;
define("_WEBPHOTO_PHOTO_TEXT2" ,  "text2" ) ;
define("_WEBPHOTO_PHOTO_TEXT3" ,  "text3" ) ;
define("_WEBPHOTO_PHOTO_TEXT4" ,  "text4" ) ;
define("_WEBPHOTO_PHOTO_TEXT5" ,  "text5" ) ;
define("_WEBPHOTO_PHOTO_TEXT6" ,  "text6" ) ;
define("_WEBPHOTO_PHOTO_TEXT7" ,  "text7" ) ;
define("_WEBPHOTO_PHOTO_TEXT8" ,  "text8" ) ;
define("_WEBPHOTO_PHOTO_TEXT9" ,  "text9" ) ;
define("_WEBPHOTO_PHOTO_TEXT10" , "text10" ) ;
define("_WEBPHOTO_PHOTO_DESCRIPTION" ,  "Descri��o da Imagem" ) ;
define("_WEBPHOTO_PHOTO_SEARCH" ,  "Busca" ) ;

// category table
define("_WEBPHOTO_CAT_TABLE" , "Tabela da Categoria" ) ;
define("_WEBPHOTO_CAT_ID" ,          "ID da categoria" ) ;
define("_WEBPHOTO_CAT_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_CAT_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_CAT_GICON_ID" ,  "ID do �cone" ) ;
define("_WEBPHOTO_CAT_FORUM_ID" ,  "ID do forum" ) ;
define("_WEBPHOTO_CAT_PID" ,    "ID relacionado" ) ;
define("_WEBPHOTO_CAT_TITLE" ,  "T�tulo da categoria" ) ;
define("_WEBPHOTO_CAT_IMG_PATH" , "Percurso relativo para a imagem" ) ;
define("_WEBPHOTO_CAT_IMG_MODE" , "Modo de exibi��o da imagem" ) ;
define("_WEBPHOTO_CAT_ORIG_WIDTH" ,  "Lagura da imagem original" ) ;
define("_WEBPHOTO_CAT_ORIG_HEIGHT" , "Altura da imagem original" ) ;
define("_WEBPHOTO_CAT_MAIN_WIDTH" ,  "Largura da imagem na categoria proncipal" ) ;
define("_WEBPHOTO_CAT_MAIN_HEIGHT" , "Altura da imagem na categoria principal" ) ;
define("_WEBPHOTO_CAT_SUB_WIDTH" ,   "Largura da imagem na sub-categoria" ) ;
define("_WEBPHOTO_CAT_SUB_HEIGHT" ,  "Altura da imagem na sub-categoria" ) ;
define("_WEBPHOTO_CAT_WEIGHT" , "Peso" ) ;
define("_WEBPHOTO_CAT_DEPTH" ,  "Profundidade" ) ;
define("_WEBPHOTO_CAT_ALLOWED_EXT" , "Extens�es Permitidas" ) ;
define("_WEBPHOTO_CAT_ITEM_TYPE" ,      "Tipo de item" ) ;
define("_WEBPHOTO_CAT_GMAP_MODE" ,      "Modo de exibi��o no GoogleMap" ) ;
define("_WEBPHOTO_CAT_GMAP_LATITUDE" ,  "Latitude no GoogleMap" ) ;
define("_WEBPHOTO_CAT_GMAP_LONGITUDE" , "Longitude no GoogleMap" ) ;
define("_WEBPHOTO_CAT_GMAP_ZOOM" ,      "Zoom no GoogleMap" ) ;
define("_WEBPHOTO_CAT_GMAP_TYPE" ,      "Tipo no GoogleMap" ) ;
define("_WEBPHOTO_CAT_PERM_READ" , "Permiss�o de leitura" ) ;
define("_WEBPHOTO_CAT_PERM_POST" , "Permis�o de Postagem" ) ;
define("_WEBPHOTO_CAT_TEXT1" ,  "text1" ) ;
define("_WEBPHOTO_CAT_TEXT2" ,  "text2" ) ;
define("_WEBPHOTO_CAT_TEXT3" ,  "text3" ) ;
define("_WEBPHOTO_CAT_TEXT4" ,  "text4" ) ;
define("_WEBPHOTO_CAT_TEXT5" ,  "text5" ) ;
define("_WEBPHOTO_CAT_DESCRIPTION" ,  "Descri��o da Categoria" ) ;

// vote table
define("_WEBPHOTO_VOTE_TABLE" , "Tabela de Voto" ) ;
define("_WEBPHOTO_VOTE_ID" ,          "ID do voto" ) ;
define("_WEBPHOTO_VOTE_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_VOTE_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_VOTE_PHOTO_ID" , "IID da imagem" ) ;
define("_WEBPHOTO_VOTE_UID" ,      "ID do usu�rio" ) ;
define("_WEBPHOTO_VOTE_RATING" ,   "Avalia��o" ) ;
define("_WEBPHOTO_VOTE_HOSTNAME" , "Endere�o de IP" ) ;

// google icon table
define("_WEBPHOTO_GICON_TABLE" , "Tabela do icone Google" ) ;
define("_WEBPHOTO_GICON_ID" ,          "ID do �cone" ) ;
define("_WEBPHOTO_GICON_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_GICON_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_GICON_TITLE" ,     "T�tulo do �cone" ) ;
define("_WEBPHOTO_GICON_IMAGE_PATH" ,  "Percurso da imagem" ) ;
define("_WEBPHOTO_GICON_IMAGE_NAME" ,  "Nome da imagem" ) ;
define("_WEBPHOTO_GICON_IMAGE_EXT" ,   "Extntion da imagem" ) ;
define("_WEBPHOTO_GICON_SHADOW_PATH" , "Percurso da sombra" ) ;
define("_WEBPHOTO_GICON_SHADOW_NAME" , "Nome da sombra" ) ;
define("_WEBPHOTO_GICON_SHADOW_EXT" ,  "Extens�o da sombra" ) ;
define("_WEBPHOTO_GICON_IMAGE_WIDTH" ,  "Largura da imagem" ) ;
define("_WEBPHOTO_GICON_IMAGE_HEIGHT" , "Altura da imagem" ) ;
define("_WEBPHOTO_GICON_SHADOW_WIDTH" ,  "Altura da sombra" ) ;
define("_WEBPHOTO_GICON_SHADOW_HEIGHT" , "Tamanho da sombra Y" ) ;
define("_WEBPHOTO_GICON_ANCHOR_X" , "�ncora X Tamanho" ) ;
define("_WEBPHOTO_GICON_ANCHOR_Y" , "�ncora Y Tamanho" ) ;
define("_WEBPHOTO_GICON_INFO_X" , "Informa��o do tamanho da janela X" ) ;
define("_WEBPHOTO_GICON_INFO_Y" , "Informa��o do tamanho da janela Y" ) ;

// mime type table
define("_WEBPHOTO_MIME_TABLE" , "Tabela MIME Tipo" ) ;
define("_WEBPHOTO_MIME_ID" ,          "ID MIME" ) ;
define("_WEBPHOTO_MIME_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_MIME_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_MIME_EXT" ,   "Extens�o" ) ;
define("_WEBPHOTO_MIME_MEDIUM" ,  "Tipo m�dio" ) ;
define("_WEBPHOTO_MIME_TYPE" ,  "Tipo de MIME" ) ;
define("_WEBPHOTO_MIME_NAME" ,  "Nome do MIME" ) ;
define("_WEBPHOTO_MIME_PERMS" , "Permiss�o" ) ;

// added in v0.20
define("_WEBPHOTO_MIME_FFMPEG" , "Op��o ffmpeg" ) ;

// tag table
define("_WEBPHOTO_TAG_TABLE" , "Tabela de Tag" ) ;
define("_WEBPHOTO_TAG_ID" ,          "ID da Tag" ) ;
define("_WEBPHOTO_TAG_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_TAG_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_TAG_NAME" ,   "Nome da Tag" ) ;

// photo-to-tag table
define("_WEBPHOTO_P2T_TABLE" , "Tabela Rela��o Imagem Tag" ) ;
define("_WEBPHOTO_P2T_ID" ,          "ID Imagem-Tag" ) ;
define("_WEBPHOTO_P2T_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_P2T_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_P2T_PHOTO_ID" , "ID da imagem" ) ;
define("_WEBPHOTO_P2T_TAG_ID" ,   "ID da Tag" ) ;
define("_WEBPHOTO_P2T_UID" ,      "ID do usu�rio" ) ;

// synonym table
define("_WEBPHOTO_SYNO_TABLE" , "Tabela Sin�nimo" ) ;
define("_WEBPHOTO_SYNO_ID" ,          "ID do sin�nimo" ) ;
define("_WEBPHOTO_SYNO_TIME_CREATE" , "�poca da cria��o" ) ;
define("_WEBPHOTO_SYNO_TIME_UPDATE" , "�poca da atualiza��o" ) ;
define("_WEBPHOTO_SYNO_WEIGHT" , "Peso" ) ;
define("_WEBPHOTO_SYNO_KEY" , "C�digo" ) ;
define("_WEBPHOTO_SYNO_VALUE" , "Sin�nimo" ) ;


//---------------------------------------------------------
// title
//---------------------------------------------------------
define("_WEBPHOTO_TITLE_LATEST","�ltima");
define("_WEBPHOTO_TITLE_SUBMIT","Enviar");
define("_WEBPHOTO_TITLE_POPULAR","Popular");
define("_WEBPHOTO_TITLE_HIGHRATE","Melhor avaliada");
define("_WEBPHOTO_TITLE_MYPHOTO","Minhas Imagens");
define("_WEBPHOTO_TITLE_RANDOM","Imagens Aleat�rias");
define("_WEBPHOTO_TITLE_HELP","Ajuda");
define("_WEBPHOTO_TITLE_CATEGORY_LIST", "Lista de Categoria");
define("_WEBPHOTO_TITLE_TAG_LIST",  "Lista de Tag");
define("_WEBPHOTO_TITLE_TAGS",  "Tag");
define("_WEBPHOTO_TITLE_USER_LIST", "Lista de Postadas");
define("_WEBPHOTO_TITLE_DATE_LIST", "Lista da data das imagens");
define("_WEBPHOTO_TITLE_PLACE_LIST","Lista de lugares das imagens");
define("_WEBPHOTO_TITLE_RSS","RSS");

define("_WEBPHOTO_VIEWTYPE_LIST", "Tipo e Lista");
define("_WEBPHOTO_VIEWTYPE_TABLE", "Tipo de Tabela");

define("_WEBPHOTO_CATLIST_ON",   "Mostrar Categoria");
define("_WEBPHOTO_CATLIST_OFF",  "Esconder Categoria");
define("_WEBPHOTO_TAGCLOUD_ON",  "Mostrar nuvem de Tag");
define("_WEBPHOTO_TAGCLOUD_OFF", "Esconder nuvem de Tag");
define("_WEBPHOTO_GMAP_ON",  "Mostrar GoogleMap");
define("_WEBPHOTO_GMAP_OFF", "Esconder GoogleMap");

define("_WEBPHOTO_NO_TAG","N�o configurar Tag");

//---------------------------------------------------------
// google maps
//---------------------------------------------------------
define("_WEBPHOTO_TITLE_GET_LOCATION", "Configura��o da Latitude e Longitude");
define("_WEBPHOTO_GMAP_DESC", "Mostrar miniatura da imagem, quando clicar no GoogleMaps");
define("_WEBPHOTO_GMAP_ICON", "�cones do GoogleMap");
define("_WEBPHOTO_GMAP_LATITUDE", "Latitude do GoogleMap");
define("_WEBPHOTO_GMAP_LONGITUDE","Longitude do GoogleMap");
define("_WEBPHOTO_GMAP_ZOOM","Zoom do GoogleMap");
define("_WEBPHOTO_GMAP_ADDRESS",  "Endere�o");
define("_WEBPHOTO_GMAP_GET_LOCATION", "Obter latitude e longitude");
define("_WEBPHOTO_GMAP_SEARCH_LIST",  "Lista de Busca");
define("_WEBPHOTO_GMAP_CURRENT_LOCATION",  "Loca��o atual");
define("_WEBPHOTO_GMAP_CURRENT_ADDRESS",  "Endre�o atual");
define("_WEBPHOTO_GMAP_NO_MATCH_PLACE",  "N�o h� lugar correspondente");
define("_WEBPHOTO_GMAP_NOT_COMPATIBLE", "N�o mostrar o GoogleMaps em seu navegador");
define("_WEBPHOTO_JS_INVALID", "N�o use JavaScript em seu navegador");
define("_WEBPHOTO_IFRAME_NOT_SUPPORT","N�o use iframe em seu navegador");

//---------------------------------------------------------
// search
//---------------------------------------------------------
define("_WEBPHOTO_SR_SEARCH","Busca");

//---------------------------------------------------------
// popbox
//---------------------------------------------------------
define("_WEBPHOTO_POPBOX_REVERT", "Clique na imagem para reduzir o tamanho dela.");

//---------------------------------------------------------
// tag
//---------------------------------------------------------
define("_WEBPHOTO_TAGS","Tags");
define("_WEBPHOTO_EDIT_TAG","Editar Tags");
define("_WEBPHOTO_DSC_TAG_DIVID", "divida com a v�rgula(,) quando confogurar duas os mais");
define("_WEBPHOTO_DSC_TAG_EDITABLE", "Voc� pode editar somente as tags que voc� postou");

//---------------------------------------------------------
// submit form
//---------------------------------------------------------
define("_WEBPHOTO_CAP_ALLOWED_EXTS", "Extens�es permitidas");
define("_WEBPHOTO_CAP_PHOTO_SELECT","Selecione a imagem principal");
define("_WEBPHOTO_CAP_THUMB_SELECT", "Selecione a imagem miniatura");
define("_WEBPHOTO_DSC_THUMB_SELECT", "Cria da imagem principal, quando n�o selecionado");
define("_WEBPHOTO_DSC_SET_DATETIME",  "Configurar datetime da imagem");
define("_WEBPHOTO_DSC_SET_TIME_UPDATE", "Configurar hora da atualiza��o");
define("_WEBPHOTO_DSC_PIXCEL_RESIZE", "Redimensionar automaticamente se maior que este tamanho");
define("_WEBPHOTO_DSC_PIXCEL_REJECT", "N�o pode ser enviada, se maior que este temanho");
define("_WEBPHOTO_BUTTON_CLEAR", "Limpar");
define("_WEBPHOTO_SUBMIT_RESIZED", "Redimensionada, porque a imagem � grande demais ");

// PHP upload error
// http://www.php.net/manual/en/features.file-upload.errors.php
define("_WEBPHOTO_PHP_UPLOAD_ERR_OK", "N�o houve erro, o arquivo enviado com sucesso.");
define("_WEBPHOTO_PHP_UPLOAD_ERR_INI_SIZE", "O arquivo enviado excedeu o upload_max_filesize.");
define("_WEBPHOTO_PHP_UPLOAD_ERR_FORM_SIZE", "O arquivo enviado excedeu %s .");
define("_WEBPHOTO_PHP_UPLOAD_ERR_PARTIAL", "O arquivo enviado foi somente carregado parcialmente.");
define("_WEBPHOTO_PHP_UPLOAD_ERR_NO_FILE", "Nenhum arquivo foi enviado.");
define("_WEBPHOTO_PHP_UPLOAD_ERR_NO_TMP_DIR", "Pasta temporaria est� faltando.");
define("_WEBPHOTO_PHP_UPLOAD_ERR_CANT_WRITE", "Falhou a grava��o do arquivo no disco.");
define("_WEBPHOTO_PHP_UPLOAD_ERR_EXTENSION", "O arquivo enviado parou devido a estens�o.");

// upload error
define("_WEBPHOTO_UPLOADER_ERR_NOT_FOUND", "Arquivo enviado n�o encontrado");
define("_WEBPHOTO_UPLOADER_ERR_INVALID_FILE_SIZE", "Tamanho do arquivo inv�lido");
define("_WEBPHOTO_UPLOADER_ERR_EMPTY_FILE_NAME", "Nome do arquivo est� vazio");
define("_WEBPHOTO_UPLOADER_ERR_NO_FILE", "Nenhum arquivo enviado");
define("_WEBPHOTO_UPLOADER_ERR_NOT_SET_DIR", "Diret�rio do upload n�o configurado");
define("_WEBPHOTO_UPLOADER_ERR_NOT_ALLOWED_EXT", "Extens�o n�o permitida");
define("_WEBPHOTO_UPLOADER_ERR_PHP_OCCURED", "Erro ocorrido: Erro #");
define("_WEBPHOTO_UPLOADER_ERR_NOT_OPEN_DIR", "Falhou a abertura do diret�rio: ");
define("_WEBPHOTO_UPLOADER_ERR_NO_PERM_DIR", "Falhou a abertura do diret�rio com pemiss�o de escrita: ");
define("_WEBPHOTO_UPLOADER_ERR_NOT_ALLOWED_MIME", "Tipo de MIME n�o permitido: ");
define("_WEBPHOTO_UPLOADER_ERR_LARGE_FILE_SIZE", "Tamanho do arquivo muito grande: ");
define("_WEBPHOTO_UPLOADER_ERR_LARGE_WIDTH", "A largura do arquivo deve ser menor que ");
define("_WEBPHOTO_UPLOADER_ERR_LARGE_HEIGHT", "A altura do arquivo deve ser menor que");
define("_WEBPHOTO_UPLOADER_ERR_UPLOAD", "Falhou o envio do arquivo: ");

//---------------------------------------------------------
// help
//---------------------------------------------------------
define("_WEBPHOTO_HELP_DSC", "Esta � a descri��o da aplica��o que trabalha em seu PC");

define("_WEBPHOTO_HELP_PICLENS_TITLE", "PicLens");
define("_WEBPHOTO_HELP_PICLENS_DSC", '
Piclens � o complemento o qual a Cooliris Inc fornece para o FireFox<br />
Esta � uma vis�o das imagens no site<br /><br />
<b>Configura��o</b><br />
(1) Baixar FireFox<br />
<a href="http://www.mozilla-japan.org/products/firefox/" target="_blank">
http://www.mozilla-japan.org/products/firefox/
</a><br /><br />
(2) Baixar o complemento Piclens<br />
<a href="http://www.piclens.com/" target="_blank">
http://www.piclens.com/
</a><br /><br />
(3) Ver webphoto em webphoto<br />
http://THIS-SITE/modules/webphoto/ <br /><br />
(4) Clique no �cone azul no canto superior dirito do Firefox<br />
Voc� n�o pode usar o Piclens, quando o �cone � preto<br />' );

//
// dummy lines , adjusts line number for Japanese lang file.
//

define("_WEBPHOTO_HELP_MEDIARSSSLIDESHOW_TITLE", "Media RSS Slide Show");
define("_WEBPHOTO_HELP_MEDIARSSSLIDESHOW_DSC", '
"Media RSS  Slide Show" is the google desktop gadget<br />
This shows photos from the internet with the slide show<br /><br />
<b>Setting</b><br />
(1) Download "Google Desktop"<br />
<a href="http://desktop.google.co.jp/" target="_blank">
http://desktop.google.co.jp/
</a><br /><br />
(2) Download "Media RSS  Slide Show" gadget<br />
<a href="http://desktop.google.com/plugins/i/mediarssslideshow.html" target="_blank">
http://desktop.google.com/plugins/i/mediarssslideshow.html
</a><br /><br />
(3) Change "URL of MediaRSS" into the following, using the option of the gadget<br />' );

//---------------------------------------------------------
// others
//---------------------------------------------------------
define("_WEBPHOTO_RANDOM_MORE","Mais imagens Aleat�rias");
define("_WEBPHOTO_USAGE_PHOTO","Abre uma janela Pop-up com a imagem grande, quando a miniatura for clicada");
define("_WEBPHOTO_USAGE_TITLE","Move para a p�gina da imagem, quando o t�tulo da imagem for clicado");
define("_WEBPHOTO_DATE_NOT_SET","N�o configurado a data da imagem");
define("_WEBPHOTO_PLACE_NOT_SET","N�o configurado o lugar da imagem");
define("_WEBPHOTO_GOTO_ADMIN", "Ir para a o Painel Administrativo");

//---------------------------------------------------------
// search for Japanese
//---------------------------------------------------------
define("_WEBPHOTO_SR_CANDICATE","Candicate para busca");
define("_WEBPHOTO_SR_ZENKAKU","Zenkaku");
define("_WEBPHOTO_SR_HANKAKU","Hanhaku");

define("_WEBPHOTO_JA_KUTEN",   "");
define("_WEBPHOTO_JA_DOKUTEN", "");
define("_WEBPHOTO_JA_PERIOD",  "");
define("_WEBPHOTO_JA_COMMA",   "");

//---------------------------------------------------------
// v0.20
//---------------------------------------------------------
define("_WEBPHOTO_TITLE_VIDEO_THUMB_SEL", "Selecionar miniatura do v�deo");
define("_WEBPHOTO_TITLE_VIDEO_REDO","Re-criar Flash e Miniatura do v�deo enviado");
define("_WEBPHOTO_CAP_REDO_THUMB","Criar miniatura");
define("_WEBPHOTO_CAP_REDO_FLASH","Croiar v�deo Flash");
define("_WEBPHOTO_ERR_VIDEO_FLASH", "N�o criar v�deo Flash");
define("_WEBPHOTO_ERR_VIDEO_THUMB", "Substituir com o �cone, porque n�o pode criar miniatura do v�deo");
define("_WEBPHOTO_BUTTON_SELECT", "Selecionar");

define("_WEBPHOTO_DSC_DOWNLOAD_PLAY","Tocar ap�s o download");
define("_WEBPHOTO_ICON_VIDEO", "V�deo");
define("_WEBPHOTO_HOUR", "hora");
define("_WEBPHOTO_MINUTE", "min");
define("_WEBPHOTO_SECOND", "seg");

//---------------------------------------------------------
// v0.30
//---------------------------------------------------------
// user table
define("_WEBPHOTO_USER_TABLE" , "Tabela Uus�rio Aux" ) ;
define("_WEBPHOTO_USER_ID" ,          "ID do Usu�rio Aux" ) ;
define("_WEBPHOTO_USER_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_USER_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_USER_UID" , "ID do usu�rio" ) ;
define("_WEBPHOTO_USER_CAT_ID" , "Categoria do ID" ) ;
define("_WEBPHOTO_USER_EMAIL" , "Endere�o de E-mail" ) ;
define("_WEBPHOTO_USER_TEXT1" ,  "text1" ) ;
define("_WEBPHOTO_USER_TEXT2" ,  "text2" ) ;
define("_WEBPHOTO_USER_TEXT3" ,  "text3" ) ;
define("_WEBPHOTO_USER_TEXT4" ,  "text4" ) ;
define("_WEBPHOTO_USER_TEXT5" ,  "text5" ) ;

// maillog
define("_WEBPHOTO_MAILLOG_TABLE" , "Tabela do Maillog" ) ;
define("_WEBPHOTO_MAILLOG_ID" ,          "ID do Maillog" ) ;
define("_WEBPHOTO_MAILLOG_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_MAILLOG_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_MAILLOG_PHOTO_IDS" , "ID da Imagem" ) ;
define("_WEBPHOTO_MAILLOG_STATUS" , "Situa��o" ) ;
define("_WEBPHOTO_MAILLOG_FROM" , "Mail do endere�o" ) ;
define("_WEBPHOTO_MAILLOG_SUBJECT" , "Assunto" ) ;
define("_WEBPHOTO_MAILLOG_BODY" ,  "Corpo" ) ;
define("_WEBPHOTO_MAILLOG_FILE" ,  "Nome do arquivo" ) ;
define("_WEBPHOTO_MAILLOG_ATTACH" ,  "Arquivos anexados" ) ;
define("_WEBPHOTO_MAILLOG_COMMENT" ,  "Commnt�rio" ) ;

// mail register
define("_WEBPHOTO_TITLE_MAIL_REGISTER" ,  "Endere�o de E-mail do Registro" ) ;
define("_WEBPHOTO_MAIL_HELP" ,  "Por favor, consulte 'Ajuda' para uso" ) ;
define("_WEBPHOTO_CAT_USER" ,  "Nome do Usu�rio" ) ;
define("_WEBPHOTO_BUTTON_REGISTER" ,  "Registro" ) ;
define("_WEBPHOTO_NOMATCH_USER","N�o h� usu�rio");
define("_WEBPHOTO_ERR_MAIL_EMPTY","Voc~e deve informar 'Endere�o de E-mail' ");
define("_WEBPHOTO_ERR_MAIL_ILLEGAL","Formato ilegal do endere�o de e-mail");

// mail retrieve
define("_WEBPHOTO_TITLE_MAIL_RETRIEVE" ,  "Recupera E-mail" ) ;
define("_WEBPHOTO_DSC_MAIL_RETRIEVE" ,  "Recuperar e-mail do servidor de e-mails" ) ;
define("_WEBPHOTO_BUTTON_RETRIEVE" ,  "Recuperar" ) ;
define("_WEBPHOTO_SUBTITLE_MAIL_ACCESS" ,  "Acessando o servidor de e-mail" ) ;
define("_WEBPHOTO_SUBTITLE_MAIL_PARSE" ,  "Analisando os emails recebidos" ) ;
define("_WEBPHOTO_SUBTITLE_MAIL_PHOTO" ,  "Enviando imagens anexadas aos e-mails" ) ;
define("_WEBPHOTO_TEXT_MAIL_ACCESS_TIME" ,  "Limita��o no acesso" ) ;
define("_WEBPHOTO_TEXT_MAIL_RETRY"  ,  "Acesse 1 minuto mais tarde" ) ;
define("_WEBPHOTO_TEXT_MAIL_NOT_RETRIEVE" ,  "E-mail n�o pode ser recuperado.<br />Provavelmente a comunica��o temporaria falhou.<br />Por favor, retorne mais tarde" ) ;
define("_WEBPHOTO_TEXT_MAIL_NO_NEW" ,  "N�o h� um novo e-mail" ) ;
define("_WEBPHOTO_TEXT_MAIL_RETRIEVED_FMT" ,  "Recuperado %s e-mails" ) ;
define("_WEBPHOTO_TEXT_MAIL_NO_VALID" ,  "N�o h� e-mail v�lido" ) ;
define("_WEBPHOTO_TEXT_MAIL_SUBMITED_FMT" ,  "Enviado %s imagens" ) ;
define("_WEBPHOTO_GOTO_INDEX" ,  "Ir ao m�dulo topo da p�gina" ) ;

// i.php
define("_WEBPHOTO_TITLE_MAIL_POST" ,  "Postado por e-mail" ) ;

// file
define("_WEBPHOTO_TITLE_FILE" , "Adicionada imagem do arquivo" ) ;
define("_WEBPHOTO_CAP_FILE_SELECT", "Selecionar arquivo");
define("_WEBPHOTO_ERR_EMPTY_FILE" , "Voc� deve selecionar o arquivo" ) ;
define("_WEBPHOTO_ERR_EMPTY_CAT" , "Voc� deve selecionar a categoria" ) ;
define("_WEBPHOTO_ERR_INVALID_CAT" , "Categoria Inv�lida" ) ;
define("_WEBPHOTO_ERR_CREATE_PHOTO" , "Imagem n�o pode ser criada" ) ;
define("_WEBPHOTO_ERR_CREATE_THUMB" , "Miniatura da imagem n�o pode ser criada" ) ;

// help
define("_WEBPHOTO_HELP_MUST_LOGIN","Por favor, efetue seu login caso deseje saber mais detalhes");
define("_WEBPHOTO_HELP_NOT_PERM", "Voc� n�o tem permiss�o. Por favor contate com o Webmaster");

define("_WEBPHOTO_HELP_MOBILE_TITLE", "Celular");
define("_WEBPHOTO_HELP_MOBILE_DSC", "Voc� pode ver a imagem e o v�deo no celular<br/>o tamanho da tela � de aproximadamente 240x320 ");
define("_WEBPHOTO_HELP_MOBILE_TEXT_FMT", '
<b>URL de Acesso</b><br />
<a href="{MODULE_URL}/i.php" target="_blank">{MODULE_URL}/i.php</a>');

define("_WEBPHOTO_HELP_MAIL_TITLE", "E-mail do celular");
define("_WEBPHOTO_HELP_MAIL_DSC", "Voc� pode postar a imagem e o v�deo por e-mail de seu telefone celular");
define("_WEBPHOTO_HELP_MAIL_GUEST", "Este � um exemplo. Voc� pode ver o endere�o REAL do e-mail, se tiver permiss�o.");

define("_WEBPHOTO_HELP_FILE_TITLE", "Enviar por FTP");
define("_WEBPHOTO_HELP_FILE_DSC", "Voc� pode enviar a imagem tamanho grande e o v�deo, quando voc� envia o arquivo por FTP");
define("_WEBPHOTO_HELP_FILE_TEXT_FMT", '
<b>Enviar Imagem</b><br />
(1) Enviar o arquivo pelo servidor FTP<br />
(2) Clique <a href="{MODULE_URL}/index.php?fct=submit_file" target="_blank">Adicionar imagem do arquivo</a><br />
(3) Selecione o arquivo enviado e postado' );

// mail check
// for Japanese
define("_WEBPHOTO_MAIL_DENY_TITLE_PREG", "" ) ;
define("_WEBPHOTO_MAIL_AD_WORD_1", "" ) ;
define("_WEBPHOTO_MAIL_AD_WORD_2", "" ) ;

//---------------------------------------------------------
// v0.40
//---------------------------------------------------------
// item table
define("_WEBPHOTO_ITEM_TABLE" , "Tabela Item" ) ;
define("_WEBPHOTO_ITEM_ID" , "ID do Item" ) ;
define("_WEBPHOTO_ITEM_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_ITEM_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_ITEM_CAT_ID" ,  "ID da categoria" ) ;
define("_WEBPHOTO_ITEM_GICON_ID" , "ID do icone GoogleMap" ) ;
define("_WEBPHOTO_ITEM_UID" ,   "ID do usu�rio" ) ;
define("_WEBPHOTO_ITEM_KIND" , "Tipo de arquivo" ) ;
define("_WEBPHOTO_ITEM_EXT" ,  "Extens�o do arquivo" ) ;
define("_WEBPHOTO_ITEM_DATETIME" ,  "Datetime da imagem" ) ;
define("_WEBPHOTO_ITEM_TITLE" , "T�tulo da imagem" ) ;
define("_WEBPHOTO_ITEM_PLACE" , "Lugar" ) ;
define("_WEBPHOTO_ITEM_EQUIPMENT" , "Equipamento" ) ;
define("_WEBPHOTO_ITEM_GMAP_LATITUDE" ,  "Latitude do GoogleMap" ) ;
define("_WEBPHOTO_ITEM_GMAP_LONGITUDE" , "Longitude no GoogleMap" ) ;
define("_WEBPHOTO_ITEM_GMAP_ZOOM" ,      "Zoom no GoogleMap" ) ;
define("_WEBPHOTO_ITEM_GMAP_TYPE" ,      "Tipo no GoogleMap" ) ;
define("_WEBPHOTO_ITEM_PERM_READ" , "Permiss�o de leitura" ) ;
define("_WEBPHOTO_ITEM_STATUS" ,   "Situa��o" ) ;
define("_WEBPHOTO_ITEM_HITS" ,     "Hits" ) ;
define("_WEBPHOTO_ITEM_RATING" ,   "Avalia��o" ) ;
define("_WEBPHOTO_ITEM_VOTES" ,    "Votos" ) ;
define("_WEBPHOTO_ITEM_DESCRIPTION" ,  "Descri��o da imagem" ) ;
define("_WEBPHOTO_ITEM_EXIF" , "Informa��o Exif" ) ;
define("_WEBPHOTO_ITEM_SEARCH" ,  "Busca" ) ;
define("_WEBPHOTO_ITEM_COMMENTS" , "Coment�rios" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_1" ,  "ID do arquivo: Conte�do" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_2" ,  "ID do arquivo: Miniatura" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_3" ,  "ID do arquivo: M�dio" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_4" ,  "ID do arquivo: V�deo Flash" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_5" ,  "ID do arquivo: V�deo Docomo" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_6" ,  "file6" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_7" ,  "file7" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_8" ,  "file8" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_9" ,  "file9" ) ;
define("_WEBPHOTO_ITEM_FILE_ID_10" , "file10" ) ;
define("_WEBPHOTO_ITEM_TEXT_1" ,  "text1" ) ;
define("_WEBPHOTO_ITEM_TEXT_2" ,  "text2" ) ;
define("_WEBPHOTO_ITEM_TEXT_3" ,  "text3" ) ;
define("_WEBPHOTO_ITEM_TEXT_4" ,  "text4" ) ;
define("_WEBPHOTO_ITEM_TEXT_5" ,  "text5" ) ;
define("_WEBPHOTO_ITEM_TEXT_6" ,  "text6" ) ;
define("_WEBPHOTO_ITEM_TEXT_7" ,  "text7" ) ;
define("_WEBPHOTO_ITEM_TEXT_8" ,  "text8" ) ;
define("_WEBPHOTO_ITEM_TEXT_9" ,  "text9" ) ;
define("_WEBPHOTO_ITEM_TEXT_10" , "text10" ) ;

// file table
define("_WEBPHOTO_FILE_TABLE" , "Tabela Arquivo" ) ;
define("_WEBPHOTO_FILE_ID" , "ID do arquivo" ) ;
define("_WEBPHOTO_FILE_TIME_CREATE" , "Hora da cria��o" ) ;
define("_WEBPHOTO_FILE_TIME_UPDATE" , "Hora da atualiza��o" ) ;
define("_WEBPHOTO_FILE_ITEM_ID" ,  "ID do item" ) ;
define("_WEBPHOTO_FILE_KIND" , "Tipo de arquivo" ) ;
define("_WEBPHOTO_FILE_URL" ,    "URL" ) ;
define("_WEBPHOTO_FILE_PATH" ,   "Percurso do arquivo" ) ;
define("_WEBPHOTO_FILE_NAME" ,   "Nome do arquivo" ) ;
define("_WEBPHOTO_FILE_EXT" ,    "Extens�o do arquivo" ) ;
define("_WEBPHOTO_FILE_MIME" ,   "Tipo de MIME" ) ;
define("_WEBPHOTO_FILE_MEDIUM" , "Tipo m�dio" ) ;
define("_WEBPHOTO_FILE_SIZE" ,   "Tamanho do arquivo" ) ;
define("_WEBPHOTO_FILE_WIDTH" ,  "Largura da imagem" ) ;
define("_WEBPHOTO_FILE_HEIGHT" , "Altura da imagem" ) ;
define("_WEBPHOTO_FILE_DURATION" , "Tempo de dura��o do v�deo" ) ;

// file kind ( for admin checktables )
define("_WEBPHOTO_FILE_KIND_1" ,  "Conte�do" ) ;
define("_WEBPHOTO_FILE_KIND_2" ,  "Miniatura" ) ;
define("_WEBPHOTO_FILE_KIND_3" ,  "M�dio" ) ;
define("_WEBPHOTO_FILE_KIND_4" ,  "V�deo Flash" ) ;
define("_WEBPHOTO_FILE_KIND_5" ,  "V�deo Docomo" ) ;
define("_WEBPHOTO_FILE_KIND_6" ,  "file6" ) ;
define("_WEBPHOTO_FILE_KIND_7" ,  "file7" ) ;
define("_WEBPHOTO_FILE_KIND_8" ,  "file8" ) ;
define("_WEBPHOTO_FILE_KIND_9" ,  "file9" ) ;
define("_WEBPHOTO_FILE_KIND_10" , "file10" ) ;

// index
define("_WEBPHOTO_MOBILE_MAILTO" , "Enviar URL para o celular" ) ;

// i.php
define("_WEBPHOTO_TITLE_MAIL_JUDGE" ,  "Juiz da operadora do celular" ) ;
define("_WEBPHOTO_MAIL_MODEL", "Operadora do celular" ) ;
define("_WEBPHOTO_MAIL_BROWSER", "Navegador WEB" ) ;
define("_WEBPHOTO_MAIL_NOT_JUDGE", "N�o foi poss�vel julgar a operadora do celular" ) ;
define("_WEBPHOTO_MAIL_TO_WEBMASTER", "E-mail para o webmaster" ) ;

// help
define("_WEBPHOTO_HELP_MAIL_POST_FMT", '
<b>Preparar</b><br />
Registre o endere�o de e-mail do celular<br />
<a href="{MODULE_URL}/index.php?fct=mail_register" target="_blank">Registrar o endere�o de e-mail</a><br /><br />
<b>Enviar Imagem</b><br />
Enviar e-mail para o seguinte endere�o com o arquivo da imagem anexo.<br />
<a href="mailto:{MAIL_ADDR}">{MAIL_ADDR}</a> {MAIL_GUEST} <br /><br />
<b>Rota��o da Imagem</b><br />
Voc� pode girar a imagem para a direita ou esquerda, desde que voc� informe o fim do "Assunto" como segue<br />
 R@ : girar a direita <br />
 L@ : girar a esquerda <br /><br />' );
define("_WEBPHOTO_HELP_MAIL_SUBTITLE_RETRIEVE", "<b>Recuperar e-mail e enviar imagem</b><br />" );
define("_WEBPHOTO_HELP_MAIL_RETRIEVE_FMT", '
Clique<a href="{MODULE_URL}/i.php?op=post" target="_blank">Enviar por e-mai</a>, depois de alguns segundos envie e-mail.<br />
Webphoto recuperou o e-mail para o qual voc� enviou, submeter e mostrar a imagem anexa<br />' );
define("_WEBPHOTO_HELP_MAIL_RETRIEVE_TEXT", "Webphoto recuperou o e-mail para o qual voc� enviou, submeter e mostrar a imagem anexa<br />" );
define("_WEBPHOTO_HELP_MAIL_RETRIEVE_AUTO_FMT", '
O e-mail � enviado automaticamente %s segundos mais tarde, quando voc� envia e-mail.<br />
Por favor, clique <a href="{MODULE_URL}/i.php?op=post" target="_blank">Postar por e-mail</a>, se n�o enviada.<br />' );

// === define end ===
}

?>
