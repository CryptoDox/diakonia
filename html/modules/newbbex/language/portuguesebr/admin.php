<?php
// $Id: admin.php,v 1.7 2003/03/05 05:56:22 w4z004 Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MDEX_A_FORUMCONF","Configura��o do f�rum");
define("_MDEX_A_ADDAFORUM","Criar um f�rum");
define("_MDEX_A_LINK2ADDFORUM","Este link permite que voc� crie um f�rum no banco de dados.");
define("_MDEX_A_EDITAFORUM","Editar f�rum");
define("_MDEX_A_LINK2EDITFORUM","Este link permite que voc� edite um forum existente.");
define("_MDEX_A_SETPRIVFORUM","Permiss�es privadas do F�rum");
define("_MDEX_A_LINK2SETPRIV","Este link permite que voc� ajuste o acesso a um forum privado existente.");
define("_MDEX_A_SYNCFORUM","Sincronizar F�rums e T�picos");
define("_MDEX_A_LINK2SYNC","Este link permite que voc� sincronize os indices acima do f�rum e do t�pico");
define("_MDEX_A_ADDACAT","Criar categoria");
define("_MDEX_A_LINK2ADDCAT","Este link permite que voc� adicione uma categoria nova para o f�rum.");
define("_MDEX_A_EDITCATTTL","Editar titulo da categoria");
define("_MDEX_A_LINK2EDITCAT","Este link permite editar o t�tulo de uma categoria.");
define("_MDEX_A_RMVACAT","Apagar categoria");
define("_MDEX_A_LINK2RMVCAT","Este link permite remover categorias do banco de dados");
define("_MDEX_A_REORDERCAT","Reordenar Categorias");
define("_MDEX_A_LINK2ORDERCAT","Este link permitir� que voc� mude a ordem em que suas categorias indicam no �ndice da pagina");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MDEX_A_FORUMUPDATED","F�rum atualizado");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF","Contudo o(s) moderador(es) selecionado(s) n�o foram removidos, pois se eles fossem removidos n�o haveria mais nenhum moderador neste f�rum.");
define("_MDEX_A_FORUMREMOVED","F�rum Removido.");
define("_MDEX_A_FRFDAWAIP","Forum removido da base de dados junto com todas suas mensagens.");
define("_MDEX_A_NOSUCHFORUM","Nenhum f�rum");
define("_MDEX_A_EDITTHISFORUM","Editar este f�rum");
define("_MDEX_A_DTFTWARAPITF","Apagar f�rum (Ser�o removidos: o f�rum e todas as suas mensagens.<br><br>ATEN��O: Voc� tem certeza que quer excluir este F�rum?)");
define("_MDEX_A_FORUMNAME","Nome do F�rum:");
define("_MDEX_A_FORUMDESCRIPTION","Descri��o do F�rum:");
define("_MDEX_A_MODERATOR","Moderador(es):");
define("_MDEX_A_REMOVE","Apagar");
define("_MDEX_A_NOMODERATORASSIGNED","N�o foi designado nenhum moderador");
define("_MDEX_A_NONE","Nenhum");
define("_MDEX_A_CATEGORY","Categoria:");
define("_MDEX_A_ANONYMOUSPOST","Visitantes");
define("_MDEX_A_REGISTERUSERONLY","Somente usu�rios registrados");
define("_MDEX_A_MODERATORANDADMINONLY","Somente Moderadores/Administradores");
define("_MDEX_A_TYPE","Tipo:");
define("_MDEX_A_PUBLIC","P�blico");
define("_MDEX_A_PRIVATE","Privado");
define("_MDEX_A_SELECTFORUMEDIT","Selecione o F�rum a ser editado");
define("_MDEX_A_NOFORUMINDATABASE","N�o h� f�runs no banco de dados");
define("_MDEX_A_DATABASEERROR","Erro no Banco de Dados");
define("_MDEX_A_EDIT","Editar");
define("_MDEX_A_CATEGORYUPDATED","Atualizar Categoria.");
define("_MDEX_A_EDITCATEGORY","Editar categoria:");
define("_MDEX_A_CATEGORYTITLE","Titulo da categoria:");
define("_MDEX_A_SELECTACATEGORYEDIT","Selecione a categoria a ser editada");
define("_MDEX_A_CATEGORYCREATED","Criar categoria.");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS","Nota: Isto N�O ir� excluir os f�runs desta categoria, para isso voc� dever� usar o Gerenciador de F�runs.<br /><br />ATEN��O: Voc� tem certeza que quer excluir esta categoria?.");
define("_MDEX_A_REMOVECATEGORY","Apagar Categoria");
define("_MDEX_A_CREATENEWCATEGORY","Criar nova categoria");
define("_MDEX_A_YDNFOATPOTFDYAA","Voc� n�o preencheu todas as partes do formulario.<br>Voc� atribuiu pelo menos um moderador? Por favor corrija o formul�rio.");
define("_MDEX_A_FORUMCREATED","F�rum Criado.");
define("_MDEX_A_VTFYJC","Exibir o f�rum criado.");
define("_MDEX_A_EYMAACBYAF","Erro: voc� deve adicionar uma categoria antes de adicionar forums");
define("_MDEX_A_CREATENEWFORUM","Criar um novo f�rum");
define("_MDEX_A_ACCESSLEVEL","N�vel de Acesso:");
define("_MDEX_A_CATEGORYMOVEUP","Mover categoria para cima");
define("_MDEX_A_TCIATHU","Esta � a categoria a mais elevada.");
define("_MDEX_A_CATEGORYMOVEDOWN","Mover categoria para baixo");
define("_MDEX_A_TCIATLD","Esta � a categoria a mais baixa.");
define("_MDEX_A_SETCATEGORYORDER","Ordem da Categoria");
define("_MDEX_A_TODHITOTCWDOTIP","A ordem exibida aqui ser� a ordem das categorias que ser� exibida no �ndice do F�rum. Para mover uma categoria p/ cima, clique em Mover Para Cima; para mover p/baixo cliquem em Mover para Baixo.");
define("_MDEX_A_ECWMTCPUODITO","Cada clique mover� o lugar da categoria 1 para cima ou para baixo em ordem.");
define("_MDEX_A_CATEGORY1","Categoria");
define("_MDEX_A_MOVEUP","Mover para cima");
define("_MDEX_A_MOVEDOWN","Mover para baixo");


