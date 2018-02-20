<?php
// $Id: admin.php,v 1.7 2003/03/05 05:56:22 w4z004 Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MDEX_A_FORUMCONF","Configuração do fórum");
define("_MDEX_A_ADDAFORUM","Criar um fórum");
define("_MDEX_A_LINK2ADDFORUM","Este link permite que você crie um fórum no banco de dados.");
define("_MDEX_A_EDITAFORUM","Editar fórum");
define("_MDEX_A_LINK2EDITFORUM","Este link permite que você edite um forum existente.");
define("_MDEX_A_SETPRIVFORUM","Permissões privadas do Fórum");
define("_MDEX_A_LINK2SETPRIV","Este link permite que você ajuste o acesso a um forum privado existente.");
define("_MDEX_A_SYNCFORUM","Sincronizar Fórums e Tópicos");
define("_MDEX_A_LINK2SYNC","Este link permite que você sincronize os indices acima do fórum e do tópico");
define("_MDEX_A_ADDACAT","Criar categoria");
define("_MDEX_A_LINK2ADDCAT","Este link permite que você adicione uma categoria nova para o fórum.");
define("_MDEX_A_EDITCATTTL","Editar titulo da categoria");
define("_MDEX_A_LINK2EDITCAT","Este link permite editar o título de uma categoria.");
define("_MDEX_A_RMVACAT","Apagar categoria");
define("_MDEX_A_LINK2RMVCAT","Este link permite remover categorias do banco de dados");
define("_MDEX_A_REORDERCAT","Reordenar Categorias");
define("_MDEX_A_LINK2ORDERCAT","Este link permitirá que você mude a ordem em que suas categorias indicam no índice da pagina");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MDEX_A_FORUMUPDATED","Fórum atualizado");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF","Contudo o(s) moderador(es) selecionado(s) não foram removidos, pois se eles fossem removidos não haveria mais nenhum moderador neste fórum.");
define("_MDEX_A_FORUMREMOVED","Fórum Removido.");
define("_MDEX_A_FRFDAWAIP","Forum removido da base de dados junto com todas suas mensagens.");
define("_MDEX_A_NOSUCHFORUM","Nenhum fórum");
define("_MDEX_A_EDITTHISFORUM","Editar este fórum");
define("_MDEX_A_DTFTWARAPITF","Apagar fórum (Serão removidos: o fórum e todas as suas mensagens.<br><br>ATENÇÃO: Você tem certeza que quer excluir este Fórum?)");
define("_MDEX_A_FORUMNAME","Nome do Fórum:");
define("_MDEX_A_FORUMDESCRIPTION","Descrição do Fórum:");
define("_MDEX_A_MODERATOR","Moderador(es):");
define("_MDEX_A_REMOVE","Apagar");
define("_MDEX_A_NOMODERATORASSIGNED","Não foi designado nenhum moderador");
define("_MDEX_A_NONE","Nenhum");
define("_MDEX_A_CATEGORY","Categoria:");
define("_MDEX_A_ANONYMOUSPOST","Visitantes");
define("_MDEX_A_REGISTERUSERONLY","Somente usuários registrados");
define("_MDEX_A_MODERATORANDADMINONLY","Somente Moderadores/Administradores");
define("_MDEX_A_TYPE","Tipo:");
define("_MDEX_A_PUBLIC","Público");
define("_MDEX_A_PRIVATE","Privado");
define("_MDEX_A_SELECTFORUMEDIT","Selecione o Fórum a ser editado");
define("_MDEX_A_NOFORUMINDATABASE","Não há fóruns no banco de dados");
define("_MDEX_A_DATABASEERROR","Erro no Banco de Dados");
define("_MDEX_A_EDIT","Editar");
define("_MDEX_A_CATEGORYUPDATED","Atualizar Categoria.");
define("_MDEX_A_EDITCATEGORY","Editar categoria:");
define("_MDEX_A_CATEGORYTITLE","Titulo da categoria:");
define("_MDEX_A_SELECTACATEGORYEDIT","Selecione a categoria a ser editada");
define("_MDEX_A_CATEGORYCREATED","Criar categoria.");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS","Nota: Isto NÃO irá excluir os fóruns desta categoria, para isso você deverá usar o Gerenciador de Fóruns.<br /><br />ATENÇÃO: Você tem certeza que quer excluir esta categoria?.");
define("_MDEX_A_REMOVECATEGORY","Apagar Categoria");
define("_MDEX_A_CREATENEWCATEGORY","Criar nova categoria");
define("_MDEX_A_YDNFOATPOTFDYAA","Você não preencheu todas as partes do formulario.<br>Você atribuiu pelo menos um moderador? Por favor corrija o formulário.");
define("_MDEX_A_FORUMCREATED","Fórum Criado.");
define("_MDEX_A_VTFYJC","Exibir o fórum criado.");
define("_MDEX_A_EYMAACBYAF","Erro: você deve adicionar uma categoria antes de adicionar forums");
define("_MDEX_A_CREATENEWFORUM","Criar um novo fórum");
define("_MDEX_A_ACCESSLEVEL","Nível de Acesso:");
define("_MDEX_A_CATEGORYMOVEUP","Mover categoria para cima");
define("_MDEX_A_TCIATHU","Esta é a categoria a mais elevada.");
define("_MDEX_A_CATEGORYMOVEDOWN","Mover categoria para baixo");
define("_MDEX_A_TCIATLD","Esta é a categoria a mais baixa.");
define("_MDEX_A_SETCATEGORYORDER","Ordem da Categoria");
define("_MDEX_A_TODHITOTCWDOTIP","A ordem exibida aqui será a ordem das categorias que será exibida no Índice do Fórum. Para mover uma categoria p/ cima, clique em Mover Para Cima; para mover p/baixo cliquem em Mover para Baixo.");
define("_MDEX_A_ECWMTCPUODITO","Cada clique moverá o lugar da categoria 1 para cima ou para baixo em ordem.");
define("_MDEX_A_CATEGORY1","Categoria");
define("_MDEX_A_MOVEUP","Mover para cima");
define("_MDEX_A_MOVEDOWN","Mover para baixo");


define("_MDEX_A_FORUMUPDATE","Configuracão atualização fórum");
define("_MDEX_A_RETURNTOADMINPANEL","Retornar ao painel de Administração.");
define("_MDEX_A_RETURNTOFORUMINDEX","Retornar ao índice de fóruns");
define("_MDEX_A_ALLOWHTML","Permite HTML:");
define("_MDEX_A_YES","Sim");
define("_MDEX_A_NO","Não");
define("_MDEX_A_ALLOWSIGNATURES","Permitir Assinaturas:");
define("_MDEX_A_HOTTOPICTHRESHOLD","Número de posts para ser popular:");
define("_MDEX_A_POSTPERPAGE","Mensagens por Página:");
define("_MDEX_A_TITNOPPTTWBDPPOT","(Número de mensagens por tópico que será exposto por página de um tópico)");
define("_MDEX_A_TOPICPERFORUM","Tópicos por Fórum:");
define("_MDEX_A_TITNOTPFTWBDPPOAF","(Número de tópicos por fórum que será exposto por página de um fórum)");
define("_MDEX_A_SAVECHANGES","Salvar Mudanças");
define("_MDEX_A_CLEAR","Limpar");
define("_MDEX_A_CLICKBELOWSYNC","Clicando no botão abaixo irá sincronizar seus fóruns e tópicos com os dados corretos do banco de dados. Use esta seção se voce notar falhas nos tópicos e na lista de fóruns.");
define("_MDEX_A_SYNCHING","Sincronizando índice de fórum e tópicos (Isto pode levar tempo)");
define("_MDEX_A_DONESYNC","Feito!");
define("_MDEX_A_CATEGORYDELETED","Categoria apagada.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MDEX_A_SAFTE","Seleciona o Fórum para Editar");
define("_MDEX_A_NFID","Nenhum Foórum no Banco de Dados");
define("_MDEX_A_EFPF","Edição de Permissões de Fórum para: <b>%s</b>");
define("_MDEX_A_UWA","Usuários Com Acesso:");
define("_MDEX_A_UWOA","Usuários Sem Acesso:");
define("_MDEX_A_ADDUSERS","Adicionar Usuários -->");
define("_MDEX_A_CLEARALLUSERS","Limpar todos os usuários");
define("_MDEX_A_REVOKEPOSTING","remover mensagens");
define("_MDEX_A_GRANTPOSTING","garantir mensagens");

// Ajouts Hervé
define("_MDEX_A_SHOWNAME","Substitua o nome de usuário pelo verdadeiro nome");
define("_MDEX_A_SHOWICONSPANEL","Mostrar Painel de Ícones");
define("_MDEX_A_SHOWSMILIESPANEL","Mostrar Painel de Smilies");
define("_MDEX_A_EDITPERMS","Permissões");
define("_MDEX_A_CURRENT","Corrente");
define("_MDEX_A_ADD","Adicionar");
define("_MDEX_A_SHOWMSGPAGINATION","mostrar paginação de mensagens em blocos");
define("_MDEX_A_CANPOST","Postagem permitida");
define("_MDEX_A_CANTPOST","Postagem negada");

// Ajout 1.5
define("_MDEX_A_ALLOW_UPLOAD", "Allow files to be uploaded");
?>