define("_MDEX_A_FORUMUPDATE","Configurac�o atualiza��o f�rum");
define("_MDEX_A_RETURNTOADMINPANEL","Retornar ao painel de Administra��o.");
define("_MDEX_A_RETURNTOFORUMINDEX","Retornar ao �ndice de f�runs");
define("_MDEX_A_ALLOWHTML","Permite HTML:");
define("_MDEX_A_YES","Sim");
define("_MDEX_A_NO","N�o");
define("_MDEX_A_ALLOWSIGNATURES","Permitir Assinaturas:");
define("_MDEX_A_HOTTOPICTHRESHOLD","N�mero de posts para ser popular:");
define("_MDEX_A_POSTPERPAGE","Mensagens por P�gina:");
define("_MDEX_A_TITNOPPTTWBDPPOT","(N�mero de mensagens por t�pico que ser� exposto por p�gina de um t�pico)");
define("_MDEX_A_TOPICPERFORUM","T�picos por F�rum:");
define("_MDEX_A_TITNOTPFTWBDPPOAF","(N�mero de t�picos por f�rum que ser� exposto por p�gina de um f�rum)");
define("_MDEX_A_SAVECHANGES","Salvar Mudan�as");
define("_MDEX_A_CLEAR","Limpar");
define("_MDEX_A_CLICKBELOWSYNC","Clicando no bot�o abaixo ir� sincronizar seus f�runs e t�picos com os dados corretos do banco de dados. Use esta se��o se voce notar falhas nos t�picos e na lista de f�runs.");
define("_MDEX_A_SYNCHING","Sincronizando �ndice de f�rum e t�picos (Isto pode levar tempo)");
define("_MDEX_A_DONESYNC","Feito!");
define("_MDEX_A_CATEGORYDELETED","Categoria apagada.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MDEX_A_SAFTE","Seleciona o F�rum para Editar");
define("_MDEX_A_NFID","Nenhum Fo�rum no Banco de Dados");
define("_MDEX_A_EFPF","Edi��o de Permiss�es de F�rum para: <b>%s</b>");
define("_MDEX_A_UWA","Usu�rios Com Acesso:");
define("_MDEX_A_UWOA","Usu�rios Sem Acesso:");
define("_MDEX_A_ADDUSERS","Adicionar Usu�rios -->");
define("_MDEX_A_CLEARALLUSERS","Limpar todos os usu�rios");
define("_MDEX_A_REVOKEPOSTING","remover mensagens");
define("_MDEX_A_GRANTPOSTING","garantir mensagens");

// Ajouts Herv�
define("_MDEX_A_SHOWNAME","Substitua o nome de usu�rio pelo verdadeiro nome");
define("_MDEX_A_SHOWICONSPANEL","Mostrar Painel de �cones");
define("_MDEX_A_SHOWSMILIESPANEL","Mostrar Painel de Smilies");
define("_MDEX_A_EDITPERMS","Permiss�es");
define("_MDEX_A_CURRENT","Corrente");
define("_MDEX_A_ADD","Adicionar");
define("_MDEX_A_SHOWMSGPAGINATION","mostrar pagina��o de mensagens em blocos");
define("_MDEX_A_CANPOST","Postagem permitida");
define("_MDEX_A_CANTPOST","Postagem negada");

// Ajout 1.5
define("_MDEX_A_ALLOW_UPLOAD", "Allow files to be uploaded");
?>